<?php

require_once(__DIR__ . '/GitHubObject.php');
require_once(__DIR__ . '/GitHubUser.php');
require_once(__DIR__ . '/GitHubCommitCommit.php');
require_once(__DIR__ . '/GitHubCommitParents.php');




class GitHubCommit extends GitHubObject
{
	/* (non-PHPdoc)
	 * @see GitHubObject::getAttributes()
	 */
	public function getAttributes()
	{
		return array_merge(parent::getAttributes(), array(
			'url' => 'string',
			'html_url' => 'string',
			'sha' => 'string',
			'author' => 'GitHubUser',
			'committer' => 'GitHubUser',
			'commit' => 'GitHubCommitCommit',
			'parents' => 'array<GitHubCommitParents>',
		));
	}
	
	/**
	 * @var string
	 */
	public $url;
	
	/**
	 * @var string
	 */
	public $html_url;
	
	/**
	 * @var string
	 */
	public $sha;

	/**
	 * @var GitHubUser
	 */
	public $author;

	/**
	 * @var GitHubUser
	 */
	public $committer;

	/**
	 * @var GitHubCommitCommit
	 */
	public $commit;

	/**
	 * @var array<GitHubCommitParents>
	 */
	public $parents;

	/**
	 * @return string
	 */
	public function getUrl()
	{
		return $this->url;
	}

	/**
	 * @return string
	 */
	public function getHtmlUrl()
	{
		return $this->html_url;
	}
        
	/**
	 * @return string
	 */
	public function getSha()
	{
		return $this->sha;
	}

	/**
	 * @return GitHubUser
	 */
	public function getAuthor()
	{
		return $this->author;
	}

	/**
	 * @return GitHubUser
	 */
	public function getCommitter()
	{
		return $this->committer;
	}

	/**
	 * @return GitHubCommitCommit
	 */
	public function getCommit()
	{
		return $this->commit;
	}

	/**
	 * @return array<GitHubCommitParents>
	 */
	public function getParents()
	{
		return $this->parents;
	}

}

