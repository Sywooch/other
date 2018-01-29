<?php

class UrlGenerator
{
    public static function generateSubcategoryUrl($params)
    {
        $url = '';
        $addParams = array();
        if(@$params['isvirtual'] == 'true') $addParams['virt'] = 'virt';
        if(@$params['clear']) $addParams['clear'] = 'clear';
        if(@$params['root']) $addParams['root'] = 'root';
        if(@$params['brand']) $addParams['brand'] = 'brand='.@$params['brand'];
        if(@$params['ProviderType'] == 'Warehouse'){
            $addParams['Provider'] = 'Provider=Warehouse';
            $addParams['SearchMethod'] = 'SearchMethod=Default';
        }
        if(@$params['Provider']) {
            $addParams['Provider'] = 'Provider='.@$params['Provider'];
            $addParams['SearchMethod'] = 'SearchMethod='.@$params['SearchMethod'];    
        }        
        if (in_array('Seo2', General::$enabledFeatures)) {
            if (! isset($params['alias']) && !empty($params['Id']) && !empty($params['Name'])) {
                $seoCatModel = new SeoCategoryRepository(new CMS());
                $params['alias'] = $seoCatModel->getCategoryAlias($params['Id'], true, $params['Name']);
            }
            $url = 'subcategory/'.htmlspecialchars($params['alias'], ENT_QUOTES);
            if(count($addParams))
                $url .= '?'.implode('&', $addParams);
        }
        else{
            $url = 'index.php?p=subcategory&cid='.$params['id'];
            if(count($addParams))
                $url .= '&'.implode('&', $addParams);
        }

        return $url;
    }

    public static function generateCategoryUrl($params, $isAbsolute = false){
        $url = '';
        $addParams = array();
        if(@$params['isvirtual'] == 'true') $addParams['virt'] = 'virt';
        if(@$params['clear']) $addParams['clear'] = 'clear';
        if (in_array('Seo2', General::$enabledFeatures)) {
            if (! isset($params['alias']) && !empty($params['Id']) && !empty($params['Name'])) {
                $seoCatModel = new SeoCategoryRepository(new CMS());
                $params['alias'] = $seoCatModel->getCategoryAlias($params['Id'], true, $params['Name']);
            }
            $url = 'category/'.htmlspecialchars($params['alias'], ENT_QUOTES);
            if(count($addParams))
                $url .= '?'.implode('&', $addParams);
        }
        else{
            $url = 'index.php?p=category&cid='.$params['id'];
            if(count($addParams))
                $url .= '&'.implode('&', $addParams);
        }
        if ($isAbsolute) {
            $url = 'http://' . $_SERVER['SERVER_NAME'] . '/' . $url;
        }
        return $url;
    }



    public static function generateFullSearchUrl($url,$cid,$tmall = false,$discounts = false){
        $url = str_replace('cid='.RequestWrapper::getValueSafe('cid'), '', $url);

        if($tmall) $addParams['tmall'] = 'tmall=true';
        if($discounts) $addParams['discounts'] = 'discounts=true';

        $url.= '&cid='.$cid;
        if(count($addParams))
          $url.= '&'.implode('&', $addParams);


        return $url;
    }

    public static function generateMycategoryUrl($params){
        $url = '';
        $addParams = array();
        if(@$params['isvirtual'] == 'true') $addParams['virt'] = 'virt';
        if(@$params['clear']) $addParams['clear'] = 'clear';
        $url = 'index.php?p=my_category&mcid='.$params['id'];
        if(count($addParams))
            $url .= '&'.implode('&', $addParams);
        return $url;
    }

    public static function generateAllcatsUrl($params){
        $url = '';
        if(in_array('Seo2', General::$enabledFeatures)){
            $url .= 'allcats';
        }
        else{
            $url = 'index.php?p=allcats';
        }

        return $url;
    }
    public static function generateReviewsUrl($params){
        $url = '';
        if(in_array('Seo2', General::$enabledFeatures)){
            $url .= 'reviews';
            if(count($params))
                $url .= '?'.implode('&', $params);      }
        else{
            $url = 'index.php?p=reviews';
            if(count($params))
                $url .= '&'.implode('&', $params);
        }

        return $url;
    }

