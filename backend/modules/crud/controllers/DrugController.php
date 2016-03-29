<?php
/**
 * /var/www/html/yiiyak/console/runtime/giiant/49eb2de82346bc30092f584268252ed2
 *
 * @package default
 */



namespace backend\modules\crud\controllers;
use backend\modules\crud\models\Drug;
use backend\modules\crud\models\search\Drug as DrugSearch;
use yii\web\Controller;
use yii\web\HttpException;
use yii\helpers\Url;
use yii\filters\AccessControl;
use dmstr\bootstrap\Tabs;
use Yii;

/**
 * This is the class for controller "DrugController".
 */
class DrugController extends \backend\modules\crud\controllers\base\DrugController
{
/**
	 * Lists all Drug models.
	 *
	 * @return mixed
	 */
    
	public function actionIndex() {
		$searchModel  = new DrugSearch;
               // $criteria = ;
               
                $_GET['Drug']['company_id'] = Yii::$app->user->identity->getCompany()->one()->id;

 		$dataProvider = $searchModel->search($_GET);

		Tabs::clearLocalStorage();

		Url::remember();
		\Yii::$app->session['__crudReturnUrl'] = null;

		return $this->render('index', [
				'dataProvider' => $dataProvider,
				'searchModel' => $searchModel,
			]);
	}

        public function actionCreate() {
		$model = new Drug;
                $_POST['Drug']['company_id'] = Yii::$app->user->identity->getCompany()->one()->id;

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
}
