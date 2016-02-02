<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\States */

$this->title = $parentmenu->name.'- Add New Child';
$this->params['breadcrumbs'][] = ['label' => 'All menus', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $parentmenu->name, 'url' => ['viewmenus', 'id' => $parentmenu->id]];
$this->params['breadcrumbs'][] = $this->title;
$this->registerJs(
	'$("#cmenus-selectdata").empty();
	$(".field-cmenus-selectdata").hide();'
);
?>
<div class="states-create">
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-body table-responsive">
					<div class="cmenus-form">

						<?php $form = ActiveForm::begin(); ?>

						<?= $form->field($model, 'parent_id')->hiddenInput()->label(false);	?>

						<?php
							echo $form->field($model, 'type')->dropDownList(
							$model->menuTypes,
							['prompt'=>'Select Menu Type',
							'onchange'=>'
								$("#cmenus-name").val("");
								$("#cmenus-link").val("");
								if($(this).val() != 2 && $(this).val() != ""){
									$.post( "'.Yii::$app->urlManager->createUrl('cmenu/values?id=').'"+$(this).val(), function( data ) {
										if(data.result){
											$( "select#cmenus-selectdata" ).html( data.result );
											$(".field-cmenus-selectdata").show();
										}
								   });
								}else{
									$("#cmenus-name").val("");
									$("#cmenus-link").val("");
									$("#cmenus-selectdata").empty();
									$(".field-cmenus-selectdata").hide();
									$(".field-cmenus-link").show();


								}
							',
							'class'=>'form-control select2']
							);

						?>

						<?= $form->field($model, 'selectdata')->dropDownList(array(),
							['prompt'=>'Select Data',
							'onchange'=>'
								pid = $("#cmenus-type").val();
								if(pid != ""){
									url = "";
									if(pid == 1){ url = ""; }
									else if(pid == 3){url = "'.Yii::$app->urlManager->createUrl('post/').'"; }
									else{url = "'.Yii::$app->urlManager->createUrl('category/').'"; }
									link = $(this).val();
									name = $("#cmenus-selectdata option:selected").text();
									$("#cmenus-link").val(url+""+link+".html");
									$("#cmenus-name").val(name);
									$(".field-cmenus-link").hide();
								}else{
									$("#cmenus-name").val("");
									$("#cmenus-link").val("");


								}
							',
							'class'=>'form-control select2'])->label('Select option'); ?>
						<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

						<?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>

						<?= $form->field($model, 'class_name')->textInput(['maxlength' => true]) ?>

						<div class="form-group">
							<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
						</div>

						<?php ActiveForm::end(); ?>

					</div>
				</div>
			</div>
		</div>
    </div>
</div>
