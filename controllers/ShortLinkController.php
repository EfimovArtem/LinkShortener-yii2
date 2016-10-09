<?php

namespace app\controllers;

use app\models\shortLink\ShortLinkForm;
use app\models\shortLink\UrlManager;
use yii\web\Controller;
use yii\web\Response;
use yii\widgets\ActiveForm;

class ShortLinkController extends Controller
{

    public $layout = 'main';

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }

    public function actionIndex()
    {
        return $this->redirect('generate-short-link');
    }

    public function actionGenerateShortLink()
    {
        $oModel = new ShortLinkForm();
        if (\Yii::$app->request->isAjax && $oModel->load(\Yii::$app->request->post())) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            $aResult = ActiveForm::validate($oModel);
            if (count($aResult) > 0) {
                $aResponse = [];
                $aResponse['status'] = 'error';
                $aResponse['messages'] = $aResult;
                return $aResponse;
            }
            return UrlManager::getShortLink($oModel);
        }
        if ($oModel->load(\Yii::$app->request->post())) {
        }
        return $this->render('generateShortLink', [
                'oModel' => $oModel,
            ]
        );
    }

    public function actionForward($sUrl)
    {
        $sLongLink = UrlManager::getLongLink($sUrl);
        if (!is_null($sLongLink)) {
            $this->redirect($sLongLink);
        }


    }
}
