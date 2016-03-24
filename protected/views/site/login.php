<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */
$this->pageTitle=Yii::app()->name . ' - Login';
?>


<form id="login-form" action="/site/login" method="post">
			
<?php $model->showErrors(); ?>

<div class="form-group">
<label for="LoginForm_username" class="sr-only">Email address</label>
<input type="text" name="LoginForm[username]" class="form-control input-danger"  id="LoginForm_username">
</div>

<div class="form-group">
<label for="LoginForm_password" class="sr-only">Password</label>
<input type="password" name="LoginForm[password]" class="form-control" id="LoginForm_password">
</div>

<button type="submit" class="btn btn-success btn-lg">登录</button>
