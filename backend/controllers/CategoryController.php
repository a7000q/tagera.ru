<?php

namespace backend\controllers;

use Yii;
use backend\models\category\Category;
use backend\models\category\PropertyField;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use kartik\grid\EditableColumnAction;
use yii\helpers\Json;
use yii\helpers\Html;
use yii\web\UploadedFile;
use backend\models\category\CategoryImage;

class CategoryController extends CController
{
    public function behaviors()
    {
        $parent = parent::behaviors();
        return ArrayHelper::merge($parent,[
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    'view-delete' => ['POST']
                ],
            ],
        ]);
    }

    public function actions()
    {
        return ArrayHelper::merge(parent::actions(), [
            'editrecord' => [    
                'class' => EditableColumnAction::className(),
                'modelClass' => Category::className(),
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

    public function actionIndex()
    {
        $query = Category::find()->where(['id_parent' => null])->orderBy('sort');
        $dataProvider = new ActiveDataProvider(['query' => $query]);
        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);

        $post = Yii::$app->request->post();
        if (isset($post['create-field']))
            PropertyField::newProperty($id);

        if (isset($post['create-category']))
            Category::newCategory($id);

        if (Yii::$app->request->isAjax && isset($post['kvdelete'])) {
            $model = $this->findModel($post['id']);
            echo Json::encode([
                'success' => true,
                'messages' => [
                    'kv-detail-info' => 'Запись удалена.' .
                        Html::a('<i class="glyphicon glyphicon-hand-right"></i>  Перейти в родительскую категорию.',
                            ($model->id_parent)?['/category/view', 'id' => $model->id_parent]:['/category/index'], ['class' => 'btn btn-sm btn-info'])
                ]
            ]);
            $model->delete();
            return;
        }

        if ($model->load($post) && $model->save()) 
            Yii::$app->session->setFlash('kv-detail-success', 'Запись сохранена');

        if (isset($post['add-photo']))
        {
            $model->imageFile = UploadedFile::getInstance($model, "imageFile");
            $model->saveImageFile();

            return $this->renderAjax('photo', ['model' => $model]);
        }
        
        return $this->render('view', ['model' => $model]);
    }

    /**
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id = null)
    {
        $model = new Category();
        $parent = Category::findOne($id);
        if ($parent)
            $model->id_parent = $id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model, 'parent' => $parent
            ]);
        }
    }

    /**
     * Updates an existing Category model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Category model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $id_parent = $model->id;
        $model->delete();

        if (Yii::$app->getRequest()->isAjax) {
            $dataProvider = new ActiveDataProvider([
                'query' => Category::find()->where(['id_parent' => $id_parent]),
                'sort' => false
            ]);
            return $this->render('child-category', [
                'dataProvider' => $dataProvider
            ]);
        }

        return $this->redirect(['index']);
    }

    public function actionViewDelete($id)
    {
        $model = $this->findModel($id);
        $id_category = $model->id_parent;
        $model->delete();

        return $this->redirect(['category/view', 'id' => $id_category]);
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
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionDelImage()
    {
        $post = Yii::$app->request->post();
        $id = ArrayHelper::getValue($post, 'id');
        $image = CategoryImage::findOne($id);

        if ($image)
        {
            $image->delete();
            return "success";
        }
    }
}
