<?php
/**
 * Продвижение сайта WebEffector
 * 
 * @package    Diafan.CMS
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */

if (! defined('DIAFAN'))
{
	include(dirname(dirname(dirname(__FILE__))).'/includes/404.php');
}

class Webeffector_admin extends Frame_admin
{
	/**
	 * @var string токен
	 */
	private $token;

	/**
	 * @var string URL текущего сайта
	 */
	private $url;

	/**
	 * @var array информация о медиаплан на текущий сайт
	 */
	private $plan;

	/**
	 * @var array информация о компании для текущего сайта
	 */
	private $seo;

	/**
	 * Основная страница модуля
	 * @return void
	 */
	public function show()
	{
		$this->url = BASE_PATH;

		include_once(ABSOLUTE_PATH.'plugins/json.php');

		echo '<ul class="tabs">
			<div class="tabs_line"></div>
<li class="tab'.(empty($_GET["action"]) || $_GET["action"] != "webeffector_seo" ? '_act' : '').'">
<a href="'.BASE_PATH_HREF.'webeffector/">Медиапланер</a>
<div class="left_tab'.(empty($_GET["action"]) || $_GET["action"] != "webeffector_seo" ? '_act' : '').'_first"></div>
<div class="right_tab'.(empty($_GET["action"]) || $_GET["action"] != "webeffector_seo" ? '_act' : '').'"></div>
</li>
<li class="tab'.(! empty($_GET["action"]) && $_GET["action"] == "webeffector_seo" ? '_act' : '').'">
<a href="'.BASE_PATH_HREF.'webeffector/?action=webeffector_seo">Запросы</a>
<div class="left_tab'.(! empty($_GET["action"]) && $_GET["action"] == "webeffector_seo" ? '_act' : '').'"></div>
<div class="right_tab'.(! empty($_GET["action"]) && $_GET["action"] == "webeffector_seo" ? '_act' : '').'"></div>
</li>
<div class="clear"></div>
</ul>';
		if(! empty($_POST["action"]))
		{
			switch($_POST["action"])
			{
				case "webeffector_register":
					$this->register();
					break;
				case "webeffector_auth":
					$this->save_auth();
					break;
			}
		}
		$this->auth();
		if(! $this->token)
		{
			if(! empty($_GET["action"]) && $_GET["action"] == "webeffector_auth")
			{
				return $this->auth_form();
			}
			return $this->register_form();
		}
		$this->get_seo();
		if(! empty($_POST["action"]))
		{
			switch($_POST["action"])
			{
				case "webeffector_create_promotion":
					$this->create_promotion();
					break;

				case "webeffector_delete_promotion":
					$this->delete_promotion();
					break;

				case "webeffector_work_promotion":
					$this->work_promotion();
					break;

				case "webeffector_create_seo":
					$this->create_seo();
					break;

				case "webeffector_plan_to_promotion":
					$this->get_plan();
					$this->plan_to_promotion();
					break;

			}
		}
		if(empty($this->seo["id"]))
		{
			$this->create_seo_form();
			return;
		}
		if(! empty($_GET["action"]))
		{
			switch($_GET["action"])
			{
				case "webeffector_seo":
					$this->template_seo();
					break;

				case "webeffector_create_promotion_form":
					$this->create_promotion_form();
					break;

				default:
					include_once(ABSOLUTE_PATH.'includes/404.php');
			}
		}
		else
		{
			$this->get_plan();
			if(! $this->plan)
			{
				if($this->diafan->configmodules("create_plan", "webeffector"))
				{
					echo '<p>Ваш сайт анализируется сервисом. Это может занять продолжительное время. Обновите страницу через несколько минут.</p>';
					return;
				}
				$this->create_seo_form();
				return;
			}
			$this->template_plan();
		}
	}
	
	/**
	 * Авторизация в системе WebEffector
	 *
	 * @return void
	 */
	private function auth()
	{
		if(! $this->diafan->configmodules("login", "webeffector") || ! $this->diafan->configmodules("password", "webeffector"))
		{
			return;
		}
		$fp = fsockopen('api.webeffector.ru', 80);
		if($fp)
		{
			$login = $this->diafan->configmodules("login", "webeffector");
			$password = $this->diafan->configmodules("password", "webeffector");
			$data = to_json(array(
				"login" => $login,
				"password" => $password,
				"signature" =>  md5($login.":".$password.":hgWl_fnY5cbqD0")
			));
			fputs($fp, "POST http://api.webeffector.ru/token HTTP/1.1\r\n");
			fputs($fp, "Host: api.webeffector.ru\r\n");
 
			fputs($fp, "Content-Type: application/json;charset=UTF-8\r\n");
			fputs($fp, "X-Application: diafan_cms\r\n");
			fputs($fp, "Content-length: ". utf::strlen($data) ."\r\n");
			fputs($fp, "Connection: close\r\n\r\n");
			fputs($fp, $data);
 
			$result = ''; 
			while(!feof($fp))
			{
			    $result .= fgets($fp, 128);
			}
			if(preg_match("/http:\/\/api\.webeffector\.ru\/token-info\?token\=(.*)/", $result, $m))
			{
				$this->token = trim($m[1]);
			}
			fclose($fp);
		}
	}
	
