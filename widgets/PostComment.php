<?php
namespace app\widgets;

use Yii;
use app\models\Recipe;
use app\models\Article;
use app\models\News;
use app\models\User;
use app\models\Comment;

class PostComment extends \yii\bootstrap\Widget
{
    public $postType = '';
    public $postArticle = 0;
    public $postId = 0;

    public function run()
    {
        switch($this->postType)
        {
            case 'recipes': $post = Comment::find()->where(['comment_id' => $this->postId, 'type' => $this->postType, 'article_id' => $this->postArticle])->one(); break;
            case 'articles': $post = Comment::find()->where(['comment_id' => $this->postId, 'type' => $this->postType, 'article_id' => $this->postArticle])->one(); break;
            case 'news': $post = Comment::find()->where(['comment_id' => $this->postId, 'type' => $this->postType, 'article_id' => $this->postArticle])->one(); break;
            default: $post = false;
        }
        if(!$post)
        {
            return $this->render('PostCommentView',[ 'NotFound'=>true, ]);
        }
        $user = User::find()->where(['id'=> $post->user_id])->one();
        return $this->render('PostCommentView',[
            'post' => $post,
            'author' => $user,
			'NotFound' => false,
        ]);
    }
}
