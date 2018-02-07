<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\GitHub;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout', 'githublogin'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {	

		return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
	
	public function beforeAction($action)
	{
		$this->enableCsrfValidation = false;
		
		return parent :: beforeAction($action);
	}
	
    public function actionGithublogin()
    {
		
		$req = json_decode( file_get_contents('php://input'), true );
		$token=$req["token"];
		//$pass=$req["pass"];
		
		$model = new GitHub();
		$result=$model->login($token);
		
		$res = array( 'res'=>$result );
		
		/*
		if($result==true){
			$res = array( 'res'=>'ok' );
		}else{
			$res = array( 'res'=>'error' );
		}
		*/
		echo json_encode($res);
		
		
		//return $this->render('index');
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
		
		
	
	
}
