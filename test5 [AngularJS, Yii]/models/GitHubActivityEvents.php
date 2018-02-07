<?php
/*
require_once(__DIR__ . '/../GitHubClient.php');
require_once(__DIR__ . '/../GitHubService.php');
require_once(__DIR__ . '/GitHubActivityEventsTypes.php');
*/
	
namespace app\models;

use Yii;
use yii\base\Model;	

class GitHubActivityEvents extends GitHubService
{

	/**
	 * @var GitHubActivityEventsTypes
	 */
	public $types;
	
	
	/**
	 * Initialize sub services
	 */
	public function __construct(GitHubClient $client)
	{
		parent::__construct($client);
		
		$this->types = new GitHubActivityEventsTypes($client);
	}
	
}

