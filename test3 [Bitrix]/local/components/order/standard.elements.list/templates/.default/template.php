<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die(); ?>
<?
use \Bitrix\Main\Localization\Loc as Loc;
Loc::loadMessages(__FILE__);
?>

<? if (count($arResult['ITEMS'])):?>
<!--<h2><?=Loc::getMessage('STANDARD_ELEMENTS_LIST_TEMPLATE_TITLE');?></h2>-->



<div class="body-content"><!-- ng-init="hidden='<?="//".$_SERVER["SERVER_NAME"].$componentPath;?>'"-->
	
	<div ng-app="test-app">
  		<form ng-controller="ctrlForm" name="form" ng-submit="submit()">
        	<h4 ng-bind-html-unsafe="html">{{greeting}}</h4>
            <span style="display:none;">{{hidden = '<?="//".$_SERVER["SERVER_NAME"].$componentPath;?>'}}</span>
            <div class="form-internal-container" ng-hide="h1">        	
              
                <select class="form-control" value="Выберите товар" ng-model="selectProduct"><!-- ng-model="user.product"-->
                  	<option selected value="">Выберите товар</option>
                	  
                  	<? foreach ($arResult['ITEMS'] as $item):?>
                  	<option value="<?=$item['ID'];?>:<?=$item['PRICE'];?>:<?=$item['DISCOUNT_PRICE'];?>:<?=$item['MEASURE'];?>:<?=$item['NAME'];?>"><?=$item['NAME'];?></option>
                  	<? endforeach;?>
                
                </select>
 
                 
                <div class="form-horizontal">
                  <div class="form-group">
                    
                    <div class="col-sm-3">
                      <input type="text" class="form-control" id="inputCount" placeholder="Количество"  ng-model="Count">
                    </div>
                    <label for="inputCount" class="col-sm-4 control-label">{{measure}}</label>
                  </div>
                  
                    <div class="form-group">
                        <div class="col-sm-3">
                          <p class="form-control-static">Стоимость:</p>
                        </div>
                        <label class="col-sm-4 control-label">{{sum}}</label>
                        
                    </div>                  
                  </div>
                  
                 
                
                
                <h4>Данные покупателя</h4>
                

                <input type="text" class="form-control" placeholder="Ваше имя" ng-model="user.name" required>
                <input type="email" class="form-control" placeholder="Ваш e-mail" ng-model="user.mail" required>
            	
                <input type="text" style="display:none;" class="form-control" placeholder="" value="" ng-model="user.sec">
                
                <input type="submit" class="btn red btn-lg btn-primary btn-block margin-top-10" value="Отправить">
    			


  			</div>
            
            <div class="form-internal-container repo" ng-show="h2">
            	<span>Поздравляем! Ваша заявка принята. В ближайшее время с Вами свяжется наш менеджер</span>
            </div>
           
        
            
            
        </form>
	</div>
   
</div>






<? endif;?>

<?

$this->addExternalJS("http://ajax.googleapis.com/ajax/libs/angularjs/1.4.2/angular.min.js");
$this->addExternalJS("http://cdnjs.cloudflare.com/ajax/libs/angular-ui-utils/0.1.1/angular-ui-utils.min.js");
$this->addExternalCss("//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css");
$template_folder="//".$_SERVER["SERVER_NAME"].$this->GetFolder();
$this->addExternalCss($template_folder."/assets/css/common.css");
$this->addExternalJS($template_folder."/assets/js/script.js");

?>	