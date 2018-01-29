// Vinnie <lazybear(at)nikolas.ru> 17.03.2011 12:47:37

//jQuery.noConflict();
jQuery(document).ready(onReadyFunc);

// выбор способа отправки
// в зависимости от способа - перерисуем список городов
function changeDeliveryType()
{
 var id = jQuery('#deliveryType').val();
 var ns = '<select id="deliveryCountry" name="deliverycountry" ' + (id == 0 ? 'disabled' : '') + '>';
 var params = {
               changedEl: "#deliveryCountry",
               visRows: 5,
               checkZIndex: true
              };
 if(id != 0) {
     var c = deliveryTypes[id]['country'];
     for(var i = 0; i < c.length; i++) {
         ns += '<option value="' + c[i]['id'] + '">' + c[i]['name'] + '</option>'; 
     };
 };
 ns += '</select>';
 jQuery('#cuselFrame-deliveryCountry').replaceWith(ns);
 cuSel(params);
 jQuery('#deliveryCountry').change(changeDeliveryCountry);
 count();
};

function changeDeliveryCountry()
{
 count();
};


function showError(id, error)
{
 jQuery('#' + id).parents('.forInput').first().addClass('errorInput');
};

function clearError(id)
{
 jQuery('#' + id).parents('.forInput').first().removeClass('errorInput');
};

// вывод промежуточных сумм валюты
// id - id родительского блока
// summ - отображаемая сумма
// a - если есть, то к выводу добавить и юань(CNY)
function showResult(id, summ, a)
{
 var res = new Array();
 if(!isNaN(a)) {
     res.push((summ > 0 ? number_format(summ) : 0) + ' CNY');
 };
 for(var i in currency) {
     res.push(_countCurrency(summ, currency[i]) + ' ' + i);  
 };
 jQuery('#c_' + id).text(res.join(' / '));
};

// цена в китае
function changePrice()
{

 var p = jQuery(this).val();
 if(!checkPrice(p)) {
     showError(jQuery(this).attr('id'), 'Некорректно указана стоимость');
 }
 else {
     tmp = parseFloat(p.replace(',', '.'), 10);
     tmp = isNaN(tmp) ? 0 : tmp;
     price = tmp; 
     showResult(jQuery(this).attr('id'), price);
     clearError(jQuery(this).attr('id'));
 };  
 count();
};

// вес посылки
function changeWeight()
{
 var p = jQuery(this).val();
// if(!checkPrice(p)) {
//   showError(jQuery(this).attr('id'), 'Некорректно указан вес');
//  }
 if(checkWeight()) {
     tmp = parseInt(p.replace(',', '.'), 10);
     tmp = isNaN(tmp) ? 0 : tmp;
     weight = tmp;
     //clearError(jQuery(this).attr('id'));
 };  
 count();
};

function checkWeight(cCountry) // макс вес для страны
{
 var w = jQuery('#weight').val();
 if(!checkPrice(w)) {
     showError('weight', 'Некорректно указан вес');
     return 0;
 };
 if(cCountry) {
     if(cCountry['weightlimit'] && cCountry['weightlimit'] < weight) {
         showError('weight', 'Указанный вес превышает максимальный');
         return  0;
     }
 };
 clearError('weight');
 return 1;
};

// доставка по китаю
function changeChinaDelivery()
{

 var p=jQuery(this).val();
 if(!checkPrice(p)) {
    showError(jQuery(this).attr('id'), 'Некорректно указана стоимость');
 }
 else {
     tmp = parseFloat(p.replace(',', '.'), 10);
     tmp = isNaN(tmp) ? 0 : tmp;
     chinaDelivery = tmp;
     showResult(jQuery(this).attr('id'), chinaDelivery);
     clearError(jQuery(this).attr('id'));
 };  
 count();
};
// считаем 
function count()
{

 countDelivery();
 countCommission();
 var summ = 0;
 if(deliveryCost && price && commission) {
     //summ = deliveryCost + price + chinaDelivery + commission;
     summ = deliveryCost + price;
 };
 showFinalCost(summ);
};

// вывод финальной суммы
function showFinalCost(summ)
{
 var resStr = '<span class="no_margin">Итоговая стоимость:</span>'; // мда.. печально..
 resStr += '<b>' + (summ > 0 ? number_format(summ) : 0) + ' CNY</b>';  
 for(var i in currency) {
     resStr += '/<span>' + _countCurrency(summ, currency[i]) + ' ' + i + '</span>';  
 };
 jQuery('#finalCost').html(resStr);
};

function currentDeliveryType()
{
 return jQuery('#deliveryType').val();  // способ доставки
};

function currentDeliveryCountry()
{
 return jQuery('#deliveryCountry').val(); // страна
};

// рассчет стоимости доставки
// формула рассчета 
// единиц_веса = округлить_до_целого_вверх(вес / единица веса);  //единица веса для каждого способов доставки своя
// стоимость = стоимость_первой_единицы_веса_для_выбранного_способа_доставки_и_города + (единиц_веса-1) ? (единиц_веса-1) * стоимость_каждой следующей_единицы_веса_для_выбранного_способа_доставки_и_города : 0; 
// прям 1С получился ))
function countDelivery()
{

 if(!weight) {deliveryCost = 0; return};
 var dType = currentDeliveryType();  // способ доставки
 var country = currentDeliveryCountry(); // страна
 var dTypes = deliveryTypes[dType];
 if(dTypes) {
     var countryList = dTypes['country'];
     var cCountry;
     for(var i = 0; i < dTypes['country'].length; i++) {
         if(dTypes['country'][i]['id'] == country) {
             cCountry = dTypes['country'][i];
             break;
         };
     };
     if(cCountry) { // ага, страна нашлась 
         if(checkWeight(cCountry)) {
             var tmp = Math.ceil(weight / dTypes['weight']); // округлим вверх
             deliveryCost = cCountry['firstweight'] + (tmp-1) * cCountry['nextweight'];
         };    
     };
 }
 else { 
     deliveryCost = 0;
 };
 showResult('deliveryCost', deliveryCost, 1); 
};

// считаем коммиссию
// комиссия считается от цены товара в Китае и стоимости доставки по Китаю
function countCommission()
{
 if(price) {
     commission = price + chinaDelivery;
     commission = commission / commissionPercent;
     commission = (commission < commissionMin ? commissionMin : commission);
 }
 else {
     commission = 0;
 };
 showResult('commission', commission, 1);    
};

// инит всего этого кошмара
function onReadyFunc() 
{

  //jQuery('#deliveryType').change(changeDeliveryType);
  jQuery('#price').keyup(changePrice);
  jQuery('#weight').keyup(changeWeight);
  jQuery('#chinaDelivery').keyup(changeChinaDelivery);
  // clean
  jQuery('#price').val('');
  jQuery('#chinaDelivery').val('');
  jQuery('#weight').val('');

  var params = {
      changedEl: "#deliveryType",
      visRows: 4,
      checkZIndex: true
  }
  cuSel(params);
  
  var params = {
      changedEl: "#deliveryCountry",
      visRows: 10,
      checkZIndex: true
  }
  cuSel(params);
  //jQuery('#deliveryType').change(changeDeliveryType);

};  