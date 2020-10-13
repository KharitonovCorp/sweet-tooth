<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Авторизация';

$this->registerMetaTag(['name' => 'description', 'content' => '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => '']);

$this->params['page_title'] = 'Авторизация';
$this->params['page_description'] = 'Ещё не зарегестрированы? <a href="' . Url::toRoute(['site/signup']) . '">Регистрация</a>';

$this->params['page_main_btn_link'] = '#';
$this->params['page_main_btn_text'] = 'Добавить рецепт';

# Open Graph
$this->params['og_title'] = '';         // Заголовок
$this->params['og_description'] = '';   // Описание
$this->params['og_image'] = '';         // Ссылка на картинку
$this->params['og_type'] = '';          // Тип ссылки («article» – статья, «movie» – кино и т.д.)
$this->params['og_url'] = '';           // Ссылка на страницу

$this->params['page-min'] = true;
$this->params['page_sidebar'] = false;
$this->params['page_filter'] = false;

//$this->params['page_id'] = 0;
//$this->params['page_type'] = $page_type;

$this->beginBlock('page_scripts'); 
?>
<!-- PAGE SCRIPTS-->
<?php
$this->endBlock(); 

?>
<form action="<?= Url::toRoute(['site/signin']) ?>" id="addArticle" method="POST" class="form publication_add" enctype="multipart/form-data">
    <input type="hidden" name="<?=Yii::$app->request->csrfParam; ?>" value="<?=Yii::$app->request->getCsrfToken(); ?>" />
    <div class="block form__group" style="padding: 20px;">
        <?php if( (!empty($errorMessage) && isset($errorMessage)) ) { echo('<p style="color: red;">'.$errorMessage.'</p>'); } ?>
        <div class="form__group">
            <label>
                <p class="form__group__name">E-mail:</p>
                <input type="text" name="email" required placeholder="Введите E-mail">
            </label>
        </div>
        <div class="form__group">
            <label>
                <p class="form__group__name">Пароль:</p>
                <input type="password" name="password" required placeholder="Введите пароль">
            </label>
        </div>
        <div class="form__group">
            <button type="submit">Войти</button>
        </div>
    </div>
</form>