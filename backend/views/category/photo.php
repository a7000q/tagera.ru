<?
use yii\widgets\Pjax;
use kartik\form\ActiveForm;
use kartik\helpers\Html;

$this->registerJsFile('/js/add-photo/script.js', ['depends' => [\backend\assets\AppAsset::className()]]);
?>

<?Pjax::begin(['enablePushState' => false, 'id' => 'pjax-add-photo'])?>
    <?$form = ActiveForm::begin([
        'options' => [
            'data-pjax' => true,
            'enctype'=>'multipart/form-data'
        ],
        'id' => 'add-photo'
    ])?>
        <?if ($model->image):?>
            <table class="table" style="width: 20%;">
                <tr>
                    <td style="width: 90%; text-align: right;">
                        <?=Html::img('@frontendWeb/'.$model->image->file->src, [
                            'style' => 'width: 100%;'
                        ])?>
                    </td>
                    <td style="width: 10%;">
                        <?=Html::a("x", '#',[
                            'style' => 'color: #962A28; font-size: 30px;',
                            'title' => 'Удалить',
                            'class' => 'del-image',
                            'data-id' => $model->image->id
                        ])?>
                    </td>
                </tr>
            </table>
        <?else:?>
            <?=$form->field($model, 'imageFile')->fileInput()?>
            <?=\kartik\helpers\Html::submitInput('Загрузить', ['class' => 'btn btn-success', 'name' => 'add-photo'])?>
        <?endif;?>
    <?ActiveForm::end()?>
<?Pjax::end()?>
