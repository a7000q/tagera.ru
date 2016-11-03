<h4><?=$category->name?></h4>
<ul class="category">
    <?foreach ($category->childrens as $cat):?>
        <li data-item="<?=$cat->id?>" class="category-item"><?=$cat->name?></li>
    <?endforeach;?>
</ul>

