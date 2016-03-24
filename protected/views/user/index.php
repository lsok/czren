<?php
/* @var $this UserController */
/* @var $dataProvider CActiveDataProvider */

// $this->breadcrumbs=array(
	// 'Users',
// );

// $this->menu=array(
	// array('label'=>'用户管理', 'url'=>array('admin')),
// );
// $this->widget('zii.widgets.CListView', array(
	// 'dataProvider'=>$dataProvider,
	// 'itemView'=>'_view',
// ));

if($model->last_login_time == null)
{
	echo '<div class="alert alert-info alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>';
	echo '欢迎注册！"沧州人" 汇聚沧州本地生活信息，简单，实用，快速解决您的问题！';
	echo '</div>';
}
?>
<p>下面应显示用户发布的部分信息和其它重要信息</p>
