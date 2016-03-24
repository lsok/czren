<?php
class UserTest extends CDbTestCase
{
	public $fixtures=array(
		'users'=>'User',
	);

	/**
	 * 测试商家注册时容易出现的错误
	 */
	public function testBusinessRegister()
	{	
		//商家注册时手机为空则失败
		$newBusinessUser=new User;
		$newBusinessUser->setScenario('businessRegister');
		$newBusinessUser->setAttributes(array(
			'username'=>'老家茶馆',
			'password'=>'12345',
			'password_repeat'=>'12345',
			'mobile'=>'',
			'address'=>'运河区68号',
			'level'=>1,
		));
		$this->assertEquals(false, $newBusinessUser->save());
		
		//商家注册时地址为空则失败
		$newBusinessUser2=new User;
		$newBusinessUser2->setScenario('businessRegister');
		$newBusinessUser2->setAttributes(array(
			'username'=>'智联电子',
			'password'=>'12345',
			'password_repeat'=>'12345',
			'mobile'=>'13987676786',
			'address'=>'',
			'level'=>1,
		));
		$this->assertEquals(false, $newBusinessUser2->save());
		
		//商家注册成功
		$newBusinessUser2=new User;
		$newBusinessUser2->setScenario('businessRegister');
		$newBusinessUser2->setAttributes(array(
			'username'=>'智联电子',
			'password'=>'12345',
			'password_repeat'=>'12345',
			'mobile'=>'13987676786',
			'address'=>'新华区78号',
			'level'=>1,
		));
		$this->assertEquals(true, $newBusinessUser2->save());
	}
}