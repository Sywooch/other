<?php
// Запрет прямого доступа.
defined('_JEXEC') or die;

// Подключаем библиотеку контроллера Joomla.
jimport('joomla.application.component.controller');

/**
 * Контроллер компонента Mobile Api.
 */
class MobileApiController extends JControllerLegacy {
	/**
	 * @var MobileApiModelMobileApi
	 */
	private $model;

	const TOKEN = '7c2310f49b45203bf5e4ddc2a12c94da';

	const CAR_NEWS_CAT_ID = 22;
	const EVENTS_CAT_ID = 23;
	const USER_NEWS_CAT_ID = 26;

	function display($tpl = null) {
		parent::display($tpl);
	}

	public function call() {
		// Get the application object.
		$app = JFactory::getApplication();

		// Get the model.
		$this->model = $this->getModel('MobileApi');

		$input = JFactory::getApplication()->input;

		$token = $input->getString("token", "");

		$result = array(
			'Success' => false,
			'ErrorDescription' => "",
		);

		if ($token !== self::TOKEN) {
			$result['Success'] = false;
			$result['ErrorDescription'] = "Access token is wrong or not specified";
		} else {
			$method = $input->getString("methodName", "");

			try {
				$data = null;

				switch ($method) {
					case 'GetCarNews' :
						$offset = $input->getInt("offset", 0);
						$limit = $input->getInt("limit", 0);
						$data = $this->model->getPosts(self::CAR_NEWS_CAT_ID, $offset, $limit, true, false);
						break;

					case 'GetEvents' :
						$offset = $input->getInt("offset", 0);
						$limit = $input->getInt("limit", 0);
						$data = $this->model->getPosts(self::EVENTS_CAT_ID, $offset, $limit, true, false);
						break;

					case 'GetUserNews' :
						$offset = $input->getInt("offset", 0);
						$limit = $input->getInt("limit", 0);
						$userId = $input->getInt("user_id", 0);
						$data = $this->model->getPosts(self::USER_NEWS_CAT_ID, $offset, $limit, true, true, $userId);
						break;

					case 'GetAdCategories':
						$data = $this->model->getAdCategories();
						break;

					case "GetAds":
						$categoryId = $input->getInt("category_id", 0);
						$userId = $input->getInt("user_id", 0);
						$data = $this->model->getAds($categoryId, $userId);
						break;

					case "GetAd":
						$id = $input->getInt("id", 0);
						$data = $this->model->getAdById($id);
						break;

					case "Auth":
						$login = $input->getString("login", null);
						$password = $input->getString("password", null);

						$data = $this->model->auth($login, $password);
						break;

					case "RestorePassword":
						$email = $input->getString("email", "");

						$data = $this->model->restorePassword($email);
						break;

					case "CheckUserByEmail":
						$email = $input->getString("email", "");

						$data = $this->model->checkUserByEmail($email);
						break;

					case "Register":
						$name = $input->getString("name", "");
						$login = $input->getString("login", "");
						$password = $input->getString("password", "");
						$email = $input->getString("email", "");
						$phone = $input->getString("phone", "");
						$city = $input->getString("city", "");

						$data = $this->model->registerUser($name, $login, $email, $password, $city, $phone);
						break;

					case "GetUserProfileData":
						$userId = $input->getInt("user_id", 0);

						$data = $this->model->getUserProfileData($userId);
						break;

					case "UpdateUserProfileData":
						$userId = $input->getInt("user_id", 0);
						$name = $input->getString("name", "");
						$email = $input->getString("email", "");
						$phone = $input->getString("phone", "");
						$city = $input->getString("city", "");
						$password = $input->getString("password", "");

						$data = $this->model->updateUserProfileData($userId, $name, $email, $phone, $city, $password);
						break;

					case "GetDictionaryItems":
						$dictionaryName = $input->getString("dict_name", "");
						$data = $this->model->getDictionaryItems($dictionaryName);
						break;

					case "AddUserNews":
						$userId = $input->getInt("user_id", 0);
						$title = $input->getString("title", "");
						$content = $input->getString("content", "");

						$data = $this->model->addUserNews($userId, $title, $content);
						break;

					case "IncrementPostHits":
						$postId = $input->getInt("id", 0);

						$data = $this->model->incrementPostHits($postId);
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

						$data = $this->model->addAd($categoryId, $userId, $email, $phone, $city,
							$price, $title, $description, $mark, $kuzov,
							$year, $engineType, $engineVolume, $wheel, $millage,
							$color, $korobka, $privod, $state, $equipmentMotoType, $equipmentSpecType);

						break;
				}

				if ($data != null) {
					$result['Success'] = true;
					$result['Data'] = $data;
				} else {
					$result['Success'] = false;
					$result['ErrorDescription'] = 'Api method is not specified or does not exists';
				}
			} catch (Exception $e) {
				$result['Success'] = false;
				$result['ErrorDescription'] = $e->getMessage();
			}
		}

		header("Content-Type: application/json");
		// Echo the data as JSON.
		print json_encode($result);

		// Close the application.
		$app->close();
	}
}