	/**
	 * Авторизация в системе WebEffector
	 *
	 * @return void
	 */
	private function auth_form()
	{
		if(! empty($_POST["action"]) && $_POST["action"] == 'webeffector_auth')
		{
			if($this->token)
			{
				$this->diafan->redirect(BASE_PATH_HREF.'webeffector/');
			}
			else
			{
				echo '<div class="error">Не верный логин или пароль.</div>';
			}
		}
		echo '<p>Если Вы уже регистрировались и у Вас есть логин и пароль сервиса Web Effector, внесите их в настройки модуля.</p>';
		echo '<form method="POST" action="">
		<input type="hidden" name="action" value="webeffector_auth">
		<p>E-mail: <input type="text" name="webeffector_email" value="'.(!empty($_POST["webeffector_email"]) ? str_replace('"', '&quot;', $_POST["webeffector_email"]) : '').'"></p>
		<p>Пароль: <input type="password" name="webeffector_password" value="'.(!empty($_POST["webeffector_password"]) ? str_replace('"', '&quot;', $_POST["webeffector_password"]) : '').'"></p>
		<input type="submit" class="button" value="Ок">
		</form>';
	}

	/**
	 * Сохранение данных в системе WebEffector
	 *
	 * @return void
	 */
	private function save_auth()
	{
		if(empty($_POST["webeffector_email"]) || empty($_POST["webeffector_password"]))
		{
			echo '<div class="error">Заполните все поля.</div>';
			return;
		}
		$this->diafan->configmodules("login", "webeffector", 0, _LANG, $_POST["webeffector_email"]);
		$this->diafan->configmodules("password", "webeffector", 0, _LANG, $_POST["webeffector_password"]);
	}
	
	/**
	 * Форма регистрации в системе WebEffector
	 *
	 * @return void
	 */
	private function register_form()
	{
		echo '<p><img src="'.BASE_PATH.'modules/webeffector/admin/img/logo.gif" alt="" align="left" hspace="10">ВебЭффектор – эффективный и автоматический сервис продвижения сайтов в ТОП поисковых систем. Незаменимый инструмент для владельцев сайтов и вебмастеров, а для SEO-специалистов – лучший друг и помощник в работе.
		<hr>
		Для начала работы требуется дополнительная регистрация в системе Web Effector.
		</p>';

		echo '<form method="POST" action="">
		<input type="hidden" name="action" value="webeffector_register">
		<p>E-mail: <input type="text" name="webeffector_email" value="'.(!empty($_POST["webeffector_email"]) ? str_replace('"', '&quot;', $_POST["webeffector_email"]) : '').'"></p>
		<p>Пароль: <input type="password" name="webeffector_password" value="'.(!empty($_POST["webeffector_password"]) ? str_replace('"', '&quot;', $_POST["webeffector_password"]) : '').'"></p>
		<input type="submit" class="button" value="Зарегистрироваться">
		</form>';
		echo '<p style="margin-top:200px; color:gray;">Если Вы уже регистрировались и у Вас есть логин и пароль сервиса Web Effector, внесите их <a href="?action=webeffector_auth">в настройки модуля</a>.</p>';
	}

