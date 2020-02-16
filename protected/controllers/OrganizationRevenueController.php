<?php
/**
*
* NOTICE OF LICENSE
*
* This source file is subject to the BSD 3-Clause License
* that is bundled with this package in the file LICENSE.
* It is also available through the world-wide-web at this URL:
* https://opensource.org/licenses/BSD-3-Clause
*
*
* @author Malaysian Global Innovation & Creativity Centre Bhd <tech@mymagic.my>
* @link https://github.com/mymagic/open_hub
* @copyright 2017-2020 Malaysian Global Innovation & Creativity Centre Bhd and Contributors
* @license https://opensource.org/licenses/BSD-3-Clause
*/

class OrganizationRevenueController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/backend', meaning
     *             using two-column layout. See 'protected/views/layouts/backend.php'.
     */
    public $layout = 'backend';

    public function actions()
    {
        return array(
        );
    }

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     *
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions' => array('index'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create', 'update', 'admin' and 'delete' actions
                'actions' => array('list', 'view', 'create', 'update', 'admin', 'delete'),
                'users' => array('@'),
                'expression' => '$user->isAdmin==true && $user->isSensitiveDataAdmin==true',
            ),
            array('deny',  // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function init()
    {
        $this->activeMenuMain = 'organization';
        parent::init();
    }

    /**
     * Displays a particular model.
     *
     * @param int $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate($organization_id = '')
    {
        $model = new OrganizationRevenue();
        $model->organization_id = $organization_id;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['OrganizationRevenue'])) {
            $model->attributes = $_POST['OrganizationRevenue'];

            if ($model->save()) {
                $log = Yii::app()->esLog->log(sprintf("created revenue record #%s for organization '%s'", $model->id, $model->organization->title), 'organization', array('trigger' => 'OrgranizationRevenueController::actionUpdate', 'model' => 'OrganizationRevenue', 'action' => 'delete', 'id' => $model->organization->id, 'organizationId' => $model->organization->id));

                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param int $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['OrganizationRevenue'])) {
            $model->attributes = $_POST['OrganizationRevenue'];

            if ($model->save()) {
                $log = Yii::app()->esLog->log(sprintf("updated revenue record #%s for organization '%s'", $model->id, $model->organization->title), 'organization', array('trigger' => 'OrgranizationRevenueController::actionUpdate', 'model' => 'OrganizationRevenue', 'action' => 'delete', 'id' => $model->organization->id, 'organizationId' => $model->organization->id));

                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     *
     * @param int $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        $model = $this->loadModel($id);
        $copy = clone $model;

        if ($model->delete()) {
            $log = Yii::app()->esLog->log(sprintf("deleted revenue record #%s for organization '%s'", $copy->id, $copy->organization->title), 'organization', array('trigger' => 'OrgranizationRevenueController::actionDelete', 'model' => 'OrganizationRevenue', 'action' => 'delete', 'id' => $copy->organization->id, 'organizationId' => $copy->organization->id));
        }

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax'])) {
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
    }

    /**
     * Index.
     */
    public function actionIndex()
    {
        $this->redirect(array('organizationRevenue/admin'));
    }

    /**
     * Lists all models.
     */
    public function actionList()
    {
        $dataProvider = new CActiveDataProvider('OrganizationRevenue');
        $dataProvider->pagination->pageSize = 5;
        $dataProvider->pagination->pageVar = 'page';

        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new OrganizationRevenue('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['OrganizationRevenue'])) {
            $model->attributes = $_GET['OrganizationRevenue'];
        }
        if (Yii::app()->request->getParam('clearFilters')) {
            EButtonColumnWithClearFilters::clearFilters($this, $model);
        }

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     *
     * @param int $id the ID of the model to be loaded
     *
     * @return OrganizationRevenue the loaded model
     *
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = OrganizationRevenue::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }

        return $model;
    }

    /**
     * Performs the AJAX validation.
     *
     * @param OrganizationRevenue $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'organizationRevenue-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
