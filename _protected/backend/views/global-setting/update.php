<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\GlobalSetting */

$this->title = 'Global Setting';
$this->params['breadcrumbs'][] = 'Global Setting';
?>
<!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
				<li class="active"><a href="#tab_1" data-toggle="tab">General Settings</a></li>
				<li><a href="#tab_2" data-toggle="tab">Site Settings</a></li>
				<li><a href="#tab_3" data-toggle="tab">Social Settings</a></li>
            </ul>

			<?= $this->render('_form', [
			'model' => $model,
			]) ?>

          </div>
          <!-- nav-tabs-custom -->
  <!-- Custom Tabs -->





            <!-- /.tab-content -->
          <!-- nav-tabs-custom -->