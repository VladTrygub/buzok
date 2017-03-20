<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order_books".
 *
 * @property integer $id
 * @property integer $order_id
 * @property integer $book_id
 * @property string $book_name
 * @property string $book_price
 * @property integer $qty_book
 *
 * @property Book $book
 * @property Order $order
 */
class OrderBooks extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_books';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'book_id', 'book_name', 'book_price'], 'required'],
            [['order_id', 'book_id', 'qty_book'], 'integer'],
            [['book_name', 'book_price'], 'string', 'max' => 255],
            [['book_id'], 'exist', 'skipOnError' => true, 'targetClass' => Book::className(), 'targetAttribute' => ['book_id' => 'id']],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['order_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Order ID',
            'book_id' => 'Book ID',
            'book_name' => 'Book Name',
            'book_price' => 'Book Price',
            'qty_book' => 'Qty Book',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBook()
    {
        return $this->hasOne(Book::className(), ['id' => 'book_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id' => 'order_id']);
    }
}
