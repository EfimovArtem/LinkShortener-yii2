<?php
namespace app\models\shortLink;

use yii\base\Model;

class ShortLinkForm extends Model
{
    public $sUrl;

    protected $errorMessage;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['sUrl'], 'required', 'message' => 'Field link cannot be blank'],
            ['sUrl', 'validateLink'],
        ];
    }

    /**
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validateLink($attribute, $params)
    {
        if (!$this->hasErrors()) {
            if (!$this->checkExistence()) {
                $this->addError($attribute, $this->errorMessage);
            }
        }
    }

    protected function checkExistence()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->sUrl);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_exec($ch);
        $response = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if (!empty($response) && $response != 404) {
            return true;
        }
        $this->errorMessage = 'Entered link does not exist or is not available at the moment';
        return false;
    }
}