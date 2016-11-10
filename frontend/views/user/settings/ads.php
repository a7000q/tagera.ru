<?php

use kartik\grid\GridView;
use kartik\helpers\Html;


$this->title = "Мои объявления";
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('/_alert', ['module' => Yii::$app->getModule('user')]) ?>

<div class="row">
    <div class="col-md-3">
        <?= $this->render('_menu') ?>
    </div>
    <div class="col-md-9">
        <div class="inner-box">
            <h2 class="title-2"><i class="icon-th-thumb"></i> <?= Html::encode($this->title) ?> </h2>

            <?=GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    [
                        'attribute' => 'dateText',
                        'options' => ['style' => 'width: 10%;']
                    ],
                    [
                        'label' => 'Фото',
                        'format' => 'raw',
                        'value' => function($data){
                            return Html::img("/".$data->generalImageSrc, [
                                'class' => 'thumbnail  img-responsive',
                                'style' => 'width: 90%;'
                            ]);
                        },
                        'options' => ['style' => 'width: 15%;']
                    ],
                    [
                        'label' => 'Категория',
                        'value' => function($data){
                            return $data->category->fullName;
                        },
                        'options' => ['style' => 'width: 25%;']
                    ],
                    [
                        'attribute' => 'name',
                        'options' => ['style' => 'width: 20%;']
                    ],
                    [
                        'attribute' => 'price',
                        'options' => ['style' => 'width: 10%;']
                    ],
                    [
                        'attribute' => 'status',
                        'value' => function($data){
                            return $data->statusText;
                        },
                        'options' => ['style' => 'width: 10%;']
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'controller' => '/ads',
                        'template' => '{update}{delete}',
                        'buttons' => [
                            'update' => function ($url, $model, $key) {
                                return Html::a('<i class="fa fa-edit"></i> Изменить', $url, [
                                    'class' => 'btn btn-primary btn-xs',
                                    'style' => 'margin-bottom: 10px;'
                                ]);
                            },
                            'delete' => function ($url, $model, $key) {
                                return Html::a('<i class="fa fa-trash"></i> Удалить', $url, [
                                    'class' => 'btn btn-danger btn-xs',
                                    'data-method' => 'post',
                                    'data-confirm' => 'Вы уверены, что хотите удалить данное объявление?'
                                ]);
                            }
                        ],
                        'options' => ['style' => 'width: 10%;']
                    ],
                ]
            ])?>
        </div>
    </div>
</div>
