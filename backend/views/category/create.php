<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\category\Category */

$this->title = 'Новая категория';
if ($parent)
{
    $this->params['breadcrumbs'] = $parent->breadcrumbs;
    $this->params['breadcrumbs'][] = ['label' => $parent->name, 'url' => ['index', 'id' => $parent->id]];
}
else
    $this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => ['index']];

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-create">

    <h1><?= Html::encode($this->title)?> <?=($parent)?"в \"".$parent->name."\"":""?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
