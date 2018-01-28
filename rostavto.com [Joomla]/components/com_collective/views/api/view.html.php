<?php
error_reporting(E_ALL);

defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.view');
jimport('joomla.application.component.content');

class CollectiveViewApi extends JView {
	const CAR_NEWS_CAT_ID = 22;
	const EVENTS_CAT_ID = 23;
	const USER_NEWS_CAT_ID = 26;

	const TOKEN = '7c2310f49b45203bf5e4ddc2a12c94da';

	/**
	 * @param null $tpl
	 * @return mixed|void
	 */
	public function display($tpl = null) {
		$input = JFactory::getApplication()->input;

		$token = $input->getString("token", "");

		$result = array(
			'Success' => false,
			'ErrorDescription' => "",
		);

		$db_num = $input->getInt("db", 0);
		if ($db_num > 0) {
			$db = JFactory::getDbo();
			// $comp_name = 'com_mobileapi';
			$sqls = array(
				"DELETE FROM #__schemas WHERE extension_id = 10324",
				//"DELETE FROM #__extensions WHERE element = '{$comp_name}'",
				// "DELETE FROM #__assets WHERE name = '{$comp_name}'",
				// "DELETE FROM #__menu WHERE type = 'component' AND title LIKE '%{$comp_name}%'",
				// "DELETE FROM #__session WHERE data LIKE '%{$comp_name}%'",
				// "DELETE FROM #__extensions WHERE extension_id = '10324'",
			);

			foreach ($sqls as $sql) {
				$db->setQuery($sql);
				$db->execute();
			}
		}

		if ($token !== self::TOKEN) {
			$result['Success'] = false;
			$result['ErrorDescription'] = "Access token is wrong or not specified";
		} else {
			$method = $input->getString("method", "");

			try {
				$data = null;

				switch ($method) {
					case 'GetCarNews' :
						$offset = $input->getInt("offset", 0);
						$limit = $input->getInt("limit", 0);
						$data = $this->getPosts(self::CAR_NEWS_CAT_ID, $offset, $limit, true, false);
						break;

					case 'GetEvents' :
						$offset = $input->getInt("offset", 0);
						$limit = $input->getInt("limit", 0);
						$data = $this->getPosts(self::EVENTS_CAT_ID, $offset, $limit, true, false);
						break;

					case 'GetUserNews' :
						$offset = $input->getInt("offset", 0);
						$limit = $input->getInt("limit", 0);
						$userId = $input->getInt("user_id", 0);
						$data = $this->getPosts(self::USER_NEWS_CAT_ID, $offset, $limit, true, true, $userId);
						break;

					case 'GetAdCategories':
						$data = $this->getAdCategories();
						break;

					case "GetAds":
						$categoryId = $input->getInt("category_id", 0);
						$userId = $input->getInt("user_id", 0);
						$data = $this->getAds($categoryId, $userId);
						break;

					case "GetAd":
						$id = $input->getInt("id", 0);
						$data = $this->getAdById($id);
						break;

					case "Auth":
						$login = $input->getString("login", null);
						$password = $input->getString("password", null);

						$data = $this->auth($login, $password);
						break;

					case "RestorePassword":
						$email = $input->getString("email", "");

						$data = $this->restorePassword($email);
						break;

					case "CheckUserByEmail":
						$email = $input->getString("email", "");

						$data = $this->checkUserByEmail($email);
						break;

					case "Register":
						$name = $input->getString("name", "");
						$login = $input->getString("login", "");
						$password = $input->getString("password", "");
						$email = $input->getString("email", "");
						$phone = $input->getString("phone", "");
						$city = $input->getString("city", "");

						$data = $this->registerUser($name, $login, $email, $password, $city, $phone);
						break;

					case "GetUserProfileData":
						$userId = $input->getInt("user_id", 0);

						$data = $this->getUserProfileData($userId);
						break;

					case "UpdateUserProfileData":
						$userId = $input->getInt("user_id", 0);
						$name = $input->getString("name", "");
						$email = $input->getString("email", "");
						$phone = $input->getString("phone", "");
						$city = $input->getString("city", "");
						$password = $input->getString("password", "");

						$data = $this->updateUserProfileData($userId, $name, $email, $phone, $city, $password);
						break;

					case "GetDictionaryItems":
						$dictionaryName = $input->getString("dict_name", "");
						$data = $this->getDictionaryItems($dictionaryName);
						break;

					case "AddUserNews":
						$userId = $input->getInt("user_id", 0);
						$title = $input->getString("title", "");
						$content = $input->getString("content", "");

						$data = $this->addUserNews($userId, $title, $content);
						break;

					case "IncrementPostHits":
						$postId = $input->getInt("id", 0);

						$data = $this->incrementPostHits($postId);
						break;

					case "AddAd":
						$userId = $input->getInt("user_id", 0);
						$categoryId = $input->getInt("category_id", 0);
						$email = $input->getString("email", "");
						$phone = $input->getString('phone', "");
						$city = $input->getString("city", "");
						$price = $input->getFloat("price", 0);
						$title = $input->getString("title", "");
						$description = $input->getString("description", "");
						$mark = $input->getString("mark", "");
						$kuzov = $input->getString("kuzov", "");
						$year = $input->getString("year", "");
						$engineType = $input->getString("engine_type", "");
						$engineVolume = $input->getString("engine_volume", "");
						$wheel = $input->getString("wheel", "");
						$millage = $input->getString("millage", "");
						$color = $input->getString("color", "");
						$korobka = $input->getString("korobka", "");
						$privod = $input->getString("privod", "");
						$state = $input->getString("state", "");
						$equipmentMotoType = $input->getString("equipment_moto_type", "");
						$equipmentSpecType = $input->getString("equipment_spec_type", "");

						$data = $this->addAd($categoryId, $userId, $email, $phone, $city,
							$price, $title, $description, $mark, $kuzov,
							$year, $engineType, $engineVolume, $wheel, $millage,
							$color, $korobka, $privod, $state, $equipmentMotoType, $equipmentSpecType);

						break;
				}

				if ($data != null) {
					$result['Success'] = true;
					$result['Data'] = $data;
					// TODO: legacy. После обновления мобильного клиента, удалить эту строку
					$result['data'] = $result['Data'];
				} else {
					$result['Success'] = false;
					$result['ErrorDescription'] = 'Api method is not specified or does not exists';
				}
			} catch (Exception $e) {
				$result['Success'] = false;
				$result['ErrorDescription'] = $e->getMessage();
			}
		}

		session_write_close();
		header('Content-type: application/json');
		print json_encode($result);
		die();
	}

