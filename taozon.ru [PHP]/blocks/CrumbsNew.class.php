<?php

class CrumbsNew extends GenerateBlock
{
    protected $_template = 'crumbsnew'; //- шаблон, на основе которого будем собирать блок
    protected $_template_path = '/main/';

    public function __construct()
    {
        parent::__construct();
    }

    protected function setVars()
    {
        $cid = isset($_GET['cid']) ? RequestWrapper::getValueSafe('cid') : false;
        $script_name = General::$isContent ? 'content' : SCRIPT_NAME;
        $crumbs = array();

        $SeoCatsRepository = new SeoCategoryRepository($this->cms);

        switch ($script_name) {
            case 'item':                
                if(in_array('Seo2', General::$enabledFeatures)){
                    try {
                        if(is_array(@$GLOBALS['itempath']))
                            foreach($GLOBALS['itempath'] as &$c){
                                $c['alias'] = $SeoCatsRepository->getCategoryAlias(@$c['Id'], true, @$c['Name']);
                            }
                    } catch (DBException $e) {
                        Session::setError($e->getMessage(), 'DBError');
                    }
                }
                $this->tpl->assign('crumbs', @$GLOBALS['itempath']);
                break;
            case 'category':
            case 'subcategory':                
                try {
                    $catpath = @$GLOBALS['rootpath'] ? $GLOBALS['rootpath'] : ($cid ? $this->otapilib->GetCategoryRootPath($cid) : array(array('Name' => '', 'last' => true)));
                    $catpath[count($catpath)-1]['last'] = true;
                    $GLOBALS['category'] = $SeoCatsRepository->getCategorySEO($cid);                    
                    if(in_array('Seo2', General::$enabledFeatures)){                        
                        if(is_array($catpath))

                        foreach($catpath as &$c){
                            if (RequestWrapper::getValueSafe('Provider')) {
                                $c['Provider'] = RequestWrapper::getValueSafe('Provider');
                                $c['SearchMethod'] = RequestWrapper::getValueSafe('SearchMethod');
                            }
                            if (is_array($c)) {
                                $c['alias'] = $SeoCatsRepository->getCategoryAlias(@$c['Id'], true, @$c['Name']);
                            }
                        }
                    }
                } catch(ServiceException $e){
                    Session::setError($e->getErrorMessage(), $e->getErrorCode());                
                } catch (DBException $e) {
                    Session::setError($e->getMessage(), 'DBError');
                }
                if(RequestWrapper::getValueSafe('search'))
                    $catpath[] = array('name' => Lang::get('search_results_on_request').' «'.RequestWrapper::getValueSafe('search').'»', 'last' => true);
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
                    try {
                        $GLOBALS['brands_seo'] = $SeoCatsRepository->getCategorySEO(RequestWrapper::getValueSafe('brand'));
                    } catch (DBException $e) {
                        Session::setError($e->getMessage(), 'DBError');
                    }
                }
                $catpath = array();
                if ($cid) {
                    if(in_array('Seo2', General::$enabledFeatures)){
                        try {
                            if(is_array(@$GLOBALS['rootpath'])) {
                                foreach($GLOBALS['rootpath'] as &$c){
                                $c['alias'] = $SeoCatsRepository->getCategoryAlias(@$c['Id'], true, @$c['Name']);
                                }
                            }
                        } catch (DBException $e) {
                            Session::setError($e->getMessage(), 'DBError');
                        }
                    }
                    $catpath = @$GLOBALS['rootpath'] ? $GLOBALS['rootpath'] : array();
                }

                if(RequestWrapper::getValueSafe('search')) {
					//============================крошки для мультипосика	============================================================================
                    
                    
					if(RequestWrapper::getValueSafe('Provider')) {						
						$catpath[] = array(
                    		'name' => Lang::get(RequestWrapper::getValueSafe('Provider').'_'.RequestWrapper::getValueSafe('SearchMethod').'_Flag').' «'.RequestWrapper::getValueSafe('search').'»'
                		);
					} elseif(General::getConfigValue('use_multi_search')) {
						$catpath[] = array('name' => Lang::get('multisearch').' «'.RequestWrapper::getValueSafe('search').'»', 'last' => true);
					}
                    else{
                        $catpath[] = array('name' => Lang::get('search_results_on_request').' «'.RequestWrapper::getValueSafe('search').'»', 'last' => true);
                    }
				}
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
                    'last' => Lang::get('profile')
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
                $alias = General::getConfigValue('site_temporary_unavailable')&&!Session::get('sid') ? 'site_unavailable' : SCRIPT_NAME;

                $cms = new CMS();
                $page = $cms->GetPageByAlias($alias);
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
            case 'profile':
                $this->_template = 'crumbsnewcontent';
                $crumbs = array(
                    'privateoffice' => Lang::get('private_office'),
                    'last' => Lang::get('profile')
                );
                $this->tpl->assign('crumbs', $crumbs);
                $GLOBALS['pagetitle'] = $crumbs['last'];
                break;
            case 'orderdetails':
                $order_id = defined('CFG_PREFIX_REPLACE_ORD') ? 
                    str_replace('ORD', CFG_PREFIX_REPLACE_ORD, $this->request->getValue('orderid')) :
                    $this->request->getValue('orderid');

                $crumbs = array(
                    'privateoffice' => Lang::get('private_office'),
                    'privateoffice&orderstate=1' => Lang::get('orders'),
                    'last' => sprintf('%s %s', Lang::get('order_number_is'), $order_id)
                );

                $this->_template = 'crumbsnewcontent';
                $this->tpl->assign('crumbs', $crumbs);
                $GLOBALS['pagetitle'] = $crumbs['last'];
                break;
            case 'privateoffice':
                if (!$this->request->valueExists('orderstate')) {
                    $crumbs = array(
                        'last' => Lang::get('private_office')

                    );
                } else {
                    $crumbs = array(
                        'privateoffice' => Lang::get('private_office'),
                        'last' => Lang::get('orders')
                    );
                }
                
                $this->_template = 'crumbsnewcontent';
                $this->tpl->assign('crumbs', $crumbs);
                $GLOBALS['pagetitle'] = $crumbs['last'];
                break;
            case 'moneyinfo':
                $crumbs = array(
                        'privateoffice' => Lang::get('private_office'),
                        'last' => Lang::get('account_info')
                    );
                $this->_template = 'crumbsnewcontent';
                $this->tpl->assign('crumbs', $crumbs);
                $GLOBALS['pagetitle'] = $crumbs['last'];
                break;
            case 'userreferal':
                $crumbs = array(
                        'privateoffice' => Lang::get('private_office'),
                        'last' => Lang::get('user_referal')
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

            case 'digest':
                $GLOBALS['pagetitle'] = Lang::get('digest');
                if (RequestWrapper::getValueSafe('cat')) {
                    $digestclass = new DigestRepository(new CMS());
                    $allCats = $digestclass->GetAllDigestCategories(Session::get('active_lang'));
                    $last = count($allCats) ? $allCats[RequestWrapper::getValueSafe('cat')]['title'] : '';
                    $crumbs = array(
                        'digest' => Lang::get('digest'),
                        'last' => $last
                    );
                } else {
                    $crumbs = array(
                        'last' => Lang::get('digest')
                    );
                }
                $this->_template = 'crumbsnewcontent';
                $this->tpl->assign('crumbs', $crumbs);
                break;

            case 'post':
				$digestclass = new DigestRepository(new CMS());
				if ($GLOBALS['CrumbNamePost']['category_id']) {
					$cat = $digestclass->GetCategoryById($GLOBALS['CrumbNamePost']['category_id']);
					if ($cat) {					
    					$crumbs = array(
                        	'digest' => Lang::get('digest'),
    						UrlGenerator::generatDigestUrl('digest',$cat[0]['alias'])=>$cat[0]['title'],
                        	'last' => $GLOBALS['CrumbNamePost']['title']
                    	);
					} else {
					    $crumbs = array(
					        'digest' => Lang::get('digest'),
					        'last' => $GLOBALS['CrumbNamePost']['title']
					    );
					}
				} else {
                	$crumbs = array(
                    	'digest' => Lang::get('digest'),
                    	'last' => $GLOBALS['CrumbNamePost']['title']
                	);
				}
                $this->_template = 'crumbsnewcontent';
                $this->tpl->assign('crumbs', $crumbs);
                break;

            case 'pristroy':
                $crumbs = array(
                    'start' => array(
                        'title' => Lang::get('pristroy'),
                        'link'  => UrlGenerator::generateContentUrl('pristroy'),
                    )
                );
                switch ($this->getAction()) {
                    case 'item':
                        $crumbs['last'] = array(
                            'title' => Lang::get('good'),
                        );
                    break;

                    case 'seller':
                        $crumbs['last'] = array(
                            'title' => Lang::get('Pristroy_all_seller_goods'),
                        );
                    break;

                    case 'list':
                    default:
                        $crumbs['last'] = array(
                            'title' => Lang::get('goods_list'),
                        );
                }

                $this->_template_path = '/pristroy/';
                $this->_template = 'crumbs';
                $this->tpl->assign('crumbs', $crumbs);
                $GLOBALS['pagetitle'] = $crumbs['last']['title'];
                break;
            
            case 'allnews':
                $crumbs = array('last' => Lang::get('all_news'));
                $this->_template = 'crumbsnewcontent';
                $this->tpl->assign('crumbs', $crumbs);
                break;
            
            case 'news':
                $news = $this->cms->GetNewsByID($this->request->getValue('id'));
                $titleNews = ($news) ? $news['title'] : '';

                $crumbs = array(
                    'allnews' => Lang::get('all_news'),
                    'last' => $titleNews
                );
                $this->_template = 'crumbsnewcontent';
                $this->tpl->assign('crumbs', $crumbs);
                $GLOBALS['pagetitle'] = $crumbs['last'];
                break;
        }
    }
}
