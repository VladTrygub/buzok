<?php

use yii\db\Migration;

/**
 * Handles the creation of table `order`.
 */
class m170215_124749_create_order_table extends Migration {
  /**
   * @inheritdoc
   */
  public function up() {
    $this->createTable('order', [
      'id' => $this->primaryKey(),
      'qty' => $this->integer()->notNull()->defaultValue(1),
      'sum' => $this->integer()->notNull(),
      'status' => "ENUM('0', '1')",
      'name' => $this->string()->notNull(),
      'email' => $this->string()->notNull(),
      'phone' => $this->string()->notNull(),
      'address' => $this->string()->notNull(),
      'created_at' => $this->integer()->notNull(),
      'updated_at' => $this->integer()->notNull(),
    ]);
  }

  /**
   * @inheritdoc
   */
  public function down() {
    $this->dropTable('order');
  }
}