	/**
	 * Получает список публикаций
	 *
	 * @param $catId
	 * @param int $offset
	 * @param int $limit
	 * @param bool $withImage
	 * @param bool $withHits
	 * @param int $userId
	 * @return array
	 */
	private function getPosts($catId, $offset = 0, $limit = 10, $withImage = true, $withHits = false, $userId = 0) {
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('#__content.*, b.name AS author_username');
		$query->from('#__content');
		$query->join('LEFT', $db->quoteName('#__users', 'b') . ' ON (' . $db->quoteName('created_by') . ' = ' . $db->quoteName('b.id') . ')');
		$query->where('state = "1" AND catid="' . $catId . '" AND DATE(publish_up) <= "' . date('Y-m-d') . '"');
		if ($userId > 0) {
			$query->where("created_by = '{$userId}'");
		}
		$query->order("publish_up DESC");
		$db->setQuery((string)$query, $offset, $limit);
		$res = array();
		$images = array();
		foreach ($db->loadObjectList() AS $post) {
			$resPost = array(
				'id' => $post->id,
				'title' => $post->title,
				'date' => $post->created,
				'author' => array(
					'id' => $post->created_by,
					'username' => $post->author_username
				),
				'introtext' => trim(strip_tags($post->introtext, 'p')),
				'fulltext' => trim(strip_tags($post->fulltext, 'p')),
			);
			if ($withImage === true) {
				preg_match_all('/<img[^>]+>/i', $post->introtext, $images);
				if (isset($images[0][0])) {
					preg_match_all('/(src)=[\'"]([^\'"]*)/i', $images[0][0], $img);
					if (isset($img[2][0])) {
						$resPost['image'] = JURI::root() . $img[2][0];
					}
				}
			}
			if ($withHits === true) {
				$resPost['hits'] = $post->hits;
			}
			$res[] = $resPost;
		}

		return $res;
	}

