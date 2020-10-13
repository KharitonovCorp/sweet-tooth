<?php

use yii\helpers\Url;

if(session_id() == '') {
	session_start();
}
?>
<header class="header">
			<div class="window-blackout hidden"></div>
			<nav class="header__nav">
				<div class="nav__button"><i class="fa fa-bars accent-color" aria-hidden="true"></i><span class="no-mobile">&nbsp;Меню</span></div>
				<div class="nav__menu hidden">
					<div class="menu__header">
						<p class="menu__title">Меню</p>
						<p class="menu__close"><i class="fa fa-times" aria-hidden="true"></i></p>
					</div>
					<?= app\widgets\SearchForm::widget(['formClass' => 'menu__search mobile']); ?>
					<div class="menu__user mobile">
						<?php if( !(!empty($_SESSION['user']) && isset($_SESSION['user'])) ): ?>
						<a href="<?= Url::toRoute(['site/signin']) ?>" class="main-button">Войти</a>
						<?php else: ?>
						<a href="<?= Url::toRoute(['site/logout']) ?>" class="main-button">Выйти</a>
						<?php endif; ?>
						</div>
					<div class="menu__links">
						<a href="<?= Url::toRoute(['recipes/index']) ?>" class="menu__link">
							<span class="link__icon"><i class="fa fa-book" aria-hidden="true"></i></span>
							<span class="link__text">Все рецепты</span>
						</a>
						<a href="<?= Url::toRoute(['articles/index']) ?>" class="menu__link">
							<span class="link__icon"><i class="fa fa-comments-o" aria-hidden="true"></i></span>
							<span class="link__text">Публикации</span>
						</a>
						<a href="<?= Url::toRoute(['news/index']) ?>" class="menu__link">
							<span class="link__icon"><i class="fa fa-newspaper-o" aria-hidden="true"></i></span>
							<span class="link__text">Новости</span>
						</a>

                        <?php if( (!empty($_SESSION['user']) && isset($_SESSION['user'])) ): ?>
                            <a href="<?= Url::toRoute(['site/public']) ?>" class="menu__link">
                                <span class="link__icon"><i class="fa fa-file-text" aria-hidden="true"></i></span>
                                <span class="link__text">Мои публикации</span>
                            </a>
                            <a href="<?= Url::toRoute(['site/settings']) ?>" class="menu__link">
                                <span class="link__icon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                                <span class="link__text">Настройки</span>
                            </a>
                            <a href="<?= Url::toRoute(['site/user', 'id' => $_SESSION['user']['id']]) ?>" class="menu__link">
                                <span class="link__icon"><i class="fa fa-user" aria-hidden="true"></i></span>
                                <span class="link__text">Профиль</span>
                            </a>
						<?php endif; ?>
					</div>
				</div>
			</nav>
		  <?= app\widgets\SearchForm::widget(['formClass' => 'header__search no-mobile']); ?>
			<a href="/" class="header__logo">Sweet Tooth</a>
			<div class="header__user">
				<?php if( !(!empty($_SESSION['user']) && isset($_SESSION['user'])) ): ?>
				<p class="no-mobile" style="margin: 15px 20px;">
					<a href="<?= Url::toRoute(['site/signup']) ?>">Регистрация</a>
					<span class="accent-color">&nbsp;/&nbsp;</span>
					<a href="<?= Url::toRoute(['site/signin']) ?>">Вход</a>
				</p>
				<?php else: ?>
				<p class="no-mobile" style="margin: 15px 20px;">
					<a href="<?= Url::toRoute(['site/logout']) ?>">Выход</a>
				</p>
				<?php endif; ?>
			</div>
		</header>
