<?php

namespace frontend\controllers;

use frontend\models\ads\AddFormAds;
use frontend\models\ads\Ads;
use frontend\models\ads\AdsImages;
use frontend\models\ads\UpdateFormAds;
use frontend\models\category\Category;
use kartik\helpers\Html;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use Yii;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;



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
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
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
                return $this->render('success');
            }

            if ($model->errors)
            {
                Yii::$app->getSession()->setFlash('danger', $this->constructError($model->errors));
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

    public function actionDelete($id)
    {
        $product = $this->findProduct($id);
        $product->delete();

        $this->redirect(['/user/settings/ads']);
    }

    public function actionUpdate($id)
    {
        $product = $this->findProduct($id);
        $model = UpdateFormAds::findOne($id);

        $post = Yii::$app->request->post();
        if (isset($post['add-image']))
        {
            $model->image = UploadedFile::getInstance($model, "image");
            $model->saveImage();
        }

        if (isset($post["save-btn"]))
        {
            $model->load($post);
            $model->loadFields($post);

            if ($model->validate()) {
                $model->save();
                Yii::$app->getSession()->setFlash('success',
                    "Альхамдулиллях! Ваше объявление сохранено. В ближайшее время мы перепроверим Ваше объявление и добавим его на сайт!"
                );
                $model->recheck();
                return $this->redirect(['user/settings/ads']);
            }
        }

        return $this->render('update', ['product' => $product, 'model' => $model]);
    }

    public function actionDelImage()
    {
        $post = Yii::$app->request->post();
        $id = ArrayHelper::getValue($post, 'id');
        $image = AdsImages::findOne($id);
        $this->findProduct($image->id_product);

        if ($image) {
            $image->delete();
            return "success";
        }

        return "success";
    }

    private function findProduct($id)
    {
        $product = Ads::find()->where(['id' => $id])->andWhere(['id_user' => Yii::$app->user->id])->one();

        if ($product)
            return $product;
        else
            throw new NotFoundHttpException('Ошибочка! Вам сюда нельзя или данной страницы не существует.');
    }

    private function constructError($errors)
    {
        foreach ($errors as $error)
            $err[] = $error[0];

        $txt = Html::ul($err);

        return $txt;
    }

}