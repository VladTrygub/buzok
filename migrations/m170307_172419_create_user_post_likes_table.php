<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_post_likes`.
 */
class m170307_172419_create_user_post_likes_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('user_post_likes', [
            'user_id' => $this->integer()->notNull(),
            'post_id' => $this->integer()->notNull()
        ]);
        $this->addForeignKey('fk-user_post_likes-user-id-user-uid', 'user_post_likes', 'user_id', 'user', 'uid', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk-user_post_likes-post-id-post-id', 'user_post_likes', 'post_id', 'post', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('user_post_likes');
    }
}
