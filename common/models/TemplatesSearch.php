<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Templates;

/**
 * TemplatesSearch represents the model behind the search form of `common\models\Templates`.
 */
class TemplatesSearch extends Templates
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['templateId', 'deleted', 'createdBy'], 'integer'],
            [['code', 'templateName', 'subject', 'message', 'comments', 'createdTime', 'updatedTime', 'deletedTime'], 'safe'],
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
        $query = Templates::find();

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
            'templateId' => $this->templateId,
            'createdTime' => $this->createdTime,
            'updatedTime' => $this->updatedTime,
            'deleted' => $this->deleted,
            'deletedTime' => $this->deletedTime,
            'createdBy' => $this->createdBy,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'templateName', $this->templateName])
            ->andFilterWhere(['like', 'subject', $this->subject])
            ->andFilterWhere(['like', 'message', $this->message])
            ->andFilterWhere(['like', 'comments', $this->comments]);

        return $dataProvider;
    }
}
