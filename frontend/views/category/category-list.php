<?
use yii\helpers\Url;
?>
<?foreach (\frontend\models\category\Category::getGeneralAll() as $category):?>
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