<div class="item-list">
    <div class="col-sm-2 no-padding photobox">
        <div class="add-image">
            <?if ($model->countImages):?>
                <span class="photo-count">
                    <i class="fa fa-camera"></i> <?=$model->countImages;?>
                </span>
            <?endif;?>
            <a href="#">
                <img class="thumbnail no-margin" src="/<?=$model->generalImageSrc?>" alt="img">
            </a>
        </div>
    </div>
    <!--/.photobox-->
    <div class="col-sm-7 add-desc-box">
        <div class="add-details">
            <h5 class="add-title"><a href="<?=$model->urlProduct?>">
                    <?=$model->name?> </a></h5>
            <span class="info-row"> <span class="date"><i
                        class=" icon-clock"> </i> <?=$model->dateText?> </span> - <span
                    class="category"><?=$model->category->fullName?> </span>- <span class="item-location"><i
                        class="fa fa-map-marker"></i> <?=$model->city->name?> </span> </span></div>
    </div>
    <!--/.add-desc-box-->
    <div class="col-sm-3 text-right  price-box">
        <h2 class="item-price"><?=$model->price?>₽</h2>
    </div>
    <!--/.add-desc-box-->
</div>
<!--/.item-list-->