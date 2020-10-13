<?php

use yii\db\Migration;

/**
 * Handles the creation of table `news`.
 */
class m180720_135833_create_news_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('news', [
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
        $this->dropTable('news');
    }
}
