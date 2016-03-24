<?php
/**
 * 限制仅管理员可访问后台功能
 */
class AdminAccessFilter extends CFilter
{
    protected function preFilter($filterChain)
	{
		//在动作执行前应用的逻辑
		$loginUser=User::model()->findByPk(Yii::app()->user->id);
		
		if($loginUser->level == 2)
		{
            $filterChain->run();
        }
		else
		{
            throw new CHttpException(403, '您无权访问该页!');
        }
    }
	
	// protected function postFilter($filterChain)
	// {
			//在动作执行后应用的逻辑
	// }
}