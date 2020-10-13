<?php

namespace app\controllers;


use Yii;
use yii\web\Controller;
use yii\web\Response;
use app\models\Recipe;
use app\models\User;
use app\models\Comment;
use app\models\Rep;
use app\models\CommentForm;
use yii\widgets\LinkPager;
use yii\data\Pagination;

class RecipesController extends Controller
{

  public function actionIndex()
  {
    $posts = Recipe::find()->select('id, post_type')->orderBy(['date_created' => SORT_DESC])->all();

      $query = Recipe::find();
      $pages = new Pagination(['totalCount' => $query->count(),'pageSize'=>6]);
      $posts = $query->offset($pages->offset)

          ->limit($pages->limit)

          ->all();

    return $this->render('index', [
      'page_type' => 'recipes',
      'posts' => $posts,
        'pages' => $pages,
    ]);
  }

  public function actionView( $id )
  {
    $post = Recipe::find()->where(['id' => $id])->one();
	$user = User::find()->where(['id' => $post['author_id']])->one();
    $comments = Comment::find()->select('comment_id')->orderBy(['date' => SORT_DESC])->all();
    $LikeCount = count(Rep::find()->where(['type' => 'recipes', 'article_id' => $id, 'reputation' => 'like'])->all());
    $DislikeCount = count(Rep::find()->where(['type' => 'recipes', 'article_id' => $id, 'reputation' => 'dislike'])->all());
    $isLike = false;
    $isDislike = false;
    if ($_SESSION['user'])
    {
        $userRep = Rep::find()->where(['type' => 'recipes', 'article_id' => $id, 'user_id' => $_SESSION['user']['id']])->all();
        if ($userRep)
        {
            $isLike = ($userRep[0]->reputation=='like');
            $isDislike = ($userRep[0]->reputation=='dislike');
        }
    }

    return $this->render('view', [
      'page_id' => $id,
      'page_type' => 'recipes',
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
		if(\Yii::$app->request->post()){
      $data = \Yii::$app->request->post();
			
			$information = array();
			$information['recipeCuisine'] = $data['recipeCuisine'];
			$information['recipeCategory'] = $data['recipeCategory'];
			$information['cookingMethod'] = $data['cookingMethod'];
			$information['cookTime'] = $data['cookTime'];
			$information['recipeLevel'] = $data['recipeLevel'];
			$information['recipeYield'] = $data['recipeYield'];
			$information = json_encode($information);
			
			$ingredients = array();
			foreach($data['ingredient'] as $index => $group)
			{
				$ingredients[$data['ingredient_title'][$index]] = $group;
			}
			$ingredients = json_encode($ingredients);
			
			$steps = array();
			foreach($data['step_image'] as $index => $image)
			{
				$temp = array();
				$temp['image'] = $image;
				$temp['text'] = $data['step_text'][$index];
				array_push($steps, $temp);
			}
			$steps = json_encode($steps);

			$filneme = saveImageFILE($_FILES['image']['tmp_name']);
			$image = array(
				'max' => '/images/uploads/max-' . $filneme,
				'min' => '/images/uploads/min-' . $filneme,
			);
			
			$model = new Recipe;
			
			$model->post_type = 'recipes';
			$model->meta_title = $data['meta_title'];
			$model->meta_description = $data['meta_description'];
			$model->meta_keywords = $data['meta_keywords'];
			$model->name = $data['title'];
			$model->description = $data['description'];
			$model->image = json_encode($image);
			$model->information = $information;
			$model->ingredients = $ingredients;
			$model->steps = $steps;
			$model->author_id = $_SESSION['user']['id'];
			$model->date_created = time();
			
			$model->save();
			
    	return $this->redirect(['recipes/add']);
		}
		$posts = Recipe::find()->all();
    
    $recipeCuisine = array();
    $recipeCategory = array();
    $cookingMethod = array();
    
    foreach($posts as $post)
    {
      $information = json_decode($post->information);
      if( !in_array($information->recipeCuisine, $recipeCuisine) ) { array_push($recipeCuisine, $information->recipeCuisine); }
      if( !in_array($information->recipeCategory, $recipeCategory) ) { array_push($recipeCategory, $information->recipeCategory); }
      if( !in_array($information->cookingMethod, $cookingMethod) ) { array_push($cookingMethod, $information->cookingMethod); }
    }
    return $this->render('add', [
      'page_type' => 'recipes',
      'data' => (isset($data)) ? $data : '',
      'recipeCuisine' => $recipeCuisine,
      'recipeCategory' => $recipeCategory,
      'cookingMethod' => $cookingMethod,
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

                $model->type = 'recipes';
                $model->article_id = $data['article_id'];
                $model->user_id = $_SESSION['user']['id'];
                $model->comment = $data['comment'];
                $model->date = time();
                //var_dump($model);
                $model->save();
            }

            return $this->redirect(['recipes/view', 'id' => $data['article_id']]);
        }

        return $this->redirect(['recipes/index']);
    }

    public function actionLike()
    {
        if(\Yii::$app->request->post())
        {
            $data = \Yii::$app->request->post();

            if((!empty($data['article_id']) && isset($data['article_id'])) && (!empty($_SESSION['user']) && isset($_SESSION['user'])) )
            {
                $model = new Rep();

                $model->type = 'recipes';
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

            return $this->redirect(['recipes/view', 'id' => $data['article_id']]);
        }

        return $this->redirect(['recipes/index']);
    }

    public function actionDislike()
    {
        if(\Yii::$app->request->post())
        {
            $data = \Yii::$app->request->post();

            if((!empty($data['article_id']) && isset($data['article_id'])) && (!empty($_SESSION['user']) && isset($_SESSION['user'])) )
            {
                $model = new Rep();

                $model->type = 'recipes';
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

            return $this->redirect(['recipes/view', 'id' => $data['article_id']]);
        }

        return $this->redirect(['recipes/index']);
    }
}
