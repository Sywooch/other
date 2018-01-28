<?php

require_once(__DIR__ . '/GitHubClient.php');
require_once(__DIR__ . '/GitHubService.php');
require_once(__DIR__ . '/GitHubBlob.php');


//namespace app\models;

//use Yii;
//use yii\base\Model;

class GitHubGitBlobs extends GitHubService
{

	/**
	 * Get a Blob
	 * 
	 * @return array<GitHubBlob>
	 */
	public function getBlob($owner, $repo, $sha)
	{
		$data = array();
		
		return $this->client->request("/repos/$owner/$repo/git/blobs/$sha", 'GET', $data, 200, 'GitHubBlob', true);
	}
	
}

