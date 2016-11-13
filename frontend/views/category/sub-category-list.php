<?
use yii\helpers\Url;
?>
<li>
    <div class="category-list-table">
        <div class="category-list-name">
            <a href="#"><span class="title"><strong><?=$model->categoryObject->name?></strong></span><span
                    class="count">&nbsp;</span>
            </a>
        </div>
        <div class="category-list-count">
            <span class="count">&nbsp;<?=$model->categoryObject->getCountProducts($model->_dataProvider->query)?></span>
        </div>
    </div>
    <ul class=" list-unstyled long-list">
        <?foreach ($model->categoryObject->childrens as $category):?>
            <li>
                <div class="category-list-table">
                    <div class="category-list-name">
                        <a href="<?=$model->getUrlForm($category->slug)?>">
                            <span class="title"><?=$category->name?></span>
                        </a>
                    </div>
                    <div class="category-list-count">
                        <span class="count">&nbsp;<?=$category->getCountProducts($model->_dataProvider->query)?></span>
                    </div>
                </div>
            </li>
        <?endforeach;?>

    </ul>
</li>