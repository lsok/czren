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
			//'postOnly + delete', // we only allow deletion via POST request
			array('application.filters.AdminAccessFilter'), //限制仅管理员可访问此控制器动作
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
				'actions'=>array('index','view','create','update','updatePW','delete'),
				'users'=>array('@'),
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
	 * 管理员添加用户(个人或商家).
	 */
	public function actionCreate($type)
	{	
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
			
			//设置默认头像
			$model->avatar = './assets/upfile/avatar/noAvatar.jpg';
			
			//记录注册时间
			$model->create_time=new CDbExpression('NOW()');
			
			if($model->save())
			{	
				$this->redirect(array('user/index'));
			}
		}

		$this->render('create',array(
			'model'=>$model,
			'userType'=>$userType,
		));
	}

	/**
	 * 管理员编辑用户
	 */
	public function actionUpdate($id)
	{		
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
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * 管理用户列表.
	 */
	public function actionIndex()
	{		
		$model=new User('search');
		$model->unsetAttributes();  // clear any default values
		
		if(isset($_GET['User']))
			$model->attributes=$_GET['User'];

		$this->render('index',array(
			'model'=>$model,
		));
	}


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
	 * 修改密码(此方法应修改为管理员重置某个用户的密码为特定值 如"123456")
	 */
	public function actionUpdatePW($id)
	{		
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
					//$model->attributes=$_POST['User'];
					
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
}
