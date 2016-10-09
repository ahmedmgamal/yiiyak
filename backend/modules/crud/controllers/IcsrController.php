<?php
/**
 * /var/www/html/yiiyak/console/runtime/giiant/49eb2de82346bc30092f584268252ed2
 *
 * @package default
 */


namespace backend\modules\crud\controllers;
use backend\modules\crud\models\Icsr;
use backend\modules\crud\models\search\Icsr as IcsrSearch;
use backend\modules\crud\models\DrugPrescription as DrugPrescription;
use bedezign\yii2\audit\models\AuditTrail;
use yii\web\Controller;
use yii\web\HttpException;
use yii\helpers\Url;
use yii\filters\AccessControl;
use dmstr\bootstrap\Tabs;

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
                //$_POST['Icsr']
		try {
			if ($model->load($_POST) ) {
                if ( $model->save()) {
                    $pres = new DrugPrescription;
                    $pres->drug_id =($model->getDrug()->one()->id);
                    $pres->drug_role = '1';//value of suspect
                    $pres->icsr_id = $model->id;
                    $pres->save();
                    return $this->redirect(Url::previous());
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

        if ($icsr->isIcsrExported($icsr->id))
        {
            \Yii::$app->getSession()->setFlash('error', \Yii::t('app','This Icsr Exported Before'));

            return $this->redirect(\Yii::$app->request->referrer);
        }

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

        if( $this->validateXML($xml,$dtd ) )
        {
            $this->createTrailForExport($icsr);
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

private function createTrailForExport ($icsrObj)
{
    $audit = new AuditTrail();
    $audit->user_id = \Yii::$app->user->id;
    $audit->action = 'EXPORT';
    $audit->model = \backend\modules\crud\models\Icsr::className();
    $audit->model_id = $icsrObj->id;
    $audit->save();
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
                'message' => 'this icsr is duplicated but it will get inserted',

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

}
