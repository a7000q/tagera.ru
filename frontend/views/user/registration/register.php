<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\helpers\Html;
use kartik\form\ActiveForm;

/**
 * @var yii\web\View              $this
 * @var dektrium\user\models\User $user
 * @var dektrium\user\Module      $module
 */

$this->title = Yii::t('user', 'Sign up');
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
    div.required label:after {
        content: " *";
        color: red;
    }
</style>

<div class="row">
    <div class="col-md-8 page-content">
        <div class="inner-box category-content">
            <h2 class="title-2"><i class="icon-user-add"></i> Создайте Ваш Аккаунт. Это бесплатно! </h2>
            <div class="row">
                <div class="col-sm-12">
                    <?php $form = ActiveForm::begin([
                        'id'                     => 'registration-form',
                        'enableAjaxValidation'   => true,
                        'options' => [
                            'class' => "form-horizontal"
                        ],
                        'fieldConfig' => [
                            'labelOptions' => ['class' => 'col-md-4 control-label'],
                            'template' => '{label}<div class="col-md-6">{input}{error}</div>',
                        ],
                    ]); ?>
                        <fieldset>

                            <!-- Text input-->
                            <?= $form->field($model, 'email') ?>

                            <?= $form->field($model, 'name') ?>

                            <?= $form->field($model, 'site') ?>

                            <?= $form->field($model, 'city')->widget(\kartik\select2\Select2::className(), ['data' => \common\models\geo\City::getAllArray()]) ?>

                            <?= $form->field($model, 'info')->textarea() ?>

                            <?= $form->field($model, 'username') ?>

                            <?php if ($module->enableGeneratingPassword == false): ?>
                                <?= $form->field($model, 'password')->passwordInput() ?>
                            <?php endif ?>

                            <?= $form->field($model, 'reCaptcha', ['template' => '{input}'])->widget(
                                \himiklab\yii2\recaptcha\ReCaptcha::className(),
                                ['siteKey' => '6LfZswoUAAAAALpMaBml8eOrB5PgpcKdFR40G3kQ']
                            ) ?>

                            <?= Html::submitButton(Yii::t('user', 'Sign up'), ['class' => 'btn btn-success btn-block']) ?>

                        </fieldset>
                        <div style="margin-bottom: 40px;"></div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>

        <p class="text-center">
            <?= Html::a(Yii::t('user', 'Already registered? Sign in!'), ['/user/security/login']) ?>
        </p>
    </div>
    <div class="col-md-4 reg-sidebar">
        <div class="reg-sidebar-inner text-center">
            <div class="promo-text-box"><i class=" icon-picture fa fa-4x icon-color-1"></i>

                <h3><strong>Размещайте объявления бесплатно</strong></h3>

                <p> «Аллах разрешил торговлю и запретил ростовщичество – риба» </p>
            </div>
            <div class="promo-text-box"><i class=" icon-pencil-circled fa fa-4x icon-color-2"></i>

                <h3><strong>Создавайте и управляйте Вашими объявлениями</strong></h3>

                <p> «Поистине, Аллах запретил алкоголь и средства, вырученные за нее, мертвое животное и деньги, полученные за него, свинью и деньги, полученные за нее»</p>
            </div>
        </div>
    </div>
</div>
