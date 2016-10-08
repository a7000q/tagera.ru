<?php

namespace backend\controllers;

use common\models\category\SSelectFieldValue;
use yii;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\category\SelectField;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use backend\models\category\PropertyField;
use kartik\grid\EditableColumnAction;

class SelectFieldController extends CController
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return ArrayHelper::merge(parent::actions(), [
            'editrecord' => [
                'class' => EditableColumnAction::className(),
                'modelClass' => SelectField::className(),
                'outputValue' => function ($model, $attribute, $key, $index) {
                    return  $model->$attribute;
                },
                'outputMessage' => function($model, $attribute, $key, $index) {
                    return '';
                },
                'showModelErrors' => true,
                'errorOptions' => ['header' => ''],
            ]
        ]);
    }
    
    public function actionIndex($id = null)
    {
        $post = Yii::$app->request->post();

        if ($id == null)
            $id = ArrayHelper::getValue($post, "expandRowKey");

        if ($id == null)
            $id = ArrayHelper::getValue($post, "id_field");

        $field = PropertyField::findOne($id);
        Yii::$app->response->getHeaders()->set('X-PJAX-Url',Url::to(['category/view', 'id' => ArrayHelper::getValue($field, "id_category")]));

        if (isset($post["create-select-value"]))
        {
            $session = Yii::$app->session;

            if ((isset($session["last_date_select_value"]) and ($session["last_date_select_value"] + 2 < time())) or (!isset($session["last_date_select_value"])))
            {
                $selectFieldValue = new SelectField();
                $selectFieldValue->id_field = $id;
                $selectFieldValue->save();

                $session["last_date_select_value"] = time();
            }
        }

        $query = SelectField::find()->where(['id_field' => $id])->orderBy("value");

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->renderPartial('index', [
            'dataProvider' => $dataProvider, 'id_field' => $id
        ]);
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $field = PropertyField::findOne($model->id_field);
        $model->delete();

        if (Yii::$app->getRequest()->isAjax) {
            return $this->render('index', [
                'dataProvider' => $field->selectValuesDataProvider
            ]);
        }
    }

    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SelectField::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
