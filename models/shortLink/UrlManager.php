<?php
namespace app\models\shortLink;

use app\models\dataBase\ShortCode;
use app\models\dataBase\Links;
use app\models\shortLink\ShortLinkForm;
use yii\base\Exception;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\web\NotAcceptableHttpException;
use yii\helpers\Url;

class UrlManager
{
    private static $sChars = '0123456789ABCDEFGHIJKLMNOPQRSTUWXYZabcdefghijklmnopqrstuwxyz';
    public $sCode;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['sCode'], 'required', 'message' => 'Error'],
            ['sCode', ''],
        ];
    }

    public static function getShortLink(ShortLinkForm $oModel)
    {

        if (!$oModel instanceof ShortLinkForm) {
            throw new Exception('"$oModel" is not an instance of a class "ShortLinkForm"');
        }
        $oModel->sUrl = (strpos($oModel->sUrl, '://') === false) ? 'http://' . $oModel->sUrl : $oModel->sUrl;

        $oModelLinks = Links::find()->joinWith('shortCode')->where(['l_link' => $oModel->sUrl])->one();
        if (is_null($oModelLinks)) {
            self::setLink($oModel);
            $oModelLinks = Links::find()->joinWith('shortCode')->where(['l_link' => $oModel->sUrl])->one();
        }

        return Url::canonical() . $oModelLinks->shortCode->sc_code;
    }


    protected static function setLink(ShortLinkForm $oModel)
    {
        if (!$oModel instanceof ShortLinkForm) {
            throw new Exception('"$oModel" is not an instance of a class "ShortLinkForm"');
        }

        $sCode = self::generateCode();

        $oModelShortCode = new ShortCode();
        $oModelShortCode->sc_code = $sCode;
        do {
            $oModelShortCode->save();
        } while (is_null($oModelShortCode->sc_id));
        $oModelLinks = new Links();
        $oModelLinks->l_link = $oModel->sUrl;
        $oModelLinks->l_short_code_id = $oModelShortCode->sc_id;
        $oModelLinks->save();

    }

    public static function getLongLink($sCode)
    {
        if (!preg_match('|^[0-9a-zA-Z]{6,6}$|', $sCode)) {
            throw new HttpException(400, 'Please enter valid short code');
        }
        $oModelShortCode = ShortCode::find()->where(['sc_code' => $sCode])->one();
        if (is_null($oModelShortCode)) {
            throw new NotFoundHttpException('This short code not found:' . $sCode);
        } else {
            $oModelLinks = Links::find()->where(['l_short_code_id' => $oModelShortCode->sc_id])->one();
            return $oModelLinks->l_link;
        }

    }

    public static function generateCode()
    {
        $i = 0;
        $sCode = NULL;
 
        while (++$i < 10) {
            $sCode = substr(str_shuffle(self::$sChars), 1, 6);
            $oModelShortCode = ShortCode::find()->where(['sc_code' => $sCode])->one();
            if (is_null($oModelShortCode)) {
                return $sCode;
            }
        }
 
       throw new Exception('Unable to shorten the link, try again');
    }
}
