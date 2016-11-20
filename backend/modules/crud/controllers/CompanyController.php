<?php
/**
 * /var/www/html/yiiyak/console/runtime/giiant/49eb2de82346bc30092f584268252ed2
 *
 * @package default
 */


namespace backend\modules\crud\controllers;
use yii\filters\AccessControl;

/**
 * This is the class for controller "CompanyController".
 */
class CompanyController extends \backend\modules\crud\controllers\base\CompanyController
{
    /**
     *
     * @inheritdoc
     * @return array
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin'],
                    ],

                ]
            ]
        ];
    }

    public function actionCompanyStatistics ($companyId)
    {
        $model = $this->findModel($companyId);

        $totalUsers = $model->plan->getOneLimitAmount('user');
        $totalProducts = $model->plan->getOneLimitAmount('drug');

        $usedUsers = count($model->users);
        $usedProducts = count($model->drugs);

        $remainingUsers = $totalUsers - $usedUsers;
        $remainingProducts = $totalProducts  - $usedProducts;

        return $this->render('company-statistics',[
            'model' => $model,
            'totalUsers' => $totalUsers,
            'totalProducts' => $totalProducts,
            'usedUsers' => $usedUsers,
            'usedProducts' => $usedProducts,
            'remainingUsers' => $remainingUsers,
            'remainingProducts' => $remainingProducts
        ]);
    }
}