	/**
	 * Регистрация в системе WebEffector
	 *
	 * @return void
	 */
	private function register()
	{
		if(empty($_POST["webeffector_email"]) || empty($_POST["webeffector_password"]))
		{
			echo '<div class="error">Заполните все поля.</div>';
			return;
		}
		$fp = fsockopen('user.diafan.ru', 80);
		if($fp)
		{
			$data = to_json(array(
				"email" => $_POST["webeffector_email"],
				"password" => $_POST["webeffector_password"]
			));
			fputs($fp, "POST http://user.diafan.ru/service/webeffector.php HTTP/1.1\r\n");
			fputs($fp, "Host: user.diafan.ru\r\n");
 
			fputs($fp, "Content-Type: application/json;charset=UTF-8\r\n");
			fputs($fp, "Content-length: ".utf::strlen($data)."\r\n");
			fputs($fp, "Connection: close\r\n\r\n");
			fputs($fp, $data);
 
			$result_json = ''; 
			while(!feof($fp))
			{
				$res = fgets($fp, 128);
				if(strpos($res, '{') !== false || strpos($res, '}') !== false)
				{
					$result_json .= $res;
				}
			}
			$result = from_json($result_json);
			if(! empty($result["success"]))
			{
				$this->diafan->configmodules("login", "webeffector", 0, _LANG, $_POST["webeffector_email"]);
				$this->diafan->configmodules("password", "webeffector", 0, _LANG, $_POST["webeffector_password"]);
				$this->diafan->redirect(BASE_PATH_HREF.'webeffector/');
			}
			else
			{
				foreach($result["errors"] as $field => $errors)
				{
					foreach($errors as $error)
					{
						switch($error["message"])
						{
							case "not a well-formed email address":
								$error["message"] = 'E-mail адрес не правильного формата.';
								break;
							case "User with login (email) already exists":
								$error["message"] = 'Ваш e-mail уже есть в системе Web Effector. Для работы с сервисом через diafan.CMS требуется отдельный e-mail';
								break;
							case "length must be between 5 and 2147483647":
								$error["message"] = 'Пароль должен быть не менее 5 символов.';
								break;
							default:
								$error["message"] = $field.': '.$error["message"];
								break;
						}
						echo '<div class="error">'.$error["message"].'</div>';
					}
				}
			}
			fclose($fp);
		}
	}
	
	/**
	 * Получаем номер медиаплана в системе WebEffector
	 *
	 * @return void
	 */
	private function get_plan()
	{
		$fp = fsockopen('api.webeffector.ru', 80);
		if($fp)
		{
			fputs($fp, "GET http://api.webeffector.ru/ifce/plan/".$this->diafan->configmodules("seo_id", "webeffector")."?token=".$this->token." HTTP/1.1\r\n");
			fputs($fp, "Host: api.webeffector.ru\r\n");
 
			fputs($fp, "Content-Type: application/json;charset=UTF-8\r\n");
			fputs($fp, "X-Application: diafan_cms\r\n");
			fputs($fp, "Content-length: 0\r\n");
			fputs($fp, "Connection: close\r\n\r\n");
 
			$result_json = ''; 
			while(!feof($fp))
			{
				$res = fgets($fp, 12800);
				if(strpos($res, '{') !== false || strpos($res, '[') !== false || strpos($res, '}') !== false)
				{
					$result_json .= $res;
				}
			}
			fclose($fp);

			$this->plan = from_json(str_replace(array("\n", "\r", "\t"), ' ', $result_json));
		}
	}
	
	/**
	 * Выводится список запросов в рамках медиаплана
	 *
	 * @return void
	 */
	private function template_plan()
	{
		if(empty($this->plan))
		{
			echo '<p>Продвигаемые запросы не найдены.</p>';
			return;
		}
		$p = 0;
		$nastr = 30;
		if(! empty($_GET["page"]))
		{
			$page = intval($_GET["page"]);
		}
		if(empty($page))
		{
			$page = 1;
		}
		echo '<script type="text/javascript" src="'.BASE_PATH.'modules/webeffector/admin/webeffector.admin.js"></script>';
		echo '
		<form action="" method="POST">
		<input type="hidden" name="check_hash_user" value="'.$this->diafan->_user->get_hash().'">
		<input type="hidden" name="action" value="">
		<table width="100%">
		<tr>
		<td>&nbsp;</td>
		<td><b>Ключевое слово</b></td>
		<td><b>Страница</b></td>
		<td><b>Бюджет, руб./мес.</b></td>
		</tr>
		<tr><td colspan="4"><hr></td></tr>';
		foreach($this->plan as $i => $row)
		{
			$p++;
			if($p <= ($page -1) * $nastr || $p > $page * $nastr)
			{
				continue;
			}
			echo '<tr>
			<td><input type="checkbox" name="ids[]" value="'.$i.'"></td>
			<td>'.$row["word"].'</td>
			<td>'.$row["url"].'</td>
			<td>'.$row["budget"].'</td>
			</tr>';
		}
		echo '
		<tr><td colspan="4"><hr><input id="webeffector_select_all" type="checkbox"> <span style="font-size: 11px;">Отметить все</span></td></tr></table>
		<p><input type="button" value="Добавить в кампанию" class="button" action="webeffector_plan_to_promotion"></p>
		</form>';
		echo '<div class="paginator">';
		for($i = 1; $i <= count($this->plan)/$nastr; $i++)
		{
			if($i == $page)
			{
				echo '['.$i.'] ';
			}
			else
			{
				echo '<a href="'.BASE_PATH_HREF.'webeffector/'.($i != 1 ? '?page='.$i : '').'">'.$i.'</a> ';
			}
		}
		echo '</div>';
	}

