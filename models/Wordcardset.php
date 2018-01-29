<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wordcardset".
 *
 * @property string $id
 * @property string $size
 * @property string $ruleId
 *
 * @property Wordcard[] $wordcards
 * @property Rule $rule
 */
class Wordcardset extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wordcardset';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['size', 'ruleId'], 'integer'],
            [['ruleId'], 'required'],
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
            'size' => 'Size',
            'ruleId' => 'Rule ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWordcards()
    {
        return $this->hasMany(Wordcard::className(), ['wordCardSetId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRule()
    {
        return $this->hasOne(Rule::className(), ['id' => 'ruleId']);
    }
}
