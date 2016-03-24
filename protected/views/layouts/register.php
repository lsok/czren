<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="col-md-12">
<!-- 使用响应式工具生成上边距 -->
<div class="visible-md-block visible-lg-block marginTop50"></div>
<div class="row">
<div class="col-md-4 col-md-offset-2">
<h2><?php echo ($this->getId() == 'site') ? '系统登录' : '欢迎注册'; ?></h2>
<?php echo $content; ?>
</div>
</div>
</div>
<?php $this->endContent(); ?>