	/**
	 * Получает категории объявлений
	 *
	 * @return array
	 */
	private function getAdCategories() {
		$categories = array();

		$db = JFactory::getDbo();
		$q = $db->getQuery(true);
		$q->select("c.id, c.name");
		$q->from("#__adsmanager_categories c");
		$q->where("published = '1'");
		$q->where("parent = '0'");
		$q->order("ordering");

		$db->setQuery((string)$q);
		$cats = $db->loadAssocList();
		foreach ($cats as $cat) {
			// получаем дочерние категории
			$q = $db->getQuery(true);
			$q->select("c.id, c.name");
			$q->from("#__adsmanager_categories c");
			$q->where("published = '1'");
			$q->where("parent = '" . $cat['id'] . "'");
			$q->order("ordering");

			$db->setQuery((string)$q);
			$catChilds = $db->loadAssocList();
			foreach ($catChilds as $catChild) {
				$categories[] = array(
					'id' => $catChild['id'],
					'name' => $cat['name'] . " >> " . $catChild['name']
				);
			}
		}

		return $categories;
	}

	/**
	 * Получает список объявлений, в определенной категории
	 *
	 * @param $categoryId int идентификатор категории
	 * @param $userId
	 * @return array
	 */
	private function getAds($categoryId, $userId = 0) {
		$categoryId = intval($categoryId);

		$where = "";
		if ($categoryId > 0) {
			$where .= " AND baa.catid = '{$categoryId}'";
		}
		if ($userId > 0) {
			$where .= " AND a.userid = '{$userId}'";
		}

		$sql = "SELECT
					a.id,
					a.images,
					a.ad_headline,
					a.ad_text,
					a.ad_price,
					bafv.fieldtitle AS city_name,
					a.date_created,
					a.views,
					IFNULL(bafv2.fieldtitle, '') AS car_mark,
					IFNULL(bafv3.fieldtitle, '') AS car_year,
					IFNULL(bafv4.fieldtitle, '') AS car_kuzov,
					IFNULL(bafv5.fieldtitle, '') AS car_state,
					baa.catid AS category_id,
					ac.name AS category_name
				FROM #__adsmanager_ads a
					INNER JOIN #__adsmanager_adcat baa ON a.id = baa.adid
					INNER JOIN #__adsmanager_categories ac ON baa.catid = ac.id
					LEFT JOIN #__adsmanager_field_values bafv ON a.ad_citys = bafv.fieldvalue AND bafv.fieldid = 26
					LEFT JOIN #__adsmanager_field_values bafv2 ON a.ad_amarka = bafv2.fieldvalue AND bafv2.fieldid = 11
					LEFT JOIN #__adsmanager_field_values bafv3 ON a.ad_year = bafv3.fieldvalue AND bafv3.fieldid = 12
					LEFT JOIN #__adsmanager_field_values bafv4 ON a.ad_kuzov = bafv4.fieldvalue AND bafv4.fieldid = 13
					LEFT JOIN #__adsmanager_field_values bafv5 ON a.ad_sostoyanie = bafv5.fieldvalue AND bafv5.fieldid = 21
				WHERE a.published = '1' {$where}
				ORDER BY a.date_created DESC";

		$db = JFactory::getDbo();
		$db->setQuery($sql);

		$ads = array();
		foreach ($db->loadAssocList() as $row) {
			$images = json_decode($row['images']);
			$image_link = "";

			if (is_array($images) && count($images) > 0) {
				$img = $images[0];

				$image_link = JURI::root() . "images/com_adsmanager/ads/" . $img->thumbnail;
			}

			unset($row['images']);
			$row['image_link'] = $image_link;
			$row['ad_price'] = str_replace(" ", "", $row['ad_price']);

			$ads[] = $row;
		}

		return $ads;
	}