    public static function generateBrandsUrl($params){
        $url = '';
        if(in_array('Seo2', General::$enabledFeatures)){
            $url .= 'brands';
        }
        else{
            $url = 'index.php?p=brands';
        }

        return $url;
    }
    
    public static function generateSearchBrandsUrl($brandId, $isAbsolute = false){
        $url = '';
        if(in_array('Seo2', General::$enabledFeatures)){
            $url .= 'search?search=&brand=' . $brandId;
        }
        else{
            $url = 'index.php?search=&brand=' . $brandId;
        }
        if ($isAbsolute) {
            $url = 'http://' . $_SERVER['SERVER_NAME'] . '/' . $url;
        }
        return $url;
    }

    public static function generateBrandUrl($id){
        $url = '';
        if(in_array('Seo2', General::$enabledFeatures)){
            $url .= 'search?brand='.$id;
        }
        else{
            $url = 'index.php?p=search&brand='.$id;
        }

        return $url;
    }

    public static function generateContentUrl($p){
        $url = '';
        if(in_array('Seo2', General::$enabledFeatures)){
            $url .= $p;
        }
        else{
            $url = 'index.php?p='.$p;
        }

        return $url;
    }

    public static function generatDigestUrl($p,$p2){
        $url = '';
        if(in_array('Seo2', General::$enabledFeatures)){
            $url .= $p."?cat=".$p2;
        }
        else{
            $url = 'index.php?p='.$p.'&cat='.$p2;
        }

        return $url;
    }
    public static function generatPostUrl($p, $p2, $alias){
        $url = '';
        if(in_array('Seo2', General::$enabledFeatures)){
            if (! empty($alias)) {
                $url .=  $p."/" . $alias;
            } else {
                $url .= $p . "?id=" . $p2;
            }
        }
        else{
            $url = 'index.php?p='.$p.'&id='.$p2;
        }

        return $url;
    }

    public static function generateSearchUrl($searchString = false, $isAbsolute = false){
        $url = '';
        if(in_array('Seo2', General::$enabledFeatures)){
            $url .= 'search';            
        } else{
            $url .= 'index.php?p=search';            
        }
        if ($searchString) {
            $url .= '?search=' . $searchString; 
        }
        if ($isAbsolute) {
            $url = 'http://' . $_SERVER['SERVER_NAME'] . '/' . $url;
        }
        return $url;
    }
    
    
    public static function generateItemUrl($id, $isAbsolute = false){
        $url = '';
        if(in_array('Seo2', General::$enabledFeatures)){
            $url .= 'item?id='.$id;
        }
        else{
            $url = 'index.php?p=item&id='.$id;
        }
        if ($isAbsolute) {
            $url = 'http://' . $_SERVER['SERVER_NAME'] . '/' . $url;
        }
        return $url;
    }
    
    public static function generateWarehouseItemUrl($id)
    {
        $url = '';
        if (in_array('Seo2', General::$enabledFeatures)) {
            $url .= 'item?id=wh-'.$id;
        }
        else{
            $url = 'index.php?p=item&id=wh-'.$id;
        }
    
        return $url;
    }
    

    public static function generatePristroyItemUrl($id)
    {
        $url = '';
        if(in_array('Seo2', General::$enabledFeatures)){
            $url .= 'pristroy/item?id='.$id;
        }
        else{
            $url = 'index.php?p=pristroy&id='.$id.'&action=item';
        }

        return $url;
    }

    public static function generatePristroySellerUrl($id)
    {
        $url = '';
        if(in_array('Seo2', General::$enabledFeatures)){
            $url .= 'pristroy/seller?id='.$id;
        }
        else{
            $url = 'index.php?p=pristroy&id='.$id.'&action=seller';
        }

        return $url;
    }

