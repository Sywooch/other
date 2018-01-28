<?php

require_once(__DIR__ . '/GitHubObject.php');



	

class GitHubFullRepo extends GitHubRepo
{
	/* (non-PHPdoc)
	 * @see GitHubObject::getAttributes()
	 */
	public function getAttributes()
	{
		return array_merge(parent::getAttributes(), array(
		));
	}
	
}

