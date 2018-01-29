<?php

class ProductsHelper
{
    public static function isWarehouseProduct($item, $asObject = false)
    {
        if (! $asObject) {
            $providerType = !empty($item['ProviderType']) ? $item['ProviderType'] : false;
            $id = !empty($item['id']) ? $item['id'] : false;
            $itemId = !empty($item['ItemId']) ? $item['ItemId'] : false;
            $itemIdLower = !empty($item['itemid']) ? $item['itemid'] : false;
        } else {
            $providerType = !empty($item->ProviderType) ? $item->ProviderType : '';
            $id = !empty($item->id) ? $item->id : false;
            $itemId = !empty($item->ItemId) ? $item->ItemId : false;
            $itemIdLower = !empty($item->itemid) ? $item->itemid : false;
        }

        if ($providerType) {
            return (string)$providerType == 'Warehouse';
        }

        $whId = $id ? strpos($id, 'wh-') === 0 : false;
        $whItemId = $itemId ? strpos($itemId, 'wh-') === 0 : false;
        $whItemIdLower = $itemIdLower ? strpos($itemIdLower, 'wh-') === 0 : false;

        return $whId || $whItemId || $whItemIdLower;
    }

    public static function getWarehouseProductUrl($item)
    {
		$itemid = false;
		
        if (isset($item->itemid)) {
            $itemid = str_replace('wh-', '', $item->itemid);
        } elseif (isset($item->ItemId)) {
            $itemid = str_replace('wh-', '', $item->ItemId);
        } elseif (isset($item['itemid'])) {
            $itemid = str_replace('wh-', '', $item['itemid']);
        } elseif (isset($item['ItemId'])) {
            $itemid = str_replace('wh-', '', $item['ItemId']);
        }

        return $itemid ? "http://$_SERVER[HTTP_HOST]/" . UrlGenerator::generateItemUrl($itemid) : '5555';
    }

    public static function getImage($item, $size = null, $checkWarehouse = true)
    {
        // Проверим кастомные картинки
        if ( !empty($item['image_path'])) {
            return $item['image_path'];
        }

        // Возьмём дефолтную картинку
        if (!empty($item['MainPictureUrl'])) {
            $imageUrl = $item['MainPictureUrl'];
        } elseif (!empty($item['MainImageUrl'])) {
            $imageUrl = $item['MainImageUrl'];
        } elseif (!empty($item['PictureURL'])) {
            $imageUrl = $item['PictureURL'];
        } elseif (!empty($item['PictureUrl'])) {
            $imageUrl = $item['PictureUrl'];
        } elseif (!empty($item['ItemImageURL'])) {
            $imageUrl = $item['ItemImageURL'];
        } elseif (!empty($item['url'])) {
            $imageUrl = $item['url'];
        }

        if (empty($imageUrl)) {
            return false;
        }

        if (! $size) {
            return $imageUrl;
        }

        // Обработка картинок только для 'Taobao', 'Warehouse'
        if (! empty($item['ProviderType'])) {
            if (! in_array($item['ProviderType'], array('Taobao', 'Warehouse'))) {
                return $imageUrl;
            }
        }

        // в имени файла не может быть знака ? - удаляем все что после знака ?
        $imageUrl = preg_replace('/\?.*/', '', $imageUrl);
        if ((! $checkWarehouse || self::isWarehouseProduct($item)) &&
            strpos($imageUrl, 'taobaocdn.com') === false) {
            // товар с пристроя, загруженный вручную с компа
            $suffix = sprintf('_%d_%d', $size, $size);
            if (strpos($imageUrl, 'uploaded/warehouse') !== false) {
                $image = str_replace('uploaded/warehouse', 'uploaded/warehouse/thumbnail' . $suffix, $imageUrl);
            } else {
                $image = str_replace('uploaded', 'uploaded/thumbnail' . $suffix, $imageUrl);
            }
        } else if (strpos($imageUrl, 'tbcdn.cn') !== false) {
            // Для урлов-заглушек вида: http://a.tbcdn.cn/app/sns/img/default/avatar-120.png
            $vendorAvailableSizes = array(100, 120, 160);
            if (in_array($size, $vendorAvailableSizes) && preg_match('#avatar\-(\d+)#si', $imageUrl, $m) && !empty($m[1])) {
                $image = str_replace($m[1], $size, $imageUrl);
            } else {
                $image = $imageUrl;
            }
        } else {
            $image = $imageUrl . sprintf('_%dx%d.jpg', $size, $size);
        }

        return $image;
    }

    public static function getPristroyImage(array $item, $size = null, $uploadedImagePriority = true)
    {
        if (empty($item['images'])) {
            return false;
        }

        $defaultImage = !empty($item['images'][0]) ? $item['images'][0] : '';
        $uploadedImage = !empty($item['images'][1]) ? $item['images'][1] : '';
        if ($uploadedImagePriority) {
            $imageUrl = $uploadedImage ? $uploadedImage : $defaultImage;
        } else {
            $imageUrl = $defaultImage;
        }

        if (! $size) {
            return $imageUrl;
        }

        return self::getPristroyImageSize($imageUrl, $size);
    }

    public static function getPristroyImageSize($imageUrl, $size)
    {
        if (strpos($imageUrl, 'taobaocdn.com') === false) {
            // товар с пристроя, загруженный вручную с компа
            $suffix = sprintf('_%d_%d/', $size, $size);
            $image = str_replace('uploaded/pristroy/', 'uploaded/pristroy/thumbnail' . $suffix, $imageUrl);
        } else {
            $image = $imageUrl . sprintf('_%dx%d.jpg', $size, $size);
        }

        return $image;
    }

}
