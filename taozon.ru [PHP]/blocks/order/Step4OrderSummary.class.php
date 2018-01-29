<?php
/**
 * User: dima
 * Date: 11.02.13
 * Time: 9:53
 * Вывод общей информации о заказе
 */
class Step4OrderSummary extends GenerateBlock
{
    protected $_cache = false; //- кэшируем или нет.
    protected $_life_time = 3600; //- время на которое будем кешировать
    protected $_template = 'order_summary'; //- шаблон, на основе которого будем собирать блок
    protected $_template_path = '/order/step4/'; //- путь к шаблону

    /**
     * @var array Способы доставок
     */
    protected $deliveryModes;
    /**
     * @var array Корзина
     */
    protected $cart;
    /**
     * @var array Вес товаров в корзине
     */
    protected $weight;
    /**
     * @var RequestWrapper POST|GET параметры
     */
    protected $request;

    /**
     * @param array $deliveryModes
     * @param array $cart
     * @param float $weight
     */
    public function __construct($deliveryModes, $cart, $weight, $type, $allBasket)
    {
        parent::__construct();

        $this->deliveryModes = $deliveryModes;
        $this->cart = $cart;
        $this->weight = $weight;
        $this->type = $type;
        $this->allBasket = $allBasket;
        $this->request = new RequestWrapper();
    }

    public function setVars(){
        $deliveryModeId = $this->request->getValue('model');
        foreach ($this->deliveryModes as $mode) {
            if ($mode['id'] == $deliveryModeId)
                $deliveryModeInfo = $mode;
        }

        // @TODO: костыль, убрать его, когда код будет нормально исправлен
        if (! isset($deliveryModeInfo)) {
            $deliveryModeInfo = reset($this->deliveryModes);
        }
        foreach ($this->cart as $providerItems) {
            $sign = $providerItems[0]['CurrencySign'];
            break;
        }

        $totalCost = $this->type == 'warehouse' ? $this->cart->getWhItemsTotalCost() : $this->cart->getTaoItemsTotalCost();

        $summary = array();
        $summary['goods_amount'] = (string)(General::priceFormat((float)$totalCost, (int)General::$siteConf['price_round_decimals']))." ".$sign;
        $summary['approximate_weight'] = number_format($this->weight, 2, '.', ' ').Lang::get('kg');
        $summary['delivery'] = $deliveryModeInfo['name'];
        $summary['delivery_cost'] = TextHelper::formatPrice($deliveryModeInfo['Price'], $deliveryModeInfo['currencysign']);

        $newSummary = Plugins::invokeEvent('onCartSummaryGenerate',
            array('summary' => $summary, 'cart' => $this->cart->asArray(), 'delivery' => $deliveryModeInfo));

        $summary = $newSummary ? $newSummary : $summary;
        $this->tpl->assign('summary', $summary);

        $order_insurance = 0;
        if (General::getConfigValue('order_insurance_percent')) {
            $order_insurance = General::getConfigValue('order_insurance_percent');
        }
        $this->tpl->assign('order_insurance', $order_insurance);

        $type = $this->type == 'warehouse' ? 'Warehouse' : 'Taobao';
        $totalPrice = TextHelper::formatPrice(
            $this->allBasket['CollectionSummaries'][$type]['TotalCost']['ConvertedPriceList']['Internal'][0] + (float)$deliveryModeInfo['Price'],
            $this->allBasket['CollectionSummaries'][$type]['TotalCost']['ConvertedPriceList']['Internal']['Sign']
        );

        $this->tpl->assign('origin_package_value', Session::get('orderOriginPackage') == 'on' ? true : false );
        $this->tpl->assign('order_insurance_value', Session::get('orderInsurance') == 'on' ? true : false);
        $this->tpl->assign('totalPrice', $totalPrice);
        $this->tpl->assign('allBasket', $this->allBasket);
    }
}
