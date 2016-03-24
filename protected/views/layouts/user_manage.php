<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="col-md-2"><!-- 左侧菜单 -->
<!-- 使用响应式工具生成上边距 -->
<div class="visible-md-block visible-lg-block marginTop15"></div>
<div class="list-group">
<div class="list-group-item active">个人中心</div>
<a href="/user/update/id/<?php echo Yii::app()->user->id; ?>" class="list-group-item">个人资料</a>
<a href="/user/updatePW/id/<?php echo Yii::app()->user->id; ?>" class="list-group-item">修改密码</a>
<a href="#" class="list-group-item">积分查询</a>
<a href="#" class="list-group-item">帐户充值</a>
<a href="/site/logout" class="list-group-item">退出系统</a>
</div>
</div>
<div class="col-md-9"><!-- 右内容区 -->
<!-- 使用响应式工具生成上边距 -->
<div class="visible-md-block visible-lg-block marginTop15"></div>
<div class="panel panel-info">
<div class="panel-heading"><span class="glyphicon glyphicon-user"></span> 个人资料</div>
<div class="panel-body">
<div class="marginTop10"></div>
<?php echo $content; ?>		
</div>
</div>
</div>
<?php $this->endContent(); ?>