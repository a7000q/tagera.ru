<?
use yii\widgets\Breadcrumbs;
use frontend\assets\SliderAsset;

$this->title = $model->name;
SliderAsset::register($this);

?>
<div class="main-container">
    <div class="container">
        <?=Breadcrumbs::widget([
            'itemTemplate' => "<li>{link}</li>\n", // template for all links
            'links' => $model->breadcrumbs,
            'options' => [
                'class' => 'breadcrumb pull-left'
            ],
            'tag' => 'ol',
            'homeLink' => [
                'label' => '<i class="icon-home fa"></i>',
                'encode' => false,
                'url' => '/'
            ]
        ]);?>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-9 page-content col-thin-right">
                <div class="inner inner-box ads-details-wrapper">
                    <h2> <?=$model->name?>
                    </h2>
                    <span class="info-row"> <span class="date"><i class=" icon-clock"> </i> <?=$model->dateText?> </span> - <span
                            class="category"><?=$model->category->name?> </span>- <span class="item-location"><i
                                class="fa fa-map-marker"></i> <?=$model->city->name?> </span> </span>

                    <div class="ads-image">
                        <h1 class="pricetag"> <?=$model->price?>₽</h1>
                        <ul class="bxslider">
                            <?if ($model->images):?>
                                <?foreach ($model->images as $image):?>
                                    <li><img src="/<?=$image->image->src?>"/></li>
                                <?endforeach;?>
                            <?else:?>
                                <li><img src="/<?=$model->generalImageSrc?>"/></li>
                            <?endif;?>
                        </ul>
                        <div id="bx-pager">
                            <?if ($model->images && count($model->images) > 1):?>
                                <?$i = 0;?>
                                <?foreach ($model->images as $image):?>
                                    <a class="thumb-item-link" data-slide-index="<?=$i;?>" href=""><img
                                            src="/<?=$image->image->src?>"/></a>
                                    <?$i++;?>
                                <?endforeach;?>
                            <?endif;?>
                        </div>
                    </div>
                    <!--ads-image-->

                    <div class="Ads-Details">
                        <h5 class="list-title"><strong>Описание</strong></h5>

                        <div class="row">
                            <div class="ads-details-info col-md-8">
                                <?=$model->description?>
                            </div>
                            <div class="col-md-4">
                                <aside class="panel panel-body panel-details">
                                    <ul>
                                        <li>
                                            <p class=" no-margin "><strong>Цена:</strong> <?=$model->price?>₽</p>
                                        </li>
                                        <li>
                                            <p class="no-margin"><strong>Город:</strong> <?=$model->city->name?> </p>
                                        </li>
                                       <?foreach ($model->fields as $field):?>
                                           <?if ($field->visibleValue):?>
                                               <li>
                                                   <p class="no-margin"><strong><?=$field->field->name?>:</strong> <?=$field->visibleValue?> </p>
                                               </li>
                                           <?endif;?>
                                       <?endforeach;?>
                                    </ul>
                                </aside>
                                <div class="ads-action">

                                </div>
                            </div>
                        </div>
                        <div class="content-footer text-left">
                        </div>
                    </div>
                </div>
                <!--/.ads-details-wrapper-->

            </div>
            <!--/.page-content-->

            <div class="col-sm-3  page-sidebar-right">
                <aside>
                    <div class="panel sidebar-panel panel-contact-seller">
                        <div class="panel-heading">Контакты</div>
                        <div class="panel-content user-info">
                            <div class="panel-body text-center">
                                <div class="seller-info">
                                    <h3 class="no-margin"><?=$model->username?></h3>

                                    <p>Город: <strong><?=$model->city->name?></strong></p>

                                    <p> Создано: <strong><?=$model->dateText?></strong></p>
                                </div>
                                <div class="user-ads-action"> <a
                                        class="btn  btn-info btn-block"><i class=" icon-phone-1"></i> <?=$model->phone?>
                                    </a></div>
                            </div>
                        </div>
                    </div>
                    <div class="panel sidebar-panel">
                        <div class="panel-heading">
                            Советы по безопасности для покупателей</div>
                        <div class="panel-content">
                            <div class="panel-body text-left">
                                <ul class="list-check">
                                    <li> Платите только после получения товара или услуги</li>
                                    <li> Максимально проверяйте предложение</li>
                                    <li> Увидели харам на сайте. Сообщите нам!</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!--/.categories-list-->
                </aside>
            </div>
            <!--/.page-side-bar-->
        </div>
    </div>
</div>
<!-- /.main-container -->