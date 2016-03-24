<!DOCTYPE html>
<html class="full" lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap -->
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.min.css" rel="stylesheet">
	<!-- 自定义CSS -->
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/custom.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
  </head>
<body>
<div class="container-fluid">
	<div class="row"><!-- header区开始 -->
		<div class="col-12">
			<nav class="navbar navbar-default" role="navigation">
				<div class="container-fluid">
				<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				 <span class="icon-bar"></span>
				<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="/site/index"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.gif" alt="沧州人"></a>
				</div>
				<?php if(Yii::app()->user->isGuest) { ?>
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<form action="/site/login" method="post" id="login-form" class="navbar-form navbar-left">
				<div class="form-group">
				<input type="text" name="LoginForm[username]" id="LoginForm_username" class="form-control" placeholder="用户名">
				</div>
				<div class="form-group">
				<input type="password" name="LoginForm[password]" id="LoginForm_password" class="form-control" placeholder="密码">
				</div>
				<button type="submit" class="btn btn-primary">登录</button>
				<a class="btn btn-primary" href="/user/create/type/p">注册</a>
				<a class="btn btn-danger" href="/user/create/type/b">商家入驻</a>
				<a class="btn btn-success" href="">生活分类</a>
				</form>
				</div>
				<?php } else { ?>
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<a class="btn btn-danger navbar-btn" href="">发布信息</a>
				<a class="btn btn-warning navbar-btn" href="/user/index/id/<?php echo Yii::app()->user->id; ?>"><span class="glyphicon glyphicon-user"></span> 个人中心</a>
				<a class="btn btn-success" href="">生活分类</a>
				</div>
				<?php } ?>
				</div>
			</nav>
		</div>
	</div><!-- header区结束 -->
	<div class="row"><!-- 主体内容区开始 -->
	<?php echo $content; ?>
	</div><!-- 主体内容区结束 -->
	</div>
	<footer class="footer"><!-- 页脚区开始 -->
      <div class="container">
        <p class="text-muted">沧州人 www.czren.me 版权所有 2015-2020</p>
      </div>
    </footer><!-- 页脚区结束 -->
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.min.js"></script>
  </body>
</html>
