<?
use yii\helpers\Url;
?>
<li>
    <a href="#"><span class="title"><strong><?=$model->categoryObject->parent->name?></strong></span><span
            class="count">&nbsp;</span>
    </a>
    <ul class=" list-unstyled long-list">
        <?foreach ($model->categoryObject->parent->childrens as $category):?>
            <li>
                <a href="<?=$model->getUrlForm($category->slug)?>">
                    <span class="title <?=($category->id == $model->categoryObject->id)?"category-bold":""?>"><?=$category->name?></span>
                </a>
            </li>
        <?endforeach;?>

    </ul>
</li>