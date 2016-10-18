<?
use yii\helpers\Url;
?>
<ul class="nav navbar-nav navbar-right">
    <?if (Yii::$app->user->isGuest):?>
        <li><a href="<?=Url::to(['/user/security/login'])?>">Авторизация</a></li>
        <li><a href="<?=Url::to(['/user/registration/register'])?>">Регистрация</a></li>
    <?else:?>
        <li><a href="<?=Url::to(['/user/security/logout'])?>" data-method="post">Выйти <i class="glyphicon glyphicon-off"></i> </a></li>
        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <span><?=Yii::$app->user->identity->username?></span> <i class="icon-user fa"></i> <i class=" icon-down-open-big fa"></i></a>
            <ul class="dropdown-menu user-menu">
                <li><a href="<?=Url::to(['/user/settings/ads'])?>"><i class="icon-th-thumb"></i> Мои объявления </a></li>
                <li><a href="<?=Url::to(['/user/settings/profile'])?>"><i class="icon-user"></i> Профиль </a>
                </li>
                <li><a href="<?=Url::to(['/user/settings/account'])?>"><i class="icon-key"></i> Аккаунт
                    </a></li>
                <li><a href="<?=Url::to(['/user/settings/networks'])?>"><i class="icon-network"></i> Соцсети
                    </a></li>
            </ul>
        </li>
    <?endif;?>
    <li class="postadd">
        <a class="btn btn-block   btn-border btn-post btn-danger" href="post-ads.html">Подать объявление</a>
    </li>
</ul>