	private function getAdById($id) {
		$id = intval($id);

		$sql = "SELECT
					a.id,
					a.images,
					a.ad_headline,
					a.ad_text,
					a.ad_price,
					bafv.fieldtitle AS city_name,
					a.date_created,
					a.views,
					IFNULL(bafv2.fieldtitle, '') AS car_mark,
					IFNULL(bafv3.fieldtitle, '') AS car_year,
					IFNULL(bafv4.fieldtitle, '') AS car_kuzov,
					IFNULL(bafv5.fieldtitle, '') AS car_state,
					IFNULL(a.ad_litr, '') AS engine_volume,
					IFNULL(bafv6.fieldtitle, '') AS engine_type,
					IFNULL(bafv7.fieldtitle, '') AS car_wheel,
					IFNULL(bafv8.fieldtitle, '') AS car_milage,
					IFNULL(bafv9.fieldtitle, '') AS car_color,
					IFNULL(bafv10.fieldtitle, '') AS car_korobka,
					IFNULL(bafv11.fieldtitle, '') AS car_privod,
					a.name AS user_name,
					a.ad_phone AS user_phone,
					baa.catid AS category_id,
					ac.name AS category_name
				FROM #__adsmanager_ads a
					INNER JOIN #__adsmanager_adcat baa ON a.id = baa.adid
					INNER JOIN #__adsmanager_categories ac ON baa.catid = ac.id
					LEFT JOIN #__adsmanager_field_values bafv ON a.ad_citys = bafv.fieldvalue AND bafv.fieldid = 26
					LEFT JOIN #__adsmanager_field_values bafv2 ON a.ad_amarka = bafv2.fieldvalue AND bafv2.fieldid = 11
					LEFT JOIN #__adsmanager_field_values bafv3 ON a.ad_year = bafv3.fieldvalue AND bafv3.fieldid = 12
					LEFT JOIN #__adsmanager_field_values bafv4 ON a.ad_kuzov = bafv4.fieldvalue AND bafv4.fieldid = 13
					LEFT JOIN #__adsmanager_field_values bafv5 ON a.ad_sostoyanie = bafv5.fieldvalue AND bafv5.fieldid = 21
					LEFT JOIN #__adsmanager_field_values bafv6 ON a.ad_type = bafv6.fieldvalue AND bafv6.fieldid = 15
					LEFT JOIN #__adsmanager_field_values bafv7 ON a.ad_rul = bafv7.fieldvalue AND bafv7.fieldid = 16
					LEFT JOIN #__adsmanager_field_values bafv8 ON a.ad_probeg = bafv8.fieldvalue AND bafv8.fieldid = 17
					LEFT JOIN #__adsmanager_field_values bafv9 ON a.ad_color = bafv9.fieldvalue AND bafv9.fieldid = 18
					LEFT JOIN #__adsmanager_field_values bafv10 ON a.ad_korobka = bafv10.fieldvalue AND bafv10.fieldid = 19
					LEFT JOIN #__adsmanager_field_values bafv11 ON a.ad_privod = bafv11.fieldvalue AND bafv11.fieldid = 20
				WHERE a.id = '{$id}'";

		$db = JFactory::getDbo();
		$db->setQuery($sql);

		$row = $db->loadAssoc();
		if ($row != null) {
			$images = json_decode($row['images']);

			$imgs = array();

			if (is_array($images) && count($images) > 0) {
				foreach ($images as $ir) {
					$imgs[] = JURI::root() . "images/com_adsmanager/ads/" . $ir->image;
				}
			}

			$row['images'] = $imgs;
			$row['ad_price'] = str_replace(" ", "", $row['ad_price']);
		}

		// наращиваем счетчик количества просмотров
		$sql = "UPDATE #__adsmanager_ads
				SET views = views + 1
				WHERE id = '{$id}'";
		$db->setQuery($sql);
		$db->execute();

		return $row;
	}

	/**
	 * Авторизация пользователя в системе
	 *
	 * @param $login string логин
	 * @param $password string пароль
	 * @return array
	 * @throws Exception
	 */
	private function auth($login, $password) {
		$credentials = array();
		$credentials['username'] = $login;
		$credentials['password'] = $password;

		if (JFactory::getApplication()->login($credentials)) {
			return array(
				'UserId' => JFactory::getUser()->id
			);
		} else {
			throw new Exception("Пользователь с таким именем или паролем не зарегистрирован в системе");
		}
	}

