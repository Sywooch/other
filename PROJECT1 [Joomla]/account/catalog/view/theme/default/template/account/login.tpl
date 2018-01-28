<?php echo $header; ?>


<div class="navbar navbar-fixed-top">
	
	<div class="navbar-inner">
		
		<div class="container">
			
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			
					
			
			<div class="nav-collapse">
				<ul class="nav pull-right">
					
					<li class="">						
						<a href="<?php echo $register; ?>" class="">
							У Вас еще нет кабинета?
						</a>
						
					</li>
					
					<li class="">						
						
						
					</li>
				</ul>
				
			</div><!--/.nav-collapse -->	
	
		</div> <!-- /container -->
		
	</div> <!-- /navbar-inner -->
	
</div> <!-- /navbar -->


<?php if ($success) { ?>
<div class="success"><?php echo $success; ?></div>
<?php } ?>
<?php if ($error_warning) { ?>
<div class="warning"><?php echo $error_warning; ?></div>
<?php } ?>

<div class="account-container">
	
	<div class="content clearfix">
		
		<form action="<?php echo $action; ?>" method="post">
		
			<h1>Вход в кабинет пользователя</h1>		
			
			<div class="login-fields">
				
				<p>Пожалуйста, введите логин и пароль</p>
				
				<div class="field">
					<label for="username">E-mail</label>
					<input type="text" id="username" name="email" value="" placeholder="E-mail" class="login username-field" />
				</div> <!-- /field -->
				
				<div class="field">
					<label for="password">Пароль:</label>
					<input type="password" id="password" name="password" value="" placeholder="Password" class="login password-field"/>
				</div> <!-- /password -->
				
			</div> <!-- /login-fields -->
			
			<div class="login-actions">
				
				<span class="login-checkbox">
					<input id="Field" name="Field" type="checkbox" class="field login-checkbox" value="First Choice" tabindex="4" />
					<label class="choice" for="Field">Запомнить меня</label>
				</span>
									
				<button class="button btn btn-success btn-large">Войти в кабинет</button>
				
			</div> <!-- .actions -->
			
			
			
		</form>
		
	</div> <!-- /content -->
	
</div> <!-- /account-container -->



<div class="login-extra">
	<a href="<?php echo $forgotten; ?>">Восстановление пароля</a>
</div> <!-- /login-extra -->


 <script src="catalog/view/theme/default/js/signin.js"></script>

<?php echo $footer; ?>