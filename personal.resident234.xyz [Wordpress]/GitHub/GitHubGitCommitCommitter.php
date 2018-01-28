<?php

require_once(__DIR__ . '/GitHubObject.php');


//namespace app\models;

//use Yii;
//use yii\base\Model;
	

class GitHubGitCommitCommitter extends GitHubObject
{
	/* (non-PHPdoc)
	 * @see GitHubObject::getAttributes()
	 */
	public function getAttributes()
	{
		return array_merge(parent::getAttributes(), array(
			'date' => 'string',
			'name' => 'string',
			'email' => 'string',
		));
	}
	
	/**
	 * @var string
	 */
	protected $date;

	/**
	 * @var string
	 */
	protected $name;

	/**
	 * @var string
	 */
	protected $email;

	/**
	 * @return string
	 */
	public function getDate()
	{
		return $this->date;
	}

	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @return string
	 */
	public function getEmail()
	{
		return $this->email;
	}

}