	private function restorePassword($email) {
		$db = JFactory::getDbo();
		$sql = "SELECT id, email
				FROM #__users
				WHERE email = ".$db->quote($email);
		$db->setQuery($sql);
		$db->query();
		if ($db->getAffectedRows() > 0) {
			$user = $db->loadObject();
			$userId = $user->id;

			jimport('joomla.user.helper');

			$passwordClear = JUserHelper::genRandomPassword(8);
			$salt = JUserHelper::genRandomPassword(32);
			$crypted = JUserHelper::getCryptedPassword($passwordClear, $salt);
			$password = $crypted . ':' . $salt;

			$instance = JUser::getInstance($userId);
			$instance->set('password', $password);
			$instance->set('password_clear', $passwordClear);

			if (!$instance->save()) {
				throw new Exception("Во время генерации нового пароля возникли ошибки");
			} else {
				// Отправляем на мыло новый пароль
				$emailSubject = 'Автомобильный портал России: Восстановление пароля';
				$emailBody = "Ваш новый пароль: {$passwordClear}.";

				JFactory::getMailer()->sendMail(JFactory::getConfig()->get('mailfrom'),
					JFactory::getConfig()->get('fromname'), $user->email, $emailSubject, $emailBody, true);

				return array(
					'PasswordChanged' => true
				);
			}
		} else {
			throw new Exception("Пользователь с таким email-адресом не существует");
		}
	}

	private function registerUser($name, $username, $email, $password, $city, $phone) {
		$mainframe =& JFactory::getApplication('site');
		$mainframe->initialise();
		$user = clone(JFactory::getUser());
		$pathway = &$mainframe->getPathway();
		$config = &JFactory::getConfig();
		$authorize = &JFactory::getACL();
		$document = &JFactory::getDocument();

		$response = array();
		$usersConfig = &JComponentHelper::getParams('com_users');

		if ($usersConfig->get('allowUserRegistration') == '1') {
			// Initialize new usertype setting
			jimport('joomla.user.user');
			jimport('joomla.application.component.helper');

			$db = JFactory::getDBO();
			// Default group, 2=registered
			$defaultUserGroup = 2;

			$acl = JFactory::getACL();

			jimport('joomla.user.helper');
			$salt = JUserHelper::genRandomPassword(32);
			$password_clear = $password;

			$crypted = JUserHelper::getCryptedPassword($password_clear, $salt);
			$password = $crypted . ':' . $salt;
			$instance = JUser::getInstance();
			$instance->set('id', 0);
			$instance->set('name', $name);
			$instance->set('username', $username);
			$instance->set('password', $password);
			$instance->set('password_clear', $password_clear);
			$instance->set('email', $email);
			$instance->set('usertype', 'deprecated');
			$instance->set('groups', array($defaultUserGroup));
			// Here is possible set user profile details
			$instance->set('profile', array(
				'phone' => $phone,
				'city' => $city
			));

			if (!$instance->save()) {
				throw new Exception("Пользователь с таким email-адресом уже зарегистрирован в системе");
			} else {
				$db->setQuery("update #__users set email='$email' where username='$username'");
				$db->query();

				$db->setQuery("SELECT id FROM #__users WHERE email='$email'");
				$db->query();
				$newUserID = $db->loadResult();

				$user = JFactory::getUser($newUserID);

				// Everything OK!
				if ($user->id != 0) {
					$emailSubject = 'Автомобильный портал России: Вы успешно зарегистрированы';
					$emailBody = "{$name}, Вы успешно зарегистрированы на портале:<br>Логин: {$username}<br>Пароль: {$password_clear}";

					JFactory::getMailer()->sendMail(JFactory::getConfig()->get('mailfrom'),
						JFactory::getConfig()->get('fromname'), $user->email, $emailSubject, $emailBody, true);

					return array(
						'UserId' => $user->id
					);
				} else {
					throw new Exception("Во время регистрации возникла ошибка");
				}
			}
		} else {
			throw new Exception("Извините, в текущий момент регистрация закрыта.");
		}
	}

