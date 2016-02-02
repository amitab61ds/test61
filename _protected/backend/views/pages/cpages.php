<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\StatesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $parent->name.' - child pages';
$this->params['breadcrumbs'][] = ['label' => 'All Menus', 'url' => ['parent-menu/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="states-index">
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-body table-responsive">	
					<p class="pull-right">
						<?= Html::a('Add New Menu', ['c-page', 'id' => $parent->id], ['class' => 'btn btn-primary']) ?>
					</p>
					<?php Pjax::begin() ?>
					<?= GridView::widget([
						'dataProvider' => $dataProvider,
						'filterModel' => $searchModel,
						'columns' => [
							['class' => 'yii\grid\SerialColumn', 'header' => 'S.No.'],

							'name',

							[
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
								'contentOptions' => ['style' => 'width:160px;text-align:center'],
								'format' => 'raw',
								'filter'=>array("1"=>"Active","0"=>"Inactive"),
							],							
							[	
								'class' => 'yii\grid\ActionColumn','header'=>'Actions',
								'template' => '{update} {delete}', 'contentOptions' => ['style' => 'width:160px;letter-spacing:10px;text-align:center'],
							],
						],
					]); ?>
		<?php Pjax::end() ?>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div><!-- /.col -->
	</div><!-- /.row --> 
</div>
