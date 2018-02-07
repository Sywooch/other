<?php
/*
require_once(__DIR__ . '/../GitHubObject.php');
*/

namespace app\models;

use Yii;
use yii\base\Model;
	

class GitHubFullRepo extends GitHubRepo
{
	/* (non-PHPdoc)
	 * @see GitHubObject::getAttributes()
	 */
	protected function getAttributes()
	{
		return array_merge(parent::getAttributes(), array(
		));
	}
	
}

