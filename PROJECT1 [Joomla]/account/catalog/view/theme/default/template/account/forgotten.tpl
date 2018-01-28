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
						<a href="<?php echo $this->url->link('account/register'); ?>" class="">
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

<?php if ($error_warning) { ?>
<div class="warning"><?php echo $error_warning; ?></div>
<?php } ?>

<div class="account-container">
	
	<div class="content clearfix">
		
		<form action="<?php echo $action; ?>" method="post">
		
			<h1>Напоминание пароля</h1>		
			
			<div class="login-fields">
				
				<p>Пожалуйста, введите E-mail</p>
				
				<div class="field">
					<label for="username">E-mail</label>
					<input type="text" id="username" name="email" value="" placeholder="E-mail" class="login username-field" />
				</div> <!-- /field -->
				
				
			</div> <!-- /login-fields -->
			
			<div class="login-actions">
			
				<button class="button btn btn-success btn-large">Войти в кабинет</button>
				
			</div> <!-- .actions -->
			
			
			
		</form>
		
	</div> <!-- /content -->
	
</div> <!-- /account-container -->


<?php  echo $footer; ?>