<?php
/**
 * @package    Diafan.CMS
 *
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */

if (! defined('DIAFAN'))
{
	include dirname(dirname(dirname(__FILE__))).'/includes/404.php';
}

/**
 * Paginator_inc
 * 
 * Постраничная навигация
 */
class Paginator_inc extends Diafan
{
	/**
	 * @var integer количество элементов, показанных на странице
	 */
	public $nastr = 11;

	/**
	 * @var integer количество ссылок постраничной навигации, показанных на одной страние
	 */
	public $navnastr = 11;

	/**
	 * @var string ссылка на первую страницу
	 */
	public $navlink;

	/**
	 * @var string шаблон ссылки второй и последующих страниц, если не задан используется navlink + urlpage
	 */
	public $navlink_tpl;

	/**
	 * @var integer номер страницы
	 */
	public $page;

	/**
	 * @var string GET переменные, участвующие в навигации для постраничного вывода
	 */
	public $get_nav;

	/**
	 * @var string шаблон части ссылки, отвечающей  за передачу номера страницы 
	 */
	public $urlpage = 'page%d/';

	/**
	 * @var integer порядковый номер элемента, с которого начинается вывод элементов
	 */
	public $polog = 0;

	/**
	 * @var integer количество элементов в списке
	 */
	public $nen;

	/**
	 * Формирует строку навигации
	 * 
	 * @return array
	 */
	public function get()
	{
		$this->config();
		$links    = array();
		$rout_end =  preg_replace('/\//', '\/', ROUTE_END);
		$navlink  = $this->navlink;
		if(! IS_ADMIN)
		{
			$navlink   = preg_replace('/'.$rout_end.'$/', '/', $navlink);
			$this->navlink_tpl = preg_replace('/\/$/', ROUTE_END, $this->navlink_tpl);
			$this->urlpage = preg_replace('/\/$/', ROUTE_END, $this->urlpage);
		}
        
		$string    = '';
		if (! $this->nastr)
		{
			$this->nastr = 11;
		}
		if ($this->nen > $this->nastr)
		{
			if($this->page != 1)
			{
				$links[] = array(
					"type" => "first",
					"link" => $this->navlink.$this->get_nav
					);
			}
			$nen = ceil($this->nen / $this->nastr);
			$apage = 1;
			$bpage = $this->navnastr;
			/*if($this->page < ($this->navnastr-1)/2+1)
			{
				while ($this->page > $bpage && $apage < $nen)
				{
					$apage += $this->navnastr;
					$bpage += $this->navnastr;
				}
			}
			else
			{
				while ($this->page > $bpage && $apage < $nen)
				{
					$apage += ($this->navnastr-1)/2+1;
					$bpage += ($this->navnastr-1)/2+1;
				}
			}
			if ($bpage > $nen)
			{
				$bpage = $nen;
			}
			if ($nen > $this->navnastr && $apage != 1)
			{
				if ($this->navlink_tpl)
				{
					$url = sprintf($this->navlink_tpl, $apage - 1);
				}
				else
				{
					$url = $navlink.sprintf($this->urlpage, $apage - 1);
				}
				$links[] = array(
						 "type" => "previous",
						 "link" => ($apage < 3 ? $this->navlink : $url).$this->get_nav
						);
			}*/
			$apage = ($this->page-5 > 0 ? ($this->page > $nen-($this->navnastr-1)/2 ? $this->page-5-(($this->navnastr-1)/2 - ($nen-$this->page)) : $this->page-5) : 1);
			$bpage = ($this->page > 6 ? ($this->page+5 > $nen ? $nen : $this->page+5) : $this->navnastr); 
			if($apage<0)$apage=1;
			if($bpage>$nen)$bpage=$nen;
			for ($i = $apage; $i <= $bpage; $i++)
			{
				if ($this->page == $i)
				{
					$links[] = array(
							 "type" => "current",
							 "name" => $i,
							 "link" => ($i == 1 ? $this->navlink : $url).$this->get_nav
							);
				} 
				else
				{
					if ($this->navlink_tpl)
					{
						$url = sprintf($this->navlink_tpl, $i);
					}
					else
					{
						$url = $navlink.sprintf($this->urlpage, $i);
					}
					$links[] = array(
							 "type" => "default",
							 "name" => $i,
							 "link" => ($i == 1 ? $this->navlink : $url).$this->get_nav
							);
					if($this->page == $i-1)
					{
						if ($this->navlink_tpl)
						{
							$url = sprintf($this->navlink_tpl, $i);
						}
						else
						{
							$url = $navlink.sprintf($this->urlpage, $i);
						}
						$links[] = array(
								 "type" => "next",
								 "name" => $i,
								 "link" => ($i == 1 ? $this->navlink : $url).$this->get_nav
								);
					}
					if($this->page == $i+1)
					{
						if ($this->navlink_tpl)
						{
							$url = sprintf($this->navlink_tpl, $i);
						}
						else
						{
							$url = $navlink.sprintf($this->urlpage, $i);
						}
						$links[] = array(
								 "type" => "previous",
								 "name" => $i,
								 "link" => ($i == 1 ? $this->navlink : $url).$this->get_nav
								);
					}
				}
			}
			/*if ($nen > $this->navnastr && $bpage != $nen)
			{
				if ($this->navlink_tpl)
				{
					$url = sprintf($this->navlink_tpl, $apage + $this->navnastr);
				}
				else
				{
					$url = $navlink.sprintf($this->urlpage, $apage + $this->navnastr);
				}
				$links[] = array(
						 "type" => "next",
						 "nen"  => $nen,
						 "link" => $url.$this->get_nav
						);
			}*/
			if($nen != $this->page)
			{
				$links[] = array(
							"type" => "last",
							"nen"  => $nen,
							"link" => $navlink.sprintf($this->urlpage, $nen).$this->get_nav
							);			
			}
		}

		return $links;
	}

	/**
	 * Рассчитывает параметры постраничной навигации
	 * 
	 * @return boolean true
	 */
	private function config()
	{
		if (! IS_ADMIN && $this->diafan->configmodules("nastr") && $this->urlpage == 'page%d/')
		{
			$this->nastr = $this->diafan->configmodules("nastr");
		}

		if ($this->page)
		{
			$this->polog = ($this->page - 1) * $this->nastr;
			if (($this->page - 1) * $this->nastr >= $this->nen)
			{
				if(IS_ADMIN)
				{
					if(preg_match('/rewrite=index\.php\/(.*)&rewrite=(.*)/', $_SERVER['QUERY_STRING'], $m))
					{
						$query = $m[1];
					}
					else
					{
						$query = $_SERVER['QUERY_STRING'];
					}
					$query = str_replace(array('page'.$this->page, 'rewrite=index.php/'), array('page1', ''), $query);
				}
				else
				{
					include ABSOLUTE_PATH.'includes/404.php';
				}
			}
		}
		else
		{
			$this->page  = 1;
			$this->polog = 0;
		}
		return true;
	}
}