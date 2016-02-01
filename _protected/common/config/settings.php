<?php

namespace common\config;

use Yii;
use yii\base\BootstrapInterface;
use common\models\Globalsetting;
/*
/* The base class that you use to retrieve the settings from the database
*/

class settings implements BootstrapInterface {

    private $db;

    public function __construct() {
        $this->db = Yii::$app->db;
    }

    /**
    * Bootstrap method to be called during application bootstrap stage.
    * Loads all the settings into the Yii::$app->params array
    * @param Application $app the application currently running
    */

    public function bootstrap($app) {

		$Globalsetting = new Globalsetting();
		$Globalsettings = $Globalsetting->getLogoFevicon();
		foreach($Globalsettings as $settings ){
			foreach ($settings as $key => $val) {
				Yii::$app->params['settings'][$key] = $val;
			}
		}	
		Yii::$app->params['adminEmail'] = Yii::$app->params['settings']['admin_mail'];
		Yii::$app->params['siteName'] = Yii::$app->params['settings']['site_title'];
    }

}