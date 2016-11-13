<?php
/**
 * Created by PhpStorm.
 * User: Раиль
 * Date: 10.11.2016
 * Time: 9:38
 */

namespace frontend\controllers;


use frontend\models\ads\Ads;
use frontend\models\ads\AdsSearch;
use frontend\models\category\Category;
use yii\web\Controller;
use Yii;
use yii\web\NotFoundHttpException;

class CategoryController extends Controller
{
    public $layout = 'main-index';

    public function actionIndex()
    {
        $get = Yii::$app->request->get();
        $model = new AdsSearch();
        $model->loadGet($get);

        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            $model->loadButton(Yii::$app->request->post());

            if ($model->validate())
            {
                $this->redirect($model->getUrlForm());
            }
        }

        $model->search();

        return $this->render('index', ['model' => $model]);
    }

    public function actionItem($category_slug, $item_slug)
    {
        $model = $this->findItemBySlug($category_slug, $item_slug);
        return $this->render('item',  ['model' => $model]);
    }

    private function findItemBySlug($category_slug, $item_slug)
    {
        $product = Ads::findOne(['slug' => $item_slug]);

        if ($product && $product->category->slug == $category_slug)
            return $product;
        else
            throw new NotFoundHttpException('Данной страницы не существует!');
    }

}