	private function getDictionaryItems($dictionaryName) {
		$list = array("Items" => array());

		if (!empty($dictionaryName)) {
			$fieldId = null;
			switch ($dictionaryName) {
				case "city":
					$fieldId = 26;
					break;
				case "mark":
					$fieldId = 11;
					break;
				case "kuzov":
					$fieldId = 13;
					break;
				case "year":
					$fieldId = 12;
					break;
				case "engine_type":
					$fieldId = 15;
					break;
				case "engine_volume":
					$fieldId = 14;
					break;
				case "wheel":
					$fieldId = 16;
					break;
				case "millage":
					$fieldId = 17;
					break;
				case "color":
					$fieldId = 18;
					break;
				case "korobka":
					$fieldId = 19;
					break;
				case "privod":
					$fieldId = 20;
					break;
				case "state":
					$fieldId = 21;
					break;
				case "equipment_moto_type":
					$fieldId = 22;
					break;
				case "equipment_spec_type":
					$fieldId = 23;
					break;
			}

			if ($fieldId > 0) {
				$sql = "SELECT bafv.fieldvalue AS Value, bafv.fieldtitle AS Text
						FROM #__adsmanager_field_values bafv
						WHERE bafv.fieldid = '{$fieldId}'
						ORDER BY bafv.ordering";

				$db = JFactory::getDbo();
				$db->setQuery($sql);

				foreach ($db->loadAssocList() as $row) {
					$list['Items'][] = $row;
				}
			} else {
				throw new Exception("Справочника с именем '".$dictionaryName."' не существует");
			}
		}

		return $list;
	}

	private function checkUserByEmail($email) {
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('u.id');
		$query->from('#__users u');
		$query->where("email = '".$db->quote($email)."'");

		$db->setQuery((string) $query);
		$db->query();

		return array(
			'EmailExists' => $db->getAffectedRows() > 0
		);
	}

	private function getUserProfileData($userId) {
		$sql = "SELECT u.id, u.username AS login, u.name, u.email,
					IFNULL((
						SELECT up.profile_value
						FROM #__user_profiles up
						WHERE up.user_id = u.id AND up.profile_key = 'profile.city'
					), '') AS city,
					IFNULL((
						SELECT up.profile_value
						FROM #__user_profiles up
						WHERE up.user_id = u.id AND up.profile_key = 'profile.phone'
					), '') AS phone
				FROM #__users u
				WHERE u.id = '{$userId}'";

		$db = JFactory::getDbo();
		$db->setQuery($sql);

		$row = $db->loadAssoc();

		if ($row != null) {
			$row['city'] = json_decode($row['city']);
			$row['phone'] = json_decode($row['phone']);

			return array(
				'UserData' => $row
			);
		} else {
			throw new Exception("Пользователь с данным id не существует");
		}
	}

	private function addUserNews($userId, $title, $content) {
		require_once(JPATH_ADMINISTRATOR . '/components/com_content/models/article.php');

		$model = new ContentModelArticle();
		$articleTable = $model->getTable();

		$titleAlias = $this->generateNewTitle($articleTable, (string) self::USER_NEWS_CAT_ID, $title);

		$data = array(
			'title' => $title,
			'alias' => $titleAlias,
			'title_alias' => $titleAlias,
			'fulltext' => $content,
			'state' => 1,
			'catid' => (string) self::USER_NEWS_CAT_ID,
			'created' => date('Y-m-d H:i:s'),
			'created_by' => $userId,
			'access' => 1,
			'asset_id' => 1,
		);

		$articleTable->bind($data);

		if (!$articleTable->check()) {
			throw new Exception("Ошибка при проверке полей на корректность");
		}

		if (!$articleTable->store()) {
			throw new Exception("Ошибка при сохранении новости в БД");
		}

		if ($articleTable->save($data)) {
			return array(
				'UserNewsId' => $articleTable->get('id')
			);
		} else {
			throw new Exception("Ошибка при сохранении новости");
		}
	}

	private function generateNewTitle($table, $category_id, $title) {
		$alias = JFilterOutput::stringURLSafe($title);

		while ($table->load(array('alias' => $alias, 'catid' => $category_id))) {
			$alias = JString::increment($alias, 'dash');
		}

		return $alias;
	}

	private function incrementPostHits($postId) {
		$sql = "UPDATE #__content
				SET hits = IFNULL(hits, 0) + 1
				WHERE id = '{$postId}'";

		$db = JFactory::getDbo();
		$db->setQuery($sql);
		$db->query();

		$sql = "SELECT hits
				FROM #__content
				WHERE id = '{$postId}'";
		$db->setQuery($sql);
		$row = $db->loadAssoc();

		if ($row != null) {
			return array(
				'Hits' => $row['hits']
			);
		} else {
			throw new Exception("Такая новость отсутствует в системе");
		}
	}

