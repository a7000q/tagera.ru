<?
use yii\helpers\Url;
?>
<?foreach (\frontend\models\category\Category::getGeneralAll() as $category):?>
    <li>
        <a href="<?=$model->getUrlForm($category->slug)?>">
            <span class="title"><?=$category->name?></span>
        </a>
    </li>
<?endforeach;?>