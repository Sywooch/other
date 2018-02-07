<?php
/*
require_once(__DIR__ . '/GitHubUser.php');
*/
namespace app\models;

use Yii;
use yii\base\Model;
	

class GitHubContributor extends GitHubUser
{
	/* (non-PHPdoc)
	 * @see GitHubObject::getAttributes()
	 */
	protected function getAttributes()
	{
		return array_merge(parent::getAttributes(), array(
			'contributions' => 'int',
		));
	}
	
	/**
	 * @var int
	 */
	protected $contributions;

	/**
	 * @return int
	 */
	public function getContributions()
	{
		return $this->contributions;
	}

}

