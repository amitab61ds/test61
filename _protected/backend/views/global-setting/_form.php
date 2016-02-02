<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\GlobalSetting */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="tab-content">
<?php

if($model->fevicon_icon != ''){
		$image = \Yii::$app->request->baseUrl . $model->fevicon_icon;
}else{
		$image = \Yii::$app->request->baseUrl . '/uploads/gal.png';
}
if($model->innerlogo != ''){
		$image2 = \Yii::$app->request->baseUrl . $model->innerlogo;
}else{
		$image2 = \Yii::$app->request->baseUrl . '/uploads/gal.png';
}
if($model->logo != '')
 {			$image1 = \Yii::$app->request->baseUrl . $model->logo; }
else{
	$image1 = \Yii::$app->request->baseUrl . '/uploads/gal.png';
}

if( isset($_GET['save']) && $_GET['save']=='yes'){
	echo"<h2>Your Settings has been saved successfully.</h2>";
}
?>
<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'
]]); ?>

<div class="tab-pane active" id="tab_1">
    <?= $form->field($model, 'site_title')->textInput(['maxlength' => true]) ?>
	
    <?= $form->field($model, 'admin_mail')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'meta_tag')->textarea(['rows' => 2]) ?>

    <?= $form->field($model, 'meta_desc')->textarea(['rows' => 6]) ?>

</div>
<div class="tab-pane " id="tab_2">
	<?php

		// Usage with ActiveForm and model
		echo $form->field($model, 'fevicon_icon')->widget(FileInput::classname(), 
		[
			'options' => ['accept' => 'image/*', 'value' => $model->fevicon_icon],    
			'pluginOptions' => [
				'showCaption' => false,
				'showRemove' => true,
				'showUpload' => false,
				 'initialPreview'=>[
					Html::img($image, ['class'=>'file-preview-images', 'alt'=>'', 'title'=>'' ,  'height' => 16]),				
				], 
			]
		]);
	?>
	<?php
		// Usage with ActiveForm and model
		echo $form->field($model, 'logo')->widget(FileInput::classname(), 
		[
			'options' => ['accept' => 'image/*', 'value' => $model->logo],    
			'pluginOptions' => [
				'showCaption' => false,
				'showRemove' => true,
				'showUpload' => false,
				 'initialPreview'=>[
					Html::img($image1, ['class'=>'file-preview-image', 'alt'=>'', 'title'=>'', 'style' => 'max-width:300px;max-height:200px;']),				
				], 
			]
		]);
	?>
	<?php
		// Usage with ActiveForm and model
		echo $form->field($model, 'innerlogo')->widget(FileInput::classname(), 
		[
			'options' => ['accept' => 'image/*', 'value' => $model->innerlogo],    
			'pluginOptions' => [
				'showCaption' => false,
				'showRemove' => true,
				'showUpload' => false,
				 'initialPreview'=>[
					Html::img($image2, ['class'=>'file-preview-image', 'alt'=>'', 'title'=>'', 'style' => 'max-width:300px;max-height:200px;']),				
				], 
			]
		]);
	?>

	<?= $form->field($model, 'contact_details')->widget(\yii\redactor\widgets\Redactor::className(), [
    'clientOptions' => [
        'imageManagerJson' => ['/redactor/upload/image-json'],
		'uploadDir' => '@webroot/uploads/images',
		'uploadUrl' => '@web/uploads/images',
        'plugins' => ['imagemanager']
    ]
	])?>
	</div>
<div class="tab-pane " id="tab_3">
	<h2>Social Links</h2>
	<?= $form->field($model, 'facebook')->textInput(['maxlength' => true]) ?>
	<?= $form->field($model, 'twitter')->textInput(['maxlength' => true]) ?>
	<?= $form->field($model, 'linkedin')->textInput(['maxlength' => true]) ?>
	<?= $form->field($model, 'googleplus')->textInput(['maxlength' => true]) ?>
	<?= $form->field($model, 'youtube')->textInput(['maxlength' => true]) ?>
	<?= $form->field($model, 'pinterest')->textInput(['maxlength' => true]) ?>
	</div>
   <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>


<style>
body .file-preview-frame.file-preview-initial {
    height: 60px;
}
body .file-preview-frame.file-preview-initial img.file-preview-images {
    width: 50px;
    height: 50px;
}
.tab-pane{
	display:none;
}
.active{
	display:block;
}
</style>
</div>