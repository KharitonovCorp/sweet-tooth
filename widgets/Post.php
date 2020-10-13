<?php
namespace app\widgets;


use Yii;
use app\models\Recipe;
use app\models\Article;
use app\models\News;
use app\models\Comment;
use app\models\Rep;

class Post extends \yii\bootstrap\Widget
{
  public $postType = '';
  
  public $postId = 0;
  
  public $theSidebar = false;
  
  public function run()
  {
    switch($this->postType)
    {
      case 'recipes': $post = Recipe::find()->where(['id' => $this->postId])->one(); break;
      case 'articles': $post = Article::find()->where(['id' => $this->postId])->one(); break;
      case 'news': $post = News::find()->where(['id' => $this->postId])->one(); break;
      default: $post = false;
    }
    if(!$post)
    {
       return $this->render('PostView',[ 'NotFound'=>true, ]);
    }

    $countComment = count(Comment::find()->where(['type'=>$this->postType, 'article_id'=>$this->postId])->all());
    $countLike = count(Rep::find()->where(['type'=>$this->postType, 'article_id'=>$this->postId, 'reputation' => 'like'])->all());
    $countDislike = count(Rep::find()->where(['type'=>$this->postType, 'article_id'=>$this->postId, 'reputation' => 'dislike'])->all());

    return $this->render('PostView',[
      'post' => $post,
      'theSidebar' => $this->theSidebar,
      'countComment' => $countComment,
      'countLike' => $countLike,
      'countDislike' => $countDislike,
      'NotFound' => false,
    ]);
  }
}
