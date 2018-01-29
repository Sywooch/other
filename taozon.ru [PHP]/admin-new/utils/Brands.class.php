<?php

OTBase::import('system.uploader.php.UploadHandler');
OTBase::import('system.lib.Validation.*');
OTBase::import('system.lib.Validation.Rules.*');

class Brands extends GeneralUtil
{
    protected $_template = 'brands';
    protected $_template_path = 'brands/';

    protected $brandsProvider;
    protected $categoriesProvider;

    public function __construct()
    {
        parent::__construct();
        $this->brandsProvider = new BrandsProvider($this->cms, $this->otapilib);
        $this->categoriesProvider = new CategoriesProvider($this->cms, $this->otapilib);
    }

    public function defaultAction($request)
    {
        try {
            $sid = Session::get('sid');
            $allBrands = $this->brandsProvider->GetGlobalBrandInfoList($sid);
            $brands = $this->brandsProvider->GetBrandInfoFullList($sid);
            
            $this->tpl->assign('brands', $brands);
            $this->tpl->assign('allBrands', $allBrands);
        } catch (ServiceException $e) {
            $this->errorHandler->registerError($e);
        }

        print $this->fetchTemplate();
    }
    
    public function hideBrandAction($request)
    {
        try {
            $sid = Session::get('sid');
            $id = $type = $request->getValue('id');
            $xml = '<EditableBrandInfo><IsHidden>true</IsHidden></EditableBrandInfo>';
            $result = $this->brandsProvider->EditBrandInfo($sid, $id, $xml);
        } catch (Exception $e) {
            $this->respondAjaxError($e->getMessage());
        }
        $this->sendAjaxResponse(array('result' => 'ok'));        
    }
    
    public function showBrandAction($request)
    {
        try {
            $sid = Session::get('sid');
            $id = $type = $request->getValue('id');
            $xml = '<EditableBrandInfo><IsHidden>false</IsHidden></EditableBrandInfo>';
            $result = $this->brandsProvider->EditBrandInfo($sid, $id, $xml);
        } catch (Exception $e) {
            $this->respondAjaxError($e->getMessage());
        }
        $this->sendAjaxResponse(array('result' => 'ok'));
    }

    public function editBrandAction($request)
    {
        $this->_template = 'crud';
        $id = $type = $request->getValue('id');
        $sid = Session::get('sid');

        $brand = array('id' => false);
        try {
            $brand = $this->brandsProvider->GetBrandInfo($id);
            $brand['seo'] = $this->categoriesProvider->getCategorySEO($id);
            if (! $brand['seo']) {
                $brand['seo'] = array('seo_title' => '||', 'pagetitle' => '', 'seo_keywords' => '', 'seo_description' => '', 'type' => '');
            }            
        } catch (Exception $e) {
            ErrorHandler::registerError($e);
        }
        
        $this->tpl->assign('brand', $brand);
        print $this->fetchTemplate();
    }
    
    public function addBrandAction($request)
    {
        $this->_template = 'crud';
        $id = $type = $request->getValue('id');
        $sid = Session::get('sid');
    
        $brand = array('id' => false);
        try {
            $brand['seo'] = array('seo_title' => '||', 'pagetitle' => '', 'seo_keywords' => '', 'seo_description' => '', 'type' => '');
        } catch (Exception $e) {
            ErrorHandler::registerError($e);
        }
    
        $this->tpl->assign('brand', $brand);
        print $this->fetchTemplate();
    }
    
