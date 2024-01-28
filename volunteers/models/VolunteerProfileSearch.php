<?php

namespace volunteers\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use volunteers\models\VolunteerProfile;

/**
 * VolunteerProfileSearch represents the model behind the search form of `volunteers\models\VolunteerProfile`.
 */
class VolunteerProfileSearch extends VolunteerProfile
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'genderId', 'volunteerUserId', 'userId', 'countryId', 'passport', 'IdNo', 'availabilityId', 'deleted', 'createdBy'], 'integer'],
            [['telephoneNo', 'email', 'physicalAddress', 'firstName', 'otherNames', 'lastNames', 'dateOfBirth', 'comments', 'createdTime', 'updatedTime', 'deletedTime'], 'safe'],
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
        $query = VolunteerProfile::find();

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
            'dateOfBirth' => $this->dateOfBirth,
            'genderId' => $this->genderId,
            'volunteerUserId' => $this->volunteerUserId,
            'userId' => $this->userId,
            'countryId' => $this->countryId,
            'passport' => $this->passport,
            'IdNo' => $this->IdNo,
            'availabilityId' => $this->availabilityId,
            'createdTime' => $this->createdTime,
            'updatedTime' => $this->updatedTime,
            'deleted' => $this->deleted,
            'deletedTime' => $this->deletedTime,
            'createdBy' => $this->createdBy,
        ]);

        $query->andFilterWhere(['like', 'telephoneNo', $this->telephoneNo])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'physicalAddress', $this->physicalAddress])
            ->andFilterWhere(['like', 'firstName', $this->firstName])
            ->andFilterWhere(['like', 'otherNames', $this->otherNames])
            ->andFilterWhere(['like', 'lastNames', $this->lastNames])
            ->andFilterWhere(['like', 'comments', $this->comments]);

        return $dataProvider;
    }
}
