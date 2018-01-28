<?php
/**
* @version 1.0.0
* @package RSEvents!Pro 1.0.0
* @copyright (C) 2012 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

class modRseventsProCalendar {

	public static function getEvents($params) {
		$db			= JFactory::getDbo();
		$user		= JFactory::getUser();
		$jinput		= JFactory::getApplication()->input;
		$categories	= $params->get('categories','');
		$locations	= $params->get('locations','');
		$tags		= $params->get('tags','');
		$order		= $params->get('ordering','start');
		$direction	= $params->get('order','DESC');
		$archived	= (int) $params->get('archived',0);
		$list		= $params->get('list','all');
		$days		= (int) $params->get('days',0);
		$full		= (int) $params->get('full',1);
		$where		= array();
		
		// Start Legacy
		$uevents	= (int) $params->get('userevents',0);
		if ($uevents) $list = 'user';
		// End Legacy
		
		$query  = 'SELECT '.$db->qn('e.id').', '.$db->qn('e.name').', '.$db->qn('e.start').', '.$db->qn('e.end').', '.$db->qn('e.allday').' FROM '.$db->qn('#__rseventspro_events','e').' WHERE '.$db->qn('e.completed').' = 1 ';
		
		$now = rseventsproHelper::date('now',null,false,true);
		$now->setTZByID($now->getTZID());
		$now->convertTZ(new RSDate_Timezone('GMT'));
		
		$month		= $jinput->getInt('month',(int) $now->formatLikeDate('m'));
		$year		= $jinput->getInt('year',(int) $now->formatLikeDate('Y'));
		
		if (strlen($month) == 1) $month = '0'.$month;
		
		$Calc		= new RSDate_Calc();
		$startMonth	= rseventsproHelper::date($year.'-'.$month.'-01 00:00:00',null,false,true);
		$startMonth->setTZByID($startMonth->getTZID());
		$startMonth->convertTZ(new RSDate_Timezone('GMT'));
		
		$month_start_day	= $startMonth->formatLikeDate('w');
		$weekstart			= $params->get('startday',1);
		$weekdays			= modRseventsProCalendar::getWeekdays($weekstart);
		
		$prevDays = 0;
		if ($month_start_day != $weekstart) {
			foreach ($weekdays as $position)
				if ($position == $month_start_day)
					break;
				else
					$prevDays++;
		}
		
		if ($prevDays)
			$startMonth->subtractSeconds($prevDays * 86400);
		
		$endofmonth = $Calc->endOfMonth($month,$year);
		$endMonth	= rseventsproHelper::date($endofmonth,null,false,true);
		$endMonth->setTZByID($endMonth->getTZID());
		$endMonth->convertTZ(new RSDate_Timezone('GMT'));
		
		$weekend	= modRseventsProCalendar::getWeekdays($weekstart,true);
		$day		= $endMonth->formatLikeDate('w');
		
		$k = 1;
		$nextDays = 0;
		if ($day != $weekend) {
			while($day != $weekend) {
				$nextmonth = $month+1 > 12 ? ($month+1)-12 : $month+1;
				$nextyear  = $month+1 > 12 ? $year+1 : $year;
				
				if (strlen($nextmonth) == 1)
					$nextmonth = '0'.$nextmonth;
				
				$cday = $k;
				if (strlen($cday) == 1)
					$cday = '0'.$cday;
				
				$nmunixdate = rseventsproHelper::date($nextyear.'-'.$nextmonth.'-'.$cday.' 00:00:00',null,false,true);
				$nmunixdate->setTZByID($nmunixdate->getTZID());
				$nmunixdate->convertTZ(new RSDate_Timezone('GMT'));
				
				$day = $nmunixdate->formatLikeDate('w');
				
				$k++;
				$nextDays++;
			}
		}
		
		if ($nextDays)
			$endMonth->addSeconds($nextDays * 86400);
		$endMonth->addSeconds(86399);
		
		$startMonth = $startMonth->formatLikeDate('Y-m-d H:i:s');
		$endMonth = $endMonth->formatLikeDate('Y-m-d H:i:s');
		
		$includeCalendar = modRseventsProCalendar::_getAllDayEvents('calendar', $params,  $startMonth, $endMonth);
			
		if (!empty($includeCalendar)) {
			$query .= ' AND (('.$db->qn('e.end').' <> '.$db->q($db->getNullDate()).' AND (('.$db->qn('e.start').' <= '.$db->q($startMonth).' AND ('.$db->qn('e.end').' <= '.$db->q($endMonth).' OR '.$db->qn('e.end').' >= '.$db->q($endMonth).')) OR ('.$db->qn('e.start').' >= '.$db->q($startMonth).' AND '.$db->qn('e.start').' <= '.$db->q($endMonth).'))) OR '.$db->qn('e.id').' IN ('.implode(',',$includeCalendar).'))';
		} else {
			$query .= ' AND '.$db->qn('e.end').' <> '.$db->q($db->getNullDate()).' AND (('.$db->qn('e.start').' <= '.$db->q($startMonth).' AND ('.$db->qn('e.end').' <= '.$db->q($endMonth).' OR '.$db->qn('e.end').' >= '.$db->q($endMonth).')) OR ('.$db->qn('e.start').' >= '.$db->q($startMonth).' AND '.$db->qn('e.start').' <= '.$db->q($endMonth).')) ';
		}
		
		// Get the list type
		// Get all events
		if ($list == 'all') {
			$query .= $archived ? ' AND '.$db->qn('e.published').' IN (1,2) ' : ' AND '.$db->qn('e.published').' = 1 ';
		} 
		// Get featured events
		else if ($list == 'featured') {
			$query .= $archived ? ' AND '.$db->qn('e.published').' IN (1,2) ' : ' AND '.$db->qn('e.published').' = 1 ';
			$where[] = ' AND '.$db->qn('e.featured').' = 1 ';
		}
		// Get archived events
		else if ($list == 'archived') {
			$query .= ' AND '.$db->qn('e.published').' = 2 ';
		} 
		// Get future events
		else if ($list == 'future') {			
			$where[] = ' AND '.$db->qn('e.end').' <> '.$db->q($db->getNullDate()).' ';
			
			$includeFuture = modRseventsProCalendar::_getAllDayEvents('future', $params);
			
			// Select future events
			if ($days > 0) {
				$start = rseventsproHelper::date('now',null,false,true);
				$start->setTZByID($start->getTZID());
				$start->convertTZ(new RSDate_Timezone('GMT'));
				$start->addSeconds($days * 86400);
				
				$start	= $start->formatLikeDate('Y-m-d H:i:s');
				
				if (!empty($includeFuture)) {
					$where[] = ' AND '.$db->qn('e.start').' >= '.$db->q($start).' OR '.$db->qn('e.id').' IN ('.implode(',',$includeFuture).') ';
				} else {
					$where[] = ' AND '.$db->qn('e.start').' >= '.$db->q($start).' ';
				}
			} 
			else 
			// Select today events
			{
				$start = rseventsproHelper::date('now',null,false,true);
				$start->setTZByID($start->getTZID());
				$start->convertTZ(new RSDate_Timezone('GMT'));
				
				$end = rseventsproHelper::date('now',null,false,true);
				$end->setTZByID($end->getTZID());
				$end->convertTZ(new RSDate_Timezone('GMT'));
				$end->addSeconds(86399);
				
				$start	= $start->formatLikeDate('Y-m-d H:i:s');
				$end	= $end->formatLikeDate('Y-m-d H:i:s');
				
				if (!empty($includeFuture)) {
					$where[] = ' AND (('.$db->qn('e.start').' <= '.$db->q($start).' AND '.$db->qn('e.end').' >= '.$db->q($start).') OR ('.$db->qn('e.start').' >= '.$db->q($start).' AND '.$db->qn('e.end').' <= '.$db->q($end).')) OR '.$db->qn('e.id').' IN ('.implode(',',$includeFuture).') ';
				} else {
					$where[] = ' AND (('.$db->qn('e.start').' <= '.$db->q($start).' AND '.$db->qn('e.end').' >= '.$db->q($start).') OR ('.$db->qn('e.start').' >= '.$db->q($start).' AND '.$db->qn('e.end').' <= '.$db->q($end).')) ';
				}
			}
			
			$query .= ' AND '.$db->qn('e.published').' = 1 ';
		}
		// Get user events
		else 
		{
			if ($user->get('id') > 0)
				$where[] = ' AND '.$db->qn('e.owner').' = '.(int) $user->get('id').' ';
		}
		
		if (!empty($categories)) {
			$categoryquery = '';
			if (JLanguageMultilang::isEnabled()) {
				$categoryquery .= ' AND c.language IN ('.$db->q(JFactory::getLanguage()->getTag()).','.$db->q('*').') ';
			}
			
			$user	= JFactory::getUser();
			$groups	= implode(',', $user->getAuthorisedViewLevels());
			$categoryquery .= ' AND c.access IN ('.$groups.') ';
			
			JArrayHelper::toInteger($categories);
			$where[] = ' AND '.$db->qn('e.id').' IN (SELECT '.$db->qn('tx.ide').' FROM '.$db->qn('#__rseventspro_taxonomy','tx').' LEFT JOIN '.$db->qn('#__categories','c').' ON '.$db->qn('c.id').' = '.$db->qn('tx.id').' WHERE '.$db->qn('c.id').' IN ('.implode(',',$categories).') AND '.$db->qn('tx.type').' = '.$db->q('category').' AND '.$db->qn('c.extension').' = '.$db->q('com_rseventspro').' '.$categoryquery.' )';
		}
		
		if (!empty($tags)) {
			JArrayHelper::toInteger($tags);
			$where[] = ' AND '.$db->qn('e.id').' IN (SELECT '.$db->qn('tx.ide').' FROM '.$db->qn('#__rseventspro_taxonomy','tx').' LEFT JOIN '.$db->qn('#__rseventspro_tags','t').' ON '.$db->qn('t.id').' = '.$db->qn('tx.id').' WHERE '.$db->qn('t.id').' IN ('.implode(',',$tags).') AND '.$db->qn('tx.type').' = '.$db->q('tag').') ';
		}
		
		if (!empty($locations)) {
			JArrayHelper::toInteger($locations);
			$where[] = ' AND '.$db->qn('e.location').' IN ('.implode(',',$locations).') ';
		}
		
		if (!empty($where))
			$query .= implode('',$where);
		
		$exclude = modRseventsProCalendar::excludeEvents();
		
		if (!empty($exclude))
			$query .= ' AND '.$db->qn('e.id').' NOT IN ('.implode(',',$exclude).') ';
		
		$query .= ' ORDER BY '.$db->qn('e.'.$order).' '.$db->escape($direction).' ';
		
		$db->setQuery($query);
		$events =  $db->loadObjectList();
		
		if (!$full) {
			foreach ($events as $i => $event)
				if (rseventsproHelper::eventisfull($event->id)) unset($events[$i]);
		}
		
		return $events;
	}
	
	protected static function excludeEvents() {
		$db		= JFactory::getDbo();
		$query	= $db->getQuery(true);
		$user	= JFactory::getUser(); 
		$ids	= array();
		
		$query->clear()
			->select($db->qn('ide'))
			->from($db->qn('#__rseventspro_taxonomy'))
			->where($db->qn('type').' = '.$db->q('groups'));
		
		$db->setQuery($query);
		$eventids = $db->loadColumn();
		
		if (!empty($eventids)) {
			foreach ($eventids as $id) {
				$query->clear()
					->select($db->qn('owner'))
					->from($db->qn('#__rseventspro_events'))
					->where($db->qn('id').' = '.(int) $id);
				
				$db->setQuery($query);
				$owner = (int) $db->loadResult();
				
				if (!rseventsproHelper::canview($id) && $owner != $user->get('id'))
					$ids[] = $id;
			}
			
			if (!empty($ids)) {
				JArrayHelper::toInteger($ids);
				$ids = array_unique($ids);
			}
		}
		
		return $ids;
	}
	
	public static function getDetailsSmall($ids) {
		$db			= JFactory::getDbo();
		$query		= $db->getQuery(true);
		$details	= '';
		
		if (!empty($ids)) {
			$count = count($ids);
			$details = $count.' ';
			$details .= JText::plural('COM_RSEVENTSPRO_CALENDAR_EVENTS',$count);
			$details .= '::';
			
			JArrayHelper::toInteger($ids);
			
			$query->clear()
				->select($db->qn('name'))
				->from($db->qn('#__rseventspro_events'))
				->where($db->qn('id').' IN ('.implode(',',$ids).')');
			
			$db->setQuery($query);
			$eventnames = $db->loadColumn();
			$details .= htmlentities(implode(', ',$eventnames),ENT_COMPAT,'UTF-8');
		} else {
			$details = JText::_('COM_RSEVENTSPRO_GLOBAL_NO_EVENTS').'::';
		}
		
		return $details;
	}
	
	protected static function getWeekdays($i,$weekend = false) {
		switch($i) {
			case 0:
				if ($weekend)
					return 6;
				else
					return array(0,1,2,3,4,5,6);
			break;
			
			case 1:
				if ($weekend)
					return 0;
				else
					return array(1,2,3,4,5,6,0);
			break;
			
			case 6:
				if ($weekend)
					return 5;
				else
					return array(6,0,1,2,3,4,5);
			break;
		}
	}
	
	protected static function _getAllDayEvents($type, $params, $sdate = null, $edate = null) {
		$db		= JFactory::getDbo();
		$query 	= $db->getQuery(true);
		
		// Parameters
		$list	= $params->get('list','all');
		$days	= (int) $params->get('days',0);
		
		$query->clear()
			->select($db->qn('id'))
			->from($db->qn('#__rseventspro_events'))
			->where($db->qn('allday').' = 1');
		
		if ($type == 'future') {
			if ($list == 'future') {
				if ($days > 0) {
					$start = rseventsproHelper::date('now',null,false,true);
					$start->setTZByID($start->getTZID());
					$start->convertTZ(new RSDate_Timezone('GMT'));
					$start->addSeconds($days * 86400);
					
					$start	= $start->formatLikeDate('Y-m-d H:i:s');
					
					$query->where($db->qn('start').' >= '.$db->q($start));
				} else {
					$start = rseventsproHelper::date('now',null,false,true);
					$start->setHourMinuteSecond(0,0,0);
					$start->setTZByID($start->getTZID());
					$start->convertTZ(new RSDate_Timezone('GMT'));
					
					$end = rseventsproHelper::date('now',null,false,true);
					$end->setHourMinuteSecond(23,59,59);
					$end->setTZByID($end->getTZID());
					$end->convertTZ(new RSDate_Timezone('GMT'));
					$end->addSeconds(1);
					
					$start	= $start->formatLikeDate('Y-m-d H:i:s');
					$end	= $end->formatLikeDate('Y-m-d H:i:s');
					
					$query->where($db->qn('start').' >= '.$db->q($start));
					$query->where($db->qn('start').' < '.$db->q($end));
				}
			}
		} elseif ($type == 'calendar') {
			$query->where($db->qn('start').' >= '.$db->q($sdate));
			$query->where($db->qn('start').' <= '.$db->q($edate));
		}
		
		$db->setQuery($query);
		if ($events = $db->loadColumn()) {
			JArrayHelper::toInteger($events);
			return $events;
		}
		
		return false;
	}
}