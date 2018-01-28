<?php
/**
 * Created by PhpStorm.
 * User: GSU
 * Date: 02.07.2017
 * Time: 17:28
 */

$GitHub = new SiteControllerGitHub();

$arResult = $GitHub->actionGithublogin(PERSONAL_WP_GITHUB_AUTH_TOKEN);

if($arResult["Status"] == "200 OK"){


    $arPortfolioData = array_filter($arResult["DATA"], function($a){
        return $a->name == PERSONAL_WP_GITHUB_PORTFOLIO_REPO;
    });


    //actionGithubcontent

    //echo "<pre>";
    //print_r(current($arPortfolioData));
    //echo "</pre>";
//$url, $owner, $repo
    $arPortfolioData = current($arPortfolioData);


    $url = $arPortfolioDat->url;
    $owner = $arPortfolioData->owner->login;
    $repo = $arPortfolioData->name;

    $obSiteControllerGitHub = new SiteControllerGitHub();
    $res = $obSiteControllerGitHub->actionGithubcontent($url, $owner, $repo);
    $res = explode("[{", $res);
    $res = $res[1];
    $res = "[{" . $res;
    $res = json_decode($res);
    $countFilesInRepo = count($res);

};