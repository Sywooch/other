<?php

require_once(__DIR__ . '/GitHubClient.php');

//namespace app\models;

//use Yii;
//use yii\base\Model;


class GitHubService
{
	/**
	 * @var GitHubClient
	 */
	protected $client;
	
	/**
	 * @param GitHubClient $client
	 */
	public function __construct(GitHubClient $client)
	{
		$this->client = $client;
	}
}
