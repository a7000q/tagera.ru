<?php
use kartik\detail\DetailView;
use yii\helpers\ArrayHelper;
use common\models\category\ATypeField;
use kartik\tabs\TabsX;

$this->title = $model->name;

$this->params['breadcrumbs'] = $model->breadcrumbs;
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="field-view">
    <?=DetailView::widget([
        'model'=>$model,
        'condensed'=>true,
        'hover'=>true,
        'mode'=>DetailView::MODE_VIEW,
        'panel'=>[
            'heading'=>'Поле # ' . $model->name,
            'type'=>DetailView::TYPE_INFO,
        ],
        'deleteOptions'=>[ 
            'params' => ['id' => $model->id, 'kvdelete'=>true],
        ],
        'attributes'=>[
            'name',
            [
                'attribute' => 'id_type',
                'format' => 'raw',
                'value' => $model->typeFieldName,
                'type' => DetailView::INPUT_SELECT2,
                'widgetOptions'=>[
                    'data'=>ArrayHelper::map(ATypeField::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
                    'options' => ['placeholder' => 'Выберите тип'],
                    'pluginOptions' => ['allowClear'=>true, 'width'=>'100%'],
                ],
            ]
        ]
    ]);?>

    <?if (count($items) > 0):?>
        <?=TabsX::widget([
            'items'=>$items,
            'position'=>TabsX::POS_ABOVE,
            'encodeLabels'=>false
        ]);?>
    <?endif;?>
   
</div>