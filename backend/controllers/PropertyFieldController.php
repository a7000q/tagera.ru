<?php

namespace backend\controllers;

use backend\models\category\SelectField;
use yii\helpers\ArrayHelper;
use backend\models\category\PropertyField;
use kartik\grid\EditableColumnAction;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii;
use yii\data\ActiveDataProvider;
use yii\helpers\Json;
use yii\helpers\Html;

class PropertyFieldController extends CController
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
            'editrecord' => [                                       // identifier for your editable column action
                'class' => EditableColumnAction::className(),     // action class name
                'modelClass' => PropertyField::className(),                // the model for the record being edited
                'outputValue' => function ($model, $attribute, $key, $index) {
                    switch ($attribute)
                    {
                        case "id_type":
                            $result = ArrayHelper::getValue($model, "typeField.name");
                            break;
                        default:
                            $result = $model->$attribute;
                            break;
                    }

                    return  $result;
                },
                'outputMessage' => function($model, $attribute, $key, $index) {
                    return '';                                  // any custom error to return after model save
                },
                'showModelErrors' => true,                        // show model validation errors after save
                'errorOptions' => ['header' => ''],             // error summary HTML options
                // 'postOnly' => true,
                // 'ajaxOnly' => true,
                // 'findModel' => function($id, $action) {},
                'checkAccess' => function($action, $model) {return 123;}
            ]
        ]);
    }


    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $id_category = $model->id_category;
        $model->delete();

        if (Yii::$app->getRequest()->isAjax) {
            $dataProvider = new ActiveDataProvider([
                'query' => PropertyField::find()->where(['id_category' => $id_category]),
                'sort' => false
            ]);
            return $this->render('fields', [
                'dataProvider' => $dataProvider
            ]);
        }

        return $this->redirect(['category/view', 'id' => $id_category]);
    }

    public function actionIndex($id)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => PropertyField::find()->where(['id_category' => $id]),
            'sort' => false
        ]);
        return $this->renderAjax('fields', [
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);
        $post = Yii::$app->request->post();
        if (Yii::$app->request->isAjax && isset($post['kvdelete'])) {
            $model = $this->findModel($post['id']);
            echo Json::encode([
                'success' => true,
                'messages' => [
                    'kv-detail-info' => 'Запись удалена.' .
                        Html::a('<i class="glyphicon glyphicon-hand-right"></i>  Перейти в родительскую категорию.',
                            ['/category/view', 'id' => $model->id_category], ['class' => 'btn btn-sm btn-info'])
                ]
            ]);
            $model->delete();
            return;
        }

        if (isset($post['create-select-value']))
            SelectField::newSelecValue($model->id);

        if ($model->load($post) && $model->save())
            Yii::$app->session->setFlash('kv-detail-success', 'Запись сохранена');

        $items = array();

        if ($model->selectValuesDataProvider)
            $items[] = [
                'label' => 'Значения',
                'content' => $this->renderPartial('@backend/views/select-field/index.php', ['dataProvider' => $model->selectValuesDataProvider])
            ];

        return $this->render('view', ['model' => $model, 'items' => $items]);
    }

    protected function findModel($id)
    {
        if (($model = PropertyField::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
