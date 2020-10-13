<?php

use yii\db\Migration;

/**
 * Handles the creation of table `article`.
 */
class m180720_135824_create_article_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('article', [
            'id' => $this->primaryKey(),
            'post_type' => $this->string(8),
            'meta_title' => $this->string(70),
            'meta_description' => $this->string(160),
            'meta_keywords' => $this->string(),
            'name' => $this->string(70),
            'description' => $this->string(160),
            'image' => $this->string(),
            'content' => 'LONGTEXT',
            'author_id' => $this->integer(),
            'date_created' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('article');
    }
}
