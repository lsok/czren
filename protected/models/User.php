<?php

/**
 * This is the model class for table "tbl_user".
 *
 * The followings are the available columns in table 'tbl_user':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $qq
 * @property string $mobile
 * @property string $phone
 * @property string $name
 * @property integer $gender
 * @property string $address
 * @property string $introduction
 * @property string $avatar
 * @property integer $level
 * @property string $create_time
 * @property string $last_login_time
 */
class User extends CActiveRecord
{
	/**
	 * @return string 重复密码
	 */
	public $password_repeat;
	
	/**
	 * @return boolean 标记是否是用户修改密码
	 */
	public $isUpdatePassword=false;
	
	/**
	 * @return string 旧密码
	 */
	public $password_old;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password', 'required', 'on'=>'register,businessRegister,updatePassword'),
			array('username', 'unique'),
			array('username', 'length', 'min'=>4, 'max'=>30),
			array('password', 'compare', 'on'=>'register,businessRegister,updatePassword'),
			array('password_repeat', 'safe'),
			array('password', 'length', 'min'=>5, 'on'=>'register,businessRegister,updatePassword'),
			array('mobile, address', 'required', 'on'=>'businessRegister'),
			array('email', 'email', 'on'=>'updateProfile,updateBusinessProfile'),
			array('mobile, phone, address, introduction', 'required', 'on'=>'updateBusinessProfile'),
			array('password_old', 'safe'),
			array('gender, level', 'numerical', 'integerOnly'=>true),
			array('email, qq, mobile, phone, name', 'length', 'max'=>256),
			array('avatar', 'file', 'allowEmpty'=>true, 'types'=>'jpg,png,gif', 'maxSize'=>1024*1024*10, 'tooLarge'=>'图片大于10M,请上传较小的图片!'),
			array('address, introduction, avatar, create_time, last_login_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, email, qq, mobile, phone, name, gender, address, introduction, level, create_time, last_login_time', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		//定义商家简介标签
		$usernameLabel = ($this->level == 1) ? '商家名称' : '用户名';
		$addressLabel = ($this->level == 1) ? '商家地址' : '地址';
		$introductionLabel = ($this->level == 1) ? '商家简介' : '个人简介';
		
		return array(
			'id' => 'ID',
			'username' => $usernameLabel,
			'password' => '密码',
			'password_repeat' => '重复密码',
			'password_old' => '旧密码',
			'email' => '电子邮件',
			'qq' => 'QQ',
			'mobile' => '手机',
			'phone' => '电话',
			'name' => '真实姓名',
			'gender' => '性别',
			'address' => $addressLabel,
			'introduction' => $introductionLabel,
			'avatar' => '头像',
			'level' => '用户级别',
			'create_time' => '注册时间',
			'last_login_time' => '最后登录时间',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('qq',$this->qq,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('gender',$this->gender);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('introduction',$this->introduction,true);
		$criteria->compare('level',$this->level);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('last_login_time',$this->last_login_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	/**
	 * 在验证完成后执行用户密码加密.
	 */
	protected function afterValidate()
	{
		parent::afterValidate();
		
		//如果是新用户注册或用户修改密码则对密码执行md5加密
		if($this->isNewRecord || $this->isUpdatePassword==true)
		{
			//如通过所有表单验证则加密密码(否则为保持用户原始输入,不执行密码加密)
			if(sizeof($this->getErrors()) == 0)
			{
				$this->password = $this->encrypt($this->password);
			}
		}
	}
	
	/**
	 * 密码加密.
	 */
	public function encrypt($value)
	{
		return md5($value);
	}
	
	/**
	 * 显示表单验证错误.
	 */
	public function showErrors()
	{
		$errors=new ShowFormError($this);
		return $errors->show();
	}
}