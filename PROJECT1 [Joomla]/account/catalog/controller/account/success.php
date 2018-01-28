<?php 
class ControllerAccountSuccess extends Controller {  
	public function index() {
    	$this->language->load('account/success');
  
    	$this->document->setTitle($this->language->get('heading_title'));

    	$this->data['heading_title'] = $this->language->get('heading_title');

	
    	$this->data['text_message'] = sprintf($this->language->get('text_message'), $this->url->link('information/contact'));
		
    	$this->data['button_continue'] = $this->language->get('button_continue');
		

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/success.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/common/success.tpl';
		} else {
			$this->template = 'default/template/common/success.tpl';
		}
		
		$this->children = array(
			'common/footer',
			'common/header'	
		);
						
		$this->response->setOutput($this->render());				
  	}
}
?>