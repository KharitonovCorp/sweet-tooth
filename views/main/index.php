<?php

use app\widgets\Post;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Главная';

$this->registerMetaTag(['name' => 'description', 'content' => '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => '']);

$this->params['page_title'] = 'Главная';
$this->params['page_description'] = 'Онлайн школа кондитеров';

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

<img src="/images/main/image.jpeg" class="block article__main-image">
