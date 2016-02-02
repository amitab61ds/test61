<?php

namespace common\traits;

use Yii;
use yii\base\Model;

trait StatusChangeTrait
{

	public function Inactive(Model $model)
    {
        return (bool)$model->updateAttributes(['status' => 0]);
    }

     // Activate the location
  
    public function Active(Model $model)
    {
        return (bool)$model->updateAttributes(['status' => 1]);
    }
	
	 // @return bool Whether the location is active or not.
	 
	public function getIsActive(Model $model)
    {
        return $model->status == 1;
    }

    
     // @return bool Whether the location is inactive or not.
     
    public function getIsInactive(Model $model)
    {
        return $model->status == 0;
    }
	public function getslugCheck(Model $model)
    {
		if($model->slug !=""){
				
				$lower = strtolower($model->slug);
				$text = str_replace(" ", "-", $lower);
				$asd= $text;
			}
			else{
				
				$lower = strtolower($model->post_title);
				$text = str_replace(" ", "-", $lower);
				$asd= $text;
			}
			return $asd;
    }
	
}
