<?php
namespace app\widgets;

use Yii;
use app\models\SearchFormModel;

class SearchForm extends \yii\bootstrap\Widget
{
  public $formClass = '';

  public function run()
  {
    $model = new SearchFormModel();
    return $this->render('SearchFormView', [
      'class' => $this->formClass,
      'model' => $model,
    ]);
  }
}
