<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Cmenus */
/* @var $form yii\widgets\ActiveForm */

$this->registerJs(
    '$("#cmenus-selectdata").empty();
	$(".field-cmenus-selectdata").hide();'
);

?>

<div class="cmenus-form">

    <?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'parent_id')->hiddenInput()->label(false);	?>

	<?php
		/*echo $form->field($model, 'type')->dropDownList(
		$model->menuTypes,
		['prompt'=>'Select Menu Type',
		'onchange'=>'
			$("#cmenus-name").val();
			$("#cmenus-link").val();
			if($(this).val() != 2 && $(this).val() != ""){
				$.post( "'.Yii::$app->urlManager->createUrl('admin/cmenu/values?id=').'"+$(this).val(), function( data ) {
					if(data.result){
						$( "select#cmenus-selectdata" ).html( data.result );
						$(".field-cmenus-selectdata").show();
					}
			   });
			}else{
				$("#cmenus-selectdata").empty();
				$(".field-cmenus-selectdata").hide();
			}
		',
		'class'=>'form-control select2']
		);*/

	?>

	<?= $form->field($model, 'selectdata')->dropDownList(array(),
		['prompt'=>'Select Data',
		'onchange'=>'
			if($(this).val() != ""){
				link = $(this).val();
				name = $("#cmenus-selectdata option:selected").text();
				$("#cmenus-link").val("'.Yii::$app->urlManager->createUrl('page/').'"+link);
				$("#cmenus-name").val(name);
			}else{
				$("#cmenus-name").val();
				$("#cmenus-link").val();
			}
		',
		'class'=>'form-control select2'])->label('Select option'); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php
		if($model->type == 2){
			echo $form->field($model, 'link')->textInput(['maxlength' => true]); 		
		}else{ 
			echo $form->field($model, 'link')->textInput(['maxlength' => true,'readonly'=>true]); 
		}
	?>
	

    <?= $form->field($model, 'class_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->hiddenInput()->label(false);	?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
