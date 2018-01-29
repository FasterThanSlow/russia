<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "chapter".
 *
 * @property string $id
 * @property string $title
 *
 * @property Rule[] $rules
 * @property Wordcard[] $wordcards
 * @property Wordcardset[] $wordcardsets
 */
class Chapter extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'chapter';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'string', 'max' => 255],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRules()
    {
        return $this->hasMany(Rule::className(), ['chapterId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWordcards()
    {
        return $this->hasMany(Wordcard::className(), ['chapterId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWordcardsets()
    {
        return $this->hasMany(Wordcardset::className(), ['chapterId' => 'id']);
    }
    
}
