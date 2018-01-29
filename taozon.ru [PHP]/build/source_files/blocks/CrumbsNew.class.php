<?php

class CrumbsNew extends GenerateBlock
{
    protected $_cache = false; //- кэшируем или нет.
    protected $_life_time = 3600; //- время на которое будем кешировать
    protected $_template = 'crumbsnew'; //- шаблон, на основе которого будем собирать блок
    protected $_template_path = '/main/';

    public function __construct()
    {
		
        parent::__construct(true);
    }

    protected function setVars()
    {
        global $otapilib;
		
        $cid = isset($_GET['cid']) ? RequestWrapper::getValueSafe('cid') : false;
        $script_name = General::$isContent ? 'content' : SCRIPT_NAME;
        $crumbs = array();
        switch($script_name){
            case 'item':
                if(in_array('Seo2', General::$enabledFeatures)){
                    $cms = new SafedCMS();
                    if(is_array(@$GLOBALS['itempath']))
                        foreach($GLOBALS['itempath'] as &$c){
                            $c['alias'] = $cms->getCategoryAlias(@$c['Id'], true, @$c['Name']);
                        }
                }
                $this->tpl->assign('crumbs', @$GLOBALS['itempath']);
                break;
            case 'category':
            case 'subcategory':
                global $opentaoCMS;
                $GLOBALS['category'] = $opentaoCMS->callCMSMethod('getCategorySEO', array('cid' => $cid));

                $catpath = @$GLOBALS['rootpath'] ? $GLOBALS['rootpath'] : $otapilib->GetCategoryRootPath($cid);
                $catpath[count($catpath)-1]['last'] = true;
                if(in_array('Seo2', General::$enabledFeatures)){
                    $cms = new SafedCMS();
                    if(is_array($catpath))
                    foreach($catpath as &$c){
                        $c['alias'] = $cms->getCategoryAlias(@$c['Id'], true, @$c['Name']);
                    }
                }
                $this->tpl->assign('crumbs', $catpath);
                $GLOBALS['catpath'] = $catpath;
                $last = end($catpath);
                $GLOBALS['pagetitle'] = @$last['Name'];
                break;
            case 'myitem':
                $this->_template = 'crumbsnewcontent';
                $crumbs = array(
					'my_category&mcid='.$GLOBALS['category']['id'] => $GLOBALS['category']['name'],
					'last' => $GLOBALS['pagetitle']
                );
                $this->tpl->assign('crumbs', $crumbs);
                $GLOBALS['pagetitle'] = $crumbs['last'];
				break;
            case 'my_category':
                $this->_template = 'crumbsnewcontent';
                $crumbs = array(
                    'index' => 'Свои категории',
                    'last' => $GLOBALS['my_category_name']
                );
                $this->tpl->assign('crumbs', $crumbs);
                $GLOBALS['pagetitle'] = $crumbs['last'];
                break;
            case 'search':
			
                $bid = isset($_GET['brand']) ? RequestWrapper::getValueSafe('brand') : false;
                if($bid){
                    $this->tpl->assign('isbrand', '1');
                    $this->tpl->assign('brandcrumb', @$GLOBALS['brandinfo']);
					//СЕО для брендов
					global $opentaoCMS;					
                	$GLOBALS['brands_seo'] = $opentaoCMS->callCMSMethod('getCategorySEO', array('cid' => RequestWrapper::getValueSafe('brand')));					
                }
                $catpath = array();
                if ($cid) {
                    if(in_array('Seo2', General::$enabledFeatures)){
                        $cms = new SafedCMS();
                        if(is_array(@$GLOBALS['rootpath'])) {
                            foreach($GLOBALS['rootpath'] as &$c){
                                $c['alias'] = $cms->getCategoryAlias(@$c['Id'], true, @$c['Name']);
                            }
                        }
                    }
                    $catpath = @$GLOBALS['rootpath'] ? $GLOBALS['rootpath'] : array();
                }
				
                if(RequestWrapper::getValueSafe('search'))
                    $catpath[] = array('name' => Lang::get('search_results_on_request').' «'.RequestWrapper::getValueSafe('search').'»', 'last' => true);
                else
                    $catpath[] = array('name' => Lang::get('search_results'), 'last' => true);
                $this->tpl->assign('crumbs', $catpath);
                $GLOBALS['catpath'] = $catpath;
                $GLOBALS['pagetitle'] = Lang::get('search_results_on_request').' «'.RequestWrapper::getValueSafe('search').'»';
                break;
            case 'support':
                $this->_template = 'crumbsnewcontent';
                $crumbs = array(
                    'privateoffice' => Lang::get('private_office'),
                    'last' => Lang::get('support_service')
                );
                $this->tpl->assign('crumbs', $crumbs);
                $GLOBALS['pagetitle'] = Lang::get('support_service');
                break;
            case 'profile':
                $this->_template = 'crumbsnewcontent';
                $crumbs = array(
                    'privateoffice' => Lang::get('private_office'),
                    'last' => Lang::get('personal_data')
                );
                $this->tpl->assign('crumbs', $crumbs);
                $GLOBALS['pagetitle'] = $crumbs['last'];
                break;
            case 'register':
                $this->_template = 'crumbsnewcontent';
                $crumbs = array(
                    'last' => Lang::get('registration')
                );
                $this->tpl->assign('crumbs', $crumbs);
                $GLOBALS['pagetitle'] = $crumbs['last'];
                break;
            case 'recovery':
                $this->_template = 'crumbsnewcontent';
                $crumbs = array(
                    'last' => Lang::get('pass_recovery')
                );
                $this->tpl->assign('crumbs', $crumbs);
                $GLOBALS['pagetitle'] = $crumbs['last'];
                break;
            case 'basket':
                $this->_template = 'crumbsnewcontent';
                $crumbs = array(
                    'last' => Lang::get('cart')
                );
                $this->tpl->assign('crumbs', $crumbs);
                $GLOBALS['pagetitle'] = $crumbs['last'];
                break;
            case 'content':
                global $opentaoCMS;

                $page = $opentaoCMS->callCMSMethod('GetPageByAlias', array('alias'=>SCRIPT_NAME));
                $GLOBALS['page'] = $page;

                $crumbs = array(
                    'last' => $page['title']
                );
                $this->_template = 'crumbsnewcontent';
                $this->tpl->assign('crumbs', $crumbs);
                $GLOBALS['pagetitle'] = $crumbs['last'];
                break;
            case 'download':
                $crumbs = array(
                    'last' => Lang::get('files')
                );
                $this->_template = 'crumbsnewcontent';
                $this->tpl->assign('crumbs', $crumbs);
                $GLOBALS['pagetitle'] = $crumbs['last'];
                break;
            case 'login':
                $crumbs = array(
                    'last' => Lang::get('auth')
                );
                $this->_template = 'crumbsnewcontent';
                $this->tpl->assign('crumbs', $crumbs);
                $GLOBALS['pagetitle'] = $crumbs['last'];
                break;
            case 'privateoffice':
                $crumbs = array(
                    'last' => Lang::get('private_office')
                );
                $this->_template = 'crumbsnewcontent';
                $this->tpl->assign('crumbs', $crumbs);
                $GLOBALS['pagetitle'] = $crumbs['last'];
                break;
            case 'referral':
                $this->_template = 'crumbsnewcontent';
                $crumbs = array(
                    'privateoffice' => Lang::get('private_office'),
                    'last' => 'Бизнес с VeliChina'
                );
                $this->tpl->assign('crumbs', $crumbs);
                $GLOBALS['pagetitle'] = $crumbs['last'];
                break;
            case 'outputofmoney':
                $this->_template = 'crumbsnewcontent';
                $crumbs = array(
                    'privateoffice' => Lang::get('private_office'),
                    'last' => Lang::get('withdraw_funds')
                );
                $this->tpl->assign('crumbs', $crumbs);
                $GLOBALS['pagetitle'] = $crumbs['last'];
                break;
            case 'allcats':
                $crumbs = array(
                    'last' => Lang::get('all_categories')
                );
                $this->_template = 'crumbsnewcontent';
                $this->tpl->assign('crumbs', $crumbs);
                $GLOBALS['pagetitle'] = $crumbs['last'];
                break;
            case 'brands':
                $crumbs = array(
                    'last' => Lang::get('brands')
                );
                $this->_template = 'crumbsnewcontent';
                $this->tpl->assign('crumbs', $crumbs);
                $GLOBALS['pagetitle'] = $crumbs['last'];
                break;
            case 'userorder':
                $this->_template = 'crumbsnewcontent';

                if(isset($_GET['step1'])){
                    $crumbs = array(
                        'basket' => Lang::get('cart'),
                        'last' => Lang::get('reg_order').': '.Lang::get('weight_calc')
                    );
                }
                if(isset($_GET['step2'])){
                    $crumbs = array(
                        'basket' => Lang::get('cart'),
                        'userorder&step1' => Lang::get('reg_order').': '.Lang::get('weight_calc'),
                        'last' => Lang::get('reg_order').': '.Lang::get('choice_order')
                    );
                }
                if(isset($_GET['step3'])){
                    $crumbs = array(
                        'basket' => Lang::get('cart'),
                        'userorder&step1' => Lang::get('reg_order').': '.Lang::get('weight_calc'),
                        'userorder&step2' => Lang::get('reg_order').': '.Lang::get('choice_order'),
                        'last' => Lang::get('reg_order').': '.Lang::get('delivery')
                    );
                }
                if(isset($_GET['step4'])){
                    $crumbs = array(
                        'basket' => Lang::get('cart'),
                        'userorder&step1' => Lang::get('reg_order').': '.Lang::get('weight_calc'),
                        'userorder&step2' => Lang::get('reg_order').': '.Lang::get('choice_order'),
                        'userorder&step3' => Lang::get('reg_order').': '.Lang::get('delivery'),
                        'last' => Lang::get('reg_order').': '.Lang::get('order_confirmation')
                    );
                }
                if(isset($_GET['createorder'])){
                    $title = Lang::get('order_processing');
                }

                $this->tpl->assign('crumbs', $crumbs);
                $GLOBALS['pagetitle'] = @$crumbs['last'] ? $crumbs['last'] : @$title;
                break;
			case 'vendor':
			
				if (isset ($_GET['id'])&&!empty($_GET['id']))
				$crumbs = array(
					array('name' => Lang::get('vendor').' '.RequestWrapper::getValueSafe('id')),
				);
				$this->tpl->assign('crumbs', $crumbs);
				break;
        }
    }
}

?>