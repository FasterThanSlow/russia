<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rulepoint".
 *
 * @property string $id
 * @property string $title
 * @property string $description
 * @property string $ruleId
 *
 * @property Rule $rule
 * @property Wordcard[] $wordcards
 * @property Wordcardset[] $wordcardsets
 */
class RulePoint extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rulepoint';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'description', 'ruleId'], 'required'],
            [['description'], 'string'],
            [['ruleId'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['ruleId'], 'exist', 'skipOnError' => true, 'targetClass' => Rule::className(), 'targetAttribute' => ['ruleId' => 'id']],
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
            'description' => 'Description',
            'ruleId' => 'Rule ID',
        ];
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
    public function getWordcards()
    {
        return $this->hasMany(Wordcard::className(), ['rulePointId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWordcardsets()
    {
        return $this->hasMany(Wordcardset::className(), ['rulePointId' => 'id']);
    }
}
