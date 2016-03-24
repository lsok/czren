<?php
/**
 * 显示表单错误
 */
class ShowFormError
{
	public $model;
	
	public function __construct($model)
	{
		$this->model=$model;
	}
	
	public function show()
	{
		if(sizeof($this->model->getErrors()) != 0)
		{
			echo '<div class="alert alert-danger alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>';
			echo '<ul class="showErrors">';
			foreach($this->model->getErrors() as $error)
			{
				foreach($error as $key=>$value)
				{
					echo '<li>'.$value.'</li>';
				}
			}
			echo '</ul>';
			echo '</div>';
		}
	}
}