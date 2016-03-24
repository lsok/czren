<?php

class DefaultController extends Controller
{	
	/**
	 * 管理后台登录页验证码
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the login page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
				'height'=>40,
			),
		);
	}
	
	/**
	 * 管理后台用户访问控制
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			array('application.filters.AdminAccessFilter - login captcha'), //限制用户访问后台页面(除后台登录页 captcha为验证码action)
		);
	}
	
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',
				'actions'=>array('login','captcha'),
				'users'=>array('*'),
			),
			array('allow',
				'actions'=>array('index','logout'),
				'users'=>array('@'),
				),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	/**
	 * 后台登录页
	 */
	public function actionLogin()
	{
		$model=new LoginForm;
		
		//定义管理员登录场景(以显示验证码)
		$model->setScenario('adminLogin');

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
			{
				if($model->isManager == true)
				{
					$this->redirect(array('index'));
				}
				else
				{
					$this->actionLogout();
				}
			}
		}
		
		$this->renderPartial('login',array('model'=>$model));
	}
	
	/**
	 * 后台首页
	 */
	public function actionIndex()
	{
		$this->render('index');
	}
	
	/**
	 * 退出系统
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(array('login'));
	}
}