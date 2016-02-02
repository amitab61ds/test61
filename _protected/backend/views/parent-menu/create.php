<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\ParentMenus */

$this->title = 'Create Parent Menus';
$this->params['breadcrumbs'][] = ['label' => 'Parent Menuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="parent-menus-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
