<?php

use yii\db\Migration;

/**
 * Handles the creation of table `our_author_books`.
 */
class m170315_163537_create_our_author_books_table extends Migration {
  /**
   * @inheritdoc
   */
  public function up() {
    $this->createTable('our_author_books', [
      'id' => $this->primaryKey(),
      'author_id' => $this->integer()->notNull(),
      'book_id' => $this->integer()->defaultValue(null),
      'name' => $this->string()->notNull(),
      'description' => $this->text()->defaultValue(null),
      'text' => $this->text()->defaultValue(null),
      'created_at' => $this->integer()->notNull(),
      'updated_at' => $this->integer()->notNull(),
    ]);

    $this->addForeignKey('fk-our_author_books-author-id-user-uid',
      'our_author_books', 'author_id',
      'user', 'uid',
      'CASCADE', 'CASCADE');
    $this->addForeignKey('fk-our_author_books-author_id-book-id',
      'our_author_books', 'book_id',
      'book', 'id',
      'CASCADE', 'CASCADE');
  }

  /**
   * @inheritdoc
   */
  public function down() {
    $this->dropTable('our_author_books');
  }
}
