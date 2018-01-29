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
    private $deliveryModes;
    /**
     * @var array Корзина
     */
    private $cart;
    /**
     * @var array Вес товаров в корзине
     */
    private $weight;
    /**
     * @var RequestWrapper POST|GET параметры
     */
    private $request;

    /**
     * @param array $deliveryModes
     * @param array $cart
     * @param float $weight
     */
    public function __construct($deliveryModes, $cart, $weight){
        parent::__construct();

        $this->deliveryModes = $deliveryModes;
        $this->cart = $cart;
        $this->request = new RequestWrapper();
    }

    public function setVars(){
        $deliveryModeId = $this->request->get('model');
        foreach ($this->deliveryModes as $mode) {
            if ($mode['id'] == $deliveryModeId)
                $deliveryModeInfo = $mode;
        }

        $summary = array();
        $summary['goods_amount'] = (string)$this->cart['Basket']['TotalCost']['ConvertedPriceList']['Internal'].
            $this->cart['Basket']['TotalCost']['ConvertedPriceList']['Internal']['Sign'];
        $summary['approximate_weight'] = number_format($this->weight, 2, '.', ' ').Lang::get('kg');
        $summary['delivery'] = $deliveryModeInfo['name'];

        $newSummary = Plugins::invokeEvent('onCartSummaryGenerate',
            array('summary' => $summary, 'cart' => $this->cart, 'delivery' => $deliveryModeInfo));

        $summary = $newSummary ? $newSummary : $summary;
        $this->tpl->assign('summary', $summary);
    }
}
