<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use yii\bootstrap\Tabs;
use backend\assets\EditablePageAsset;

if ($model->categoriesDataProvider->count == 0 and $model->fieldsDataProvider->count == 0)
    EditablePageAsset::register($this);

$this->title = $model->name;
if ($model->parent)
{
    $this->params['breadcrumbs'] = $model->breadcrumbs;
}
else
{
    $this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => ['index']];
}

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-view">

    <?= DetailView::widget([
        'model' => $model,
        'panel'=>[
            'heading'=>'Категория # ' . $model->name,
            'type'=>DetailView::TYPE_INFO,
        ],
        'deleteOptions'=>[ // your ajax delete parameters
            'params' => ['id' => $model->id, 'kvdelete'=>true],
        ],
        'attributes' => [
            [
                'attribute' => 'parentName',
                'label' => 'Родительская категория',
                'displayOnly' => true
            ],
            'name',
            'icon',
            'sort'
        ],
    ]) ?>

    <?
    echo Tabs::widget([
        'items' => [
            [
                'label' => 'Категории',
                'content' => $this->render('child-category', ['dataProvider' => $model->categoriesDataProvider]),
                'active' => true
            ],
            [
                'label' => 'Поля',
                'content' => $this->render('fields', ['dataProvider' => $model->fieldsDataProvider]),
            ],
            [
                'label' => 'Фото',
                'content' => $this->render('photo', ['model' => $model]),
            ]
        ]
    ]);
    ?>
    

</div>
