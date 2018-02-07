<?php
/*
require_once(__DIR__ . '/../GitHubObject.php');
*/

namespace app\models;

use Yii;
use yii\base\Model;
	

class GitHubFeedsLinksUser extends GitHubObject
{
	/* (non-PHPdoc)
	 * @see GitHubObject::getAttributes()
	 */
	protected function getAttributes()
	{
		return array_merge(parent::getAttributes(), array(
			'href' => 'string',
			'type' => 'string',
		));
	}
	
	/**
	 * @var string
	 */
	protected $href;

	/**
	 * @var string
	 */
	protected $type;

	/**
	 * @return string
	 */
	public function getHref()
	{
		return $this->href;
	}

	/**
	 * @return string
	 */
	public function getType()
	{
		return $this->type;
	}

}

