<?php

class UserController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
			'onlyAccessOwnProfile + index update updatePW', //限制用户仅可访问自己的资料
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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('create'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','update','updatePW'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($type)
	{
		$this->layout='//layouts/register';
	
		$model=new User;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		//定义注册场景
		$model->setScenario('register');
		
		//确定注册类型(个人或商家)
		if($type=='p')
		{
			$userType='person';
		}
		else if($type=='b')
		{
			$userType='business';
		}
		
		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
						
			//如果是商家注册
			if($userType == 'business')
			{
				//定义用户级别为1
				$model->level=1;
				
				//定义商家注册场景(以验证手机和地址为必填项)
				$model->setScenario('businessRegister');
			}
			
			//默认头像
			$model->avatar = './assets/upfile/avatar/noAvatar.jpg';
			
			//注册时间
			$model->create_time=new CDbExpression('NOW()');
			
			if($model->save())
			{
				//注册成功后自动登录
				$logForm = new LoginForm;
				$logForm->username = $model->username;
				$logForm->password = $_POST['User']['password'];					
				$logForm->validate();
				$logForm->login();
				
				$this->redirect(array('user/index','id'=>$model->id));
			}
		}

		$this->render('create',array(
			'model'=>$model,
			'userType'=>$userType,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$this->layout='//layouts/user_manage';
		
		$model=$this->loadModel($id);
		
		//定义修改资料场景
		$model->setScenario('updateProfile');
				
		if($model->level == 1)
		{
			//定义商家修改资料场景(以验证手机电话地址等必填项)
			$model->setScenario('updateBusinessProfile');
		}

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			
			//上传头像: 获得一个CUploadedFile的实例
			$file = CUploadedFile::getInstance($model,'avatar');
			if(is_object($file) && get_class($file) === 'CUploadedFile')
			{	
				//缩略图处理(将上传的图片缩小或放大到指定尺寸)
				$thumb = Yii::app()->thumb; //使用缩略图扩展
				$thumb->image = $file->tempName; //要处理的图片
				$thumb->width = 50; //缩略图宽度
				$thumb->height = 60; //缩略图高度
				$thumb->directory = './assets/upfile/avatar/'; //图片保存目录
				$thumb->defaultName = 'file_'.time().'_'.rand(0,9999); //定义图片文件名
				$thumb->createThumb(); //生成缩略图
				$thumb->save(); //保存缩略图
				
				$model->avatar = $thumb->directory.$thumb->defaultName.'.'.$file->extensionName;
			}
			else //如未上传头像则设置默认头像
			{
				if($model->avatar == '')
				{
					$model->avatar = './assets/upfile/avatar/noAvatar.jpg';
				}
			}
			
			if($model->save())
			{
				$this->redirect(array('user/update','id'=>$model->id));
			}
				
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	/* public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	} */

	/**
	 * Lists all models.
	 */
	public function actionIndex($id)
	{
		$this->layout='//layouts/user_manage';
		
		$model=$this->loadModel($id);
		
		//$dataProvider=new CActiveDataProvider('User');
		
		$this->render('index',array(
			'model'=>$model,
			//'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	/* public function actionAdmin()
	{
		$model=new User('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['User']))
			$model->attributes=$_GET['User'];

		$this->render('admin',array(
			'model'=>$model,
		));
	} */

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return User the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=User::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param User $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	/**
	 * 修改密码.
	 */
	public function actionUpdatePW($id)
	{
		$this->layout='//layouts/user_manage';
		
		$model=$this->loadModel($id);
		
		//确定当前操作为修改密码以便执行密码加密(见model中afterValidate()方法)
		$model->isUpdatePassword=true;
		//定义修改密码场景
		$model->setScenario('updatePassword');
		
		//获取旧密码
		$oldPassword=$model->password;
		
		//清空密码以保证初始化表单时密码字段为空
		$model->password='';
		
		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			
			//验证旧密码
			if($model->encrypt($_POST['User']['password_old']) == $oldPassword)
			{
				//检查两次输入的密码是否一致
				if($_POST['User']['password'] == $_POST['User']['password_repeat'])
				{					
					if($model->save())
					{
						$this->redirect(array('user/index','id'=>$model->id));
					}
				}
				else
				{
					$model->addError('password', '两次输入的密码不一致!');
				}
			}
			else
			{
				$model->addError('password_old', '旧密码错误!');
			}
		}
		
		$this->render('update',array(
			'model'=>$model,
		));
	}
	
	/**
	* 限制用户仅可访问自己的资料
	*/
	 public function filterOnlyAccessOwnProfile($filterChain)
	 {
		if(isset($_GET['id']) && $_GET['id'] != Yii::app()->user->id)
		 throw new CHttpException(403, '您无权访问该页!');
		
		//complete the running of other filters and execute the requested
		//action
		$filterChain->run();
	 }
}
