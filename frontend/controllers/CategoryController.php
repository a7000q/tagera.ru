<?php
/**
 * Created by PhpStorm.
 * User: Раиль
 * Date: 10.11.2016
 * Time: 9:38
 */

namespace frontend\controllers;


use frontend\models\ads\AdsSearch;
use frontend\models\category\Category;
use yii\web\Controller;
use Yii;

class CategoryController extends Controller
{
    public $layout = 'main-index';

    public function actionIndex($slug = null, $search = null, $p1 = null, $p2 = null)
    {
        $model = new AdsSearch([
            'category_slug' => $slug,
            'search_text' => $search,
            'p1' => $p1,
            'p2' => $p2
        ]);

        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            $model->loadButton(Yii::$app->request->post());

            if ($model->validate())
            {
                $this->redirect($model->getUrlForm());
            }

            $model->search();
        }

        return $this->render('index', ['model' => $model]);
    }

}