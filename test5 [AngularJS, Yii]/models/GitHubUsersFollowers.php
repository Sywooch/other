<?php
/*
require_once(__DIR__ . '/../GitHubClient.php');
require_once(__DIR__ . '/../GitHubService.php');
*/
namespace app\models;

use Yii;
use yii\base\Model;
	

class GitHubUsersFollowers extends GitHubService
{

	/**
	 * List followers of a user
	 * 
	 */
	public function listFollowersOfUser($user)
	{
		$data = array();
		
		return $this->client->request("/user/following/$user", 'PUT', $data, 204, '');
	}
	
}

