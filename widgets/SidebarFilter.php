<?php
namespace app\widgets;

use Yii;
use app\models\Recipe;

class SidebarFilter extends \yii\bootstrap\Widget
{
  public function run()
  {
    $posts = Recipe::find()->all();
    
    $recipeCuisine = array();
    $recipeCategory = array();
    $cookingMethod = array();
    
    foreach($posts as $post)
    {
      $information = json_decode($post->information);
      if( !in_array($information->recipeCuisine, $recipeCuisine) ) { array_push($recipeCuisine, $information->recipeCuisine); }
      if( !in_array($information->recipeCategory, $recipeCategory) ) { array_push($recipeCategory, $information->recipeCategory); }
      if( !in_array($information->cookingMethod, $cookingMethod) ) { array_push($cookingMethod, $information->cookingMethod); }
    }
    
    return $this->render('SidebarFilterView', [
      'recipeCuisine' => $recipeCuisine,
      'recipeCategory' => $recipeCategory,
      'cookingMethod' => $cookingMethod,
    ]);
  }
}
