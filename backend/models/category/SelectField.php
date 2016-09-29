<?php

namespace backend\models\category;


class SelectField extends \common\models\category\SSelectFieldValue
{
    static public function newSelecValue($id_field)
    {
        $model = new SelectField();
        $model->id_field = $id_field;
        $model->save();
    }
}