<?php
namespace app\widgets;

use Yii;
use app\models\Recipe;
use app\models\Article;
use app\models\News;

class ModerationTable extends \yii\bootstrap\Widget
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
            return $this->render('TableView',[ 'NotFound'=>true, ]);
        }
        return
            $this->render('TableView',[
            'post' => $post,
            'theSidebar' => $this->theSidebar,
        ]);
    }
}
?>
