<?php

namespace volunteers\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use volunteers\models\MembershipIndividualProfiles;

/**
 * MembershipIndividualProfilesSearch represents the model behind the search form of `volunteers\models\MembershipIndividualProfiles`.
 */
class MembershipIndividualProfilesSearch extends MembershipIndividualProfiles
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'genderId', 'membershipUserId', 'countryId', 'passport', 'IdNo', 'membershipstatusId', 'membershipTypeId', 'ngoId', 'MembershipApprovalStatusId', 'deleted', 'createdBy'], 'integer'],
            [['telephoneNo', 'email', 'physicalAddress', 'firstname', 'otherNames', 'lastName', 'dateOfBirth', 'effectiveDate', 'expiryDate', 'comments', 'createdTime', 'updatedTime', 'deletedTime'], 'safe'],
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
        $query = MembershipIndividualProfiles::find();

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
            'membershipUserId' => $this->membershipUserId,
            'countryId' => $this->countryId,
            'passport' => $this->passport,
            'IdNo' => $this->IdNo,
            'membershipstatusId' => $this->membershipstatusId,
            'membershipTypeId' => $this->membershipTypeId,
            'ngoId' => $this->ngoId,
            'MembershipApprovalStatusId' => $this->MembershipApprovalStatusId,
            'effectiveDate' => $this->effectiveDate,
            'expiryDate' => $this->expiryDate,
            'createdTime' => $this->createdTime,
            'updatedTime' => $this->updatedTime,
            'deleted' => $this->deleted,
            'deletedTime' => $this->deletedTime,
            'createdBy' => $this->createdBy,
        ]);

        $query->andFilterWhere(['like', 'telephoneNo', $this->telephoneNo])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'physicalAddress', $this->physicalAddress])
            ->andFilterWhere(['like', 'firstname', $this->firstname])
            ->andFilterWhere(['like', 'otherNames', $this->otherNames])
            ->andFilterWhere(['like', 'lastName', $this->lastName])
            ->andFilterWhere(['like', 'comments', $this->comments]);

        return $dataProvider;
    }
}
