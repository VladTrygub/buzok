<?php

use yii\db\Migration;

class m161202_135514_createTablesUserAndAuth extends Migration {

  public function up() {
    $this->createTable('user', [
      'uid' => $this->primaryKey(),
      'uname' => $this->string()->notNull()->unique(),
      'password' => $this->string(),
      'email' => $this->string()->unique(),
      'img_name' => $this->string(),
      'gender' => $this->string(),
      'user_status' => $this->smallInteger()->notNull()->defaultValue(0),
      'isAdmin'=>$this->integer()->defaultValue(0),
      'created_at' => $this->integer()->notNull(),
      'updated_at' => $this->integer()->notNull(),
    ]);
    $this->createTable('auth', [
      'id' => $this->primaryKey(),
      'user_id' => $this->integer()->notNull(),
      'auth_key' => $this->string()->notNull(),
      'source' => $this->string()->notNull(),
      'source_id' => $this->string()->notNull(),
    ]);
    $this->addForeignKey('fk-auth-user-id-user-uid', 'auth', 'user_id', 'user', 'uid', 'CASCADE', 'CASCADE');
  }

  public function down() {
    $this->dropTable('auth');
    $this->dropTable('user');
  }

  /*
  // Use safeUp/safeDown to run migration code within a transaction
  public function safeUp()
  {
  }

  public function safeDown()
  {
  }
  */
}
