<?php
namespace app\models\dataBase;

use Yii;

/**
 * This is the model class for table "short_url".
 *
 * @property integer $sc_id
 * @property string $sc_code
 */
class ShortCode extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'short_code';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sc_code'], 'string', 'max' => 10],
            [['sc_code'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'sc_id' => 'ID',
            'sc_code' => 'Short Code',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLinks()
    {
        return $this->hasMany(Links::className(), ['l_short_code_id' => 'sc_id']);
    }
}
