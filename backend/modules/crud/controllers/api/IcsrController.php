<?php
/**
 * /var/www/html/yiiyak/console/runtime/giiant/f197ab8e55d1e29a2dea883e84983544
 *
 * @package default
 */


namespace backend\modules\crud\controllers\api;

/**
 * This is the class for REST controller "IcsrController".
 */
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class IcsrController extends \yii\rest\ActiveController
{
	public $modelClass = 'backend\modules\crud\models\Icsr';

	/**
	 *
	 * @inheritdoc
	 * @return unknown
	 */
	public function behaviors() {
		return ArrayHelper::merge(
			parent::behaviors(),
			[
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
			]
		);
	}


}
