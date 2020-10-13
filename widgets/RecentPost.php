<?php
namespace app\widgets;

use Yii;

class RecentPost extends \yii\bootstrap\Widget
{
  public $typePage = '';

  public $idPage = 0;

  public function widgetTitle()
  {
    switch($this->typePage)
    {
      case 'recipes': return 'Последние рецепты';
      case 'articles': return 'Последние статьи';
      case 'news': return 'Последние новости';
      default: return false;
    }
  }

  public function run()
  {
    return $this->render('RecentPostView', [
      'widgetTitle' => $this->widgetTitle(),
      'id' => $this->idPage,
    ]);
  }
}
