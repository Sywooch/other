<?php

require_once(__DIR__ . '/GitHubClient.php');
require_once(__DIR__ . '/GitHubService.php');
require_once(__DIR__ . '/GitHubGittag.php');



//namespace app\models;

//use Yii;
//use yii\base\Model;

class GitHubGitTags extends GitHubService
{

	/**
	 * Get a Tag
	 * 
	 * @return GitHubGittag
	 */
	public function getTag($owner, $repo, $sha)
	{
		$data = array();
		
		return $this->client->request("/repos/$owner/$repo/git/tags/$sha", 'GET', $data, 200, 'GitHubGittag');
	}
	
}

