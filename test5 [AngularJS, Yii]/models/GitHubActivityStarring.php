<?php
/*
require_once(__DIR__ . '/../GitHubClient.php');
require_once(__DIR__ . '/../GitHubService.php');
*/

namespace app\models;

use Yii;
use yii\base\Model;
	

class GitHubActivityStarring extends GitHubService
{

	/**
	 * List Stargazers
	 * 
	 */
	public function listStargazers($owner, $repo)
	{
		$data = array();
		
		return $this->client->request("/user/starred/$owner/$repo", 'PUT', $data, 204, '');
	}
	
}

