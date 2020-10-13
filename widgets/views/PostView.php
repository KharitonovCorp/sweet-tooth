 <?php

use yii\helpers\Url;

if( !$NotFound ):
?>
<a href="<?= Url::toRoute([$post->post_type.'/view', 'id' => $post->id]) ?>" class="block article-preview <?php if( $theSidebar ) { echo 'sitebar-article no-mobile'; }?>">
						<img src="<?= json_decode($post->image)->min ?>" class="article-preview__image">
						<h3 class="article-preview__title"><?= $post->name ?></h3>
						<p class="article-preview__description"><?= $post->description ?></p>
						<div class="article-preview__statistics">
							<div class="preview-statistics__likes"><i class="fa fa-thumbs-o-up accent-color" aria-hidden="true"></i>&nbsp;<?= countTransformation($countLike) ?></div>
							<div class="preview-statistics__dislikes"><i class="fa fa-thumbs-o-down accent-color" aria-hidden="true"></i>&nbsp;<?= countTransformation($countDislike) ?></div>
							<div class="preview-statistics__comments"><i class="fa fa-comment-o accent-color" aria-hidden="true"></i>&nbsp;<?= countTransformation($countComment) ?></div>
						</div>
					</a>

<?php endif; ?>