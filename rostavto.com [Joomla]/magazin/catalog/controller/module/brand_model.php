<?php
/**
 * Class ControllerModuleBrandModel
 * @property ModelCatalogManufacturer $model_catalog_manufacturer
 * @property Mixed $data
 * @property Request $request
 * @property Document $document
 * @property ModelModuleBrandModel $model_module_brand_model
 * @property ModelCatalogProduct $model_catalog_product
 */
class ControllerModuleBrandModel extends Controller
{
    protected function index($setting)
    {
        $this->document->addStyle('catalog/view/theme/default/stylesheet/brand_model.css');

        $this->language->load('module/brand_model');

        if (isset($this->request->get['filter_model'])) {
            $this->data['_model'] = $this->request->get['filter_model'];
        } else {
            $this->data['_model'] = '';
        }

        if (isset($this->request->get['filter_manufacturer_id'])) {
            $manufacturer_id = (int)$this->request->get['filter_manufacturer_id'];
            $this->data['manufacturer_id'] = $this->request->get['filter_manufacturer_id'];
        } else {
            $this->data['manufacturer_id'] = 0;
            $manufacturer_id = false;
        }

        $this->document->setTitle(strip_tags($this->language->get('heading_title')));

        $this->data['heading_title'] = $this->language->get('heading_title');

        $this->data['text_select'] = $this->language->get('text_select');

        $this->data['entry_brand'] = $this->language->get('entry_brand');
        $this->data['entry_model'] = $this->language->get('entry_model');

        $this->load->model('catalog/manufacturer');

        $this->data['manufacturers'] = array();

        $results = $this->model_catalog_manufacturer->getManufacturers();

        foreach ($results as $result) {
            $this->data['manufacturers'][] = array(
                'manufacturer_id' => $result['manufacturer_id'],
                'name' => $result['name']
            );
        }

        $this->data['models'] = array();

        if ($manufacturer_id) {
            $this->load->model('module/brand_model');

            $data = array(
                'filter_manufacturer_id' => $manufacturer_id
            );

            $results = $this->model_module_brand_model->getModels($data);

            foreach ($results as $result) {
                $this->data['models'][] = $result['model'];
            }
        }

        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/stylesheet/brand_model.css')) {
            $this->document->addStyle('catalog/view/theme/' . $this->config->get('config_template') . '/stylesheet/brand_model.css');
        }

        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/brand_model.tpl')) {
            $this->template = $this->config->get('config_template') . '/template/module/brand_model.tpl';
        } else {
            $this->template = 'default/template/module/brand_model.tpl';
        }

        $this->render();
    }

    public function models()
    {
        if ($this->request->request['manufacturer_id']) {
            $manufacturer_id = (int)$this->request->request['manufacturer_id'];

            $this->load->model('module/brand_model');

            $data = array(
                'filter_manufacturer_id' => $manufacturer_id
            );

            $results = $this->model_module_brand_model->getModels($data);

            $models = '<option value="">' . $this->language->get('text_select') . '</option>';

            foreach ($results as $result) {
                $models .= '<option value="' . $result['model'] . '">' . $result['model'] . '</option>';
            }

            exit(json_encode(array('models' => $models)));
        }
    }

    public function search()
    {
        if (isset($this->request->get['filter_model'])) {
            $model = $this->request->get['filter_model'];
        } else {
            $this->data['_model'] = '';
        }

        if (isset($this->request->get['filter_manufacturer_id'])) {
            $manufacturer_id = (int)$this->request->get['filter_manufacturer_id'];
        } else {
            $manufacturer_id = false;
        }

        if ($model && $manufacturer_id) {
            $this->language->load('module/brand_model');

            $this->load->model('catalog/manufacturer');

            $this->document->addScript('catalog/view/javascript/jquery/jquery.total-storage.min.js');

            if (isset($this->request->get['sort'])) {
                $sort = $this->request->get['sort'];
            } else {
                $sort = 'p.sort_order';
            }

            if (isset($this->request->get['order'])) {
                $order = $this->request->get['order'];
            } else {
                $order = 'ASC';
            }

            if (isset($this->request->get['page'])) {
                $page = $this->request->get['page'];
            } else {
                $page = 1;
            }

            if (isset($this->request->get['limit'])) {
                $limit = $this->request->get['limit'];
            } else {
                $limit = $this->config->get('config_catalog_limit');
            }

            $manufacturer = $this->model_catalog_manufacturer->getManufacturer($manufacturer_id);

            $this->data['heading_title'] = sprintf($this->language->get('text_search'), $manufacturer['name'], $model);

            $this->data['breadcrumbs'] = array();

            $this->data['breadcrumbs'][] = array(
                'text' => $this->language->get('text_home'),
                'href' => $this->url->link('common/home'),
                'separator' => false
            );

            $this->data['breadcrumbs'][] = array(
                'text' => $manufacturer['name'],
                'href' => $this->url->link('product/manufacturer', 'manufacturer_id=' . $manufacturer_id),
                'separator' => $this->language->get('text_separator')
            );

            $this->data['breadcrumbs'][] = array(
                'text' => $model,
                'href' => $this->url->link('module/brand_model/search', 'filter_manufacturer_id=' . $manufacturer_id . '&filter_model=' . urlencode($model)),
                'separator' => $this->language->get('text_separator')
            );

            $this->document->setTitle($this->data['heading_title']);

            $this->data['text_refine'] = $this->language->get('text_refine');
            $this->data['text_empty'] = $this->language->get('text_empty');
            $this->data['text_quantity'] = $this->language->get('text_quantity');
            $this->data['text_manufacturer'] = $this->language->get('text_manufacturer');
            $this->data['text_model'] = $this->language->get('text_model');
            $this->data['text_price'] = $this->language->get('text_price');
            $this->data['text_tax'] = $this->language->get('text_tax');
            $this->data['text_points'] = $this->language->get('text_points');
            $this->data['text_compare'] = sprintf($this->language->get('text_compare'), (isset($this->session->data['compare']) ? count($this->session->data['compare']) : 0));
            $this->data['text_display'] = $this->language->get('text_display');
            $this->data['text_list'] = $this->language->get('text_list');
            $this->data['text_grid'] = $this->language->get('text_grid');
            $this->data['text_sort'] = $this->language->get('text_sort');
            $this->data['text_limit'] = $this->language->get('text_limit');

            $this->data['button_cart'] = $this->language->get('button_cart');
            $this->data['button_wishlist'] = $this->language->get('button_wishlist');
            $this->data['button_compare'] = $this->language->get('button_compare');
            $this->data['button_continue'] = $this->language->get('button_continue');

            $this->load->model('catalog/product');
            $this->load->model('tool/image');

            $this->data['products'] = array();

            $this->data['products'] = array();

            $data = array(
                'sort' => $sort,
                'order' => $order,
                'start' => ($page - 1) * $limit,
                'limit' => $limit,
                'filter_manufacturer_id' => $manufacturer_id,
                'filter_model' => $model
            );

            $results = $this->model_catalog_product->getProducts($data);

            foreach ($results as $result) {
                if ($result['image']) {
                    $image = $this->model_tool_image->resize($result['image'], $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
                } else {
                    $image = $this->model_tool_image->resize('no_image.jpg', $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
                }

                if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
                    $price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')));
                } else {
                    $price = false;
                }

                if ((float)$result['special']) {
                    $special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')));
                } else {
                    $special = false;
                }

                if ($this->config->get('config_tax')) {
                    $tax = $this->currency->format((float)$result['special'] ? $result['special'] : $result['price']);
                } else {
                    $tax = false;
                }

                $this->data['products'][] = array(
                    'product_id' => $result['product_id'],
                    'thumb' => $image,
                    'name' => $result['name'],
                    'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, 300) . '..',
                    'price' => $price,
                    'special' => $special,
                    'tax' => $tax,
                    'rating' => $result['rating'],
                    'reviews' => sprintf($this->language->get('text_reviews'), (int)$result['reviews']),
                    'href' => $this->url->link('product/product', 'product_id=' . $result['product_id'])
                );
            }

            $url = '';

            if (isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
            }

            if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }

            if (isset($this->request->get['limit'])) {
                $url .= '&limit=' . $this->request->get['limit'];
            }

            $this->data['sorts'] = array();

            $this->data['sorts'][] = array(
                'text'  => $this->language->get('text_default'),
                'value' => 'p.sort_order-ASC',
                'href'  => $this->url->link('module/brand_model/search', 'filter_manufacturer_id=' . $manufacturer_id . '&filter_model=' . $model . '&sort=p.sort_order&order=ASC' . $url)
            );

            $this->data['sorts'][] = array(
                'text'  => $this->language->get('text_name_asc'),
                'value' => 'pd.name-ASC',
                'href'  => $this->url->link('module/brand_model/search', 'filter_manufacturer_id=' . $manufacturer_id . '&filter_model=' . $model . '&sort=pd.name&order=ASC' . $url)
            );

            $this->data['sorts'][] = array(
                'text'  => $this->language->get('text_name_desc'),
                'value' => 'pd.name-DESC',
                'href'  => $this->url->link('module/brand_model/search', 'filter_manufacturer_id=' . $manufacturer_id . '&filter_model=' . $model . '&sort=pd.name&order=DESC' . $url)
            );

            $this->data['sorts'][] = array(
                'text'  => $this->language->get('text_price_asc'),
                'value' => 'p.price-ASC',
                'href'  => $this->url->link('module/brand_model/search', 'filter_manufacturer_id=' . $manufacturer_id . '&filter_model=' . $model . '&sort=p.price&order=ASC' . $url)
            );

            $this->data['sorts'][] = array(
                'text'  => $this->language->get('text_price_desc'),
                'value' => 'p.price-DESC',
                'href'  => $this->url->link('module/brand_model/search', 'filter_manufacturer_id=' . $manufacturer_id . '&filter_model=' . $model . '&sort=p.price&order=DESC' . $url)
            );

            if ($this->config->get('config_review_status')) {
                $this->data['sorts'][] = array(
                    'text'  => $this->language->get('text_rating_desc'),
                    'value' => 'rating-DESC',
                    'href'  => $this->url->link('module/brand_model/search', 'filter_manufacturer_id=' . $manufacturer_id . '&filter_model=' . $model . '&sort=rating&order=DESC' . $url)
                );

                $this->data['sorts'][] = array(
                    'text'  => $this->language->get('text_rating_asc'),
                    'value' => 'rating-ASC',
                    'href'  => $this->url->link('module/brand_model/search', 'filter_manufacturer_id=' . $manufacturer_id . '&filter_model=' . $model . '&sort=rating&order=ASC' . $url)
                );
            }

            $this->data['limits'] = array();

            $limits = array_unique(array($this->config->get('config_catalog_limit'), 25, 50, 75, 100));

            sort($limits);

            foreach($limits as $limits){
                $this->data['limits'][] = array(
                    'text'  => $limits,
                    'value' => $limits,
                    'href'  => $this->url->link('module/brand_model/search', 'filter_manufacturer_id=' . $manufacturer_id . '&filter_model=' . $model . $url . '&limit=' . $limits)
                );
            }

            $pagination = new Pagination();
            $pagination->total = $this->model_catalog_product->getTotalProducts($data);
            $pagination->page = $page;
            $pagination->limit = $limit;
            $pagination->text = $this->language->get('text_pagination');
            $pagination->url = $this->url->link('module/brand_model/search', 'filter_manufacturer_id=' . $manufacturer_id . '&filter_model=' . $model . $url . 'page={page}');

            $this->data['pagination'] = $pagination->render();


            if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/brand_model_search.tpl')) {
                $this->template = $this->config->get('config_template') . '/template/module/brand_model_search.tpl';
            } else {
                $this->template = 'default/template/module/brand_model_search.tpl';
            }

            $this->children = array(
                'common/column_left',
                'common/column_right',
                'common/content_top',
                'common/content_bottom',
                'common/footer',
                'common/header'
            );

            $this->response->setOutput($this->render());

        } else {
            $this->redirect($this->url->link('error/not_found', '', ''));
        }
    }

}

?>