<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use dektrium\user\widgets\Connect;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View                   $this
 * @var dektrium\user\models\LoginForm $model
 * @var dektrium\user\Module           $module
 */

$this->title = Yii::t('user', 'Sign in');
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('/_alert', ['module' => Yii::$app->getModule('user')]) ?>

<div class="row">
    <div class="col-sm-5 login-box">
        <div class="panel panel-default">
            <div class="panel-intro text-center">
                <h2 class="logo-title">
                    <span class="logo-icon"><i class="icon icon-search-1 ln-shadow-logo shape-0"></i> </span> VSE<span>HALAL </span>
                </h2>
            </div>
            <?php $form = ActiveForm::begin([
                'id'                     => 'login-form',
                'enableAjaxValidation'   => true,
                'enableClientValidation' => false,
                'validateOnBlur'         => false,
                'validateOnType'         => false,
                'validateOnChange'       => false,
                'options' => [
                    'role' => 'form'
                ]
            ]) ?>
                <div class="panel-body">


                    <?= $form->field(
                        $model,
                        'login',
                        [
                            'inputOptions' => [
                                'autofocus' => 'autofocus',
                                'class' => 'form-control email',
                                'tabindex' => '1',
                                'id' => 'sender-email',
                                'placeholder' => 'Логин'
                            ],
                            'template' => '<div class="input-icon"><i class="icon-user fa"></i>{input}{error}</div>'
                        ]
                    ) ?>

                    <?= $form
                        ->field(
                            $model,
                            'password',
                            [
                                'inputOptions' => [
                                    'class' => 'form-control',
                                    'tabindex' => '2',
                                    'id' => "user-pass",
                                    'placeholder' => 'Пароль'
                                ],
                                'template' => '<div class="input-icon"><i class="icon-lock fa"></i>{input}{error}</div>'
                            ]
                        )
                        ->passwordInput()
                    ?>

                    <?= Html::submitButton(
                        Yii::t('user', 'Sign in'),
                        ['class' => 'btn btn-primary btn-block', 'tabindex' => '3']
                    ) ?>

                </div>
                <div class="panel-footer">

                    <?= $form->field($model, 'rememberMe', ['options' => ['class' => 'checkbox pull-left']])->checkbox(['tabindex' => '4']) ?>

                    <p class="text-center pull-right">
                        <?=($module->enablePasswordRecovery) ? Html::a(Yii::t('user', 'Forgot password?'), ['/user/recovery/request'], ['tabindex' => '5']) : ''?>
                    </p>
                    <div style=" clear:both"></div>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
        <?php if ($module->enableConfirmation): ?>
            <p class="text-center">
                <?= Html::a(Yii::t('user', 'Didn\'t receive confirmation message?'), ['/user/registration/resend']) ?>
            </p>
        <?php endif ?>
        <?php if ($module->enableRegistration): ?>
            <p class="text-center">
                <?= Html::a(Yii::t('user', 'Don\'t have an account? Sign up!'), ['/user/registration/register']) ?>
            </p>
        <?php endif ?>
        <?= Connect::widget([
            'baseAuthUrl' => ['/user/security/auth'],
        ]) ?>
    </div>
</div>
