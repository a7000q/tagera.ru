<?
use kartik\grid\GridView;
use common\models\category\ATypeField;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
?>

<?=GridView::widget([
    'dataProvider'=> $dataProvider,
    'pjax'=>true,
    'id' => 'fields-grid-table',
    'pjaxSettings' =>[
        'neverTimeout'=>true,
        'options'=>[
            'id'=>'fields-grid',
        ]
    ],
    'columns' => [
        [
            'attribute' => 'name',
            'class' => '\kartik\grid\EditableColumn',
            'editableOptions'=> ['formOptions' => ['action' => ['/property-field/editrecord']]]
        ],
        [
            'attribute' => 'id_type',
            'class' => '\kartik\grid\EditableColumn',
            'value' => function($data){
                return ArrayHelper::getValue($data, "typeField.name");
            },
            'editableOptions'=> [
                'formOptions' => ['action' => ['/property-field/editrecord']],
                'inputType' => 'dropDownList',
                'data' => ATypeField::getAllArray()
            ]
        ],
        [
            'class' => '\kartik\grid\ActionColumn',
            'template' => '{view}{delete}',
            'controller' => 'property-field'
        ]
    ]
]);
?>
