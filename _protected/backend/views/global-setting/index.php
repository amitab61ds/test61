<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\GlobalSettingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Global Settings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="global-setting-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
	<div class="row">
        <div class="col-md-12">
			<div class="box">
                <div class="box-body table-responsive">

					<p class="pull-right">
						<?= Html::a('Global Settings', ['create'], ['class' => 'btn btn-primary']) ?>
					</p>

					<?= GridView::widget([
						'dataProvider' => $dataProvider,
						'filterModel' => $searchModel,
						'columns' => [
							['class' => 'yii\grid\SerialColumn', 'header' => 'S.No.'],

							'id',
							'site_title',
							'meta_tag:ntext',
							'meta_desc:ntext',
							'fevicon_icon',
							// 'logo',

							['class' => 'yii\grid\ActionColumn'],
						],
					]); ?>
	</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div><!-- /.col -->
	</div><!-- /.row --> 
</div>
