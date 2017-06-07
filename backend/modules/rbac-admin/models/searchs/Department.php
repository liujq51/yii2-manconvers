<?php

namespace rbac\admin\models\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use rbac\admin\models\Department as DepartmentModel;

/**
 * User represents the model behind the search form about `rbox\admin\models\User`.
 */
class Department extends DepartmentModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['dep_name'], 'string', 'max' => 100],
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
        $query = DepartmentModel::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pagesize' => '20',
            ]
        ]);
        if(empty($params['sort'])){
            $query->orderBy(['id' => SORT_DESC]);
        }
        $this->load($params);
        //var_dump($this->assignment);exit;
        if (!$this->validate()) {
            $query->where('1=0');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            //'created_at' => $this->created_at,
             //   'auth.item_name' => NULL,
            //'updated_at' => $this->updated_at,
        ]);
        
        $query->andFilterWhere(['like', 'dep_name', $this->dep_name]);
            //->andFilterWhere(['<>', 'auth.item_name', 'null'])
            //->andFilterWhere(['like', 'email', $this->email]);
        
        return $dataProvider;
    }
}
