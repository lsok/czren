<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Bootstrap Admin Template</title>

    <!-- Bootstrap Core CSS -->
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/plugins/morris.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand brandText" href="/admin/default/index"><span class="glyphicon glyphicon-cog"></span> 管理后台</a>
            </div>
            <!-- Top Menu Items -->
			
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
			<ul class="nav navbar-nav">
					<li><a href="#"><span class="glyphicon glyphicon-calendar"></span> 2015-03-08</a></li>
					<li><a href="#"><span class="glyphicon glyphicon-user"></span> <?php echo User::model()->findByPk(Yii::app()->user->id)->username; ?></a></li>
					<li><a href="/site/index" target="_blank"><span class="glyphicon glyphicon-eye-open"></span> 查看站点</a></li>
					<li><a href="/admin/default/logout"><span class="glyphicon glyphicon-ban-circle"></span> 退出系统</a></li>
				</ul>
                <ul class="nav navbar-nav side-nav">
                    <li class="active">
                        <a href="/admin/user/index">用户管理</a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i> 下拉菜单 <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                            <li>
                                <a href="#">Dropdown Item</a>
                            </li>
                            <li>
                                <a href="#">Dropdown Item</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
						<?php echo $content; ?>
                    </div>
                </div>
                <!-- /.row -->



            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/admin/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/admin/raphael.min.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/admin/morris.min.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/admin/morris-data.js"></script>
    <!--<script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>-->

</body>

</html>
