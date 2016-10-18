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
use yii\widgets\ActiveForm;

/*
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var dektrium\user\models\RecoveryForm $model
 */

$this->title = Yii::t('user', 'Recover your password');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-sm-5 login-box">
        <div class="panel panel-default">
            <div class="panel-intro text-center">
                <h2 class="logo-title">
                    <span class="logo-icon"><i class="icon icon-search-1 ln-shadow-logo shape-0"></i> </span> VSE<span>HALAL </span>
                </h2>
            </div>
            <div class="panel-body">
                <?php $form = ActiveForm::begin([
                    'id'                     => 'password-recovery-form',
                    'enableAjaxValidation'   => true,
                    'enableClientValidation' => false,
                ]); ?>

                <?= $form->field($model, 'email',  [
                    'inputOptions' => [
                        'class' => 'form-control',
                        'tabindex' => '2',
                        'id' => "user-email",
                        'placeholder' => 'Email'
                    ],
                    'template' => '<div class="input-icon"><i class="icon-user fa"></i>{input}{error}</div>'
                ])->textInput(['autofocus' => true]) ?>

                <?= Html::submitButton("Отправить мне мой пароль", ['class' => 'btn btn-primary btn-block']) ?><br>

                <?php ActiveForm::end(); ?>
            </div>
            <div class="panel-footer">
                <p class="text-center "><a href="<?=\yii\helpers\Url::toRoute(['security/login'])?>"> Назад к авторизации </a></p>

                <div style=" clear:both"></div>
            </div>
        </div>
    </div>
</div>
