<?php

use yii\db\Migration;

/**
 * Handles the creation of table `book`.
 */
class m170222_144947_create_book_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
      $this->createTable('book', [
        'id' => $this->primaryKey(),
        'author_id' => $this->integer()->defaultValue(null),
        'name' => $this->string()->notNull(),
        'description' => $this->text()->notNull(),
        'img_name' => $this->string()->notNull(),
        'price' => $this->float()->notNull(),
        'literature_id' => $this->integer()->defaultValue(0),
        'theme_id' => $this->integer()->defaultValue(0),
        'style_id' => $this->integer()->defaultValue(0),
        'genre_id' => $this->integer()->defaultValue(0),
        'created_at' => $this->integer()->notNull(),
        'updated_at' => $this->integer()->notNull(),
      ]);
      $this->addForeignKey('fk-book-author-id-user-uid',
        'book', 'author_id',
        'user', 'uid',
        'CASCADE', 'CASCADE');
      $this->addForeignKey('fk-book-literature-id-literature-id', 'book', 'literature_id', 'literature', 'id', 'CASCADE', 'CASCADE');
      $this->addForeignKey('fk-book-theme-id-theme-id', 'book', 'theme_id', 'theme', 'id', 'CASCADE', 'CASCADE');
      $this->addForeignKey('fk-book-style-id-style-id', 'book', 'style_id', 'style', 'id', 'CASCADE', 'CASCADE');
      $this->addForeignKey('fk-book-genre-id-genre-id', 'book', 'genre_id', 'genre', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('book');
    }
}
