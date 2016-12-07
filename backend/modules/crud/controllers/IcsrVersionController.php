<?php

namespace backend\modules\crud\controllers;
use Aws\CloudFront\Exception\Exception;
use Swift_RfcComplianceException;
use Yii;

/**
* This is the class for controller "IcsrVersionController".
*/
class IcsrVersionController extends \backend\modules\crud\controllers\base\IcsrVersionController
{
    public function actionCreateEmail($xmlUrl,$icsrId)
    {

        return $this->render('create-email',['xmlUrl' => $xmlUrl,'icsrId' => $icsrId]);

    }

    public function actionSendEmail ()
    {


        $request = Yii::$app->request;

        $xmlFilePath = Yii::getAlias('@webroot').substr($request->post('xmlUrl'),strpos($request->post('xmlUrl'),'/files'));
        $additionalInfo = $request->post('additionalInfo');
        $senderEmail = \Yii::$app->user->identity->email;
        $sendToEmail = $request->post('email');
        $senderCompanyName = \Yii::$app->user->identity->company->name;

        if (!isset($sendToEmail) || empty($sendToEmail))
        {
            \Yii::$app->getSession()->setFlash('error', \Yii::t('app',"Email Can't Be Empty"));
            return $this->redirect(\Yii::$app->request->referrer);
        }

        if (file_exists($xmlFilePath)) {
            try {
                if (\Swift_Validate::email($sendToEmail) == 1) {
                    Yii::$app->mailer->compose('xmlEmail', ['additionalInfo' => $additionalInfo, 'senderCompanyName' => $senderCompanyName])
                        ->setFrom('yiiyaktest@gmail.com')
                        ->setTo($sendToEmail)
                        ->setSubject('Xml File')
                        ->setReplyTo($senderEmail)
                        ->attach($xmlFilePath)
                        ->send();
                }
                else
                {
                    \Yii::$app->getSession()->setFlash('error', \Yii::t('app',"Please Write A Valid Email "));
                    return $this->redirect(\Yii::$app->request->referrer);
                }
            }
            catch (Swift_RfcComplianceException $e)
            {
                \Yii::$app->getSession()->setFlash('error', \Yii::t('app',"Can't Send Email Right Now Try Again Later "));
                return $this->redirect(\Yii::$app->request->referrer);
            }
            \Yii::$app->getSession()->setFlash('success', \Yii::t('app',"Email Sent Successfully"));
            return $this->redirect(['/crud/icsr/view','id' => $request->post('icsrId')]);
        }

        \Yii::$app->getSession()->setFlash('error', \Yii::t('app',"XML File Is No Longer Exist "));
        return $this->redirect(\Yii::$app->request->referrer);

    }
}
