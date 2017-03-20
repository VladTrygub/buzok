<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_comment_rates_up`.
 */
class m170309_160142_create_user_comment_rates_up_table extends Migration {
  /**
   * @inheritdoc
   */
  public function up() {
    $this->createTable('user_comment_rates_up', [
      'comment_id' => $this->integer()->notNull(),
      'user_id' => $this->integer()->notNull(),
    ]);
    $this->addForeignKey('fk-user_comment_rates_up-comment_id-comment-id', 'user_comment_rates_up', 'comment_id', 'comment', 'id', 'CASCADE', 'CASCADE');
    $this->addForeignKey('fk-user_comment_rates_up-user_id-user-uid', 'user_comment_rates_up', 'user_id', 'user', 'uid', 'CASCADE', 'CASCADE');
  }

  /**
   * @inheritdoc
   */
  public function down() {
    $this->dropTable('user_comment_rates_up');
  }
}
