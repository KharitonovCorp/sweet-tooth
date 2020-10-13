<?php
namespace app\widgets;

use app\models\Article;
use app\models\News;
use Yii;
use app\models\Recipe;

class RandomPost extends \yii\bootstrap\Widget
{
  public $postType = '';
  
  public $postId = 0;
  
  public $theSidebar = false;

  public function run()
  {
    if ($this->postType == 'recipes'){
        $this->postId = Recipe::find()->select('id')->where(['not', ['id'=> $this->postId]])->orderBy('RAND()')->one();
    }
    elseif ($this->postType == 'articles')
    {
        $this->postId = Article::find()->select('id')->where(['not', ['id'=> $this->postId]])->orderBy('RAND()')->one();
    }
    elseif ($this->postType == 'news')
    {
        $this->postId = News::find()->select('id')->where(['not', ['id'=> $this->postId]])->orderBy('RAND()')->one();
    }
    return $this->render('RandomPostView', [
      'type' => $this->postType,
      'id' => $this->postId,
      'theSidebar' => $this->theSidebar,
    ]);
  }
}
