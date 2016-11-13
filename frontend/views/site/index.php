<?php

/* @var $this yii\web\View */

$this->title = 'Сайт бесплатных объявлений для мусульман';
use yii\helpers\ArrayHelper;
use kartik\helpers\Html;
use frontend\assets\CarouselAsset;

CarouselAsset::register($this);
?>

<div class="intro" style="background-image: url('/theme/images/bg3.jpg');">
    <div class="dtable hw100">
        <div class="dtable-cell hw100">
            <div class="container text-center">
                <h1 class="intro-title animated fadeInDown"> Объявления для мусульман </h1>

                <p class="sub animateme fittext3 animated fadeIn">Мы стараемся, чтобы вы нашли, иншаАллах!</p>

                <div class="row search-row animated fadeInUp">
                    <form action="<?=\yii\helpers\Url::toRoute(['/category'])?>" method="get">
                        <div class="col-lg-5 col-sm-5 search-col relative locationicon">
                            <i class="icon-location-2 icon-append"></i>
                            <?=Html::button(Yii::$app->geo->cityName, [
                                'class' => 'form-control locinput input-rel searchtag-input has-icon',
                                'onclick' => 'showModal();',
                                'style' => 'text-align: left;'
                            ])?>

                        </div>
                        <div class="col-lg-6 col-sm-6 search-col relative"><i class="icon-docs icon-append"></i>
                            <input type="text" name="search" class="form-control has-icon"
                                   placeholder="Введите, что Вас интересует..." value="">
                        </div>
                        <div class="col-lg-1 col-sm-1 search-col">
                            <button class="btn btn-primary btn-search btn-block" type="submit"><i
                                    class="icon-search"></i><strong>&nbsp;</strong></button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="main-container">
    <div class="container">
        <div class="col-lg-12 content-box ">
            <div class="row row-featured row-featured-category">
                <div class="col-lg-12  box-title no-border">
                    <div class="inner"><h2><span>Поиск по</span>
                            Категориям </h2>
                    </div>
                </div>

                <?foreach ($categoryes as $category):?>
                    <div class="col-lg-2 col-md-3 col-sm-3 col-xs-4 f-category">
                        <a href="#"><img src="<?=ArrayHelper::getValue($category, 'image.file.src')?>" class="img-responsive" alt="<?=$category->name?>">
                            <h6> <?=$category->name?> </h6></a>
                    </div>
                <?endforeach;?>




            </div>


        </div>

        <?if ($items):?>
            <div class="col-lg-12 content-box ">
                <div class="row row-featured">
                    <div class="col-lg-12  box-title ">
                        <div class="inner"><h2><span>Последние </span>
                                объявления</h2>


                        </div>
                    </div>

                    <div style="clear: both"></div>

                        <div class=" relative  content featured-list-row clearfix">
                            <nav class="slider-nav has-white-bg nav-narrow-svg">
                                <a class="prev">
                                    <span class="nav-icon-wrap"></span>

                                </a>
                                <a class="next">
                                    <span class="nav-icon-wrap"></span>
                                </a>
                            </nav>
                            <div class="no-margin featured-list-slider ">
                                <?foreach ($items as $item):?>
                                        <div class="item">
                                            <a href="<?=$item->urlProduct?>">
                                             <span class="item-carousel-thumb" style="height: 90px;">
                                                <img class="img-responsive" src="/<?=$item->generalImageSrc?>" alt="img">
                                             </span>
                                            <span class="item-name"> <?=$item->name?> </span>
                                            <span class="price">  <?=$item->price?>₽</span>
                                            </a>
                                        </div>
                                <?endforeach;?>
                            </div>
                        </div>
                </div>
            </div>
        <?endif;?>
    </div>
</div>

<div class="page-info hasOverly" style="background: url(/theme/images/bg.jpg); background-size:cover">
    <div class="bg-overly">
        <div class="container text-center section-promo">
            <div class="row">
                <div class="col-sm-3 col-xs-6 col-xxs-12">
                    <div class="iconbox-wrap">
                        <div class="iconbox">
                            <div class="iconbox-wrap-icon">
                                <i class="icon  icon-group"></i>
                            </div>
                            <div class="iconbox-wrap-content">
                                <h5><span><?=\frontend\models\user\User::countUsers()?></span></h5>

                                <div class="iconbox-wrap-text">Продавцев</div>
                            </div>
                        </div>
                        <!-- /..iconbox -->
                    </div>
                    <!--/.iconbox-wrap-->
                </div>

                <div class="col-sm-3 col-xs-6 col-xxs-12">
                    <div class="iconbox-wrap">
                        <div class="iconbox">
                            <div class="iconbox-wrap-icon">
                                <i class="icon  icon-th-large-1"></i>
                            </div>
                            <div class="iconbox-wrap-content">
                                <h5><span><?=\frontend\models\category\Category::find()->count()?></span></h5>

                                <div class="iconbox-wrap-text">Категорий</div>
                            </div>
                        </div>
                        <!-- /..iconbox -->
                    </div>
                    <!--/.iconbox-wrap-->
                </div>

                <div class="col-sm-3 col-xs-6  col-xxs-12">
                    <div class="iconbox-wrap">
                        <div class="iconbox">
                            <div class="iconbox-wrap-icon">
                                <i class="icon  icon-map"></i>
                            </div>
                            <div class="iconbox-wrap-content">
                                <h5><span><?=\common\models\geo\City::find()->count()?></span></h5>

                                <div class="iconbox-wrap-text">Городов</div>
                            </div>
                        </div>
                        <!-- /..iconbox -->
                    </div>
                    <!--/.iconbox-wrap-->
                </div>

                <div class="col-sm-3 col-xs-6 col-xxs-12">
                    <div class="iconbox-wrap">
                        <div class="iconbox">
                            <div class="iconbox-wrap-icon">
                                <i class="icon icon-docs"></i>
                            </div>
                            <div class="iconbox-wrap-content">
                                <h5><span><?=\frontend\models\ads\Ads::find()->where(['status' => 10])->count()?></span></h5>

                                <div class="iconbox-wrap-text"> Объявлений</div>
                            </div>
                        </div>
                        <!-- /..iconbox -->
                    </div>
                    <!--/.iconbox-wrap-->
                </div>

            </div>

        </div>
    </div>
</div>
<!-- /.page-info -->

<div class="page-bottom-info">
    <div class="page-bottom-info-inner">

        <div class="page-bottom-info-content text-center">
            <h1>
                Если у Вас возникли вопросы или предложения, напишите нам на a7000q@gmail.com
            </h1>
        </div>

    </div>
</div>
