<?
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<br>

<?php
$this->registerJs(
    '$("document").ready(function(){
            $("#pjax-add-category").on("pjax:end", function() {
            $.pjax.reload({container:"#category-grid"});  //Reload GridView
        });
    });'
);
?>

<?php yii\widgets\Pjax::begin(['enablePushState' => false, 'id' => 'pjax-add-category']) ?>
    <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true], 'id' => 'category-form']); ?>
        <div class="form-group">
            <?= Html::submitButton('Добавить категорию', ['class' => 'btn btn-success', 'name' => 'create-category']) ?>
        </div>
    <?php ActiveForm::end(); ?>
<?php yii\widgets\Pjax::end(); ?>

<?=GridView::widget([
    'dataProvider'=> $dataProvider,
    'pjax'=>true,
    'pjaxSettings' =>[
        'neverTimeout'=>true,
        'options'=>[
            'id'=>'category-grid',
        ]
    ],
    'columns' => [
        [
            'attribute' => 'name',
            'class' => '\kartik\grid\EditableColumn',
            'editableOptions'=> ['formOptions' => ['action' => ['/category/editrecord']]]
        ],
        [
            'attribute' => 'sort',
            'class' => '\kartik\grid\EditableColumn',
            'editableOptions'=> ['formOptions' => ['action' => ['/category/editrecord']]]
        ],
        [
            'class' => '\kartik\grid\ActionColumn',
            'template' => '{view}{delete}',
            'controller' => 'category',
        ]
    ]
]);
?>


