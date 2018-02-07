<?php
/*
require_once(__DIR__ . '/GitHubGist.php');
*/

namespace app\models;

use Yii;
use yii\base\Model;
	

class GitHubFullGist extends GitHubObject
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

