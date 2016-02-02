<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\CmenusSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cmenuses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cmenus-index">
	<div class="row">
        <div class="col-md-12">
			<div class="box">
                <div class="box-body table-responsive">

					<p class="pull-right">
						<?= Html::a('Create new child menu', ['create'], ['class' => 'btn btn-primary']) ?>
					</p>
					<?php Pjax::begin() ?>
					<?= GridView::widget([
						'dataProvider' => $dataProvider,
						'filterModel' => $searchModel,
						'columns' => [
							['class' => 'yii\grid\SerialColumn','header'=>'S.no'],

							'id',
							'parent_id',
							'type',
							'name',
							'link',
							// 'class',
							// 'status',

							['class' => 'yii\grid\ActionColumn'],
						],
					]); ?>
					<?php Pjax::end() ?>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div><!-- /.col -->
	</div><!-- /.row --> 
</div>
