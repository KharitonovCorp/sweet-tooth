<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

function siteURL()
{
  $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
  $domainName = $_SERVER['HTTP_HOST'];
  return $protocol.$domainName;
}

function cookTime($min)
{
  $h = floor($min / 60);
  $m = $min - $h * 60;
  $result = '';
  if($h == 0 && $m == 0) { $result = 0; }
  elseif($h == 0) { $result = $m.' мин'; }
  elseif($m == 0) { $result = $h.' ч'; }
  else { $result = $h.' ч '.$m.' мин'; }
  return $result;
}

$this->title = $post->meta_title;

$this->registerMetaTag(['name' => 'description', 'content' => $post->meta_description]);
$this->registerMetaTag(['name' => 'keywords', 'content' => $post->meta_keywords]);

$this->params['page_title'] = $post->name;
$this->params['page_description'] = '<a href="' . (($author != NULL) ? Url::toRoute(['site/user', 'id' => $author['id']]) : '#') . '" class="page-title__link">' . (($author != NULL) ? $author['first_name'] . ' ' . $author['second_name'] : 'Пользователь не существует') . '</a> / '.date('d.m.Y', $post->date_created);

$this->params['page_main_btn_link'] = Url::toRoute([$page_type.'/add']);
$this->params['page_main_btn_text'] = 'Добавить рецепт';

# Open Graph
$this->params['og_title'] = $post->name;
$this->params['og_description'] = $post->description;
$this->params['og_image'] = siteURL().json_decode($post->image)->max;
$this->params['og_type'] = 'article';
$this->params['og_url'] = '';

$this->params['page-min'] = false;
$this->params['page_sidebar'] = true;
$this->params['page_filter'] = false;


$this->params['page_id'] = $page_id;
$this->params['page_type'] = $page_type;

$this->params['like_count'] = $likes;
$this->params['dislike_count'] = $dislikes;

$this->beginBlock('page_scripts');

?>
<!--
<script type="text/javascript" src="/web/libs/swiper/swiper.js"></script>
<script type="text/javascript">
  $(window).load(function(){
    var swiper = new Swiper('.articles32', {
      slidesPerView: 3,
      spaceBetween: 20,
      breakpoints: {
        480: {
          slidesPerView: 1,
          spaceBetween: 10
        },
        768: {
          slidesPerView: 2,
          spaceBetween: 20
        },
      },
      keyboard: {	
        enabled: true,
      },
      mousewheel: true,
    });
  });
</script>
-->
<?php
$this->endBlock(); 

