<?php

namespace rbac\admin\models\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use rbac\admin\models\User as UserModel;

/**
 * User represents the model behind the search form about `rbox\admin\models\User`.
 */
class User extends UserModel
{
    public $user_type = '1';
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_at', 'updated_at'], 'integer'],
            [['username','mobile','password_hash', 'password_reset_token', 'email'], 'safe'],
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
        $query = UserModel::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pagesize' => '20',
            ]
        ]);
        $this->load($params);
        //var_dump($this->assignment);exit;
        if (!$this->validate()) {
            $query->where('1=0');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            //'status' => $this->status,
            //'created_at' => $this->created_at,
             //   'auth.item_name' => NULL,
            //'updated_at' => $this->updated_at,
        ]);
        
        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'mobile', $this->mobile])
            //->andFilterWhere(['<>', 'auth.item_name', 'null'])
            ->andFilterWhere(['like', 'email', $this->email]);
        
        return $dataProvider;
    }
}
