<?php

use yii\helpers\Html;

?>

<?php if($this->params['page_sidebar']): ?>
<div class="main__sidebar">
					<a href="<?= Html::encode($this->params['page_main_btn_link']) ?>" class="main-button no-mobile" style="margin-bottom: 20px;"><?= Html::encode($this->params['page_main_btn_text']) ?></a>
					<?php if($this->params['page_filter']): ?>
					  <?= app\widgets\SidebarFilter::widget(); ?>
					<?php endif; ?>
					
					<?= app\widgets\RandomPost::widget(['postType' => $this->params['page_type'], 'postId' => $this->params['page_id'], 'theSidebar' => true]); ?>
					<div class="sidebar__advertising no-mobile">
						<!--<div class="block" style="height: 300px; margin-bottom: 20px; background: yellow"></div>-->
					</div>
				</div>
<?php endif; ?>