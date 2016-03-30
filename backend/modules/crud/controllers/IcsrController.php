<?php
/**
 * /var/www/html/yiiyak/console/runtime/giiant/49eb2de82346bc30092f584268252ed2
 *
 * @package default
 */


namespace backend\modules\crud\controllers;
use backend\modules\crud\models\Icsr;
use backend\modules\crud\models\search\Icsr as IcsrSearch;
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
        return [];
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
			if ($model->load($_POST) && $model->save()) {
				return $this->redirect(Url::previous());
			} elseif (!\Yii::$app->request->isPost) {
				$model->load($_GET);
			}
		} catch (\Exception $e) {
			$msg = (isset($e->errorInfo[2]))?$e->errorInfo[2]:$e->getMessage();
			$model->addError('_exception', $msg);
		}
		return $this->render('create', ['model' => $model]);
	}

        public function actionExport($id) {
 
//\Yii::$app->response->format = \yii\web\Response::FORMAT_XML;

		return $this->render('export', [
				'model' => $this->findModel($id),
			]);

        }

    
}
