<?php

namespace app\controllers;


use Yii;
use yii\web\Controller;
use yii\web\Response;
use app\models\Article;
use app\models\User;
use app\models\Comment;
use app\models\Rep;
use yii\widgets\LinkPager;
use yii\data\Pagination;

class ArticlesController extends Controller
{
  public function actionIndex()
  {
    $posts = Article::find()->select('id, post_type')->orderBy(['date_created' => SORT_DESC])->all();
    return $this->render('index', [
      'page_type' => 'articles',
      'posts' => $posts,
    ]);
  }

  public function actionView( $id )
  {
    $post = Article::find()->where(['id' => $id])->one();
    $user = User::find()->where(['id' => $post['author_id']])->one();
    $comments = Comment::find()->select('comment_id')->orderBy(['date' => SORT_DESC])->all();
    $LikeCount = count(Rep::find()->where(['type' => 'articles', 'article_id' => $id, 'reputation' => 'like'])->all());
    $DislikeCount = count(Rep::find()->where(['type' => 'articles', 'article_id' => $id, 'reputation' => 'dislike'])->all());
    $isLike = false;
    $isDislike = false;
    if ($_SESSION['user'])
    {
        $userRep = Rep::find()->where(['type' => 'articles', 'article_id' => $id, 'user_id' => $_SESSION['user']['id']])->all();
        if ($userRep)
        {
            $isLike = ($userRep[0]->reputation=='like');
            $isDislike = ($userRep[0]->reputation=='dislike');
        }
    }

    return $this->render('view', [
      'page_id' => $id,
      'page_type' => 'articles',
      'post' => $post,
      'author' => $user,
      'comments' => $comments,
      'likes' => $LikeCount,
      'dislikes' => $DislikeCount,
      'isLike' => $isLike,
      'isDislike' => $isDislike,
    ]);
  }

  public function actionAdd()
  {
      if (\Yii::$app->request->post()){
          $data = \Yii::$app->request->post();
          //var_dump($data);
          //exit;
          $filneme = saveImageFILE($_FILES['image']['tmp_name']);
          $image = array(
              'max' => '/images/uploads/max-' . $filneme,
              'min' => '/images/uploads/min-' . $filneme,
          );

          $model = new Article;
          $model -> post_type = 'articles';
          $model -> meta_title = $data['meta_title'];
          $model -> meta_description = $data['meta_description'];
          $model -> meta_keywords = $data['meta_keywords'];
          $model -> name = $data['title'];
          $model -> description = $data[description];
          $model -> image = json_encode($image);
          $model -> content = $data['mce_0'];
          $model -> author_id = $_SESSION['user']['id'];
          $model -> date_created = time();

          $model->save();


          return $this->redirect(['articles/add']);
      }

      return $this->render('add', [
          'page_type' => 'articles',
          'data' => (isset($data)) ? $data : '',
      ]);
  }

    public function actionComment()
    {
        if(\Yii::$app->request->post())
        {
            $data = \Yii::$app->request->post();

            if((!empty($data['comment']) && isset($data['comment'])) && (!empty($data['article_id']) && isset($data['article_id'])) && (!empty($_SESSION['user']) && isset($_SESSION['user'])) )
            {
                $model = new Comment();

                $model->type = 'articles';
                $model->article_id = $data['article_id'];
                $model->user_id = $_SESSION['user']['id'];
                $model->comment = $data['comment'];
                $model->date = time();
                //var_dump($model);
                $model->save();
            }

            return $this->redirect(['articles/view', 'id' => $data['article_id']]);
        }

        return $this->redirect(['articles/index']);
    }

    public function actionLike()
    {
        if(\Yii::$app->request->post())
        {
            $data = \Yii::$app->request->post();

            if((!empty($data['article_id']) && isset($data['article_id'])) && (!empty($_SESSION['user']) && isset($_SESSION['user'])) )
            {
                $model = new Rep();

                $model->type = 'articles';
                $model->article_id = $data['article_id'];
                $model->user_id = $_SESSION['user']['id'];
                $model->reputation = 'like';

                $checkDislike = Rep::find()->where(['type' => $model->type, 'article_id' => $model->article_id, 'user_id' => $model->user_id, 'reputation' => 'dislike'])->one();
                $checkDislikeCount = count($checkDislike);
                if ($checkDislikeCount == 1)
                {
                    $checkDislike->delete();
                }

                $checkLike = Rep::find()->where(['type' => $model->type, 'article_id' => $model->article_id, 'user_id' => $model->user_id])->one();
                $checkLikeCount = count($checkLike);
                if ($checkLikeCount == 1)
                {
                    $checkLike->delete();
                }
                elseif ($checkLikeCount == 0){
                    $model->save();
                }
            }

            return $this->redirect(['articles/view', 'id' => $data['article_id']]);
        }

        return $this->redirect(['articles/index']);
    }

    public function actionDislike()
    {
        if(\Yii::$app->request->post())
        {
            $data = \Yii::$app->request->post();

            if((!empty($data['article_id']) && isset($data['article_id'])) && (!empty($_SESSION['user']) && isset($_SESSION['user'])) )
            {
                $model = new Rep();

                $model->type = 'articles';
                $model->article_id = $data['article_id'];
                $model->user_id = $_SESSION['user']['id'];
                $model->reputation = 'dislike';

                $checkLike = Rep::find()->where(['type' => $model->type, 'article_id' => $model->article_id, 'user_id' => $model->user_id, 'reputation' => 'like'])->one();
                $checkLikeCount = count($checkLike);
                if ($checkLikeCount == 1)
                {
                    $checkLike->delete();
                }

                $check = Rep::find()->where(['type' => $model->type, 'article_id' => $model->article_id, 'user_id' => $model->user_id])->one();
                $checkCount = count($check);
                if ($checkCount == 1)
                {
                    $check->delete();
                }
                elseif ($checkCount == 0){
                    $model->save();
                }
            }

            return $this->redirect(['articles/view', 'id' => $data['article_id']]);
        }

        return $this->redirect(['articles/index']);
    }
}
