<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Cmenus */

$this->title = $parentmenu->name . ':  ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'All Menus', 'url' => ['parent-menu/index']];
$this->params['breadcrumbs'][] = ['label' => $parentmenu->name, 'url' => ['viewmenus', 'id' => $parentmenu->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cmenus-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
