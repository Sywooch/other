<?php
/**
 * Created by PhpStorm.
 * User: GSU
 * Date: 02.07.2017
 * Time: 16:56
 */

require_once($_SERVER['DOCUMENT_ROOT'].'/GitHub/GitHub.php');

class SiteControllerGitHub
{


    public function actionGithublogin($token)
    {

        //$token = "9db1e2267a570e867b9611c9982ecb4d1a923848";

        $model = new GitHub();
        $result=$model->login($token);

        $res = array( 'res' => $result );

        $arData = $res["res"];


        $arData =  "[{" . explode("[{", $arData)[1];
        $arData = json_decode($arData);


        $res = explode("\n", $res["res"]);

        unset($arResult);
        foreach($res as $item){
            $arResult[trim(explode(":", $item)[0])] = trim(explode(":", $item)[1]);
        }

        $arResult["DATA"] = $arData;
        

        return $arResult;

    }


    public function actionGithubcommits()
    {

        $req = json_decode( file_get_contents('php://input'), true );
        $url=$req["url"];
        $owner=$req["owner"];
        $repo=$req["repo"];


        //$result=$repo;

        $model = new GitHub();
        $result=$model->commits($url, $owner, $repo);



        //$res = array( 'res'=>$result );

        /*
        if($result==true){
            $res = array( 'res'=>'ok' );
        }else{
            $res = array( 'res'=>'error' );
        }
        */
        //echo json_encode($res);
        return $result;

        //return $this->render('index');
    }

    public function actionGithubcontent($url, $owner, $repo)
    {

        /*$req = json_decode( file_get_contents('php://input'), true );
        $url=$req["url"];
        $owner=$req["owner"];
        $repo=$req["repo"];*/


        //$result=$repo;

        $model = new GitHub();
        $result=$model->content($url, $owner, $repo);



        //$res = array( 'res'=>$result );

        /*
        if($result==true){
            $res = array( 'res'=>'ok' );
        }else{
            $res = array( 'res'=>'error' );
        }
        */
        //echo json_encode($res);
        return $result;

        //return $this->render('index');
    }



}