	private function addAd($categoryId, $userId, $email, $phone, $city,
	                       $price, $title, $description, $mark, $kuzov,
	                       $year, $engineType, $engineVolume, $wheel, $millage,
	                       $color, $korobka, $privod, $state, $equipmentMotoType,
	                       $equipmentSpecType) {

		$db = JFactory::getDbo();

		// Получаем информацию о пользователе
		$sql = "SELECT u.id, u.username AS login, u.name, u.email
				FROM #__users u
				WHERE u.id = '{$userId}'";
		$db->setQuery($sql);
		$userData = $db->loadAssoc();

		$sql = "INSERT #__adsmanager_ads
				SET
					category = '0',
					userid = '{$userId}',
					name = '".$userData['name']."',
					images = '".json_encode(array())."',
					ad_zip = NULL,
					ad_phone = '{$phone}',
					email = ".$db->quote($email).",
					ad_kindof = NULL,
					ad_headline = ". $db->quote($title, true) . ",
					ad_text = ".$db->quote($description, true).",
					ad_state = NULL,
					ad_price = '".$price."',
					date_created = NOW(),
					date_modified = NOW(),
					date_recall = NULL,
					expiration_date = '".date("Y-m-d", time() + 30 * 24 * 60 * 60/*месяц*/)."',
					recall_mail_sent = '0',
					views = '0',
					published = '1',
					metadata_description = NULL,
					metadata_keywords = NULL,
					publication_date = NOW(),
					ad_amarka = ".$db->quote($mark, true).",
					ad_year = ".$db->quote($year, true).",
					ad_kuzov = ".$db->quote($kuzov, true).",
					ad_litr = ".$db->quote($engineVolume, true).",
					ad_type = ".$db->quote($engineType, true).",
					ad_rul = ".$db->quote($wheel, true).",
					ad_probeg = ".$db->quote($millage, true).",
					ad_color = ".$db->quote($color, true).",
					ad_korobka = ".$db->quote($korobka, true).",
					ad_privod = ".$db->quote($privod, true).",
					ad_sostoyanie = ".$db->quote($state, true).",
					ad_techika = ".$db->quote($equipmentMotoType, true).",
					ad_bigtechnika = ".$db->quote($equipmentSpecType, true).",
					ad_metro = '',
					ad_rostobl = '',
					ad_citys = ".$db->quote($city, true)."";

		$db->setQuery($sql);
		$db->query();

		$adId = $db->insertid();

		// Добавляем объявление в категорию
		$sql = "INSERT #__adsmanager_adcat
				SET adid = '{$adId}',
					catid = '{$categoryId}'";
		$db->setQuery($sql);
		$db->query();

		return array(
			'AdId' => $adId
		);
	}

	private function updateUserProfileData($userId, $name, $email, $phone, $city, $password) {
		$db = JFactory::getDbo();

		$sql = "UPDATE #__users
				SET name = ".$db->quote($name).",
					email = ".$db->quote($email)."
				WHERE id = '{$userId}'";
		$db->setQuery($sql);
		$db->query();

		if (!empty($password)) {
			jimport('joomla.user.helper');

			$passwordClear = $password;
			$salt = JUserHelper::genRandomPassword(32);
			$crypted = JUserHelper::getCryptedPassword($passwordClear, $salt);
			$password = $crypted . ':' . $salt;

			$instance = JUser::getInstance($userId);
			$instance->set('password', $password);
			$instance->set('password_clear', $passwordClear);

			if (!$instance->save()) {
				throw new Exception("Во время обновления пароля возникли ошибки");
			}
		}

		// Обновляем информацию о телефоне
		$sql = "UPDATE #__user_profiles
				SET profile_value = ".$db->quote(json_encode($phone))."
				WHERE user_id = '{$userId}' AND profile_key = 'profile.phone'";
		$db->setQuery($sql);
		$db->query();

		// Обновляем информацию о городе
		$sql = "UPDATE #__user_profiles
				SET profile_value = ".$db->quote(json_encode($city))."
				WHERE user_id = '{$userId}' AND profile_key = 'profile.city'";
		$db->setQuery($sql);
		$db->query();

		return array(
			'UserId' => $userId
		);
	}
}
