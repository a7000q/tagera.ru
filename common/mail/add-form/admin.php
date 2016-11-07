<div>
    <b>Название: </b> <?=$product->name?>
</div>
<div>
    <b>Текст: </b> <?=$product->description?>
</div>
<div>
    <b>Поля: </b><br>
    <ul>
        <?foreach ($product->fields as $field):?>
            <li><b><?=$field->field->name?></b> <?=$field->visibleValue?></li>
        <?endforeach;?>
    </ul>
</div>
<div>
    <b>Фото: </b><br>
    <?foreach ($product->images as $image):?>
        <img src="<?=Yii::getAlias("@frontendWeb")?>/<?=$image->image->src?>">
    <?endforeach;?>
</div>