<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron"><!--ng-app="head"-->
 		<h3>GitHub аккаунт</h3><!-- ng-controller="headText" {{greeting}}-->
 
    </div>

    <div class="body-content">
	
	<div ng-app="test-app">
  		<form ng-controller="ctrlForm" name="form" ng-submit="submit()">
        	<span ng-bind-html-unsafe="html">{{greeting}}</span>
			<div class="form-internal-container span4" ng-hide="h1">        	
                <input type="text" class="form-control" placeholder="Токен" ng-model="user.token" required>
                <!--<input type="password" class="form-control margin-top-10" placeholder="Пароль" ng-model="user.pass">-->
                <input type="submit" class="btn red btn-lg btn-primary btn-block margin-top-10" value="Войти">
  			</div>
            <div class="form-internal-container span4 repo" ng-show="h2">
            	
            </div>
            <div class="form-internal-container span10 graph" ng-show="h3">
            	<div class="btn-group btn-group__graph">
                
  					<!--<button type="button" class="btn btn-default">Левая</button>
  					<button type="button" class="btn btn-default">Средняя</button>
  					<button type="button" class="btn btn-default">Правая</button>-->
				</div>
            	<div id="graph" class="form-internal-container__graph"  ng-show="h3_graph"></div>
            </div>
            
        </form>
	</div>



<!--
        <div class="row">
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
            </div>
        </div>
        -->

    </div>
</div>