	/**
	 * Получаем номер кампании в системе WebEffector
	 *
	 * @return void
	 */
	private function get_seo()
	{
		$this->get_seos();
		if(! $this->diafan->configmodules("seo_id", "webeffector"))
		{
			$this->get_seos();
		}
		if(! $this->diafan->configmodules("seo_id", "webeffector"))
			return;

			
		$fp = fsockopen('api.webeffector.ru', 80);
		if($fp)
		{
			fputs($fp, "GET http://api.webeffector.ru/seo/".$this->diafan->configmodules("seo_id", "webeffector")."?token=".$this->token."&notEmpty=false HTTP/1.1\r\n");
			fputs($fp, "Host: api.webeffector.ru\r\n");
 
			fputs($fp, "Content-Type: application/json;charset=UTF-8\r\n");
			fputs($fp, "X-Application: diafan_cms\r\n");
			fputs($fp, "Content-length: 0\r\n");
			fputs($fp, "Connection: close\r\n\r\n");
 
			$result_json = ''; 
			while(!feof($fp))
			{
				$res = fgets($fp, 1280);
				if(strpos($res, '{') !== false || strpos($res, '[') !== false || strpos($res, '}') !== false)
				{
					$result_json .= $res;
				}
			}
			fclose($fp);

			$this->seo = from_json($result_json);
		}
	}

	/**
	 * Получаем номер кампании в системе WebEffector из списка всех кампаний
	 *
	 * @return void
	 */
	private function get_seos()
	{
		$fp = fsockopen('api.webeffector.ru', 80);
		if($fp)
		{
			fputs($fp, "GET http://api.webeffector.ru/seo?token=".$this->token."&notEmpty=false HTTP/1.1\r\n");
			fputs($fp, "Host: api.webeffector.ru\r\n");
 
			fputs($fp, "Content-Type: application/json;charset=UTF-8\r\n");
			fputs($fp, "X-Application: diafan_cms\r\n");
			fputs($fp, "Content-length: 0\r\n");
			fputs($fp, "Connection: close\r\n\r\n");
 
			$result_json = ''; 
			while(!feof($fp))
			{
				$res = fgets($fp, 128);
				if(strpos($res, '{') !== false || strpos($res, '[') !== false || strpos($res, '}') !== false)
				{
					$result_json .= $res;
				}
			}
			fclose($fp);

			$result = from_json($result_json);
			if(! empty($result))
			{
				foreach($result as $row)
				{
					if($row["url"] == $this->url)
					{
						$this->diafan->configmodules("seo_id", "webeffector", 0, _LANG, $row["id"]);
						break;
					}
				}
			}
		}
	}

	/**
	 * Получаем баланса пользователя
	 *
	 * @return void
	 */
	private function get_balanse()
	{
		$fp = fsockopen('api.webeffector.ru', 80);
		if($fp)
		{
			fputs($fp, "GET http://api.webeffector.ru/user?token=".$this->token." HTTP/1.1\r\n");
			fputs($fp, "Host: api.webeffector.ru\r\n");
 
			fputs($fp, "Content-Type: application/json;charset=UTF-8\r\n");
			fputs($fp, "X-Application: diafan_cms\r\n");
			fputs($fp, "Content-length: 0\r\n");
			fputs($fp, "Connection: close\r\n\r\n");
 
			$result_json = ''; 
			while(!feof($fp))
			{
				$res = fgets($fp, 1280);
				if(strpos($res, '{') !== false || strpos($res, '[') !== false || strpos($res, '}') !== false)
				{
					$result_json .= $res;
				}
			}
			fclose($fp);

			$user = from_json($result_json);
			if(! empty($user["balance"]))
			{
				return $user["balance"];
			}
			else
			{
				return 0;
			}
		}
		return 0;
	}
	
