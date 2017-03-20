<?php

use yii\db\Migration;

/**
 * Handles the creation of table `theme`.
 */
class m170222_144801_create_theme_table extends Migration {
  /**
   * @inheritdoc
   */
  public function up() {
    $this->createTable('theme', [
      'id' => $this->primaryKey(),
      'name' => $this->string()->notNull(),
    ]);
  }

  /**
   * @inheritdoc
   */
  public function down() {
    $this->dropTable('theme');
  }
}
