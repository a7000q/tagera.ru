<?
use kartik\form\ActiveForm;
use frontend\models\category\Category;
use kartik\helpers\Html;
use yii\helpers\Url;
use yii\widgets\MaskedInput;

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
                    <div class="tab-box ">

                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs add-tabs" id="ajaxTabs" role="tablist">
                            <li class="active"><a href="ajax/1.html" data-url="ajax/1.html" role="tab"
                                                  data-toggle="tab">All Ads <span class="badge">228,705</span></a>
                            </li>
                            <li><a href="ajax/2.html" data-url="ajax/2.html" role="tab" data-toggle="tab">Business
                                    <span class="badge">22,805</span></a></li>
                            <li><a href="ajax/3.html" data-url="ajax/3.html" role="tab" data-toggle="tab">Personal
                                    <span class="badge">18,705</span></a></li>
                        </ul>


                        <div class="tab-filter">
                            <select class="selectpicker" data-style="btn-select" data-width="auto">
                                <option>Short by</option>
                                <option>Price: Low to High</option>
                                <option>Price: High to Low</option>
                            </select>
                        </div>
                    </div>
                    <!--/.tab-box-->

                    <div class="listing-filter">
                        <div class="pull-left col-xs-6">
                            <div class="breadcrumb-list"><a href="#" class="current"> <span>All ads</span></a>
                                in

                                <!-- cityName will replace with selected location/area from location modal -->
                                <span class="cityName"> New York </span> <a href="#selectRegion" id="dropdownMenu1"
                                                                            data-toggle="modal"> <span
                                        class="caret"></span> </a></div>
                        </div>
                        <div class="pull-right col-xs-6 text-right listing-view-action"><span
                                class="list-view active"><i class="  icon-th"></i></span> <span
                                class="compact-view"><i class=" icon-th-list  "></i></span> <span
                                class="grid-view "><i class=" icon-th-large "></i></span></div>
                        <div style="clear:both"></div>
                    </div>
                    <!--/.listing-filter-->


                    <!-- Mobile Filter bar-->
                    <div class="mobile-filter-bar col-lg-12  ">
                        <ul class="list-unstyled list-inline no-margin no-padding">
                            <li class="filter-toggle">
                                <a class="">
                                    <i class="  icon-th-list"></i>
                                    Filters
                                </a>
                            </li>
                            <li>


                                <div class="dropdown">
                                    <a data-toggle="dropdown" class="dropdown-toggle"><i class="caret "></i> Short
                                        by </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="" rel="nofollow">Relevance</a></li>
                                        <li><a href="" rel="nofollow">Date</a></li>
                                        <li><a href="" rel="nofollow">Company</a></li>
                                    </ul>
                                </div>

                            </li>
                        </ul>
                    </div>
                    <div class="menu-overly-mask"></div>
                    <!-- Mobile Filter bar End-->

                    <div class="adds-wrapper">
                        <div class="tab-content">
                            <div class="tab-pane active" id="allAds">Loading...</div>
                        </div>
                    </div>
                    <!--/.adds-wrapper-->

                    <div class="tab-box  save-search-bar text-center"><a href=""> <i class=" icon-star-empty"></i>
                            Save Search </a></div>
                </div>
                <div class="pagination-bar text-center">
                    <ul class="pagination">
                        <li class="active"><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li><a href="#"> ...</a></li>
                        <li><a class="pagination-btn" href="#">Next &raquo;</a></li>
                    </ul>
                </div>
                <!--/.pagination-bar -->

                <div class="post-promo text-center">
                    <h2> Do you get anything for sell ? </h2>
                    <h5>Sell your products online FOR FREE. It's easier than you think !</h5>
                    <a href="post-ads.html" class="btn btn-lg btn-border btn-post btn-danger">Post a Free Ad </a>
                </div>
                <!--/.post-promo-->

            </div>
            <!--/.page-content-->

        </div>
    </div>
</div>
<!-- /.main-container -->