	/**
	 * Форма создания кампании
	 *
	 * @return void
	 */
	private function create_seo_form()
	{
		echo '<form method="POST" action="">
		<input type="hidden" name="action" value="webeffector_create_seo">
		<p>Медиапланер – это инструмент, автоматически составляющий оптимальный план продвижения Вашего сайта. <br><br>
		После нажатия кнопки «Создать», система проанализирует контент Вашего сайта и предложит ключевые слова, по которым рекомендуется продвигать Ваш сайт, чтобы получить целевых посетителей, а также ежемесячный бюджет. <br><br>
		Чтобы запустить продвижение по тем или иным ключевым словам, необходимо отметить их в предложенном списке и добавить в кампанию. <br><br>
		Выбранные слова появятся во вкладке «Запросы» с возможностью редактирования.<br><br>
		Для запуска медиаплана требуется только указать регион Вашего сайта</p>
		<p><select name="webeffector_region">';
		include(ABSOLUTE_PATH.'modules/webeffector/admin/webeffector.admin.regions.php');
		foreach($regions as $id => $region)
		{
			echo '<option value="'.$id.'"'.(!empty($_POST["webeffector_region"]) && $_POST["webeffector_region"] == $id || empty($_POST["webeffector_region"]) && $id == 225 ? ' selected' : '').'>'.$region.'</option>';
		}
		echo '</select></p>
		<input type="submit" class="button" value="Создать">
		</form>';
	}
	
	/**
	 * Создание заявки в системе WebEffector
	 *
	 * @return void
	 */
	private function create_seo()
	{
		if(empty($this->seo["id"]))
		{
			$id = rand(0, 99999);
			$this->diafan->configmodules("seo_id", "webeffector", 0, _LANG, $id);
			$fp = fsockopen('api.webeffector.ru', 80);
			if($fp)
			{
				include(ABSOLUTE_PATH.'modules/webeffector/admin/webeffector.admin.regions.php');
				$data = to_json(array(
					"name" => $this->url,
					"id" => $id,
					"url" => $this->url,
					"mode" => "DEFAULT",
					"region" => $regions[$_POST["webeffector_region"]],
					"pos" => array("yandex_ru", "google_ru"),
					"top" => array("yandex_ru"),
					"promos" => array(
						array(
						"id" => rand(0, 999999),
						"state" => "SLEEP",
						"url" => $this->url,
						"word" => TITLE,
						"budget" => 100,
						"position" => 10,
						"anchors" => array()
						)
					),
				));
				fputs($fp, "POST http://api.webeffector.ru/seo/".$id."?token=".$this->token." HTTP/1.1\r\n");
				fputs($fp, "Host: api.webeffector.ru\r\n");
	 
				fputs($fp, "Content-Type: application/json;charset=UTF-8\r\n");
				fputs($fp, "X-Application: diafan_cms\r\n");
				fputs($fp, "Content-length: ". utf::strlen($data) ."\r\n");
				fputs($fp, "Connection: close\r\n\r\n");
				fputs($fp, $data);
 
				$result = ''; 
				while(!feof($fp))
				{
				    $result .= fgets($fp, 128);
				}
				fclose($fp);
			}
		}
		$this->create_plan();
	}
	
