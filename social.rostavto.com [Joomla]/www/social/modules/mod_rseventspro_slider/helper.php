<?php
/**
* @version 1.0.0
* @package RSEvents!Pro 1.0.0
* @copyright (C) 2012 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

abstract class modRseventsProSlider {

	public static function getEvents($params) {
		$db			= JFactory::getDbo();
		$query		= $db->getQuery(true);
		$subquery	= $db->getQuery(true);
		$categories	= $params->get('categories','');
		$locations	= $params->get('locations','');
		$tags		= $params->get('tags','');
		$order		= $params->get('ordering','start');
		$direction	= $params->get('order','DESC');
		$events		= (int) $params->get('events',0);
		$archived	= (int) $params->get('archived',0);
		$repeating	= (int) $params->get('repeating',0);
		$limit		= (int) $params->get('limit',4);
		
		$time		= rseventsproHelper::date('now',null,false,true);
		$time->setTZByID($time->getTZID());
		$time->convertTZ(new RSDate_Timezone('GMT'));
		
		$now		= rseventsproHelper::date('now',null,false,true);
		$now->setHourMinuteSecond(0,0,0);
		$now->setTZByID($now->getTZID());
		$now->convertTZ(new RSDate_Timezone('GMT'));
		$today_start = $now->formatLikeDate('Y-m-d H:i:s');
		
		$now->addSeconds(86400);
		$today_end	 = $now->formatLikeDate('Y-m-d H:i:s');
		
		$query->clear()
			->select($db->qn('e.id'))->select($db->qn('e.name'))->select($db->qn('e.description'))
			->select($db->qn('e.icon'))->select($db->qn('e.start'))->select($db->qn('e.end'))
			->select($db->qn('e.allday'))
			->from($db->qn('#__rseventspro_events','e'))
			->where($db->qn('e.completed').' = 1');
		
		if ( !$repeating )
			$query->where ($db->qn('e.parent').' = '.$db->q('0'));
		
		$date_filter = '';
		
		$active_today	= '(('.$db->qn('e.start').' <= '.$db->q($today_start).' AND '.$db->qn('e.end').' >= '.$db->q($today_start).') OR ('.$db->qn('e.start').' >= '.$db->q($today_start).' AND '.$db->qn('e.start').' <= '.$db->q($today_end).'))';
		$upcoming		= $db->qn('e.start').' >= '.$db->q($time->formatLikeDate('Y-m-d H:i:s'));
		
		if ($events == 0) {
			$date_filter .= '('.$active_today.' OR ('.$upcoming.'))';
		} elseif ($events == 2) {
			$date_filter .= $upcoming;
		} elseif ($events == 1) {
			$date_filter .= $active_today;
		}
		
		if ($archived) {
			$query->where('(('.$db->qn('e.published').' = 1 AND '.$date_filter.') OR ('.$db->qn('published').'='.$db->q(2).'))');
		} else {
			$query->where($db->qn('e.published').' = 1')
				  ->where($date_filter);
		}
		
		if (!empty($categories)) {
			JArrayHelper::toInteger($categories);
			
			$subquery->clear()
				->select($db->qn('tx.ide'))
				->from($db->qn('#__rseventspro_taxonomy','tx'))
				->join('left', $db->qn('#__categories','c').' ON '.$db->qn('c.id').' = '.$db->qn('tx.id'))
				->where($db->qn('c.id').' IN ('.implode(',',$categories).')')
				->where($db->qn('tx.type').' = '.$db->q('category'))
				->where($db->qn('c.extension').' = '.$db->q('com_rseventspro'));
			
			if (JLanguageMultilang::isEnabled()) {
				$subquery->where('c.language IN ('.$db->q(JFactory::getLanguage()->getTag()).','.$db->q('*').')');
			}
			
			$user	= JFactory::getUser();
			$groups	= implode(',', $user->getAuthorisedViewLevels());
			$subquery->where('c.access IN ('.$groups.')');
			
			$query->where($db->qn('e.id').' IN ('.$subquery.')');
		}
		
		if (!empty($tags)) {
			JArrayHelper::toInteger($tags);
			
			$subquery->clear()
				->select($db->qn('tx.ide'))
				->from($db->qn('#__rseventspro_taxonomy','tx'))
				->join('left', $db->qn('#__rseventspro_tags','t').' ON '.$db->qn('t.id').' = '.$db->qn('tx.id'))
				->where($db->qn('t.id').' IN ('.implode(',',$tags).')')
				->where($db->qn('tx.type').' = '.$db->q('tag'));
			
			$query->where($db->qn('e.id').' IN ('.$subquery.')');
		}
		
		if (!empty($locations)) {
			JArrayHelper::toInteger($locations);
			
			$query->where($db->qn('e.location').' IN ('.implode(',',$locations).')');
		}
		
		$exclude = modRseventsProSlider::excludeEvents();
		
		if (!empty($exclude))
			$query->where($db->qn('e.id').' NOT IN ('.implode(',',$exclude).')');
		
		$query->order($db->qn('e.'.$order).' '.$db->escape($direction));
		
		$db->setQuery($query,0,$limit);
		return $db->loadObjectList();
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
	
	public static function getTimeline($events,$nr_events) {
        $timeline = array();

		$pages = ceil(count($events) / $nr_events);
		for ($i=1; $i<=$pages; $i++) {
			$start 	= $i*$nr_events - $nr_events;
			$end 	= $i*$nr_events - 1;
			
			if (!isset($events[$end]))
				$end = array_search(end($events), $events);
			
			$startdate = rseventsproHelper::date($events[$start]->start,'d') . ' ' . rseventsproHelper::date($events[$start]->start,'M');
			$enddate = rseventsproHelper::date($events[$end]->start,'d') . ' ' . rseventsproHelper::date($events[$end]->start,'M');
			
			array_push($timeline, array('start' => $startdate, 'end' => $enddate));
		}
		
		return $timeline;
	}
}