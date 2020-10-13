<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Новая публикация';

$this->registerMetaTag(['name' => 'description', 'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse, sit quia saepe quidem incidunt, consequuntur neque architecto.']);
$this->registerMetaTag(['name' => 'keywords', 'content' => 'yii, framework, php']);

$this->params['page_title'] = 'Новая публикация';
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
<form action="<?= Url::toRoute([$page_type.'/add']) ?>" id="addArticle" method="POST" class="form publication_add" enctype="multipart/form-data">
    <input type="hidden" name="<?=Yii::$app->request->csrfParam; ?>" value="<?=Yii::$app->request->getCsrfToken(); ?>" />
    <div class="block form__group" style="padding: 20px;">
        <label>
            <h3 class="main__block-title">Название</h3>
            <input type="text" name="title" data-maxlength="70" required placeholder="Введите название статьи">
        </label>
    </div>
    <div class="block form__group" style="padding: 20px;">
        <h3 class="main__block-title">Картинка</h3>
        <input type="file" name="image" class="select-input" required placeholder="Выберите изображение">
        <!-- <div class="formSelectLoadImage"></div> -->
    </div>
    <div class="block form__group" style="padding: 20px;">
        <label>
            <h3 class="main__block-title">Описание</h3>
            <textarea name="description" data-maxlength="160" required placeholder="Введите описание рецепта"></textarea>
        </label>
    </div>

    <div class="block form__group" style="padding: 20px;">
        <h3 class="main__block-title">Статья</h3>
        <div class="form-tinymce-editor" style="border: 1px solid #e6e6e6; border-radius: 3px;">
            <p>Введите вашу статью</p>
        </div>
    </div>

    <div class="block pa__meta" style="padding: 20px;">
        <div class="pa__meta__title">
            <p>Изменить мета данные</p>
            <div class="pa__meta__title-icon close"></div>
        </div>
        <div class="pa__meta__content" style="display: none;">
            <div class="form__group">
                <label>
                    <p class="form__group__name">Название: </p>
                    <input type="text" name="meta_title" required placeholder="Введите название страницы">
                    <p class="form__group__description">Информация из данного поля учитывается поисковыми системами при определении релевантности статьи. На странице она не выводится, но выводится в результатах поиска, а также в качестве заголовка в браузере.</p>
                </label>
            </div>
            <div class="form__group">
                <label>
                    <p class="form__group__name">Описание: </p>
                    <textarea type="text" name="meta_description" required placeholder="Введите описание страницы"></textarea>
                    <p class="form__group__description">Данное поле является мета-описанием страницы. Google выводит эту информацию в результатах поиска, а Яндекс ее учитывает при ранжировании страниц, но сниппет зачастую формирует без ее учета.</p>
                </label>
            </div>
            <div class="form__group">
                <label>
                    <p class="form__group__name">Ключевые слова/фразы: </p>
                    <input type="text" name="meta_keywords" placeholder="Введите ключевые слова">
                    <p class="form__group__description">Поисковые системы могут использовать ключевые слова/фразы при показе вашей статьи в результатах поиска. Не указывайте более 10 ключевых слов.</p>
                </label>
            </div>
        </div>
    </div>

    <script src="/libs/tinymce/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: 'div.form-tinymce-editor',
            theme: 'inlite',
            plugins: 'lists image media table link paste contextmenu textpattern autolink codesample',
            insert_toolbar: 'quickimage quicktable media',
            selection_toolbar: 'h2 h3 blockquote | bold italic | alignleft aligncenter alignright | bullist numlist | quicklink',
            inline: true,
            paste_data_images: true,
            content_css: ['/libs/tinymce/codepen.min.css']
        });
    </script>

    <div class="form__group">
        <button type="submit">Отправить</button>
    </div>
</form>