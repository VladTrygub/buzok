<?php

use yii\db\Migration;

/**
 * Handles the creation of table `post`.
 */
class m170210_120236_create_post_table extends Migration {
  /**
   * @inheritdoc
   */
  public function up() {
    $this->createTable('post', [
      'id' => $this->primaryKey(),
      'author_id' => $this->integer()->notNull(),
      'title' => $this->string()->notNull(),
      'img_name' => $this->string()->notNull(),
      'text' => $this->text()->notNull(),
      'likes' => $this->integer()->notNull()->defaultValue(0),
      'count_comments' => $this->integer()->notNull()->defaultValue(0),
      'created_at' => $this->integer()->notNull(),
      'updated_at' => $this->integer()->notNull(),
    ]);
    $this->addForeignKey('fk-post-author-id-user-uid', 'post', 'author_id', 'user', 'uid', 'CASCADE', 'CASCADE');
  }
  
  /**
   * @inheritdoc
   */
  public function down() {
    $this->dropTable('post');
  }
}
