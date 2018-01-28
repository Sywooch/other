<?php

//namespace app\models;

//use Yii;
//use yii\base\Model;

$files = scandir($_SERVER['DOCUMENT_ROOT'] . "/GitHub/");


foreach($files as $itemFile){
    if($itemFile == "." || $itemFile == ".." || $itemFile == "GitHub.php") continue;
    include_once($_SERVER['DOCUMENT_ROOT'] . '/GitHub/' . $itemFile);
}



class GitHub
{
    public $login;
    public $pass;



    /**
     * Авторизация на GitHub
     * @param логин и пароль
     * @return в случае успеха возвращаем список репозиториев
     */
    public function login($token)
    {	
		
		$return="";
		
		
		$GitHubClientBase = new GitHubClientBase();

		$url="/user/repos";
		$method="GET";
		$data=null;
		$response=$GitHubClientBase->setAuthType('Oauth');
		

		$GitHubClientBase->setOauthToken($token);
		
		$response=$GitHubClientBase->doRequest($url, $method, $data, null, null);
		
		return $response;


		
    }
	
    /**
     * Достать последние 50 коммитов репозитория и составить статистику
     * @param url репозитория
     * @return 
     */
    public function commits($url, $owner, $repo)
    {	
		
		
		
		
		//$response="222";
		
		//$GitHubReposCommits = new GitHubReposCommits();
		//$response = $GitHubReposCommits->listCommitsOnRepository($owner, $repo);
		
		
		$GitHubClientBase = new GitHubClientBase();

		$url="/repos/".$owner."/".$repo."/commits";
		$method="GET";
		$data=null;
		//$response=$GitHubClientBase->setAuthType('Oauth');
		

		//$GitHubClientBase->setOauthToken($token);
		
		$response = $GitHubClientBase->doRequest($url, $method, $data, null, null);
		
		
		//$response=strlen($response);
		//$m_tmp=explode("[",$response); 		
		//$response="[".$m_tmp[1];
		
		return $response;


		
    }



    public function content($url, $owner, $repo)
    {




        //$response="222";

        //$GitHubReposCommits = new GitHubReposCommits();
        //$response = $GitHubReposCommits->listCommitsOnRepository($owner, $repo);


        $GitHubClientBase = new GitHubClientBase();

        $url="/repos/".$owner."/".$repo."/contents/";
        $method="GET";
        $data=null;
        //$response=$GitHubClientBase->setAuthType('Oauth');


        //$GitHubClientBase->setOauthToken($token);

        $response = $GitHubClientBase->doRequest($url, $method, $data, null, null);


        //$response=strlen($response);
        //$m_tmp=explode("[",$response);
        //$response="[".$m_tmp[1];

        return $response;



    }



}
