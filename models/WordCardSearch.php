<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\WordCard;

/**
 * WordCardSearch represents the model behind the search form about `app\models\WordCard`.
 */
class WordCardSearch extends WordCard
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'wordCardSetId', 'chapterId', 'ruleId', 'rulePointId'], 'integer'],
            [['correctWord', 'incorrectWord'], 'safe'],
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
        $query = WordCard::find();

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
            'wordCardSetId' => $this->wordCardSetId,
            'chapterId' => $this->chapterId,
            'ruleId' => $this->ruleId,
            'rulePointId' => $this->rulePointId,
        ]);

        $query->andFilterWhere(['like', 'correctWord', $this->correctWord])
            ->andFilterWhere(['like', 'incorrectWord', $this->incorrectWord]);

        return $dataProvider;
    }
}
