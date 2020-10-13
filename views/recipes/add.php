<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = 'Новый рецепт';

$this->registerMetaTag(['name' => 'description', 'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse, sit quia saepe quidem incidunt, consequuntur neque architecto.']);
$this->registerMetaTag(['name' => 'keywords', 'content' => 'yii, framework, php']);

$this->params['page_title'] = 'Новый рецепт';
$this->params['page_description'] = 'Поделитесь своими знаниями';

$this->params['page_main_btn_link'] = Url::toRoute([$page_type.'/add']);
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

    <form action="<?= Url::toRoute([$page_type.'/add']) ?>" id="addArticle" method="POST" class="form publication_add" enctype="multipart/form-data">
        <input type="hidden" name="<?=Yii::$app->request->csrfParam; ?>" value="<?=Yii::$app->request->getCsrfToken(); ?>" />
        <div class="block form__group" style="padding: 20px;">
            <label>
                <h3 class="main__block-title">Название</h3>
                <input type="text" name="title" data-maxlength="70" required placeholder="Введите название рецепта">
            </label>
        </div>
        <div class="block form__group" style="padding: 20px;">
            <label>
                <h3 class="main__block-title">Описание</h3>
                <textarea name="description" data-maxlength="160" required placeholder="Введите описание рецепта"></textarea>
            </label>
        </div>
        <div class="block form__group" style="padding: 20px;">
            <h3 class="main__block-title">Картинка</h3>
            <input type="file" name="image" class="select-input" required placeholder="Выберите изображение">
            <!-- <div class="formSelectLoadImage"></div> -->
        </div>
        <div class="block form__group" style="padding: 20px;">
            <h3 class="main__block-title">Информация о рецепте</h3>
            <div class="form__group">
                <p class="form__group__name">Кухня:</p>
                <div class="selectInput">
                    <input type="text" name="recipeCuisine" class="select-input" required placeholder="Выберите кухню или введите свою">
                    <ul class="select-options">
                        <?php foreach ($recipeCuisine as $elem): ?>
                        <li><?= $elem ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <div class="form__group">
                <p class="form__group__name">Категория рецепта:</p>
                <div class="selectInput">
                    <input type="text" name="recipeCategory" class="select-input" required placeholder="Выберите категорию рецепта или введите свою">
                    <ul class="select-options">
                        <?php foreach ($recipeCategory as $elem): ?>
                        <li><?= $elem ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <div class="form__group">
                <p class="form__group__name">Способ приготовления:</p>
                <div class="selectInput">
                    <input type="text" name="cookingMethod" class="select-input" required placeholder="Выберите способ приготовления или введите свой">
                    <ul class="select-options">
                        <?php foreach ($cookingMethod as $elem): ?>
                        <li><?= $elem ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <div class="form__group">
                <label>
                    <p class="form__group__name">Время приготовления:</p>
                    <input type="number" name="cookTime" min="0" required placeholder="Введите время в минутах">
                </label>
            </div>
            <div class="form__group">
                    <p class="form__group__name">Сложность приготовления:</p>
                    <div class="form-select">
                        <div type="text" class="select-input">
                            <p>Выберите cложность приготовления</p>
                            <div class="select-input-icon close"></div>
                        </div>
                        <input type="text" name="recipeLevel" class="select" required>
                        <ul class="select-options">
                            <li data-value="1">Легко</li>
                            <li data-value="2">Средне</li>
                            <li data-value="3">Сложно</li>
                        </ul>
                    </div>
            </div>
            <div class="form__group">
                <label>
                    <p class="form__group__name">Количество порций:</p>
                    <input type="number" name="recipeYield" min="0" placeholder="Введите количество порций">
                </label>
            </div>
        </div>
        <div class="block form__group" style="padding: 20px; position: relative;">
            <h3 class="main__block-title">Ингредиенты</h3>
            <i class="fa fa-plus group_block_del" onclick="addIngredientsBlock(this)" title="Добавить группу"></i>
            <div class="ingredient_block" data-groupid="0">
                <div class="ingredient_header">
                    <input type="text" name="ingredient_title[]" required placeholder="Введите название группы">
                    <div class="header_action">
                        <i class="fa fa-plus" onclick="addIngredient(this)" title="Добавить ингредиент"></i>
                        <i class="fa fa-times" onclick="delIngredientsBlock(this)" title="Удалить группу"></i>
                    </div>
                </div>
                <div class="ingredient_content">
                    <div class="form__group">
                        <input type="text" name="ingredient[0][]" class="input-with-icon" required placeholder="Введите ингредиент">
                        <i class="fa fa-times" onclick="delIngredient(this)" title="Удалить ингредиент"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="block form__group" style="padding: 20px; position: relative;">
            <h3 class="main__block-title">Пошаговый рецепт приготовления</h3>
            <i class="fa fa-plus group_block_del" onclick="addStepsBlock(this)" title="Добавить шаг"></i>
            <div class="step_block" data-groupid="0" style="position: relative;">
                <i class="fa fa-times del_step" onclick="delStepsBlock(this)" title="Удалить шаг"></i>
                <div class="step_image" style="background: url(/images/no-image.svg) no-repeat; background-size: cover; background-position: center;">
                    <label>
                        <input type="file" onchange="recipeEncodeImageFile(this)" data-delwsend style="display: none;">
                        <input type="hidden" name="step_image[0][]" value="">
                    </label>
                </div>
                <div class="form__group" style="margin-top: 0px;">
                    <h4>Шаг 1</h4>
                    <label>
                        <textarea type="text" name="step_text[0][]" required placeholder="Введите текст шага" style="height: 150px"></textarea>
                    </label>
                </div>
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
                        <input type="text" name="meta_title" data-maxlength="70" required placeholder="Введите название страницы">
                        <p class="form__group__description">Информация из данного поля учитывается поисковыми системами при определении релевантности статьи. На странице она не выводится, но выводится в результатах поиска, а также в качестве заголовка в браузере.</p>
                    </label>
                </div>
                <div class="form__group">
                    <label>
                        <p class="form__group__name">Описание: </p>
                        <textarea type="text" name="meta_description" data-maxlength="160" required placeholder="Введите описание страницы"></textarea>
                        <p class="form__group__description">Данное поле является мета-описанием страницы. Google выводит эту информацию в результатах поиска, а Яндекс ее учитывает при ранжировании страниц, но сниппет зачастую формирует без ее учета.</p>
                    </label>
                </div>
                <div class="form__group">
                    <label>
                        <p class="form__group__name">Ключевые слова/фразы: </p>
                        <input type="text" name="meta_keywords" placeholder="Введите ключевые слова">
                        <p class="form__group__description"><strong>Разделяются запятыми.</strong> Поисковые системы могут использовать ключевые слова/фразы при показе вашей статьи в результатах поиска. Не указывайте более 10 ключевых слов.</p>
                    </label>
                </div>
            </div>
        </div>
        <div class="form__group">
            <button type="submit">Отправить</button>
        </div>
    </form>