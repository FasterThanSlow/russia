<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wordcard".
 *
 * @property string $id
 * @property string $correctWord
 * @property string $incorrectWord
 * @property string $wordCardSetId
 * @property string $chapterId
 * @property string $ruleId
 * @property string $rulePointId
 *
 * @property Chapter $chapter
 * @property Rule $rule
 * @property Rulepoint $rulePoint
 * @property Wordcardset $wordCardSet
 */
class WordCard extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wordcard';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['wordCardSetId', 'chapterId', 'ruleId', 'rulePointId'], 'required'],
            [['wordCardSetId', 'chapterId', 'ruleId', 'rulePointId'], 'integer'],
            [['correctWord', 'incorrectWord'], 'string', 'max' => 255],
            [['chapterId'], 'exist', 'skipOnError' => true, 'targetClass' => Chapter::className(), 'targetAttribute' => ['chapterId' => 'id']],
            [['ruleId'], 'exist', 'skipOnError' => true, 'targetClass' => Rule::className(), 'targetAttribute' => ['ruleId' => 'id']],
            [['rulePointId'], 'exist', 'skipOnError' => true, 'targetClass' => Rulepoint::className(), 'targetAttribute' => ['rulePointId' => 'id']],
            [['wordCardSetId'], 'exist', 'skipOnError' => true, 'targetClass' => Wordcardset::className(), 'targetAttribute' => ['wordCardSetId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'correctWord' => 'Correct Word',
            'incorrectWord' => 'Incorrect Word',
            'wordCardSetId' => 'Word Card Set ID',
            'chapterId' => 'Chapter ID',
            'ruleId' => 'Rule ID',
            'rulePointId' => 'Rule Point ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChapter()
    {
        return $this->hasOne(Chapter::className(), ['id' => 'chapterId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRule()
    {
        return $this->hasOne(Rule::className(), ['id' => 'ruleId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRulePoint()
    {
        return $this->hasOne(Rulepoint::className(), ['id' => 'rulePointId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWordCardSet()
    {
        return $this->hasOne(Wordcardset::className(), ['id' => 'wordCardSetId']);
    }
}
