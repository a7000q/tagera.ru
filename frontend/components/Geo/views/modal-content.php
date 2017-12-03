<?
use kartik\select2\Select2;
use kartik\helpers\Html;
use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;

?>

<?$form = ActiveForm::begin()?>

    <div style="overflow: hidden;">

        <div class="form-group">

            <div class="col-md-12">
                <?=Select2::widget([
                    'data' => ArrayHelper::merge(['Вся Турция'], \common\models\geo\City::getAllArray()),
                    'name' => 'geo_id_city',
                    'id' => 'select-city',
                    'value' => (\Yii::$app->session->get('geo'))?\Yii::$app->session->get('geo'):"",
                    'options' => [
                        'placeholder' => 'Выберите город'
                    ],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ])?>

            </div>
        </div>


        <div class="form-group">

            <div class="col-md-12">
                <?=Html::submitButton('Выбрать', [
                    'class' => 'btn btn-success',
                    'style' => 'width: 100%; margin-top: 10px;',
                    'name' => 'setGeo'
                ])?>

            </div>
        </div>

    </div>

<?ActiveForm::end()?>

