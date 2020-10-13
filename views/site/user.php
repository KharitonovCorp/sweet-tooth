<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $user['first_name'] . ' ' . $user['second_name'];

$this->registerMetaTag(['name' => 'description', 'content' => '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => '']);

$this->params['page_title'] = $user['first_name'] . ' ' . $user['second_name'];
$this->params['page_description'] = '<a href="mailto:' . $user['email'] . '" class="page-title__link">' . $user['email'] . '</a> / Рейтинг: 3';

$this->params['page_main_btn_link'] = Url::toRoute(['recipes/add']);
$this->params['page_main_btn_text'] = 'Добавить рецепт';

# Open Graph
$this->params['og_title'] = $user['first_name'] . ' ' . $user['second_name'];         // Заголовок
$this->params['og_description'] = '';   // Описание
$this->params['og_image'] = '';         // Ссылка на картинку
$this->params['og_type'] = '';          // Тип ссылки («article» – статья, «movie» – кино и т.д.)
$this->params['og_url'] = '';           // Ссылка на страницу

$this->params['page-min'] = false;
$this->params['page_sidebar'] = true;
$this->params['page_filter'] = false;

$this->params['page_id'] = 0;
$this->params['page_type'] = 'recipes';

$this->beginBlock('page_scripts'); 
?>
<!-- PAGE SCRIPTS-->
<?php
$this->endBlock(); 


?>

<div class="block page-content__user" style="background: url(<?= json_decode($user['bg_image'])->max ?>); background-size: cover; background-position: center;">
							<div class="user__back-gradient"></div>
							<img class="user__avatar" src="<?= json_decode($user['avatar'])->min ?>" alt="<?= ($user['first_name'] . ' ' . $user['second_name']); ?>">
							<p class="user__description"><?= $user['description'] ?></p>
						</div>
						<div class="block" style="padding: 20px; margin-bottom: 20px">
							<h2 class="user__title-block">Публикации</h2>
						</div>
						<?php foreach($posts as $post): ?>
						<a href="<?= Url::toRoute([$post->post_type.'/view', 'id' => $post->id]) ?>" class="block user__public">
							<img src="<?= json_decode($post->image)->min ?>" class="public__image">
							<h3 class="public__title"><?= $post->name ?></h3>
							<p class="public__description"><?= $post->description ?></p>
							<p class="public__date"><?= date('d.m.Y', $post->date_created) ?></p>
						</a>
						<?php endforeach; ?>