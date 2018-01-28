<?php if (!defined("DIAFAN")){include "../../includes/404.php";}?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title><insert name="show_title"> - from diafan.ru</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="<insert name="path">css/style.css" rel="stylesheet" type="text/css">
<insert name="show_background">
<script type="text/javascript" src="http://yandex.st/jquery/1.7.1/jquery.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="http://<insert name="base_url">/js/jquery-ui-1.8.18.custom.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="http://<insert name="base_url">/js/timepicker.js" charset="UTF-8"></script>
<link href="<insert name="path">css/custom-theme/jquery-ui-1.8.18.custom.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="http://yandex.st/jquery/form/2.83/jquery.form.min.js" charset="UTF-8"></script>

<script type="text/javascript" src="http://<insert name="base_url">/js/jquery.tooltip.min.js" charset="UTF-8"></script>
<link href="http://<insert name="base_url">/css/jquery.tooltip.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="http://<insert name="base_url">/js/admin/admin.base.js" charset="UTF-8"></script>
<insert name="show_js">

</head>
<body>
	<div class="page">
		<div class="main">
			<table width="100%">
				<tr valign="top">
					<td class="head">

						<table width="100%">
							<tr>
								<td class="head_td head_1">
									<div class="logo">
										<insert value="Система управления сайтом">
										<div class="logo_url"><a href="http://<insert name="base_url">/" target="_blank"><insert name="base_url"></a></div>
									</div>

								</td>
								<td class="head_td head_2">
									<insert value="Администрирование"> <img src="<insert name="path">img/admin_top_icon.png" alt=""> <a href="http://<insert name="base_url">/" class="go_site"><insert value="Сайт"></a>  <span class="go_edit">(<span><insert value="режим редактирования"></span>)</span>
								</td>
								<insert name="show_languages">

								<td class="head_td head_4">
									<div class="user_info">
									<span class="user_name"><a href="<insert name="path_url">users/edit<insert name="userid">/"><insert name="userfio"></a></span><span class="exit"><a href="<insert name="path_url">logout/?<insert name="show_rand">"><insert value="Выйти"></a></span></div>
								</td>
							</tr>

						</table>
					</td>
				</tr>
				<tr>
					<td>
						<div class="content">
							<table>
								<tr>
									<td class="col_1_top">
										<insert name="show_menu">
									</td>
									<td class="col_2_top">
										<div class="col_2_content">
										
										<insert name="show_body">

										</div>
									</td>
									<td class="col_3_top">
										<insert name="show_themes">
									</td>
								</tr>

								<tr>
									<td class="col_1_bottom"></td>
									<td class="col_2_bottom">
										<div class="bottom">
											<div class="bottom_copyright">
												<insert name="show_brand" id="2">
											</div>
											<div class="teh"><a href="https://user.diafan.ru/support/"><insert value="Техническая поддержка"></a>
                                                                                        <insert name="show_docs">
                                                                                        </div>
										</div>
									</td>
									<td class="col_3_bottom"></td>
								</tr>
							</table>
						</div>
					</td>
				</tr>
			</table>

		</div>
	</div>
</body>
</html>