<?php
/**
 * /var/www/html/yiiyak/console/runtime/giiant/f197ab8e55d1e29a2dea883e84983544
 *
 * @package default
 */


namespace backend\modules\crud\controllers\api;

/**
 * This is the class for REST controller "LkpMeddraHlgtController".
 */
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class LkpMeddraHlgtController extends \yii\rest\ActiveController
{
	public $modelClass = 'backend\modules\crud\models\LkpMeddraHlgt';

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
