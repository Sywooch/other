<?php
class NewsController extends Site_Controller
{
	public function actionDefault()
	{
		if (!$this->app->request->id) {
			
			
			if(strpos($_SERVER['REQUEST_URI'],"about/news") != false)
			{
			
			$paging = array(
				'total' => 0,
				'from' => 0,
				'npp' => 5,
				'base_url' => preg_replace('/page\/\d+\//i', '', $_SERVER['REQUEST_URI']).'page/',
				'url_append' => '/',
				'separator' => ' ',
				'curr_page' => 0,
				'pages' => 0,
				'first' => '|<',
				'prev' => '<',
				'next' => '>',
				'last' => '>|',
				'skip' => ' ... ',
				'linkcount' => 10
			);
			
			}else{
			
			$paging = array(
				'total' => 0,
				'from' => 0,
				'npp' => 20,
				'base_url' => preg_replace('/page\/\d+\//i', '', $_SERVER['REQUEST_URI']).'page/',
				'url_append' => '/',
				'separator' => ' ',
				'curr_page' => 0,
				'pages' => 0,
				'first' => '|<',
				'prev' => '<',
				'next' => '>',
				'last' => '>|',
				'skip' => ' ... ',
				'linkcount' => 10
			);
				
				
			}
			
			
			if(strpos($_SERVER['REQUEST_URI'],"about/news/page/all") != false)
			{
			
			$paging = array(
				'total' => 0,
				'from' => 0,
				'npp' => 20000,
				'base_url' => preg_replace('/page\/\d+\//i', '', $_SERVER['REQUEST_URI']).'page/',
				'url_append' => '/',
				'separator' => ' ',
				'curr_page' => 0,
				'pages' => 0,
				'first' => '|<',
				'prev' => '<',
				'next' => '>',
				'last' => '>|',
				'skip' => ' ... ',
				'linkcount' => 10
			);
			
			}
			
			
			
			
			//echo "====".print_r($this->model('news')->getFieldsNames('news', 'listing'))."---";
			
			$paging['from'] = $this->app->request->page > 0 ? ($this->app->request->page-1)*$paging['npp'] : 0;
			
			
			
			if(strpos($_SERVER['REQUEST_URI'],"about/news") != false)
			{
				//$mas_tmp=$this->model('news')->getFieldsNames('news', 'listing');
			//	print_r($this->model('news')->getFieldsNames('news', 'listing'));
				$mas_tmp[]="id";
				$mas_tmp[]="date";
				$mas_tmp[]="image";
				$mas_tmp[]="title";
				$mas_tmp[]="description";
				
				$this->page->news = $this->model('news')->getPage(
					'news',
					$mas_tmp,
					$paging['total'], $paging['from'], $paging['npp'],
					array('where' => array('hidden' => 'no'), 'order' => array('date' => 'desc'))
				);
					
				
			/*	
				$this->page->news = $this->model('news')->getPage('news',
                $this->model('news')->getFieldsNames('news', 'listing'),
                $total, 0, 5,
                array('where' => array('hidden' => 'no'), 'order' => array('date' => 'desc'))
            	);
			*/
			
			
			}else{
				
				$this->page->news = $this->model('news')->getPage(
					'news',
					$this->model('news')->getFieldsNames('news', 'listing'),
					$paging['total'], $paging['from'], $paging['npp'],
					array('where' => array('hidden' => 'no'), 'order' => array('date' => 'desc'))
				);
				
			}
			
			$paging['pages'] = ceil($paging['total']/$paging['npp']);
			$paging['curr_page'] = $this->app->request->page > 0 ? $this->app->request->page : 1; 
			$this->page->paging = $paging;
			
			
			
			
			
			
			
			$tmp = $this->model('news')->getPage('news',
                $this->model('news')->getFieldsNames('news', 'listing'),
                $total, 0, 4,
                array('where' => array('hidden' => 'no'), 'order' => array('date' => 'desc'))
            );
			
			for($i=0;$i<count($tmp);$i++){
				
				$desc=$tmp[$i]['description'];
				$desc=strip_tags($desc);
				$desc=trim($desc);
				$desc = $this->getPrewText($desc,10,100);
				$tmp[$i]['description']=$desc;
					
			}	
			
			$this->page->main_news = $tmp;
			
			
			
			
			
			
			$this->page->content = $this->renderView('list');
		} else {
			
			
			
			$this->page->news = $this->model('news')->GetByCond(
				'news',
				$this->model('news')->getFieldsNames('news', 'one'),
				array('where' => array('id' => $this->app->request->id, 'hidden' => 'no'))
			);




			$tmp = $this->model('news')->getPage('news',
                $this->model('news')->getFieldsNames('news', 'listing'),
                $total, 0, 4,
                array('where' => array('hidden' => 'no'), 'order' => array('date' => 'desc'))
            );
			
			for($i=0;$i<count($tmp);$i++){
				
				$desc=$tmp[$i]['description'];
				$desc=strip_tags($desc);
				$desc=trim($desc);
				$desc = $this->getPrewText($desc,10,100);
				$tmp[$i]['description']=$desc;
					
			}	
			
			$this->page->main_news = $tmp;






			$this->page->content = $this->renderView('show');
		}
		$this->loadView('main', null);
	}
	
	
		
	public function getPrewText($text,$maxwords=60,$maxchar=50) {
	//$text=strip_tags($text);
	$words=split(' ',$text);
	$text='';
	foreach ($words as $word) {
		if (mb_strlen($text.' '.$word)<$maxchar) {
			$text.=' '.$word;
		}
		else {
			$text.='...';
			break;
		}
	}
	return $text;
	}
	
	
	
	
	
	
}