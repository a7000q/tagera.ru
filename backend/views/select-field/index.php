<?
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use backend\assets\EditablePageAsset;

if ($dataProvider->count == 0)
    EditablePageAsset::register($this);

?>
<br>

<?php
$this->registerJs(
    '$("document").ready(function(){
            $("#pjax-add-select-value").on("pjax:end", function() {
            $.pjax.reload({container:"#select-grid"});  //Reload GridView
        });
    });'
);
?>

<?php yii\widgets\Pjax::begin(['enablePushState' => false, 'id' => 'pjax-add-select-value']) ?>
    <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true], 'id' => 'add-select-value-form']); ?>
        <div class="form-group">
            <?= Html::submitButton('Добавить значение', ['class' => 'btn btn-success', 'name' => 'create-select-value', 'data-pjax' => true]) ?>
        </div>
    <?php ActiveForm::end(); ?>
<?php yii\widgets\Pjax::end(); ?>

<?=GridView::widget([
    'dataProvider'=> $dataProvider,
    'pjax'=>true,
    'id' => 'table-select-field',
    'pjaxSettings' =>[
        'neverTimeout'=>true,
        'options'=>[
            'id'=>'select-grid',
        ]
    ],
    'columns' => [
        [
            'attribute' => 'value',
            'class' => '\kartik\grid\EditableColumn',
            'editableOptions'=> ['formOptions' => ['action' => ['/select-field/editrecord']]]
        ],
        [
            'class' => '\kartik\grid\ActionColumn',
            'deleteOptions' => ['label' => '<i class="glyphicon glyphicon-remove"></i>'],
            'template' => '{delete}',
            'controller' => 'select-field'
        ]
    ]
]);
?>