	/**
	 * Создание плана в системе WebEffector
	 *
	 * @return void
	 */
	private function create_plan()
	{
		$fp = fsockopen('api.webeffector.ru', 80);
		if($fp)
		{
			$data = to_json(array(
				"url" => $this->url,
				"regionId" => $_POST["webeffector_region"],
			));
			fputs($fp, "POST http://api.webeffector.ru/ifce/plan/".$this->diafan->configmodules("seo_id", "webeffector")."?token=".$this->token." HTTP/1.1\r\n");
			fputs($fp, "Host: api.webeffector.ru\r\n");
			fputs($fp, "Content-Type: application/json;charset=UTF-8\r\n");
			fputs($fp, "X-Application: diafan_cms\r\n");
			fputs($fp, "Content-length: ". utf::strlen($data) ."\r\n");
			fputs($fp, "Connection: close\r\n\r\n");
			fputs($fp, $data);
 
			$result = ''; 
			while(!feof($fp))
			{
			    $result .= fgets($fp, 128);
			}
			fclose($fp);
			$this->diafan->configmodules("create_plan", "webeffector", 0, _LANG, true);
		}
		$this->diafan->redirect(BASE_PATH_HREF.'webeffector/');
	}
	
	
	/**
	 * Выводится список продвигаемых запросов в рамках бюджета
	 *
	 * @return void
	 */
	private function template_seo()
	{
		if(empty($this->seo["promos"]))
		{
			echo '<p>Продвигаемые запросы не найдены.</p>';
			return;
		}
		$p = 0;
		$nastr = 10;
		if(! empty($_GET["page"]))
		{
			$page = intval($_GET["page"]);
		}
		if(empty($page))
		{
			$page = 1;
		}
		$balanse = $this->get_balanse();

		echo '<script type="text/javascript" src="'.BASE_PATH.'modules/webeffector/admin/webeffector.admin.js"></script>';
		echo '
		<form action="'.BASE_PATH_HREF.'webeffector/" method="GET">
		<input type="hidden" name="action" value="webeffector_create_promotion_form">
		<p><input type="submit" value="Добавить запрос" class="button"></p>
		</form>
		
		<form action="" method="POST">
		<input type="hidden" name="check_hash_user" value="'.$this->diafan->_user->get_hash().'">
		<input type="hidden" name="action" value="">
		<table width="100%" class="rows">
		<tr>
		<td>&nbsp;</td>
		<td width="25%"><b>Ключевое слово</b></td>
		<td><b title="Геозависимый запрос">GEO</b></td>';
		$doptd = 0;
		foreach($this->seo["promos"][0]["positions"] as $k => $v)
		{
			echo '<td><div style="background: url(http://client.webeffector.ru/images/icon_library_png.png) 0 0 no-repeat; background-position: -'.($k=="google_ru"?'16':'33').'px -11px; width: 16px; height: 16px; margin: 0 0 0 3px;"  title="Позиция в '.str_replace('_', '.', $k).'"></div>
			</td>';
			$doptd++;
		}
		echo '<td><b title="Стремимся в ТОП поисковой системы">ТОП</b></td>
		<td><b title="Продвигаемая страница">URL</b></td>
		<td><b title="Бюджет, рублей в месяц">Бюджет</b></td>
		<td><b title="Рекомендуемый бюджет, рублей в месяц">Рекоменд.</b></td>
		<td><b title="Ваши расходы, рублей в месяц">Расход</b></td>
		<td><b title="Запущено в продвижение">+</b></td>
		</tr>
		<tr><td colspan="20"><hr></td></tr>';
		$budget = 0;
		foreach($this->seo["promos"] as $row)
		{
			if(empty($row["recommended_budget"]))
			{
				$row["recommended_budget"] = 0;
			}
			$p++;
			if($p <= ($page -1) * $nastr || $p > $page * $nastr)
			{
				continue;
			}
			echo '
			<tr>
			<td><input type="checkbox" name="ids[]" value="'.$row["id"].'"></td>
			<td>'.$row["word"].'</td>
			<td>'.($row["yandex_geo"] == "GEO" ? 'да' : 'нет').'</td>';
			foreach($row["positions"] as $k => $v)
			{
				echo '<td';
				if($row["yesterday_positions"][$k] < $v)
				{
					' style="color: green"';
				}
				elseif($row["yesterday_positions"][$k] > $v)
				{
					' style="color: red"';
				}
				echo '>'.($v==10000?'-':$v).'</td>';
			}
			echo '
			<td>'.$row["position"].'</td>
			<td class="name" title="'.$row["url"].'">...'.utf::substr(str_replace('http://', '', $row["url"]), -11, 11).'</td>
			<td>'.number_format($row["budget"], 0, ',', ' ').' р.</td>
			<td>'.number_format($row["recommended_budget"], 0, ',', ' ').' р.</td>
			<td><b>'.$row["day_cost"].'</b></td>
			<td>'.($row["state"] == 'SLEEP' ? '-' : '+').'</td>
			</tr>';
			$budget = $budget + $row["recommended_budget"];
		}
		echo '<tr><td colspan="20"><hr></td></tr>
		<tr><td colspan="2"><input id="webeffector_select_all" type="checkbox"> <span style="font-size: 11px;">Отметить все</span></td><td colspan="'.(4+$doptd).'" align="right">Рекомендуемый бюджет:&nbsp;&nbsp;</td><td> <b>'.$budget.'</b> руб. в месяц</td><td>&nbsp;</td></tr>
		</table>
		<p><input type="button" confirm="Вы действительно хотите удалить запросы?" value="Удалить из кампании" class="button" action="webeffector_delete_promotion">';
		if($balanse)
		{
			echo ' <input type="button" value="Запустить в продвижение" class="button" action="webeffector_work_promotion">';
		}
		echo '</p>
		</form>';

		if($this->seo["state"] == 'SLEEP')
		{
			echo '<p><b>Все готово для продвижения Вашего сайта!</b></p>';
			if(! $balanse)
			{
				echo '<p>Осталось только <a href="http://client.webeffector.ru/secure/seo.html?pid=1#!profile/pay" target="_blank"><b>пополнить счет в сервисе Web Effector</b></a> на сумму рекомендуемого бюджета,<br>используя Ваши логин и пароль: <b>'.$this->diafan->configmodules("login", "webeffector") .'</b> и <b>'. $this->diafan->configmodules("password", "webeffector") . '</b>.<br><br>
				После пополнения счета вернитесь сюда, обновите страницу и нажмите кнопку <b>Запустить продвижение</b>, которая появится после пополнения баланса.<br><br>
				После запуска продвижения в этом модуле Вы сможете видеть Ваш текущий расход на продвижение и
				актуальные позиции по каждому ключевому слову в поисковых системах Яндекс и Google.</p>';
			}
		}
		
		//если на балансе меньше денег, чем на неделю продвижения
		if ($balanse < ($budget/4))
		{
			echo '<p><b>Внимание</b>, на Вашем балансе в системе Web Effector денег хватит менее чем на неделю.<br>Рекомендуем <a href="http://client.webeffector.ru/secure/seo.html?pid=1#!profile/pay" target="_blank"><b>пополнить счет</b></a>, используя Ваши логин и пароль.</p>';
		}
		
		echo '<p style="margin-top:50px;"><b>Внимание</b>, данный модуль - упрощенная версия сервиса Web Effector.<br>Вы можете перейти на основной сайт <a href="http://webeffector.ru/" target="_blank">WebEffector.ru</a> для расширенной настройки проекта,<br>используя Ваши логин и пароль: <b>'.$this->diafan->configmodules("login", "webeffector") .'</b> и <b>'. $this->diafan->configmodules("password", "webeffector") . '</b></p>';
		
		echo '<div class="paginator">';
		for($i = 1; $i <= count($this->seo["promos"])/$nastr; $i++)
		{
			if($i == $page)
			{
				echo '['.$i.'] ';
			}
			else
			{
				echo '<a href="'.BASE_PATH_HREF.'webeffector/?action=webeffector_seo'.($i != 1 ? '&page='.$i : '').'">'.$i.'</a> ';
			}
		}
		echo '</div>';
	}

