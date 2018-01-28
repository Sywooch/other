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
						<a href="http://kondratik.ru/account" class="">
							У Вас есть кабинет? ВОЙДИТЕ!
						</a>
						
					</li>
					<li class="">						
						
					</li>
				</ul>
				
			</div><!--/.nav-collapse -->	
	
		</div> <!-- /container -->
		
	</div> <!-- /navbar-inner -->
	
</div> <!-- /navbar -->


<?php if ($error_warning) { ?>
<div class="warning"><?php echo $error_warning; ?></div>
<?php } ?>
<div class="account-container register">
	
	<div class="content clearfix">
		
		<form action="<?php echo $action; ?>" method="post">
		
			<h1>Регистрация нового кабинета</h1>			
			
			<div class="login-fields">
				
				<p>Пожалуйста, заполните строки:</p>
				
				<div class="field"><?php if ($error_firstname) { ?>
            <span class="error"><?php echo $error_firstname; ?></span>
            <?php } ?>
					<label for="firstname">Имя:</label>
					<input type="text" id="firstname" name="firstname" value="" placeholder="* Ваше имя" class="login" />
				</div> <!-- /field -->
				 
				
				<div class="field"> <?php if ($error_email) { ?>
            <span class="error"><?php echo $error_email; ?></span>
            <?php } ?>
					<label for="email">E-mail:</label>
					<input type="text" id="email" name="email" value="" placeholder="* Email" class="login"/>
				</div> <!-- /field -->
				
			<div class="field"> <?php if ($error_telephone) { ?>
            <span class="error"><?php echo $error_telephone; ?></span>
            <?php } ?>
					<label for="email">Телефон:</label>
					<input type="text" id="phone" name="telephone" value="" placeholder="* Ваш телефон" class="login"/>
				</div> <!-- /field -->
			
				<div class="field"> <?php if ($error_password) { ?>
            <span class="error"><?php echo $error_password; ?></span>
            <?php } ?>
					<label for="password">Password:</label>
					<input type="password" id="password" name="password" value="" placeholder="* Пароль" class="login"/>
				</div> <!-- /field -->
				
				<div class="field"><?php if ($error_confirm) { ?>
            <span class="error"><?php echo $error_confirm; ?></span>
            <?php } ?>
					<label for="confirm_password">Confirm Password:</label>
					<input type="password" id="confirm_password" name="confirm" value="" placeholder="* Повторите пароль" class="login"/>
				</div> <!-- /field -->
				 
			</div> <!-- /login-fields -->
			
			<div class="login-actions">
				
				
									
				<button class="button btn btn-primary btn-large">Зарегистрировать</button>
				<input type="hidden" name="partner_id" value="<?php echo $partner_id; ?>" />
			</div> <!-- .actions -->
			
		</form>
		
	</div> <!-- /content -->
	
</div> <!-- /account-container -->


<!-- Text Under Box -->
<div class="login-extra">
У Вас есть кабинет? <a href="">ВОЙДИТЕ!</a>
</div> <!-- /login-extra -->






<?php  echo $footer; ?>