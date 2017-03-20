<?php

use yii\db\Migration;

/**
 * Handles the creation of table `order_books`.
 */
class m170222_145831_create_order_books_table extends Migration {
  /**
   * @inheritdoc
   */
  public function up() {
    $this->createTable('order_books', [
      'id' => $this->primaryKey(),
      'order_id' => $this->integer()->notNull(),
      'book_id' => $this->integer()->notNull(),
      'book_name' => $this->string()->notNull(),
      'book_price' => $this->string()->notNull(),
      'qty_book' => $this->integer()->notNull()->defaultValue(1),
    ]);
    $this->addForeignKey('fk-order-books-order-id-order-id', 'order_books', 'order_id', 'order', 'id', 'CASCADE', 'CASCADE');
    $this->addForeignKey('fk-order-books-book-id-book-id', 'order_books', 'book_id', 'book', 'id', 'CASCADE', 'CASCADE');
  }

  /**
   * @inheritdoc
   */
  public function down() {
    $this->dropTable('order_books');
  }
}
