<!DOCTYPE html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<link rel="stylesheet" href="style.css"/>
	<script src="http://yandex.st/jquery/1.7.2/jquery.min.js"></script>
	<script src="inner.js"></script>
	<script src="general.js"></script>
	<title></title>
</head>
<body>
        <form action="index.php?action=setlang" method="post">
            <input type="hidden" name="lang" id="lang" />
            <input type="hidden" name="from" value="<?=$_SERVER['REQUEST_URI']?>" />
        </form>
	<!-- .header -->
	<div class="header"><div class="wrap clrfix">
		<!-- .col240 -->
		<div class="col col240 mr30">
                    <a href="http://<?=$_SERVER['HTTP_HOST']?>" class="logo">Opentao Shop</a>
		</div>
		<!-- /.col240 -->
		<!-- .col690 -->
		<div class="col col690">
			<ul class="hblocks">
				<li class="name">
					<?=Lang::get('opentao_shop_installation_br')?>
				</li>
			</ul>
		</div>	
		<!-- /.col690 -->
	</div></div>
	<!-- /.header -->
	
	<!-- .spacer -->
	<div class="spacer"><div class="wrap clrfix"></div></div>
	<!-- /.spacer -->
	
        <!-- .nav -->
        <div class="navigation"><div class="wrap clrfix">
                <ul class="flr sblocks">

                    <li>
                        <a href="#" onclick="return false" class="lang arrow"><span><i class="<?=@$_SESSION['active_lang']?>"></i></span></a>
                        <ul class="bgr-block bx5 menu-lang">
                            <li><a href="#" class="lang"><i class="ru"></i></a></li>
                            <li><a href="#" class="lang"><i class="en"></i></a></li>
                        </ul>
                    </li>
                </ul>
            </div></div>
        <!-- /.nav -->
    
	<div class="spacer mb20"><div class="wrap clrfix"></div></div>
