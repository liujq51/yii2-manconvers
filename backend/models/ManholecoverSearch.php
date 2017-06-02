<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Manholecover;

/**
 * AppSearch represents the model behind the search form about `admin\models\App`.
 */
class ManholecoverSearch extends Manholecover
{
    public $province;
    public $city;
    public $area;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cover_id', 'status'], 'integer'],
            [['province','city','area'],'string'],
            [['cover_name','remark', 'createat', 'updateat'], 'safe'],
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
        $query = Manholecover::find()->where(['>=','status',-1])->joinWith(['province as p']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pagesize' => '20',
            ]
        ]);
       $dataProvider->setSort([
            'attributes' => [
                'cover_id' => [
                    'asc' => ['cover_id' => SORT_ASC],
                    'desc' => ['cover_id' => SORT_DESC],
                ],
                'cover_name' => [
                    'asc' => ['cover_name' => SORT_ASC],
                    'desc' => ['cover_name' => SORT_DESC],
                ],
                'province' => [
                    'asc' => ['p.province' => SORT_ASC],
                    'desc' => ['p.province' => SORT_DESC],
                ],
                'city' => [
                    'asc' => ['c.city' => SORT_ASC],
                    'desc' => ['c.city' => SORT_DESC],
                ],
                'area' => [
                    'asc' => ['a.area' => SORT_ASC],
                    'desc' => ['a.area' => SORT_DESC],
                ],
            ]
        ]);
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'cover_id' => $this->cover_id,
            'status' => $this->status,
            'createat' => $this->createat,
            'updateat' => $this->updateat,
        ]);

        $query->andFilterWhere(['like', 'cover_name', $this->cover_name])
            ->andFilterWhere(['like', 'p.province', $this->province])
            ->andFilterWhere(['like', 'remark', $this->remark]);

        return $dataProvider;
    }
}
