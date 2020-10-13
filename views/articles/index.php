<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Публикации';

$this->registerMetaTag(['name' => 'description', 'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse, sit quia saepe quidem incidunt, consequuntur neque architecto.']);
$this->registerMetaTag(['name' => 'keywords', 'content' => 'yii, framework, php']);

$this->params['page_title'] = 'Публикации';
$this->params['page_description'] = 'Наша небольшая шкатулка знаний';

$this->params['page_main_btn_link'] = Url::toRoute([$page_type.'/add']);
$this->params['page_main_btn_text'] = 'Добавить публикацию';

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
							  <?= app\widgets\Post::widget(['postType' => $post->post_type, 'postId' => $post->id]) ?>
						  <?php endforeach; ?>
							<div class="article-preview"></div>
							<div class="article-preview"></div>
							<div class="article-preview"></div>
						</div>