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

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var dektrium\user\models\Profile $profile
 */

$this->title = Yii::t('user', 'Profile settings');
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('/_alert', ['module' => Yii::$app->getModule('user')]) ?>

<div class="row">
    <div class="col-md-3">
        <?= $this->render('_menu') ?>
    </div>
    <div class="col-md-9">
        <div class="inner-box">
            <h2 class="title-2"><i class="icon-user"></i> <?= Html::encode($this->title) ?> </h2>
            <div class="welcome-msg">
                <h3 class="page-sub-header2 clearfix no-padding">Ассаляму алейкум ва рахматуллахи ва баракатуху, <?=Yii::$app->user->identity->mainUsername?>! </h3>
            </div>
            <?php $form = \yii\widgets\ActiveForm::begin([
                'id' => 'profile-form',
                'options' => ['class' => 'form-horizontal'],
                'fieldConfig' => [
                    'template' => "{label}\n<div class=\"col-lg-9\">{input}</div>\n<div class=\"col-sm-offset-3 col-lg-9\">{error}\n{hint}</div>",
                    'labelOptions' => ['class' => 'col-lg-3 control-label'],
                ],
                'enableAjaxValidation'   => true,
                'enableClientValidation' => false,
                'validateOnBlur'         => false,
            ]); ?>

            <?= $form->field($model, 'name') ?>

            <?= $form->field($model, 'public_email') ?>

            <?= $form->field($model, 'website') ?>

            <?= $form->field($model, 'id_city')->widget(\kartik\select2\Select2::className(), ['data' => \common\models\geo\City::getAllArray()]) ?>

            <?= $form->field($model, 'bio')->textarea() ?>

            <div class="form-group">
                <div class="col-lg-offset-3 col-lg-9">
                    <?= \yii\helpers\Html::submitButton(
                        Yii::t('user', 'Save'),
                        ['class' => 'btn btn-block btn-success']
                    ) ?><br>
                </div>
            </div>

            <?php \yii\widgets\ActiveForm::end(); ?>
        </div>
    </div>
</div>
