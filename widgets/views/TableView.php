<?php

use yii\helpers\Url;

if( !isset($NotFound) && !$NotFound ):
    ?>
    <a href="<?= Url::toRoute([$post->post_type.'/view', 'id' => $post->id]) ?>" class="block article-preview <?php if( $theSidebar ) { echo 'sitebar-article no-mobile'; }?>">

        <img src="<?= json_decode($post->image)->min ?>" class="article-preview__image">
        <h3 class="article-preview__title"><?= $post->name ?></h3>
        <p class="article-preview__description"><?= $post->description ?></p>
    </a>

<?php endif; ?>