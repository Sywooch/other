<?php
class DocumentsController extends Site_Controller
{
	public function actionDefault()
	{
		$this->page->documents = $this->model('documents')->getList(
			'documents',
			$this->model('documents')->getFieldsNames('documents', 'listing'),
			array('where' => array('dealer_category_id' => $this->page->dealer['category_id']))
		);
		 
		 
		 
		$tmp=$this->model('news')->getPage('news',
                $this->model('news')->getFieldsNames('news', 'listing'),
                $total, 0, 3,
                array('where' => array('hidden' => 'no'), 'order' => array('date' => 'desc'))
            );
			
		
	  	for($i=0;$i<count($tmp);$i++){
				$desc=$tmp[$i]['description'];
				$desc=strip_tags($desc);
				$desc=trim($desc);
				//echo "==".$desc."==<br>";
				$desc = $this->getPrewText($desc,10,100);
				$tmp[$i]['description']=$desc;
					
			}	
			
				
		
		$this->page->main_news = $tmp;
		
			
			
			
		$this->page->content = $this->renderView('list');
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