<?
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\category\ATypeField;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
?>
<br>

<?php
$this->registerJs(
    '$("document").ready(function(){
            $("#pjax-add-field").on("pjax:end", function() {
            $.pjax.reload({container:"#fields-grid"});  //Reload GridView
        });
    });'
);
?>

<?php yii\widgets\Pjax::begin(['enablePushState' => false, 'id' => 'pjax-add-field']) ?>
<?php $form = ActiveForm::begin(['options' => ['data-pjax' => true], 'id' => 'add-field-form']); ?>
    <div class="form-group">
        <?= Html::submitButton('Добавить поле', ['class' => 'btn btn-success', 'name' => 'create-field', 'data-pjax' => true]) ?>
    </div>
<?php ActiveForm::end(); ?>
<?php yii\widgets\Pjax::end(); ?>

<?=$this->render('@backend/views/property-field/fields.php', ['dataProvider' => $dataProvider]);?>

