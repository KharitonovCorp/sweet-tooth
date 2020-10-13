<?php

use yii\helpers\Url;

// $author->first_name  $author->second_name;

if( !$NotFound ):
    ?>
    <div class="cl-block__comment">
        <img src="<?= json_decode($author->avatar)->min ?>" class="comment__user-image">
        <div class="comment__content">
            <a href="<?= Url::toRoute(['site/user', 'id' => $author->id]) ?>"  class="comment__user"><?= $author->first_name . ' ' .  $author->second_name; ?></a>
            <p class="comment__text"><?= $post->comment ?></p>
            <p class="comment__footer">
                <span class="comment__footer-date"><?= date('d.m.Y в H:i',$post->date) ?></span>
                <!--<a class="comment__footer-link">Ответить</a>-->
            </p>
        </div>
    </div>

<?php endif; ?>