	/**
	 * Форма создания запроса на продвижение
	 *
	 * @return void
	 */
	private function create_promotion_form()
	{
		echo '<form method="POST" action="">
		<input type="hidden" name="action" value="webeffector_create_promotion">
		<input type="hidden" name="check_hash_user" value="'.$this->diafan->_user->get_hash().'">
		<p>Добавление нового запроса</p>
		<p><input name="word" type="text" value="" size="40"></p>
		<input type="submit" class="button" value="Добавить">
		</form>';
	}

	/**
	 * Создание запроса на продвижение
	 *
	 * @return void
	 */
	private function create_promotion()
	{
		if (! $this->diafan->_user->checked)
		{
			include(ABSOLUTE_PATH.'includes/404.php');
		}
		if(! empty($_POST["word"]) && $this->diafan->configmodules("seo_id", "webeffector"))
		{
			$fp = fsockopen('api.webeffector.ru', 80);
			if($fp)
			{
				$id = rand(0, 999999);
				$data = to_json(array(
					"id" => $id,
					"state" => "SLEEP",
					"word" => $_POST["word"],
					"anchors" => array(),
					"position" => 10,
					"budget" => 100,
					"url" => $this->url,
				));
				fputs($fp, "POST http://api.webeffector.ru/seo/".$this->diafan->configmodules("seo_id", "webeffector").'/'.$id.'?token='.$this->token." HTTP/1.1\r\n");
				fputs($fp, "Host: api.webeffector.ru\r\n");
				fputs($fp, "X-Application: diafan_cms\r\n");
				fputs($fp, "Content-Type: application/json;charset=UTF-8\r\n");
				fputs($fp, "Content-length: ".utf::strlen($data)."\r\n");
				fputs($fp, "Connection: close\r\n\r\n");
				fputs($fp, $data);
 
				$result_json = ''; 
				while(!feof($fp))
				{
					$res = fgets($fp, 128);
					if(strpos($res, '{') !== false || strpos($res, '[') !== false || strpos($res, '}') !== false)
					{
						$result_json .= $res;
					}
				}
				fclose($fp);
			}
		}
		$this->diafan->redirect(BASE_PATH_HREF.'webeffector/?action=webeffector_seo');
	}

	/**
	 * Создание запроса на продвижение на основе медиаплана
	 *
	 * @return void
	 */
	private function plan_to_promotion()
	{
		if (! $this->diafan->_user->checked)
		{
			include(ABSOLUTE_PATH.'includes/404.php');
		}
		if(! empty($_POST["ids"]) && $this->diafan->configmodules("seo_id", "webeffector"))
		{
			foreach($_POST["ids"] as $i)
			{
				$fp = fsockopen('api.webeffector.ru', 80);
				if($fp)
				{
					$id = rand(0, 999999);
					$data = to_json(array(
						"id" => $id,
						"state" => "SLEEP",
						"word" => $this->plan[$i]["word"],
						"anchors" => array(),
						"position" => 10,
						"budget" => $this->plan[$i]["budget"],
						"url" => $this->plan[$i]["url"],
					));
					fputs($fp, "POST http://api.webeffector.ru/seo/".$this->diafan->configmodules("seo_id", "webeffector").'/'.$id.'?token='.$this->token." HTTP/1.1\r\n");
					fputs($fp, "Host: api.webeffector.ru\r\n");
					fputs($fp, "X-Application: diafan_cms\r\n");
					fputs($fp, "Content-Type: application/json;charset=UTF-8\r\n");
					fputs($fp, "Content-length: ".utf::strlen($data)."\r\n");
					fputs($fp, "Connection: close\r\n\r\n");
					fputs($fp, $data);
					fclose($fp);
				}
			}
		}
		$this->diafan->redirect(BASE_PATH_HREF.'webeffector/?action=webeffector_seo');
	}

