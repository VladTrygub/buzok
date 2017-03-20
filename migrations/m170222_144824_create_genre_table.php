<?php

use yii\db\Migration;

/**
 * Handles the creation of table `genre`.
 */
class m170222_144824_create_genre_table extends Migration {
  /**
   * @inheritdoc
   */
  public function up() {
    $this->createTable('genre', [
      'id' => $this->primaryKey(),
      'name' => $this->string()->notNull(),
    ]);
  }

  /**
   * @inheritdoc
   */
  public function down() {
    $this->dropTable('genre');
  }
}
