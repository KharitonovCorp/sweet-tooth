<?php

use yii\helpers\Html;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
	<head>
		<meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Open Graph -->
    <meta property="og:title" content="<?= Html::encode($this->params['og_title']) ?>">
    <meta property="og:description" content="<?= Html::encode($this->params['og_description']) ?>">
    <meta property="og:image" content="<?= Html::encode($this->params['og_image']) ?>">
    <meta property="og:type" content="<?= Html::encode($this->params['og_type']) ?>">
    <meta property="og:url" content= "<?= Html::encode($this->params['og_url']) ?>">
    <!-- /Open Graph -->
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
	</head>
	<body>
	<?php $this->beginBody() ?>
    <?php $this->beginContent('@app/views/layouts/header.php'); ?>
      <!-- You may need to put some content here -->
    <?php $this->endContent(); ?>
		
		<main class="main <?php if($this->params['page-min']) { echo('page-min'); } ?>">
			<div class="content-position">
				<div class="main__content-block">
					<a href="<?= Html::encode($this->params['page_main_btn_link']) ?>" class="main-button main__top-button mobile"><?= Html::encode($this->params['page_main_btn_text']) ?></a>
					<div class="block page-title">
						<h1 class="page-title__name"><?= Html::encode($this->params['page_title']) ?></h1>
						<p class="page-title__description"><?= $this->params['page_description'] ?></p>
					</div>
					<div class="page-content">
						<?= $content ?>
					</div>
				</div>
				<?php $this->beginContent('@app/views/layouts/sidebar.php'); ?>
          <!-- You may need to put some content here -->
        <?php $this->endContent(); ?>
			</div>			
		</main>
		<?php $this->beginContent('@app/views/layouts/footer.php'); ?>
      <!-- You may need to put some content here -->
    <?php $this->endContent(); ?>
  <?php $this->endBody() ?>
  <?php if (isset($this->blocks['page_scripts'])){ echo $this->blocks['page_scripts'];  } ?>
	</body>
</html>
<?php $this->endPage() ?>
