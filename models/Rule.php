<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rule".
 *
 * @property string $id
 * @property string $title
 * @property string $chapterId
 *
 * @property Chapter $chapter
 * @property Rulepoint[] $rulepoints
 * @property Wordcard[] $wordcards
 * @property Wordcardset[] $wordcardsets
 */
class Rule extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rule';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'chapterId'], 'required'],
            [['chapterId'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['chapterId'], 'exist', 'skipOnError' => true, 'targetClass' => Chapter::className(), 'targetAttribute' => ['chapterId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'chapterId' => 'Chapter ID',
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
    public function getRulepoints()
    {
        return $this->hasMany(Rulepoint::className(), ['ruleId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWordcards()
    {
        return $this->hasMany(Wordcard::className(), ['ruleId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWordcardsets()
    {
        return $this->hasMany(Wordcardset::className(), ['ruleId' => 'id']);
    }
}
