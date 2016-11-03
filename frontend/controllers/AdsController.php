<?php

namespace frontend\controllers;

use frontend\models\ads\AddFormAds;
use frontend\models\category\Category;
use yii\base\Controller;
use Yii;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use yii\web\UploadedFile;

class AdsController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => [],
                'rules' => [
                    [
                        'actions' => [],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionAdd()
    {
        $model = new AddFormAds();

        $model->setDefaultUser(Yii::$app->user->identity);

        $post = Yii::$app->request->post();
        $model->image1 = UploadedFile::getInstance($model, 'image1');
        $model->image2 = UploadedFile::getInstance($model, 'image2');
        $model->image3 = UploadedFile::getInstance($model, 'image3');
        $model->image4 = UploadedFile::getInstance($model, 'image4');
        $model->image5 = UploadedFile::getInstance($model, 'image5');
        $model->image6 = UploadedFile::getInstance($model, 'image6');

        if (isset($post['AddFormAds']))
        {
            $model->load($post);

            $model->loadFields($post);

            if (isset($post['save-btn']) && $model->validate())
            {
                $model->saveProduct();
                $this->redirect(['settings/ads']);
            }

        }
        return $this->render('add', ['model' => $model]);
    }

    public function actionGetChildren()
    {
        $post = Yii::$app->request->post();
        $id_category = ArrayHelper::getValue($post, "id_category");

        $category = Category::findOne($id_category);

        if (!$category->childrens)
            return "true";

        return $this->renderPartial('children-category', ['category' => $category]);
    }
}