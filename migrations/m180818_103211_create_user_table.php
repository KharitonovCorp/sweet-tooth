<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m180818_103211_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'first_name' => $this->string(70),
            'second_name' => $this->string(70),
            'email' => $this->string(70),
            'password' => $this->string(70),
            'permission' => $this->string(70),
            'date_reg' => $this->integer(),
            'bg_image' => $this->string(500),
            'avatar' => $this->string(500),
            'description' => $this->string(2000),
            'social' => $this->string(2000),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('user');
    }
}
