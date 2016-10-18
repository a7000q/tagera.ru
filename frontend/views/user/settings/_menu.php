<?php
use yii\helpers\Html;
use yii\widgets\Menu;
use yii\helpers\Url;

$user = Yii::$app->user->identity;
$networksVisible = count(Yii::$app->authClientCollection->clients) > 0;

?>
<aside>
    <div class="inner-box">
        <div class="user-panel-sidebar">
            <div class="collapse-box">
                <h5 class="collapse-title no-border"> Объявления <a class="pull-right" data-toggle="collapse" href="#Ads"><i class="fa fa-angle-down"></i></a></h5>
                <div id="Ads" class="panel-collapse collapse in">
                    <?= Menu::widget([
                        'options' => [
                            'class' => 'acc-list',
                        ],
                        'encodeLabels' => false,
                        'items' => [
                            ['label' => '<i class="icon-th-thumb"></i> Мои объявления', 'url' => ['/user/settings/ads']],
                        ],
                    ]) ?>
                </div>
            </div>
            <div class="collapse-box">
                <h5 class="collapse-title"> Личные данные <a class="pull-right" data-toggle="collapse" href="#user-profile"><i class="fa fa-angle-down"></i></a></h5>
                <div id="user-profile" class="panel-collapse collapse in">
                    <?= Menu::widget([
                        'options' => [
                            'class' => 'acc-list',
                        ],
                        'encodeLabels' => false,
                        'items' => [
                            ['label' => '<i class="icon-user"></i>'.Yii::t('user', 'Profile'), 'url' => ['/user/settings/profile']],
                            ['label' => '<i class="icon-key"></i>'.Yii::t('user', 'Account'), 'url' => ['/user/settings/account']],
                            [
                                'label' => '<i class="icon-network"></i>'.Yii::t('user', 'Networks'),
                                'url' => ['/user/settings/networks'],
                                'visible' => $networksVisible
                            ],
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</aside>
