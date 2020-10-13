<?php

use app\widgets\Post;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Обратная связь';

$this->registerMetaTag(['name' => 'description', 'content' => '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => '']);

$this->params['page_title'] = 'Обратная связь';
$this->params['page_description'] = 'с администрацией сайта';

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

<form action="<?= Url::toRoute(['site/feed']) ?>" id="addArticle" method="POST" class="form publication_add" enctype="multipart/form-data">
    <input type="hidden" name="<?=Yii::$app->request->csrfParam; ?>" value="<?=Yii::$app->request->getCsrfToken(); ?>" />
    <div class="block form__group" style="padding: 20px;">
        <label>
            <h3 class="main__block-title">Введите ваше ФИО</h3>
            <input type="text" name="fio" data-maxlength="70" required placeholder="Как вас зовут?">
        </label>
    </div>
    <div class="block form__group" style="padding: 20px;">
        <label>
            <h3 class="main__block-title">Введите E-mail</h3>
            <input type="text" name="email" data-maxlength="70" required placeholder="Введите E-mail">
        </label>
    </div>
    <div class="block form__group" style="padding: 20px;">
        <label>
            <h3 class="main__block-title">Ведите ваше сообщение</h3>
            <textarea name="text" data-maxlength="300" required placeholder="Сообщение"></textarea>
        </label>
    </div>
    <div class="form__group">
        <button type="submit">Отправить</button>
    </div>
</form>