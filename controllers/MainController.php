<?php

namespace app\controllers;

use app\models\ContactForm;
use Yii;
use yii\web\Controller;
use yii\web\Response;
use app\models\Recipe;
use app\models\User;
use yii\widgets\LinkPager;
use yii\data\Pagination;

class MainController extends Controller
{

    public function actionIndex()
    {
        $model = new ContactForm();
        return $this->render('index', [
            'model' => $model,
        ]);
    }
}
