<?php  
class ControllerCommonFooter extends Controller {
	protected function index() {
	
		$this->data['powered'] = $this->config->get('config_name').' '. date('Y', time());
		
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/footer.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/common/footer.tpl';
		} else {
			$this->template = 'default/template/common/footer.tpl';
		}
		
		$this->render();
	}
}
?>