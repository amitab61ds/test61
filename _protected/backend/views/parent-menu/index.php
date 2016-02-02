<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\ParentMenusSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Parent Menuses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="parent-menus-index">

	<div class="row">
        <div class="col-md-12">
			<div class="box">
                <div class="box-body table-responsive">
				    <p class="pull-right">
						<?= Html::a('Create New Menu', ['create'], ['class' => 'btn btn-primary']) ?>
					</p>

					<?php Pjax::begin() ?>
					<?= GridView::widget([
						'dataProvider' => $dataProvider,
						'filterModel' => $searchModel,
						'columns' => [
							['class' => 'yii\grid\SerialColumn'],
							'name',
							'description',
/* 							[
								'attribute' => 'status',
								'value' => function ($model) {
									if ($model->status) {
										return Html::a(Yii::t('app', 'Active'), ['status', 'id' => $model->id], [
											'class' => 'btn btn-success',
											'data-method' => 'post',
											'data-confirm' => Yii::t('app', 'Are you sure you want to deactivate this menu?'),
										]);
									} else {
										return Html::a(Yii::t('app', 'Inactive'), ['status', 'id' => $model->id], [
											'class' => 'btn btn-danger',
											'data-method' => 'post',
											'data-confirm' => Yii::t('app', 'Are you sure you want to activate this menu?'),
										]);
									}
								},
								'contentOptions' => ['style' => 'text-align:center'],
								'format' => 'raw',
								'filter'=>array("1"=>"Active","0"=>"Inactive"),
							],	 */		
							[	
								'class' => 'yii\grid\ActionColumn','header'=>'Actions',
								'buttons' => [
									'viewmenus' =>function ($url, $model, $key) {
										$options = array_merge([
											'title' => Yii::t('yii', 'View '.$model->name.' childs'),
											'aria-label' => Yii::t('yii', 'View '.$model->name.' childs'),
											'data-pjax' => '0',
										], []);
										return Html::a('<span class="glyphicon glyphicon-folder-open"></span>', ['cmenu/viewmenus','id'=>$model->id], $options);
									},
									 'delete' => function ($url, $model) {
										return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
											'title' => Yii::t('app', 'Delete menu'),
											'data-confirm'=>'Are you sure you want to delete '.$model->name.' menu?',
											'data-method'=>'POST',
											'data-pjax' => '0',											
										]);
									}
								],
								'template' => '{viewmenus} {update} ', 'contentOptions' => ['style' => 'width:160px;letter-spacing:10px;text-align:center'],
							],	
						],
					]); ?>
					<?php Pjax::end() ?>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div><!-- /.col -->
	</div><!-- /.row --> 
</div>