	/**
	 * Запускает запросы на продвижение
	 * 
	 * @return void
	 */
	private function work_promotion($sleep = false)
	{
		if (! $this->diafan->_user->checked)
		{
			include(ABSOLUTE_PATH.'includes/404.php');
		}
		if(! empty($_POST["ids"]) && $this->diafan->configmodules("seo_id", "webeffector"))
		{
			foreach($_POST["ids"] as $id)
			{
				$promotion = array();
				$fp = fsockopen('api.webeffector.ru', 80);
				if($fp)
				{
					fputs($fp, "GET http://api.webeffector.ru/seo/".$this->diafan->configmodules("seo_id", "webeffector").'/'.$id.'?token='.$this->token." HTTP/1.1\r\n");
					fputs($fp, "Host: api.webeffector.ru\r\n");
		 
					fputs($fp, "Content-Type: application/json;charset=UTF-8\r\n");
					fputs($fp, "X-Application: diafan_cms\r\n");
					fputs($fp, "Content-length: 0\r\n");
					fputs($fp, "Connection: close\r\n\r\n");
 
					$result_json = ''; 
					while(!feof($fp))
					{
						$res = fgets($fp, 12800);
						if(strpos($res, '{') !== false || strpos($res, '[') !== false || strpos($res, '}') !== false)
						{
							$result_json .= $res;
						}
					}
					$promotion = from_json($result_json);
					fclose($fp);
				}
				if(empty($promotion))
				{
					continue;
				}

				$fp = fsockopen('api.webeffector.ru', 80);
				if($fp)
				{
					$data = to_json(array(
						"id" => $id,
						"state" => "WORK",
						"word" => $promotion["word"],
						"anchors" => array(),
						"position" => $promotion["position"],
						"budget" => $promotion["budget"],
						"url" => $promotion["url"],
					));
					fputs($fp, "POST http://api.webeffector.ru/seo/".$this->diafan->configmodules("seo_id", "webeffector").'/'.$id.'?token='.$this->token." HTTP/1.1\r\n");
					fputs($fp, "Host: api.webeffector.ru\r\n");
					fputs($fp, "X-Application: diafan_cms\r\n");
					fputs($fp, "Content-Type: application/json;charset=UTF-8\r\n");
					fputs($fp, "Content-length: ".utf::strlen($data)."\r\n");
					fputs($fp, "Connection: close\r\n\r\n");
					fputs($fp, $data);
					fclose($fp);
				}
			}
		}
		$this->diafan->redirect(BASE_PATH_HREF.'webeffector/?action=webeffector_seo'.(! empty($_GET["page"]) ? '&page='.$this->diafan->get_param($_GET, "page", 0, 2) : ''));
	}

	/**
	 * Удаляет запросы на продвижение
	 *
	 * @return void
	 */
	private function delete_promotion()
	{
		if (! $this->diafan->_user->checked)
		{
			include(ABSOLUTE_PATH.'includes/404.php');
		}
		if(! empty($_POST["ids"]) && $this->diafan->configmodules("seo_id", "webeffector"))
		{
			foreach($_POST["ids"] as $id)
			{
				$fp = fsockopen('api.webeffector.ru', 80);
				if($fp)
				{
					fputs($fp, "DELETE http://api.webeffector.ru/seo/".$this->diafan->configmodules("seo_id", "webeffector").'/'.$id.'?token='.$this->token." HTTP/1.1\r\n");
					fputs($fp, "Host: api.webeffector.ru\r\n");
					fputs($fp, "X-Application: diafan_cms\r\n");
					fputs($fp, "Connection: close\r\n\r\n");
					fclose($fp);
				}
			}
		}
		$this->diafan->redirect(BASE_PATH_HREF.'webeffector/?action=webeffector_seo'.(! empty($_GET["page"]) ? '&page='.$this->diafan->get_param($_GET, "page", 0, 2) : ''));
	}
}