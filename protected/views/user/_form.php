<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>
	<!-- 如果是用户注册 -->
	<?php if($this->getAction()->getId() == 'create'): ?>
						
		<!-- 如果是个人注册 -->
		<?php if($userType == 'person'): ?>
		
			<form id="user-form" action="/user/create/type/p" method="post">
			
			<?php $model->showErrors(); ?>
		
			<div class="form-group">
			<label for="User_username" class="sr-only">Email address</label>
			<input type="text" name="User[username]" class="form-control input-danger"  id="User_username" placeholder="用户名（英文或中文）" value="<?php echo $model->username; ?>">
			</div>

			<div class="form-group">
			<label for="User_password" class="sr-only">Password</label>
			<input type="password" name="User[password]" class="form-control" id="User_password" placeholder="密码（5—15个字符）" value="<?php echo $model->password; ?>">
			</div>
			
			<div class="form-group">
			<label for="User_password_repeat" class="sr-only">Password</label>
			<input type="password" name="User[password_repeat]" class="form-control" id="User_password_repeat" placeholder="再次输入密码" value="<?php echo $model->password_repeat; ?>">
			</div>
			
		<!-- 如果是商家注册 -->
		<?php else: ?>
		
			<form id="user-form" action="/user/create/type/b" method="post">
		
			<?php $model->showErrors(); ?>
			
			<div class="form-group">
			<label for="User_username" class="sr-only">商家名称</label>
			<input type="text" name="User[username]" class="form-control"  id="User_username" placeholder="商家名称（中文或英文）" value="<?php echo $model->username; ?>">
			</div>

			<div class="form-group">
			<label for="User_password" class="sr-only">密码</label>
			<input type="password" name="User[password]" class="form-control" id="User_password" placeholder="密码（5—15个字符）" value="<?php echo $model->password; ?>">
			</div>
			
			<div class="form-group">
			<label for="User_password_repeat" class="sr-only">重复密码</label>
			<input type="password" name="User[password_repeat]" class="form-control" id="User_password_repeat" placeholder="再次输入密码" value="<?php echo $model->password_repeat; ?>">
			</div>
			
			<div class="form-group">
			<label for="User_mobile" class="sr-only">手机号码</label>
			<input type="text" name="User[mobile]" class="form-control"  id="User_mobile" placeholder="手机号码" value="<?php echo $model->mobile; ?>">
			</div>
			
			<div class="form-group">
			<label for="User_address" class="sr-only">商家地址</label>
			<input type="text" name="User[address]" class="form-control"  id="User_address" placeholder="商家地址" value="<?php echo $model->address; ?>">
			</div>
			
		<?php endif; ?>
	<?php endif; ?>
	
	<!-- 如果是修改用户资料 -->
	<?php if($this->getAction()->getId() == 'update'): ?>
		
		<form enctype="multipart/form-data" id="user-form" action="/user/update/id/<?php echo $model->id; ?>" method="post">
		
		<?php $model->showErrors(); ?>
		
		<div class="form-group">
		<label for="exampleInputEmail1"><?php echo ($model->level ==0) ? '用户名' : '商家名'; ?>：<?php echo $model->username; ?></label>
		</div>
		
		
		<div class="form-group <?php if($model->hasErrors('email')) {echo 'has-error';} ?>">
		<label for="User_email">电子邮件</label>
		<div class="row">
		<div class="col-md-7">
		<input type="email" name="User[email]" class="form-control" id="User_email" value="<?php echo $model->email; ?>">
		</div>
		</div>
		</div>
					
		<div class="form-group <?php if($model->hasErrors('qq')) {echo 'has-error';} ?>">
		<label for="User_qq">QQ</label>
		<div class="row">
		<div class="col-md-7">
		<input type="text" name="User[qq]" class="form-control" id="User_qq" value="<?php echo $model->qq; ?>">
		</div>
		</div>
		</div>	
					
		<div class="form-group <?php if($model->hasErrors('mobile')) {echo 'has-error';} ?>">
		<label for="User_mobile">手机</label><?php if($model->level == 1) {echo '<span class="required">*</span>';} ?>
		<div class="row">
		<div class="col-md-7">
		<input type="text" name="User[mobile]" class="form-control" id="User_mobile" value="<?php echo $model->mobile; ?>">
		</div>
		</div>
		</div>

		<div class="form-group <?php if($model->hasErrors('phone')) {echo 'has-error';} ?>">
		<label for="User_phone">电话</label><?php if($model->level == 1) {echo '<span class="required">*</span>';} ?>
		<div class="row">
		<div class="col-md-7">
		<input type="text" name="User[phone]" class="form-control" id="User_phone" value="<?php echo $model->phone; ?>">
		</div>
		</div>
		</div>
		
		<div class="form-group">
		<label for="User_name">真实姓名</label>
		<div class="row">
		<div class="col-md-7">
		<input type="text" name="User[name]" class="form-control" id="User_name" value="<?php echo $model->name; ?>">
		</div>
		</div>
		</div>

		<div class="form-group">
		<label class="radio-inline">
		<input type="radio" name="User[gender]" id="inlineRadio1" value="0" <?php echo ($model->gender == 0) ? 'checked' : ''; ?>> 男
		</label>
		<label class="radio-inline">
		<input type="radio" name="User[gender]" id="inlineRadio2" value="1" <?php echo ($model->gender == 1) ? 'checked' : ''; ?>> 女
		</label>
		</div>
		
		<div class="form-group <?php if($model->hasErrors('address')) {echo 'has-error';} ?>">
		<label for="User_address"><?php echo ($model->level ==0) ? '地址' : '商家地址'; ?></label><?php if($model->level == 1) {echo '<span class="required">*</span>';} ?>
		<div class="row">
		<div class="col-md-7">
		<input type="text" name="User[address]" class="form-control" id="User_address" value="<?php echo $model->address; ?>">
		</div>
		</div>
		</div>

		<div class="form-group <?php if($model->hasErrors('introduction')) {echo 'has-error';} ?>">
		<label for="User_introduction"><?php echo ($model->level ==0) ? '个人简介' : '商家简介'; ?></label><?php if($model->level == 1) {echo '<span class="required">*</span>';} ?>
		<div class="row">
		<div class="col-md-7">
		<textarea name="User[introduction]" class="form-control" rows="3"><?php echo $model->introduction; ?></textarea>
		</div>
		</div>
		</div>

		<div class="form-group">
		<label for="User_avatar">头像</label>
		<div class="row">
		<div class="col-md-7">
		<?php
		echo '<img src="'.Yii::app()->baseUrl.'/'.$model->avatar.'" style="width:80px; height:82px;" />';
		?>
		</div>
		</div>
		</div>
		
		<div class="form-group">
		<?php echo CHtml::activeFileField($model,'avatar'); ?>
		</div>
		
	<?php endif; ?>
	
	<!-- 如果是修改密码 -->
	<?php if($this->getAction()->getId() == 'updatePW'): ?>
	
		<form id="user-form" action="/user/updatePW/id/<?php echo $model->id; ?>" method="post">
		
		<?php $model->showErrors(); ?>
		
		<div class="form-group <?php if($model->hasErrors('password_old')) {echo 'has-error';} ?>">
		<label for="password_old">旧密码</label>
		<div class="row">
		<div class="col-md-7">
		<input type="password" name="User[password_old]" class="form-control" id="password_old" value="<?php echo $model->password_old; ?>">
		</div>
		</div>
		</div>
		
		<div class="form-group <?php if($model->hasErrors('password')) {echo 'has-error';} ?>">
		<label for="password">新密码</label>
		<div class="row">
		<div class="col-md-7">
		<input type="password" name="User[password]" class="form-control" id="password" value="<?php echo $model->password; ?>">
		</div>
		</div>
		</div>
		
		<div class="form-group">
		<label for="password_repeat">重复密码</label>
		<div class="row">
		<div class="col-md-7">
		<input type="password" name="User[password_repeat]" class="form-control" id="password_repeat" value="<?php echo $model->password_repeat; ?>">
		</div>
		</div>
		</div>
	<?php endif; ?>
	
	<?php	
	if($model->isNewRecord)
	{
		echo '<button type="submit" class="btn btn-success btn-lg">注册</button>';
	}
	else
	{
		echo '<button type="submit" class="btn btn-success">保存</button>';
	}
	?>
	</form>