    public function saveBrandAction($request) 
    {
        $sid = Session::get('sid');
        try {
            $id = $request->getValue('id');
            $brandName = $request->getValue('brand-name');
            $externalId = $request->getValue('external-id');
            $oldImage = $request->getValue('old-image');
            $brandDescription = $request->getValue('brand-description');
            $pageTitle = $request->getValue('pagetitle');
            $prefix = $request->getValue('prefix');
            $suffix = $request->getValue('suffix');
            $seoKeywords = $request->getValue('seo-keywords');
            $seoDescription = $request->getValue('seo-description');
        
            //validate
            $validator = new Validator(array(
                'brandName' => trim($brandName),
                'externalId' => trim($externalId),
            ));
            $validator->addRule(new NotEmptyString(), 'brandName', LangAdmin::get('brands::Brand_name_cannot_be_empty'));
            $validator->addRule(new NotEmptyString(), 'externalId', LangAdmin::get('brands::Taobao_id_cannot_be_empty'));
            if (! $validator->validate()) {
                $this->respondAjaxError($validator->getErrors());
            }

            if ($externalId) {
                $brands = $this->brandsProvider->GetBrandInfoFullList($sid);
                if ($this->brandExists($brands, $externalId) && $id != 0) {
                    $this->respondAjaxError(LangAdmin::get('brands::Brand_already_exists'));
                }
            }
            
            $imageUrl = $oldImage;
            $newImage = $this->getNameUploadImage();
            if ($newImage) {
                $imageUrl = $newImage;
            }
            
            //save
            if (!empty($id)) {
                // update
                $brandId = $id;
                $result = $this->brandsProvider->UpdateBrandInfo($sid, $id, $brandName, $imageUrl, $brandDescription, $externalId);
            } else {
                // add brand
                $brandId = $this->brandsProvider->AddBrandInfo($sid, $brandName, $imageUrl, $brandDescription, $externalId);
            }
            
            $this->categoriesProvider->setCategorySEO(array('cid' => $brandId, 'seo_title' => $prefix . '||' . $suffix , 'meta_title' => $pageTitle, 'meta_keywords' => $seoKeywords, 'meta_description' => $seoDescription));
        
        } catch (Exception $e) {
            $this->respondAjaxError($e->getMessage());
        }
        $this->sendAjaxResponse(array('result' => 'ok'), true);
    }
    
    
    
    public function deleteBrandAction($request)
    {
        try {
            $sid = Session::get('sid');
            $id = $type = $request->getValue('id');
            
            $result = $this->brandsProvider->RemoveBrandInfo($sid, $id);
        } catch (Exception $e) {
            $this->respondAjaxError($e->getMessage());
        }
        $this->sendAjaxResponse(array('result' => 'ok'));
    }
    
    /**
     * @param RequestWrapper $request
     */
    public function searchBrandsAction($request)
    {
        try {
            $sid = Session::get('sid');
            $brands = $this->brandsProvider->SearchOriginalBrandsFrame($sid, $request->getValue('name'));

            $brandsJson = array();
            foreach ($brands['Content'] as $brand) {
                $brandsJson[] = $brand;
            }
        }
        catch (ServiceException $e) {
            $this->respondAjaxError($e);
        }
        $this->sendAjaxResponse(array('options' => $brandsJson));
    }
    
    private function uploadImage()
    {
        $uploader = new UploadHandler(array(
            'param_name' => 'new-image',
            'image_versions' => array(
                '' => array(
                    'max_width' => 100,
                    'max_height' => 100,
                    'jpeg_quality' => 95
                ),
            ),
        ), false, null, '/uploaded/brands/');
        return $uploader->post(false);
    }
    
    private function getNameUploadImage()
    {
        if (! empty($_FILES['new-image']['tmp_name'])) {
            $uploadResult = $this->uploadImage();
            if (isset($uploadResult['new-image'][0])) {
                if (isset($uploadResult['new-image'][0]->url)) {
                    $logoUrl = $uploadResult['new-image'][0]->url;
                } else if (isset($uploadResult['new-image'][0]->error)) {
                    $this->respondAjaxError($uploadResult['new-image'][0]->error);
                }
            } else {
                $this->respondAjaxError('Unknown error occured while uploading image. Try again.');
            }
        } else {
            $logoUrl = '';
        }
        return $logoUrl;
    }
    
    public function addBrandsAction($request)
    {
        $brands = array();
        try {
            $id2add = array();
            $sid = Session::get('sid');
            $ids = $request->getValue('ids');
            $ids = explode(';',$ids);
            
            foreach ($ids as $key => $value) {
                $id2add[$value] = true;
            }

            $allBrands = $this->brandsProvider->GetGlobalBrandInfoList($sid);
            $existingBrands = $this->brandsProvider->GetBrandInfoFullList($sid);
            foreach ($allBrands as $i => &$brand) {
                if(array_key_exists($brand['id'], $id2add) && $id2add[$brand['id']]) {
                    if ($brand['externalid']) {
                        if ($this->brandExists($existingBrands, $brand['externalid'])) {
                            continue;
                        }
                    }
                    $brandId = $this->brandsProvider->AddBrandInfo($sid, $brand['name'], $brand['pictureurl'], $brand['description'], $brand['externalid']);
                    if ($brandId) {
                        $brand['id'] = $brandId;
                        $brands[] = $brand;    
                    }
                }
            }
        } catch (Exception $e) {
            $this->respondAjaxError($e->getMessage());
        }
        $this->sendAjaxResponse(array('result' => 'ok', 'brands' => $brands));
    }
    
    private function brandExists($brands, $externalId)
    {
        foreach ($brands as $key => $brand) {
            if ($brand['externalid'] == $externalId) {
                return true;
            } 
        };
        return false;
    }
    
}
