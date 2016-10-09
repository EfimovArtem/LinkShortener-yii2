<?php
namespace app\models\dataBase;

use Yii;

/**
 * This is the model class for table "links".
 *
 * @property integer $l_id
 * @property string $l_link
 * @property integer $l_short_code
 */
class Links extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'links';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['l_short_code_id'], 'integer'],
            [['l_link'], 'string', 'max' => 250],
            [['l_link'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'l_id' => 'ID',
            'l_link' => 'Long Link',
            'l_short_code_id' => 'Short Code ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShortCode()
    {
        return $this->hasOne(ShortCode::className(), ['sc_id' => 'l_short_code_id']);
    }
}
