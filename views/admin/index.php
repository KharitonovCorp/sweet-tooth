<?php

use app\widgets\Post;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Модерация записей';

$this->registerMetaTag(['name' => 'description', 'content' => '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => '']);

$this->params['page_title'] = 'Модерация записей';
$this->params['page_description'] = 'Панель модерации записей';

$this->params['page_main_btn_link'] = Url::toRoute(['recipes/add']);
$this->params['page_main_btn_text'] = 'Добавить рецепт';

# Open Graph
$this->params['og_title'] = '';
$this->params['og_description'] = '';
$this->params['og_image'] = '';
$this->params['og_type'] = '';
$this->params['og_url'] = '';

$this->params['page-min'] = false;
$this->params['page_sidebar'] = true;
$this->params['page_filter'] = false;


$this->params['page_id'] = 0;
$this->params['page_type'] = '';

$this->beginBlock('page_scripts');

$this->endBlock();
?>

<div class="page-content__articles">
    <table>
    <?php foreach($posts as $post) : ?>
        <?= app\widgets\ModerationTable::widget(['postType' => $post->post_type, 'postId' => $post->id]) ?>
    <?php endforeach; ?>
    </table>
</div> 
