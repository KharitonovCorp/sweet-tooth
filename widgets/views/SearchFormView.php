<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<?php $form = ActiveForm::begin([
  'action'=> Url::toRoute(['site/search']),
  'options' => ['class' => $class],
  'fieldConfig' => [
    'template' => '{input}',
  ],
]); ?>
  <?= $form->field($model, 'query', ['options' => ['tag' => false]])->textInput(array('placeholder' => 'Поиск...', 'class'=>'search__input')) ?>
  <?= Html::submitButton('<i class="fa fa-search" aria-hidden="true"></i>', ['class' => 'search__button']) ?>
<?php ActiveForm::end() ?>