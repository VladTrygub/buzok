<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\OrderBooks;

/**
 * OrderBooksSearch represents the model behind the search form about `app\models\OrderBooks`.
 */
class OrderBooksSearch extends OrderBooks
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'order_id', 'book_id', 'qty_book'], 'integer'],
            [['book_name', 'book_price'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = OrderBooks::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'order_id' => $this->order_id,
            'book_id' => $this->book_id,
            'qty_book' => $this->qty_book,
        ]);

        $query->andFilterWhere(['like', 'book_name', $this->book_name])
            ->andFilterWhere(['like', 'book_price', $this->book_price]);

        return $dataProvider;
    }
}
