<?
$this->registerJsFile('/js/add-ads/script.js',  ['position' => yii\web\View::POS_END, 'depends' => \frontend\assets\AppAsset::className()]);
$data_item = 1;
?>

<div class="category-general">
    <div class="category-block" data-item="<?=$data_item?>">
        <h4>Категория</h4>
        <ul class="category">
            <?foreach ($model->getCategoryArray() as $id_category => $name):?>
                <?
                    $active_item = "";
                    if ($model->categoryChain and $model->categoryChain[0] == $id_category)
                        $active_item = 'active-item';
                ?>
                <li data-item="<?=$id_category?>" class="category-item <?=$active_item?>"><?=$name?></li>
            <?endforeach;?>
        </ul>
        <?$data_item++;?>
    </div>
    <?if ($model->categoryChain):?>
        <?foreach ($model->categoryChain as $id_category):?>
            <?
                $category = \frontend\models\category\Category::findOne($id_category);
                $category_array = \yii\helpers\ArrayHelper::map($category->childrens, 'id', 'name');
            ?>
            <?if (count($category_array) != 0):?>
                <div class="category-block" data-item="<?=$data_item;?>">
                    <h4><?=$category->name?></h4>
                    <ul class="category">
                        <?foreach ($category_array as $id_category_child => $name):?>
                            <?
                            $active_item = "";
                            if ($model->categoryChain and $model->categoryChain[$data_item - 1] == $id_category_child)
                                $active_item = 'active-item';
                            ?>
                            <li data-item="<?=$id_category_child?>" class="category-item <?=$active_item?>"><?=$name?></li>
                        <?endforeach;?>
                    </ul>
                    <?$data_item++;?>
                </div>
            <?endif;?>
        <?endforeach;?>
    <?endif;?>
</div>


<style>
    .category-block{
        border: 1px solid #e6e6e6;
        padding: 0;
        height: 100%;
        display: inline-table;
        width: 20%;
        border-left: 0;
    }

    .category-block:first-child{
        border-left: 1px solid #e6e6e6;
    }

    .category-block h4{
        font-weight: bold;
        margin: 10px;
    }

    .category li{
        display: block;
        width: 100%;
        padding: 10px;
        padding-top: 5px;
        padding-bottom: 5px;
    }

    .category li:hover{
        background: #e3f4f1;
        cursor: pointer;
    }

    .active-item{
        background: rgb(22,160,133);
    }

    .category-general{
        width: 100%;
        margin-bottom: 20px;
        display: table;
        border-collapse: collapse;
        table-layout:fixed;
    }

    .modal-lg{
        width: 90%;
    }


</style>

