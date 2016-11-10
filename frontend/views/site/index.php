<?php

/* @var $this yii\web\View */

$this->title = 'Сайт бесплатных объявлений для мусульман';
use yii\helpers\ArrayHelper;
use kartik\helpers\Html;
?>

<div class="intro" style="background-image: url('/theme/images/bg3.jpg');">
    <div class="dtable hw100">
        <div class="dtable-cell hw100">
            <div class="container text-center">
                <h1 class="intro-title animated fadeInDown"> Объявления для мусульман </h1>

                <p class="sub animateme fittext3 animated fadeIn">Мы стараемся, чтобы вы нашли, иншаАллах!</p>

                <div class="row search-row animated fadeInUp">
                    <div class="col-lg-5 col-sm-5 search-col relative locationicon">
                        <i class="icon-location-2 icon-append"></i>
                        <?=Html::button(Yii::$app->geo->cityName, [
                            'class' => 'form-control locinput input-rel searchtag-input has-icon',
                            'onclick' => 'showModal();',
                            'style' => 'text-align: left;'
                        ])?>

                    </div>
                    <div class="col-lg-6 col-sm-6 search-col relative"><i class="icon-docs icon-append"></i>
                        <input type="text" name="ads" class="form-control has-icon"
                               placeholder="Введите, что Вас интересует..." value="">
                    </div>
                    <div class="col-lg-1 col-sm-1 search-col">
                        <button class="btn btn-primary btn-search btn-block"><i
                                class="icon-search"></i><strong></strong></button>
                    </div>
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
    </div>
</div>
