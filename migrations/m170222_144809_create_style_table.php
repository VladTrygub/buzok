<?php

use yii\db\Migration;

/**
 * Handles the creation of table `style`.
 */
class m170222_144809_create_style_table extends Migration {
  /**
   * @inheritdoc
   */
  public function up() {
    $this->createTable('style', [
      'id' => $this->primaryKey(),
      'name' => $this->string()->notNull(),
    ]);
  }

  /**
   * @inheritdoc
   */
  public function down() {
    $this->dropTable('style');
  }
}
