<?php

use yii\db\Migration;

/**
 * Handles the creation of table `comment`.
 */
class m170307_193506_create_comment_table extends Migration {
  /**
   * @inheritdoc
   */
  public function up() {
    $this->createTable('comment', [
      'id' => $this->primaryKey(),
      'user_id' => $this->integer()->notNull(),
      'post_id' => $this->integer()->notNull(),
      'likes' => $this->integer()->notNull()->defaultValue(0),
      'dislikes' => $this->integer()->notNull()->defaultValue(0),
      'created_at' => $this->integer()->notNull(),
      'updated_at' => $this->integer()->notNull(),
    ]);
    $this->addForeignKey('fk-comment-user-id-user-uid', 'comment', 'user_id', 'user', 'uid', 'CASCADE', 'CASCADE');
    $this->addForeignKey('fk-comment-post-id-post-id', 'comment', 'post_id', 'post', 'id', 'CASCADE', 'CASCADE');
  }

  /**
   * @inheritdoc
   */
  public function down() {
    $this->dropTable('comment');
  }
}
