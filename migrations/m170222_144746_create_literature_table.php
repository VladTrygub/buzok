<?php

use yii\db\Migration;

/**
 * Handles the creation of table `literature`.
 */
class m170222_144746_create_literature_table extends Migration {
  /**
   * @inheritdoc
   */
  public function up() {
    $this->createTable('literature', [
      'id' => $this->primaryKey(),
      'name' => $this->string()->notNull(),
    ]);
  }

  /**
   * @inheritdoc
   */
  public function down() {
    $this->dropTable('literature');
  }
}
