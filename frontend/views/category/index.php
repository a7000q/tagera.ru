<?
use kartik\form\ActiveForm;
use frontend\models\category\Category;
use kartik\helpers\Html;
use yii\helpers\Url;
use yii\widgets\MaskedInput;
use yii\widgets\ListView;

if (!$model->categoryObject)
    $this->title = "Все категории";
else
    $this->title = 'Категория "'.$model->categoryObject->name.'"';
?>
<div class="search-row-wrapper">
    <div class="container ">
        <?$form = ActiveForm::begin(['method' => 'post'])?>
            <div class="col-sm-8">
                <?=Html::activeTextInput($model, 'search_text', [
                    'class' => 'form-control keyword',
                    'placeholder' => 'Например: Коран'
                ])?>
            </div>
            <div class="col-sm-3">
                <?=\kartik\helpers\Html::button('<i class="icon-location"></i>'.Yii::$app->geo->cityName, [
                    'class' => 'form-control',
                    'onclick' => 'showModal()',
                    'style' => 'text-align: left;'
                ])?>
            </div>
            <div class="col-sm-1">
                <button class="btn btn-block btn-primary  "><i class="fa fa-search"></i></button>
            </div>
        <?ActiveForm::end()?>
    </div>
</div>
<!-- /.search-row -->
<div class="main-container">
    <div class="container">
        <div class="row">
            <!-- this (.mobile-filter-sidebar) part will be position fixed in mobile version -->
            <div class="col-sm-3 page-sidebar mobile-filter-sidebar">
                <aside>
                    <div class="inner-box">
                        <div class="categories-list  list-filter">
                            <h5 class="list-title">
                                <strong>
                                    <?if (!$model->categoryObject):?>
                                        <a href="<?=Url::toRoute(['/category', 'search' => $model->search_text])?>">Все категории</a>
                                    <?elseif (!$model->categoryObject->parent):?>
                                        <a href="<?=Url::toRoute(['/category', 'search' => $model->search_text])?>"><i class="fa fa-angle-left"></i> Все категории</a>
                                    <?elseif (($model->categoryObject->childrens)):?>
                                        <a href="<?=Url::toRoute(['/'.$model->categoryObject->parent->slug, 'search' => $model->search_text])?>"><i class="fa fa-angle-left"></i> <?=$model->categoryObject->parent->name?></a>
                                    <?elseif (!$model->categoryObject->parent->parent):?>
                                        <a href="<?=Url::toRoute(['/category', 'search' => $model->search_text])?>"><i class="fa fa-angle-left"></i> Все категории</a>
                                    <?else:?>
                                        <a href="<?=Url::toRoute(['/'.$model->categoryObject->parent->parent->slug, 'search' => $model->search_text])?>"><i class="fa fa-angle-left"></i> <?=$model->categoryObject->parent->parent->name?></a>
                                    <?endif;?>
                                </strong>
                            </h5>
                            <ul class=" list-unstyled">
                                <?if (!$model->categoryObject):?>
                                    <?=$this->render('category-list', ['model' => $model])?>
                                <?elseif ($model->categoryObject->childrens):?>
                                    <?=$this->render('sub-category-list', ['model' => $model])?>
                                <?else:?>
                                    <?=$this->render('sub-sub-category-list', ['model' => $model])?>
                                <?endif;?>
                            </ul>
                        </div>
                        <!--/.categories-list-->

                        <div class="locations-list  list-filter">
                            <h5 class="list-title"><strong><a href="#">Диапазон цен</a></strong></h5>

                            <?$form = ActiveForm::begin([
                                'fieldConfig' => [
                                    'template' => '{input}'
                                ]
                            ])?>
                                <div class="form-group col-sm-12 no-padding">
                                    <?=$form->field($model, 'p1')->widget(MaskedInput::className(), [
                                        'options' => [
                                            'placeholder' => 'от',
                                            'class' => 'form-control',
                                        ],
                                        'clientOptions' => [
                                            'alias' =>  'decimal',
                                            'groupSeparator' => ' ',
                                            'autoGroup' => true
                                        ]
                                    ])?>
                                </div>

                                <div class="form-group col-sm-12 no-padding">
                                    <?=$form->field($model, 'p2')->widget(MaskedInput::className(), [
                                        'options' => [
                                            'placeholder' => 'до',
                                            'class' => 'form-control',
                                        ],
                                        'clientOptions' => [
                                            'alias' =>  'decimal',
                                            'groupSeparator' => ' ',
                                            'autoGroup' => true
                                        ]
                                    ])?>
                                </div>
                                <div class="form-group col-sm-12 no-padding">
                                    <button class="btn btn-default col-sm-12" type="submit" name="price-ok"><i class="icon-check"></i>
                                        Применить
                                    </button>
                                </div>
                                <div class="form-group col-sm-12 no-padding">
                                    <button class="btn btn-default col-sm-12" type="submit" name="price-reset"><i class="icon-cancel"></i>
                                        Сбросить
                                    </button>
                                </div>


                            <?ActiveForm::end()?>
                            <div style="clear:both"></div>
                        </div>

                        <div style="clear:both"></div>
                    </div>

                    <!--/.categories-list-->
                </aside>
            </div>
            <!--/.page-side-bar-->
            <div class="col-sm-9 page-content col-thin-left">
                <div class="category-list">

                    <div class="adds-wrapper">
                        <div class="tab-box ">

                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs add-tabs" role="tablist">
                                <li class="active"><a href="#allAds" role="tab" data-toggle="tab">Найдено объявлений <span
                                            class="badge"><?=$model->_dataProvider->totalCount?></span></a></li>
                            </ul>
                        </div>
                        <?=ListView::widget([
                            'dataProvider' => $model->_dataProvider,
                            'itemView' => 'category-item',
                            'layout' => "{items}\n<div class='pagination-bar text-center'>{pager}</div>",
                        ])?>
                    </div>
                </div>

                <div class="post-promo text-center">
                    <h2> Хотите что нибудь продать? </h2>
                    <h5>Разместите с БисмиЛлях, Ваше предложение бесплатно!</h5>
                    <a href="<?=Url::toRoute(['/ads/add'])?>" class="btn btn-lg btn-border btn-post btn-danger">Подать объявление </a>
                </div>
                <!--/.post-promo-->

            </div>
            <!--/.page-content-->

        </div>
    </div>
</div>
<!-- /.main-container -->