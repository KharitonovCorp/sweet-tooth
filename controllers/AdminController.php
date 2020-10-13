<?php

namespace app\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Article;
use app\models\Recipe;
use app\models\News;
class AdminController extends Controller
{
    public function actionIndex()
    {
        $news = News::find()->select('id, post_type,date_created')->orderBy(['date_created' => SORT_DESC])->all();
        $recipe = Recipe::find()->select('id, post_type,date_created')->orderBy(['date_created' => SORT_DESC])->all();
        $article = Article::find()->select('id, post_type,date_created')->orderBy(['date_created' => SORT_DESC])->all();

        $temp_posts = array_merge($news, $recipe, $article);
        $posts = array();
        foreach($temp_posts as $post){
            $temp = array(
                'id' => $post->id,
                'post_type' => $post->post_type,
                'date_created' => $post->date_created,
            );
            //$temp = (object) $temp;
            array_push($posts, $temp);
        }
        $posts = $this->array_multisort_value($posts, 'date_created', SORT_DESC);


        foreach($posts as $key=>$value){

            $posts[$key] = (object) $value;

        }

        $posts = (object) $posts;

        return $this->render('index', [
            'posts' => $posts,
        ]);
    }

    public function array_multisort_value()
    {
        $args = func_get_args();
        $data = array_shift($args);
        foreach ($args as $n => $field) {
            if (is_string($field)) {
                $tmp = array();
                foreach ($data as $key => $row) {
                    $tmp[$key] = $row[$field];
                }
                $args[$n] = $tmp;
            }
        }
        $args[] = &$data;
        call_user_func_array('array_multisort', $args);
        return array_pop($args);
    }
}

