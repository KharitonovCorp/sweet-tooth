<?php

use yii\db\Migration;

/**
 * Handles the creation of table `recipe`.
 */
class m180720_135811_create_recipe_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('recipe', [
            'id' => $this->primaryKey(),
            'post_type' => $this->string(7),
            'meta_title' => $this->string(70),
            'meta_description' => $this->string(160),
            'meta_keywords' => $this->string(),
            'name' => $this->string(70),
            'description' => $this->string(160),
            'image' => $this->string(),
            'information' => $this->text(),
            'ingredients' => $this->text(),
            'steps' => 'LONGTEXT',
            'author_id' => $this->integer(),
            'date_created' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('recipe');
    }
}
