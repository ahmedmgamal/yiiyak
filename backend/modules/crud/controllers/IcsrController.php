<?php
/**
 * /var/www/html/yiiyak/console/runtime/giiant/49eb2de82346bc30092f584268252ed2
 *
 * @package default
 */


namespace backend\modules\crud\controllers;
use Aws\CloudFront\Exception\Exception;
use backend\modules\crud\models\Icsr;
use backend\modules\crud\models\search\Icsr as IcsrSearch;
use backend\modules\crud\models\DrugPrescription as DrugPrescription;
use bedezign\yii2\audit\models\AuditTrail;
use Yii;
use yii\web\Controller;
use yii\web\HttpException;
use yii\helpers\Url;
use yii\filters\AccessControl;
use dmstr\bootstrap\Tabs;
use backend\modules\crud\models\IcsrVersion;
use backend\modules\crud\models\IcsrNarritive;

use backend\modules\crud\overrides\TrailChild\AuditTrailChild;
use yii\web\Response;

/**
 * This is the class for controller "IcsrController".
 */
class IcsrController extends \backend\modules\crud\controllers\base\IcsrController
{

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => false,
                        'actions' => ['update','delete','export','export-null-case'],
                        'matchCallback' => function ($rule,$action){
                            $icsr_id = \Yii::$app->request->getQueryParam('id');


                            return Icsr::findOne($icsr_id)->isNullExported();

                        }
                    ],

                    [
                        'allow' => true,
                        'matchCallback' => function ($rule, $action) {
                            $user_id = \Yii::$app->user->id;
                            $icsr_id = \Yii::$app->request->getQueryParam('id');
                            return Icsr::checkAccess($user_id,$icsr_id);
                        },
                    ]
                ]
            ]
        ];
    }

    	/**
	 * Creates a new Icsr model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 *
	 * @return mixed
	 */
	public function actionCreate() {

        $model = new Icsr;

		try {
			if ($model->load($_POST) ) {
			    $model->created_by = Yii::$app->user->identity->id;
                $connection = \Yii::$app->db;
                $transaction = $connection->beginTransaction();

                if ( $model->save()) {

                    $narritive = new IcsrNarritive();
                    $narritive->icsr_id = $model->id;


                    $pres = new DrugPrescription;
                    $pres->drug_id =($model->getDrug()->one()->id);
                    $pres->drug_role = '1';//value of suspect
                    $pres->icsr_id = $model->id;

                    if ($narritive->save() && $pres->save()) {
                        $transaction->commit();
                        return $this->redirect(Url::previous());
                    }

                    else {
                        \Yii::$app->getSession()->setFlash('error', \Yii::t('app',"Something Went Wrong Please Try Again"));
                        return $this->redirect(['create']);

                    }
                }

			} elseif (!\Yii::$app->request->isPost) {
				$model->load($_GET);
			}

		} catch (\Exception $e) {
			$msg = (isset($e->errorInfo[2]))?$e->errorInfo[2]:$e->getMessage();
			$model->addError('_exception', $msg);
		}
		return $this->render('create', ['model' => $model]);
	}

    public function actionExport($id,$case) {

        $icsr = $this->findModel($id);
        $this->layout = false;

        //set content type xml in response
        \Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        $headers = \Yii::$app->response->headers;
        $headers->add('Content-Type', 'text/xml');

        if ($case == 'null')
        {
            $request = \Yii::$app->request;

            $nullReason = $request->post('nullReason');
            $xml = $this->renderPartial('export',['model' => $icsr , 'nullReason' => $nullReason]);

        }
        else {
            $xml = $this->renderPartial('export', [
                'model' => $icsr,
            ]);
        }


        $dtd = \Yii::$app->getModule('crud')->getViewPath().'/icsr/ich-icsr-v2_1.dtd';
        $request = Yii::$app->request;
        if( $this->validateXML($xml,$dtd ) )
        {
            $this->createTrailForExport($icsr,$case);
            $fileUrl =  $this->createExportFile($icsr,$xml);

            if ($request->isAjax){
                \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return ['fileUrl' =>$fileUrl];
            }
            return $this->redirect($fileUrl);
        }
        if ($request->isAjax){
            return $xml;
        }
        return $xml;
    }




    public function validateXML($xml, $dtd_realpath=null) {
    $xml ='<!DOCTYPE ichicsr SYSTEM "ich-icsr-v2_1.dtd">\n'.$xml;
    $xml_lines = explode('\n', $xml);
    $doc = new \DOMDocument;
    if ($dtd_realpath) {
        // Inject DTD inside DOCTYPE line:
        $dtd_lines = file($dtd_realpath);
        $new_lines = array();
        foreach ($xml_lines as $x) {
    
            // Assume DOCTYPE SYSTEM "blah blah" format:
            if (preg_match('/DOCTYPE/', $x)) {
                $y = preg_replace('/SYSTEM "(.*)"/', " [\n" . implode("\n", $dtd_lines) . "\n]", $x);
                $new_lines[] = $y;
            } else {
                $new_lines[] = $x;
            }
        }

        
        $doc->loadXML(implode("\n", $new_lines));
    } else {
        $doc->loadXML(implode("\n", $xml_lines));
    }
    // Enable user error handling
    libxml_use_internal_errors(true);
    if (@$doc->validate()) {
       return 1;
    } else {
        echo "Not valid:\n";
        file_put_contents(\Yii::$app->getModule('crud')->getViewPath().'/icsr/invalid.xml', $xml);
        $errors = libxml_get_errors();
        foreach ($errors as $error) {
            print_r($error, true);
        }
        die();
    }
}

