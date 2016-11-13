<?
use yii\helpers\Url;
?>
<li>
    <div class="category-list-table">
        <div class="category-list-name">
            <a href="#"><span class="title"><strong><?=$model->categoryObject->parent->name?></strong></span><span
                    class="count">&nbsp;</span>
            </a>
        </div>
        <div class="category-list-count">
            <span class="count">&nbsp;<?=$model->categoryObject->parent->getCountProducts($model->_dataProvider->query)?></span>
        </div>
    </div>
    <ul class=" list-unstyled long-list">
        <?foreach ($model->categoryObject->parent->childrens as $category):?>
            <li>
                <div class="category-list-table">
                    <div class="category-list-name">
                        <a href="<?=$model->getUrlForm($category->slug)?>">
                            <span class="title <?=($category->id == $model->categoryObject->id)?"category-bold":""?>"><?=$category->name?></span>
                        </a>
                    </div>
                    <div class="category-list-count">
                        <span class="count"><?=$category->getCountProducts($model->_dataProvider->query)?></span>
                    </div>
                </div>
            </li>
        <?endforeach;?>

    </ul>
</li>