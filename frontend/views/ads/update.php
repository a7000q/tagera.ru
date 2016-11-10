<?php
use yii\bootstrap\Html;
use kartik\form\ActiveForm;
use yii\widgets\Pjax;
use dosamigos\fileinput\FileInput;


$this->title = "Изменение объявления \"".$product->name."\"";
$this->registerJsFile('/js/update-ads/script.js',['depends' => [\frontend\assets\AppAsset::className()]]);
?>

<div id="domMessage" style="display:none;">
    <h1><img src="/img/loading.gif"> Сабр!</h1>
</div>

<div class="row">
    <div class="col-md-3">
        <?= $this->render('/user/settings/_menu') ?>
    </div>
    <div class="col-md-9">
        <div class="inner-box">
            <h2 class="title-2"> <?= Html::encode($this->title) ?> </h2>

            <?Pjax::begin(['enablePushState' => false])?>
                <?$form = ActiveForm::begin([
                    'options' => [
                        'data-pjax' => true,
                        'enctype'=>'multipart/form-data',
                        'id' => 'update-form'
                    ],
                    'enableClientValidation' => false
                ])?>
                    <?=$form->field($model, "name")?>

                    <?=$form->field($model, "description")->textarea()?>

                    <?foreach ($model->category->fieldsAll as $field):?>
                        <?=$this->render('field/field', ['form' => $form, 'model' => $model, 'field' => $field])?>
                    <?endforeach;?>

                    <?=$form->field($model, "price")->textarea()?>

                    <div style="overflow: hidden;">
                        <div style="width: 45%; float: left;">
                            <?=$form->field($model, 'image')->widget(FileInput::className(), [
                                'style' => FileInput::STYLE_INPUT,
                                'options' => [
                                    'multiple' => false,
                                    'accept' => 'image/*'
                                ]
                            ])?>
                            <?=Html::submitInput('Загрузить', [
                                'name' => 'add-image',
                                'class' => 'btn btn-danger',
                                'style' => 'width: 100%',
                                'data-pjax' => true
                            ])?>
                        </div>
                        <div style="width: 45%; float: right;">
                            <table class="table">
                                <?foreach ($model->images as $image):?>
                                    <tr>
                                        <td style="width: 95%;"><?=Html::img("/".$image->image->src, ['style' => 'width: 100%;'])?></td>
                                        <td style="width: 5%;">
                                            <?=Html::a("<i class=\"icon-cancel\"></i>", '#',[
                                                'style' => 'color: #962A28; font-size: 30px;',
                                                'title' => 'Удалить',
                                                'class' => 'del-image',
                                                'data-id' => $image->id
                                            ])?>
                                        </td>
                                    </tr>
                                <?endforeach;?>
                            </table>
                        </div>
                    </div>
                    <div style="overflow: hidden;">
                        <div style="display: block; float: left; width: 100%; ">
                            <div class="content-subheading"><i class="icon-user fa"></i> <strong>Информация о продавце</strong></div>
                        </div>

                        <?=$form->field($model, 'username')->textInput(['style' => 'margin-top: 0;'])?>

                        <?=$form->field($model, 'phone')->widget(\yii\widgets\MaskedInput::className(), [
                            'mask' => '+7(999) 999-9999'
                        ])?>

                        <?= $form->field($model, 'id_city')->widget(\kartik\select2\Select2::className(), ['data' => \common\models\geo\City::getAllArray()]) ?>

                        <!-- Button  -->
                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="submit" name="ajax" hidden>
                                <?= Html::submitInput("Сохранить", ['class' => 'btn btn-success btn-block', 'name' => 'save-btn', 'style' => 'width: 100%']) ?>

                            </div>
                        </div>
                    </div>
                <?ActiveForm::end()?>
            <?Pjax::end()?>
        </div>
    </div>
</div>

