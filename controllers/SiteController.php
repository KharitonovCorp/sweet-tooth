<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

use app\models\SearchFormModel;
use app\models\Recipe;
use app\models\Article;
use app\models\News;
use app\models\User;
use app\models\Feedback;

class SiteController extends Controller
{
  public function actionIndex()
  {
    return $this->redirect(['recipes/index']);
  }
  
  public function actionSearch()
  {
    $model = new SearchFormModel();
    if($model->load(\Yii::$app->request->post())){
      $data = \Yii::$app->request->post();

        if ($data['SearchFormModel']['query'] == "")
        {
            //var_dump($data);
            return $this->redirect(['recipes/index']);
        }

      $posts = array();
      
      $recipes = Recipe::find()->all();
      $articles = Article::find()->all();
      $news = News::find()->all();
      
      foreach($recipes as $post) {
        $tempArray = array();
        foreach($post as $key => $val) { $tempArray[$key] = mb_strtolower($val, 'UTF-8'); }
        array_push($posts, $tempArray);
      }
      foreach($articles as $post) {
        $tempArray = array();
        foreach($post as $key => $val) { $tempArray[$key] = mb_strtolower($val, 'UTF-8'); }
        array_push($posts, $tempArray);
      }
      foreach($news as $post) {
        $tempArray = array();
        foreach($post as $key => $val) { $tempArray[$key] = mb_strtolower($val, 'UTF-8'); }
        array_push($posts, $tempArray);
      }
      
      $postsInStr = array();
      foreach($posts as $post)
      {
        $tempArray = array();
        if( strpos(implode("|", $post), mb_strtolower($data['SearchFormModel']['query'], 'UTF-8')) )
        {
          $tempArray['id'] = $post['id'];
          $tempArray['post_type'] = $post['post_type'];
          $tempArray['count_words'] = count(explode($data['SearchFormModel']['query'], implode("|", $post)))-1;
          array_push($postsInStr, $tempArray);
        }
      }
      
      $posts = array();
      foreach($postsInStr as $elem)
      {
        $maxCount = 0;
        $maxIndex = 0;
        foreach($postsInStr as $key => $post)
        {
          if($post['count_words'] > $maxCount) { $maxCount = $post['count_words']; $maxIndex = $key; }
        }
        array_push($posts, $postsInStr[$maxIndex]);
        unset($postsInStr[$maxIndex]);
      }
      
      return $this->render('search', [
        'query' => $data['SearchFormModel']['query'],
        'posts' => $posts,
      ]);
    };
    return $this->redirect(['recipes/index']);
  }
  
  public function actionUser( $id )
  {
    $user = User::find()->where(['id' => $id])->one();
    if($user == NULL) {
      return $this->redirect(['site/index']);
    }

		$tempPosts = array();
      
		$recipes = Recipe::find()->where(['author_id' => $id])->all();
		$articles = Article::find()->where(['author_id' => $id])->all();
		$news = News::find()->where(['author_id' => $id])->all();

		foreach($recipes as $post) { array_push($tempPosts, $post); }
		foreach($articles as $post) {	array_push($tempPosts, $post); }
		foreach($news as $post) {	array_push($tempPosts, $post); }
		
		$posts = array();
		foreach ($tempPosts as $elem) {
			$minDate = 0;
			$minDateIndex = 0;
			foreach ($tempPosts as $index => $post) {
				if ($post->date_created > $minDate) {
					$minDate = $post->date_created;
					$minDateIndex = $index;
				}
			}
			array_push($posts, $tempPosts[$minDateIndex]);
      unset($tempPosts[$minDateIndex]);
    }
    

    return $this->render('user', [
      'user' => $user,
      'posts' => $posts,
    ]);
  }

  public function actionSignin( )
  {
    if(\Yii::$app->request->post()){
      $data = \Yii::$app->request->post();

      if (strlen($data['password']) < 6) {
        return $this->render('signin', [
          'data' => $data,
          'errorMessage' => 'Длина пароля должна быть больше 6 символов'
        ]);
      }
      
      $user = User::find()->where(['email' => $data['email']])->one();

      if ($user == NULL) {
        return $this->render('signin', [
          'data' => $data,
          'errorMessage' => 'Пользователь не найден'
        ]);
      }
      if ($user['password'] != hash('sha256', $data['password'])) {
        return $this->render('signin', [
          'data' => $data,
          'errorMessage' => 'Пароль введён неверно'
        ]);
      }
      $_SESSION['user'] = array(
        'id' => $user['id'],
        'first_name' => $user['first_name'],
        'second_name' => $user['second_name'],
        'email' => $user['email'],
        'password' => $user['password'],
        'permission' => $user['permission'],
        'date_reg' => $user['date_reg'],
        'bg_image' => $user['bg_image'],
        'avatar' => $user['avatar'],
        'description' => $user['description'],
        'social' => $user['social'],
      );
      return $this->redirect(['site/user', 'id' => $user['id']]);
    }
    return $this->render('signin');
  }
  
  public function actionSignup( )
  {
    if(\Yii::$app->request->post()){
      $data = \Yii::$app->request->post();

      if ($data['password'] != $data['password2']) {
        return $this->render('signup', [
          'data' => $data,
          'errorMessage' => 'Пароли не совпадают'
        ]);
      }
      if (strlen($data['password']) < 6) {
        return $this->render('signup', [
          'data' => $data,
          'errorMessage' => 'Длина пароля должна быть больше 6 символов'
        ]);
      }


			$model = new User;
			
			$model->first_name = $data['firstname'];
			$model->second_name = $data['secondname'];
			$model->email = $data['email'];
			$model->password = hash('sha256', $data['password']);
			$model->permission = 'user';

      $model->date_reg = time();
      $model->bg_image = '{"max":"/images/user/backgrounds/default.jpg", "min":"/images/user/backgrounds/default.jpg"}';
      $model->avatar = '{"max":"/images/user/avatars/default.jpg", "min":"/images/user/avatars/default.jpg"}';
      $model->description = '';
      $model->social = '[]';

			$model->save();

      return $this->redirect(['site/signin']);
    }
    return $this->render('signup');
  }
  public function actionLogout() {
    unset($_SESSION['user']);
    return $this->redirect(['site/index']);
  }

  public function actionFeedback()
  {
      return $this->render('feedback');
  }

  public function actionFeed()
  {
      if(\Yii::$app->request->post()) {
          $data = \Yii::$app->request->post();

          $model = new Feedback();

          $model->fio = $data['fio'];
          $model->email = $data['email'];
          $model->text = $data['text'];

          $model->save();
      }

      return $this->redirect(['site/feedback']);
  }
}
