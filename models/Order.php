<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property integer $id
 * @property integer $qty
 * @property integer $sum
 * @property integer $status
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $address
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property OrderBooks[] $orderBooks
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['qty', 'sum', 'status', 'created_at', 'updated_at'], 'integer'],
            [['sum', 'name', 'email', 'phone', 'address', 'created_at', 'updated_at'], 'required'],
            [['name', 'email', 'phone', 'address'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'qty' => 'Qty',
            'sum' => 'Sum',
            'status' => 'Status',
            'name' => 'Name',
            'email' => 'Email',
            'phone' => 'Phone',
            'address' => 'Address',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderBooks()
    {
        return $this->hasMany(OrderBooks::className(), ['order_id' => 'id']);
    }
}
