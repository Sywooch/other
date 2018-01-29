<?php

class UrlGenerator {
    public static function generateSubcategoryUrl($params){
        $url = '';
        $addParams = array();
        if(@$params['isvirtual'] == 'true') $addParams['virt'] = 'virt';
        if(@$params['clear']) $addParams['clear'] = 'clear';
        if(@$params['root']) $addParams['root'] = 'root';
        if(@$params['brand']) $addParams['brand'] = 'brand='.@$params['brand'];

        if(in_array('Seo2', General::$enabledFeatures)){
            $url = 'subcategory/'.$params['alias'];
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

    public static function generateCategoryUrl($params){
        $url = '';
        $addParams = array();
        if(@$params['isvirtual'] == 'true') $addParams['virt'] = 'virt';
        if(@$params['clear']) $addParams['clear'] = 'clear';
        if(in_array('Seo2', General::$enabledFeatures)){
            $url = 'category/'.$params['alias'];
            if(count($addParams))
                $url .= '?'.implode('&', $addParams);
        }
        else{
            $url = 'index.php?p=category&cid='.$params['id'];
            if(count($addParams))
                $url .= '&'.implode('&', $addParams);
        }

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
				$url .= '?'.implode('&', $params);		}
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

    public static function generateSearchUrl(){
        $url = '';
        if(in_array('Seo2', General::$enabledFeatures)){
            $url .= 'search';
        }
        else{
            $url = 'index.php';
        }

        return $url;
    }

    public static function generateItemUrl($id){
        $url = '';
        if(in_array('Seo2', General::$enabledFeatures)){
            $url .= 'item?id='.$id;
        }
        else{
            $url = 'index.php?p=item&id='.$id;
        }

        return $url;
    }

    public static function generateVendorUrl($id){
        return CMS::IsFeatureEnabled('Seo2') ? 'vendor?id='.$id : 'index.php?p=vendor&id='.$id;
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
}

?>
