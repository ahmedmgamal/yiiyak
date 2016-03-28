<?php
/**
 * /var/www/html/yiiyak/console/runtime/giiant/358b0e44f1c1670b558e36588c267e47
 *
 * @package default
 */


// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace backend\modules\crud\controllers\base;

use backend\modules\crud\models\IcsrType;
use backend\modules\crud\models\search\IcsrType as IcsrTypeSearch;
use yii\web\Controller;
use yii\web\HttpException;
use yii\helpers\Url;
use yii\filters\AccessControl;
use dmstr\bootstrap\Tabs;

/**
 * IcsrTypeController implements the CRUD actions for IcsrType model.
 */
class IcsrTypeController extends Controller
{

	/**
	 *
	 * @var boolean whether to enable CSRF validation for the actions in this controller.
	 * CSRF validation is enabled only when both this property and [[Request::enableCsrfValidation]] are true.
	 */
	public $enableCsrfValidation = false;

	/**
	 *
	 * @inheritdoc
	 * @return unknown
	 */
	public function behaviors() {
		return [
			'access' => [
				'class' => AccessControl::className(),
				'rules' => [
					[
						'allow' => true,

						/**
						 *
						 */
						'matchCallback' => function ($rule, $action) {return \Yii::$app->user->can($this->module->id . '_' . $this->id . '_' . $action->id, ['route' => true]);},
					]
				]
			]
		];
	}


	/**
	 * Lists all IcsrType models.
	 *
	 * @return mixed
	 */
	public function actionIndex() {
		$searchModel  = new IcsrTypeSearch;
		$dataProvider = $searchModel->search($_GET);

		Tabs::clearLocalStorage();

		Url::remember();
		\Yii::$app->session['__crudReturnUrl'] = null;

		return $this->render('index', [
				'dataProvider' => $dataProvider,
				'searchModel' => $searchModel,
			]);
	}


	/**
	 * Displays a single IcsrType model.
	 *
	 * @param integer $icsr_id
	 * @param integer $icsr_type_lkp_id
	 * @return mixed
	 */
	public function actionView($icsr_id, $icsr_type_lkp_id) {
		\Yii::$app->session['__crudReturnUrl'] = Url::previous();
		Url::remember();
		Tabs::rememberActiveState();

		return $this->render('view', [
				'model' => $this->findModel($icsr_id, $icsr_type_lkp_id),
			]);
	}


	/**
	 * Creates a new IcsrType model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 *
	 * @return mixed
	 */
	public function actionCreate() {
		$model = new IcsrType;

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


	/**
	 * Updates an existing IcsrType model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 *
	 * @param integer $icsr_id
	 * @param integer $icsr_type_lkp_id
	 * @return mixed
	 */
	public function actionUpdate($icsr_id, $icsr_type_lkp_id) {
		$model = $this->findModel($icsr_id, $icsr_type_lkp_id);

		if ($model->load($_POST) && $model->save()) {
			return $this->redirect(Url::previous());
		} else {
			return $this->render('update', [
					'model' => $model,
				]);
		}
	}


	/**
	 * Deletes an existing IcsrType model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 *
	 * @param integer $icsr_id
	 * @param integer $icsr_type_lkp_id
	 * @return mixed
	 */
	public function actionDelete($icsr_id, $icsr_type_lkp_id) {
		try {
			$this->findModel($icsr_id, $icsr_type_lkp_id)->delete();
		} catch (\Exception $e) {
			$msg = (isset($e->errorInfo[2]))?$e->errorInfo[2]:$e->getMessage();
			\Yii::$app->getSession()->addFlash('error', $msg);
			return $this->redirect(Url::previous());
		}


		// TODO: improve detection
		$isPivot = strstr('$icsr_id, $icsr_type_lkp_id', ',');
		if ($isPivot == true) {
			return $this->redirect(Url::previous());
		} elseif (isset(\Yii::$app->session['__crudReturnUrl']) && \Yii::$app->session['__crudReturnUrl'] != '/') {
			Url::remember(null);
			$url = \Yii::$app->session['__crudReturnUrl'];
			\Yii::$app->session['__crudReturnUrl'] = null;

			return $this->redirect($url);
		} else {
			return $this->redirect(['index']);
		}
	}


	/**
	 * Finds the IcsrType model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @throws HttpException if the model cannot be found
	 * @param integer $icsr_id
	 * @param integer $icsr_type_lkp_id
	 * @return IcsrType the loaded model
	 */
	protected function findModel($icsr_id, $icsr_type_lkp_id) {
		if (($model = IcsrType::findOne(['icsr_id' => $icsr_id, 'icsr_type_lkp_id' => $icsr_type_lkp_id])) !== null) {
			return $model;
		} else {
			throw new HttpException(404, 'The requested page does not exist.');
		}
	}


}
