<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\PagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pages';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pages-index">

	<div class="row">
        <div class="col-md-12">
			<div class="box">
                <div class="box-body table-responsive">

					<p class="pull-right">

						<?= Html::a('Create Pages', ['create'], ['class' => 'btn btn-success']) ?>
					</p>
					<?php Pjax::begin() ?>
					<?= GridView::widget([
						'dataProvider' => $dataProvider,
						'filterModel' => $searchModel,
						'columns' => [
							['class' => 'yii\grid\SerialColumn', 'header' => 'S.No.'],

							'name',
							'slug',
							[
								'contentOptions' => ['style' => 'width:160px;text-align:center'],
								'format' => 'raw',
								'attribute'=>'parentid',
								'filter' => $searchModel->ParentList,
								'value' => function ($model) {
									
									return $model->getParentName($model->rel->parentid);
								}
							],
							//'content:ntext',
							[
								'attribute' => 'status',
								'value' => function ($model) {
									if ($model->status) {
										return Html::a(Yii::t('app', 'Active'), ['status', 'id' => $model->id], [
											'class' => 'btn btn-success',
											'data-method' => 'post',
											'data-confirm' => Yii::t('app', 'Are you sure you want to deactivate this page?'),
										]);
									} else {
										return Html::a(Yii::t('app', 'Inactive'), ['status', 'id' => $model->id], [
											'class' => 'btn btn-danger',
											'data-method' => 'post',
											'data-confirm' => Yii::t('app', 'Are you sure you want to activate this page?'),
										]);
									}
								},
								'contentOptions' => ['style' => 'width:160px;text-align:center'],
								'format' => 'raw',
								'filter'=>array("1"=>"Active","0"=>"Inactive"),
							],	
							//'meta_keywords',
							// 'meta_desc',
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
