<div class="filter__mobile-btn mobile"><i class="fa fa-filter" aria-hidden="true"></i></div>
					<div class="sidebar__filter block hidden">
						<h2 class="filter__title">Фильтр</h2>
						<div class="filter__category">
							<div class="f-category__title">Кухня<div class="f-category__menu-icon"></div></div>
							<div class="f-category__menu">
                <?php foreach ($recipeCuisine as $elem): ?>
								<label class="f-category__item">
									<input type="checkbox" class="f-item__input">
									<div class="f-item__icon">
										<div class="f-item__icon-checked"></div>
									</div>
									<span class="f-item__text"><?= $elem ?></span>
								</label>
								<?php endforeach; ?>
							</div>
						</div>
						<div class="filter__category">
							<div class="f-category__title">Категория рецепта<div class="f-category__menu-icon"></div></div>
							<div class="f-category__menu">
                <?php foreach ($recipeCategory as $elem): ?>
								<label class="f-category__item">
									<input type="checkbox" class="f-item__input">
									<div class="f-item__icon">
										<div class="f-item__icon-checked"></div>
									</div>
									<span class="f-item__text"><?= $elem ?></span>
								</label>
								<?php endforeach; ?>
							</div>
						</div>
						<div class="filter__category">
							<div class="f-category__title">Способ приготовления<div class="f-category__menu-icon"></div></div>
							<div class="f-category__menu">
                <?php foreach ($cookingMethod as $elem): ?>
								<label class="f-category__item">
									<input type="checkbox" class="f-item__input">
									<div class="f-item__icon">
										<div class="f-item__icon-checked"></div>
									</div>
									<span class="f-item__text"><?= $elem ?></span>
								</label>
								<?php endforeach; ?>
							</div>
						</div>
						<div class="filter__category">
							<div class="f-category__title">Сложность<div class="f-category__menu-icon"></div></div>
							<div class="f-category__menu">
								<label class="f-category__item">
									<input type="checkbox" class="f-item__input">
									<div class="f-item__icon">
										<div class="f-item__icon-checked"></div>
									</div>
									<span class="f-item__text">Легко</span>
								</label>
								<label class="f-category__item">
									<input type="checkbox" class="f-item__input">
									<div class="f-item__icon">
										<div class="f-item__icon-checked"></div>
									</div>
									<span class="f-item__text">Средне</span>
								</label>
								<label class="f-category__item">
									<input type="checkbox" class="f-item__input">
									<div class="f-item__icon">
										<div class="f-item__icon-checked"></div>
									</div>
									<span class="f-item__text">Сложно</span>
								</label>
							</div>
						</div>
						<div class="filter__category">
							<div class="f-category__title">Время приготовления<div class="f-category__menu-icon"></div></div>
							<div class="f-category__menu">
								<label class="f-category__item">
									<input type="checkbox" class="f-item__input">
									<div class="f-item__icon">
										<div class="f-item__icon-checked"></div>
									</div>
									<span class="f-item__text">до 10 минут</span>
								</label>
								<label class="f-category__item">
									<input type="checkbox" class="f-item__input">
									<div class="f-item__icon">
										<div class="f-item__icon-checked"></div>
									</div>
									<span class="f-item__text">от 10 до 30 минут</span>
								</label>
								<label class="f-category__item">
									<input type="checkbox" class="f-item__input">
									<div class="f-item__icon">
										<div class="f-item__icon-checked"></div>
									</div>
									<span class="f-item__text">от 30 до 60 минут</span>
								</label>
								<label class="f-category__item">
									<input type="checkbox" class="f-item__input">
									<div class="f-item__icon">
										<div class="f-item__icon-checked"></div>
									</div>
									<span class="f-item__text">от 1 до 2 часов</span>
								</label>
								<label class="f-category__item">
									<input type="checkbox" class="f-item__input">
									<div class="f-item__icon">
										<div class="f-item__icon-checked"></div>
									</div>
									<span class="f-item__text">более 2 часов</span>
								</label>
							</div>
						</div>
					</div>