<?php

namespace volunteers\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use volunteers\models\JobApplication;

/**
 * JobApplicationSearch represents the model behind the search form of `volunteers\models\JobApplication`.
 */
class JobApplicationSearch extends JobApplication
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'volunteerProfileId', 'jobListingId', 'approvalStatusId', 'deleted', 'createdBy'], 'integer'],
            [['comments', 'createdTime', 'updatedTime', 'deletedTime'], 'safe'],
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
        $query = JobApplication::find();

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
            'volunteerProfileId' => $this->volunteerProfileId,
            'jobListingId' => $this->jobListingId,
            'approvalStatusId' => $this->approvalStatusId,
            'createdTime' => $this->createdTime,
            'updatedTime' => $this->updatedTime,
            'deleted' => $this->deleted,
            'deletedTime' => $this->deletedTime,
            'createdBy' => $this->createdBy,
        ]);

        $query->andFilterWhere(['like', 'comments', $this->comments]);

        return $dataProvider;
    }
}
