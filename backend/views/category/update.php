<?php

use yii\helpers\Html;

$this->title = 'Изменение категории: ' . $model->name;
if ($model->parent)
{
    $this->params['breadcrumbs'] = $model->breadcrumbs;
    $this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
}
else
{
    $this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => ['index']];
    $this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
}

$this->params['breadcrumbs'][] = 'Изменение';
?>
<div class="category-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
