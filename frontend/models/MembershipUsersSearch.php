<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\MembershipUsers;

/**
 * MembershipUsersSearch represents the model behind the search form of `frontend\models\MembershipUsers`.
 */
class MembershipUsersSearch extends MembershipUsers
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'membershipProfileId', 'deleted', 'createdBy'], 'integer'],
            [['username', 'firstname', 'othernames', 'lastnames', 'email', 'password', 'comments', 'createdTime', 'updatedTime', 'deletedTime'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = MembershipUsers::find();

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
            'membershipProfileId' => $this->membershipProfileId,
            'createdTime' => $this->createdTime,
            'updatedTime' => $this->updatedTime,
            'deleted' => $this->deleted,
            'deletedTime' => $this->deletedTime,
            'createdBy' => $this->createdBy,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'firstname', $this->firstname])
            ->andFilterWhere(['like', 'othernames', $this->othernames])
            ->andFilterWhere(['like', 'lastnames', $this->lastnames])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'comments', $this->comments]);

        return $dataProvider;
    }
}
