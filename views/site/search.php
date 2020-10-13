<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Результат поиска';

$this->registerMetaTag(['name' => 'description', 'content' => '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => '']);

$this->params['page_title'] = 'Результат поиска';
$this->params['page_description'] = 'Запрос: '.$query;

$this->params['page_main_btn_link'] = Url::toRoute(['recipes/add']);
$this->params['page_main_btn_text'] = 'Добавить рецепт';

# Open Graph
$this->params['og_title'] = '';         // Заголовок
$this->params['og_description'] = '';   // Описание
$this->params['og_image'] = '';         // Ссылка на картинку
$this->params['og_type'] = '';          // Тип ссылки («article» – статья, «movie» – кино и т.д.)
$this->params['og_url'] = '';           // Ссылка на страницу

$this->params['page-min'] = false;
$this->params['page_sidebar'] = true;
$this->params['page_filter'] = false;

$this->params['page_id'] = 0;
$this->params['page_type'] = $page_type;

$this->beginBlock('page_scripts'); 
?>
<!-- PAGE SCRIPTS-->
<?php
$this->endBlock(); 


?>

<div class="page-content__articles">
							<?php foreach($posts as $post): ?>
							  <?= app\widgets\Post::widget(['postType' => $post['post_type'], 'postId' => $post['id']]) ?>
						  <?php endforeach; ?>
							<div class="article-preview"></div>
							<div class="article-preview"></div>
							<div class="article-preview"></div>
						</div>