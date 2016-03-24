<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>管理登录</title>

    <!-- Bootstrap Core CSS -->
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/sb-admin.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body class="login">

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">管理登录</h3>
                    </div>
                    <div class="panel-body">
						<form role="form" id="login-form" action="/admin/default/login" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="用户名" name="LoginForm[username]" type="text" id="LoginForm_username" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="密码" name="LoginForm[password]" type="password" id="LoginForm_password">
                                </div>
								<?php if(CCaptcha::checkRequirements()): ?>
								<div class="form-group">
								<div class="row">
								<div class="col-xs-6">
								<input class="form-control" placeholder="验证码" name="LoginForm[verifyCode]" type="text">
								</div>
								<div class="col-xs-6">
								<?php $this->widget('CCaptcha'); ?>
								</div>
								</div>
								</div>
								<?php endif; ?>
								<button type="submit" class="btn btn-success btn-lg btn-block">登录</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