    public static function generateVendorUrl($id, $isAbsolute = false, $cid = null) {
        $url = CMS::IsFeatureEnabled('Seo2') ? '/vendor?id='.$id : '/index.php?p=vendor&id='.$id;
        if ($cid) {
            $url .= '&cid=' . $cid;
        }
        if ($isAbsolute) {
            $url = 'http://' . $_SERVER['SERVER_NAME'] . '' . $url;
        }
        return $url;
    }

    public static function generateVendorsUrl(){
        return CMS::IsFeatureEnabled('Seo2') ? 'all_vendors' : 'index.php?p=all_vendors';
    }

    public static function generateFavouritesUrl($params){
        switch($params['action']){
            case 'move_to_basket':
                $url = CMS::IsFeatureEnabled('Seo2') ? 'move_to_basket?id=' : 'index.php?p=move_to_basket&id=';
                return $url . $params['id'];
                break;
        }
        return '';
    }

    public static function generateBasketUrl($params){
        switch($params['action']){
            case 'move_to_favourites':
                $url = CMS::IsFeatureEnabled('Seo2') ? 'move_to_favourites?id=' : 'index.php?p=move_to_favourites&id=';
                return $url . $params['id'];
                break;
        }
        return '';
    }

    public static function generateOrderDetailsUrl($orderId, $params = array(),$fullPath = false){
        if ($fullPath) {
            $url = "http://".$_SERVER['SERVER_NAME']."/";
        } else {
            $url = "";
        }
        $url.= CMS::IsFeatureEnabled('Seo2') ? 'orderdetails' : 'index.php?p=orderdetails';
        $url.= '&orderid=' . $orderId;
        if($params)
            $url.= '&' . http_build_query($params);
        return $url;
    }

    public static function generatePrivateOfficeUrl($params = array(), $isAbsolute = false){
        $url = CMS::IsFeatureEnabled('Seo2') ? 'privateoffice' : 'index.php?p=privateoffice';
        if($params)
            $url .= '&' . http_build_query($params);
        if($isAbsolute)
            $url = 'http://' . $_SERVER['SERVER_NAME'] . '/' . $url;
        return $url;
    }

    public static function generateSupportUrl($params, $isAbsolute = false)
    {
        if (isset($params['mode']) && $params['mode'] == 'chat') {
            if (isset($params['id']) && strpos($params['id'], 'Ticket') === false) {
                $params['id'] = 'Ticket-' . $params['id'];
            }
        }
        if (in_array('Seo2', General::$enabledFeatures)) {
            $url = 'support' . (!empty($params) ? '?' . http_build_query($params) : '');
        } else {
            $url = 'index.php?p=support' . (!empty($params) ? '&' . http_build_query($params) : '');
        }
        if($isAbsolute) {
            $url = 'http://' . $_SERVER['SERVER_NAME'] . '/' . $url;
        }
        return $url;
    }

    public static function generateFullCatUrl($type,$params,$tmall = false,$discounts = false){
        $addParams = array();
        if(@$params['isvirtual'] == 'true') $addParams['virt'] = 'virt';
        if(@$params['clear']) $addParams['clear'] = 'clear';
        if(@$params['root']) $addParams['root'] = 'root';
        if(@$params['brand']) $addParams['brand'] = 'brand='.@$params['brand'];

        if(@$params['Provider']) $addParams['Provider'] = 'Provider='.@$params['Provider'];
        if(@$params['SearchMethod']) $addParams['SearchMethod'] = 'SearchMethod='.@$params['SearchMethod'];

        if($tmall) $addParams['tmall'] = 'tmall=true';
        if($discounts) $addParams['discounts'] = 'discounts=true';

        if(in_array('Seo2', General::$enabledFeatures)){
            $url = $type.'/'.htmlspecialchars($params['alias'], ENT_QUOTES);
            if(count($addParams))
                $url .= '?'.implode('&', $addParams);
        }
        else{
            $url = 'index.php?p='.$type.'&cid='.$params['id'];
            if(count($addParams))
                $url .= '&'.implode('&', $addParams);
        }

        return $url;
    }
}

?>
