<?
use dosamigos\fileinput\FileInput;
use kartik\form\ActiveForm;
use kartik\helpers\Html;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\widgets\Pjax;

\frontend\assets\CarouselAsset::register($this);
$this->title = "Новое объявление";

$this->registerJsFile('/js/add-ads/script.js',  ['position' => yii\web\View::POS_END, 'depends' => \frontend\assets\AppAsset::className()]);

?>


<div id="domMessage" style="display:none;">
    <h1><img src="/img/loading.gif"> Сабр!</h1>
</div>

<div class="row">
    <div class="col-md-9 page-content">
        <div class="inner-box category-content">
            <h2 class="title-2 uppercase"><strong> <i class="icon-docs"></i> <?=$this->title?></strong></h2>

            <div class="row">
                <div class="col-sm-12">
                    <?Pjax::begin()?>
                        <?= $this->render('/user/_alert', ['module' => Yii::$app->getModule('user')]) ?>
                        <?$form = ActiveForm::begin([
                            'fieldConfig' => [
                                'template' => '<label class="col-md-3 control-label">{label}</label><div class="col-md-8">{input}{error}</div>'
                            ],
                            'class' => 'form-horizontal',
                            'id' => 'add-form',
                            'options' => [
                                'data-pjax' => true,
                                'enctype'=>'multipart/form-data'
                            ],
                            'enableClientValidation' => false
                        ])?>
                            <fieldset style="overflow: hidden;">
                                <div class="form-group required <?=(isset($model->errors['id_category']))?"has-error":""?>">
                                    <label class="col-md-3 control-label">Категория</label>
                                    <div class="col-md-8">
                                        <?
                                        Modal::begin([
                                            'toggleButton' => [
                                                'label' => $model->getModalLabel(),
                                                'tag' => 'a',
                                                'class' =>'btn-modal-category'
                                            ],
                                            'header' => '<h2>Выбор категории</h2>',
                                            'size' => 'modal-lg',
                                            'id' => 'category-modal',


                                        ]);
                                        echo $this->render('category', ['form' => $form, 'model' => $model]);
                                        Modal::end();
                                        ?>
                                        <?if (isset($model->errors['id_category'])):?>
                                            <div class="help-block" style="margin-top: 0;">
                                                <?foreach ($model->errors['id_category'] as $error):?>
                                                    <?=$error;?>
                                                <?endforeach;?>
                                            </div>
                                        <?endif;?>
                                        <?=Html::activeHiddenInput($model, 'id_category', ['id' => 'id_category'])?>
                                    </div>
                                </div>

                                <?=$form->field($model, 'name')?>

                                <?=$form->field($model, 'description')->textarea()?>

                                <?if ($model->id_category):?>

                                    <?foreach ($model->category->fieldsAll as $field):?>
                                        <?=$this->render('field/field', ['form' => $form, 'model' => $model, 'field' => $field])?>
                                    <?endforeach;?>

                                <?endif?>

                                <?=$form->field($model, 'price')?>

                                <?=$form->field($model, 'image1')->widget(FileInput::className(), [
                                    'style' => FileInput::STYLE_INPUT,
                                    'options' => [
                                        'multiple' => false,
                                        'accept' => 'image/*'
                                    ]
                                ])?>

                                <?=$form->field($model, 'image2')->widget(FileInput::className(), [
                                    'style' => FileInput::STYLE_INPUT,
                                    'options' => [
                                        'multiple' => false,
                                        'accept' => 'image/*'
                                    ]
                                ])->label(false)?>

                                <?=$form->field($model, 'image3')->widget(FileInput::className(), [
                                    'style' => FileInput::STYLE_INPUT,
                                    'options' => [
                                        'multiple' => false,
                                        'accept' => 'image/*'
                                    ]
                                ])->label(false)?>

                                <?=$form->field($model, 'image4')->widget(FileInput::className(), [
                                    'style' => FileInput::STYLE_INPUT,
                                    'options' => [
                                        'multiple' => false,
                                        'accept' => 'image/*'
                                    ]
                                ])->label(false)?>

                                <?=$form->field($model, 'image5')->widget(FileInput::className(), [
                                    'style' => FileInput::STYLE_INPUT,
                                    'options' => [
                                        'multiple' => false,
                                        'accept' => 'image/*'
                                    ]
                                ])->label(false)?>

                                <?=$form->field($model, 'image6')->widget(FileInput::className(), [
                                    'style' => FileInput::STYLE_INPUT,
                                    'options' => [
                                        'multiple' => false,
                                        'accept' => 'image/*'
                                    ]
                                ])->label(false)?>


                                <div style="display: block; float: left; width: 100%;">
                                    <div class="content-subheading"><i class="icon-user fa"></i> <strong>Информация о продавце</strong></div>
                                </div>

                                <?=$form->field($model, 'username')?>

                                <?=$form->field($model, 'phone')->widget(\yii\widgets\MaskedInput::className(), [
                                    'mask' => '+7(999) 999-9999'
                                ])?>

                                <?= $form->field($model, 'city')->widget(\kartik\select2\Select2::className(), ['data' => \common\models\geo\City::getAllArray()]) ?>

                                <!-- Button  -->
                                <div class="form-group">
                                    <label class="col-md-3 control-label"></label>

                                    <div class="col-md-8">
                                        <input type="submit" name="ajax" hidden>
                                        <?= Html::submitInput("Добавить", ['class' => 'btn btn-success btn-block', 'name' => 'save-btn']) ?>

                                    </div>
                                </div>
                            </fieldset>
                            <div style="margin-bottom: 40px;"></div>
                        <?ActiveForm::end()?>
                    <?Pjax::end()?>
                </div>
            </div>
        </div>
    </div>
    <!-- /.page-content -->

    <div class="col-md-3 reg-sidebar">
        <div class="reg-sidebar-inner text-center">
            <div class="promo-text-box"><i class=" icon-picture fa fa-4x icon-color-1"></i>

                <h3><strong>Размещайте БЕСПЛАТНО и только ХАЛЯЛЬ</strong></h3>

                <p>"О те, которые уверовали! Указать ли вам на торговлю, которая спасет вас от мучительных страданий?
                    Веруйте в Аллаха и Его посланника и сражайтесь на пути Аллаха своим имуществом и своими душами.
                    Так будет лучше для вас, если бы вы только знали." (Ряды, 61 10:11)</p>
            </div>

            <div class="panel sidebar-panel">
                <div class="panel-heading uppercase">
                    <small><strong>Как продать быстро?</strong></small>
                </div>
                <div class="panel-content">
                    <div class="panel-body text-left">
                        <ul class="list-check">
                            <li> Указывайте краткое название</li>
                            <li> Размещайте  в правильной категории</li>
                            <li> Добавляйте хорошие фотографии</li>
                            <li> Указывайте реальную цену</li>

                        </ul>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <!--/.reg-sidebar-->
</div>
<!-- /.row -->