private function createTrailForExport ($icsrObj,$case)
{
    $audit = new AuditTrail();
    $audit->user_id = \Yii::$app->user->id;
    $audit->action = 'EXPORT';

    if ($case == 'null')
    {
        $audit->action ='EXPORT NULL';
    }

    $audit->model = \backend\modules\crud\models\Icsr::className();
    $audit->model_id = $icsrObj->id;
    $audit->save();
}


private function createExportFile ($icsrObj,$content)
{
    $bucket = \Yii::$app->fileStorage->getBucket('icsrVersions');
    $fileName = 'IcsrVersion_IcsrId'.$icsrObj->id.'_DrugId'.$icsrObj->drug->id.'_'.strtotime("now").'.xml';
       try{
    $bucket->saveFileContent($fileName, $content);
        }
           catch(Exception $e)
    {
        \Yii::$app->getSession()->setFlash('error', 'The XML File not saved please try again later');
        return $this->redirect(\Yii::$app->request->referrer);
    }
    $fileUrl = $bucket->getFileUrl($fileName);

    $icsrVersion = new IcsrVersion();
    $icsrVersion->icsr_id =$icsrObj->id;
    $icsrVersion->file_name = $fileName;
    $icsrVersion->file_url  = $fileUrl;
    $icsrVersion->exported_by = \Yii::$app->user->id;
    $icsrVersion->version_no = $icsrObj->getVersion();
 

        $icsrVersion->save();
    return $fileUrl;
 

}


    /**
     * Updates an existing Icsr model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load($_POST) && $model->save()) {
            return $this->redirect(Url::previous());
        } elseif (!\Yii::$app->request->isPost) {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
        else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }


    public function actionCheckDuplicateIcsr ()
    {
        $model = new Icsr;

        \Yii::$app->response->format = 'json';

        if ($model->load($_POST) &&  $model->isDuplicate())
        {
            return  [
                'status' => 'duplicate',
                'message' => 'this icsr is duplicated for the same patient , want to save or not',

            ];
        }

        return [
            'status' => 'unique'
        ];
    }

    public function actionExportNullCase($id)
    {
        $icsr = $this->findModel($id);
        return $this->render('null-case-reason',['model' => $icsr]);
    }


    public function actionOpenPdf($path)
    {
        $path =  Yii::getAlias('@webroot') . $path;

                  if (file_exists($path))
                  {
                      $e2pLkp = Yii::$app->params['e2bLkp'];
                      $elementsLkp = Yii::$app->params['elementsLkp'];

                      Yii::$app->response->format = 'pdf';
                        $this->layout =false;

                      $xml = simplexml_load_file($path);

                      return $this->render('open-pdf',['xml' => $xml , 'e2pLkp' => $e2pLkp , 'elementsLkp' => $elementsLkp]);

                  }
            else
                {
                        Yii::$app->session->setFlash('error',Yii::t('app','File Doesn\'t Exist Any More'));

                      return $this->redirect(Yii::$app->request->referrer);
                 }
    }

    public function actionGetDiffBeforeDate($icsrId,$date,$versionNo)
    {

        Yii::$app->response->format = Response::FORMAT_JSON;

        if ($versionNo -1 <= 0 )
        {
            return ['diffs' =>  [] ,'fromVer' =>$versionNo, 'toVer' =>   Yii::t('app','First Export Version Have No Difference') ];
        }

        $dateTimeObj = new \DateTime($date);

        //subtract 2 hours from the current time stamp
        $dateTimeObj = $dateTimeObj->sub(new \DateInterval('PT2H'));

        $maxDateRange = $dateTimeObj->format('Y-m-d H:i:s');

        $icsrObj = Icsr::findOne($icsrId);

        $minDateRange = AuditTrailChild::find()->where(['model_id' => $icsrObj->id , 'action' => 'EXPORT' ])->andWhere(['<','created',$maxDateRange])->orderBy('created DESC')->one()->created;

        $diffArrOfObjs = $icsrObj->getIcsrTrails()->where(['between', 'created', $minDateRange, $maxDateRange ])->andWhere(['<>','action' ,'EXPORT'])->all();

        return ['diffs' =>  $diffArrOfObjs ,'fromVer' =>$versionNo, 'toVer' =>   $versionNo - 1];


    }

}