$ingredients = json_decode($post->ingredients);
$information = json_decode($post->information);
$steps = json_decode($post->steps);
?>
<img src="<?= json_decode($post->image)->max ?>" class="block article__main-image">
						<p class="article__main-description block"><?= $post->description ?></p>
						<div class="recipe">
							<div class="recipe__top">
								<div class="block recipe__ingredients">
									<h2 class="recipe__title-block">Ингредиенты</h2>
									<?php foreach($ingredients as $groupName => $group): ?>
								  <div class="ingredients__group">
										<h3 class="ingredients__group-title"><?= Html::encode($groupName) ?></h3>
										<?php foreach($group as $ingredient): ?>
										<p><?= Html::encode($ingredient) ?></p>
										<?php endforeach; ?>
									</div>
									<?php endforeach; ?>
								</div>
								<div class="block recipe__info">
									<a href="javascript:window.print();" class="main-button" style="padding: 12px 15px;">Распечатать</a>
									<div class="recipe__info-option">
										<h4 class="recipe__info-name">Кухня</h4>
										<p class="recipe__info-value"><?= Html::encode($information->recipeCuisine) ?></p>									
									</div>
									<div class="recipe__info-option">
										<h4 class="recipe__info-name">Категория рецепта</h4>
										<p class="recipe__info-value"><?= Html::encode($information->recipeCategory) ?></p>									
									</div>
									<div class="recipe__info-option">
										<h4 class="recipe__info-name">Способ приготовления</h4>
										<p class="recipe__info-value"><?= Html::encode($information->cookingMethod) ?></p>									
									</div>
									<div class="recipe__info-option">
										<h4 class="recipe__info-name">Время приготовления</h4>
										<p class="recipe__info-value"><?= Html::encode(cookTime($information->cookTime)) ?></p>									
									</div>
									<div class="recipe__info-option">
										<h4 class="recipe__info-name">Сложность приготовления</h4>
										<p class="recipe__info-value"><?= Html::encode($information->recipeLevel) ?></p>									
									</div>
									<div class="recipe__info-option">
										<h4 class="recipe__info-name">Количество порций</h4>
										<p class="recipe__info-value"><?= Html::encode($information->recipeYield) ?></p>									
									</div>
								</div>
							</div>
							<div class="block recipe__steps pbb-always">
								<h2 class="recipe__title-block">Пошаговый рецепт приготовления</h2>
								<?php foreach($steps as $stepIndex => $step): ?>
								<div class="steps__group pbi-avoid">
									<h3 class="steps__group-title">Шаг <?= ($stepIndex + 1) ?></h3>
									<div class="steps__group-block">
                    <?php if(isset($step->image[0]) && $step->image[0] != '') { echo '<img src="'.Html::encode($step->image[0]).'" alt="">'; } ?>
										<p><?= Html::encode($step->text[0]) ?></p>
									</div>
								</div>
								<?php endforeach; ?>
							</div>
						</div>
						<div class="block article__main-statistics">
							<div style="display: flex;">

                                <form action="<?= Url::toRoute([$page_type.'/like']) ?>" id="Like" method="POST" class="page-content__comments" enctype="multipart/form-data">
                                    <input type="hidden" name="<?=Yii::$app->request->csrfParam; ?>" value="<?=Yii::$app->request->getCsrfToken(); ?>" />
                                    <input type="hidden" name="article_id" value="<?= $page_id ?>"/>
                                    <button name="getLike" style="background: transparent; border: none;">
                                    <div class="a-statistics__like"><i class="fa fa-thumbs-o-up <?= ($isLike) ? 'accent-color' : '' ?>" aria-hidden="true"></i> <?= countTransformation($likes) ?></div>
                                    </button>
                                </form>


                                <form action="<?= Url::toRoute([$page_type.'/dislike']) ?>" id="Dislike" method="POST" class="page-content__comments" enctype="multipart/form-data">
                                    <input type="hidden" name="<?=Yii::$app->request->csrfParam; ?>" value="<?=Yii::$app->request->getCsrfToken(); ?>" />
                                    <input type="hidden" name="article_id" value="<?= $page_id ?>"/>
                                    <button name="getLike" style="background: transparent; border: none;">
                                        <div class="a-statistics__dislike"><i class="fa fa-thumbs-o-down <?= ($isDislike) ? 'accent-color' : '' ?>" aria-hidden="true"></i> <?= countTransformation($dislikes) ?></div>
                                    </button>
                                </form>

							</div>
							<div class="ya-share2" data-services="vkontakte,twitter,odnoklassniki,gplus,moimir,blogger,reddit,evernote,lj,pocket,qzone,renren,sinaWeibo,surfingbird,whatsapp,skype" data-limit="4" data-lang="ru"></div>
							<script src="https://yastatic.net/es5-shims/0.0.2/es5-shims.min.js" async="async"></script>
        			<script src="https://yastatic.net/share2/share.js" async="async"></script>
						</div>
						<!-- RecentPost -->
						<?php # app\widgets\RecentPost::widget(['typePage' => $page_type, 'idPage' => $page_id]); ?>
						<!-- /RecentPost -->
						
						<div class="page-content__comments">

                            <?php if((!empty($_SESSION['user']) && isset($_SESSION['user'])) ): ?>
							<form action="<?= Url::toRoute([$page_type.'/comment']) ?>" id="addComment" method="POST" class="page-content__comments" enctype="multipart/form-data">
                                <input type="hidden" name="<?=Yii::$app->request->csrfParam; ?>" value="<?=Yii::$app->request->getCsrfToken(); ?>" />
                                <input type="hidden" name="article_id" value="<?= $page_id ?>"/>
                                <div class="block comments__add-comment" >
                                    <h2 class="comments-title">Добавить комментарий</h2>
                                    <textarea class="add-comment__input" name="comment" placeholder="Написать комментарий..."></textarea>
                                    <button class="add-comment__button main-button" name="sendComment">Отправить</button>
                                </div>
                            </form>
                            <?php endif; ?>


							<div class="block comments__comment-list">
								<h2 class="comments-title">Комментарии</h2>
								<div class="comments-list__block">


                                    <?php foreach($comments as $comment): ?>
                                    <?= app\widgets\PostComment::widget(['postType' => $page_type, 'postId' => $comment->comment_id, 'postArticle' => $page_id]) ?>
                                    <?php endforeach; ?>

								</div>
							</div>
						</div>