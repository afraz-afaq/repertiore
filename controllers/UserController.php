<?php

namespace app\controllers;

use app\config\Helper;
use app\models\forms\SettingsForm;
use Yii;
use app\models\User;
use app\models\search\UserSearch;
use app\models\SystemConfig;
use app\models\UserTimeSpent;
use yii\bootstrap\ActiveForm;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['save-time'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['index','view','update','create','settings','delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post())) {
            $model->username = time().'';
            $model->type = User::APP_USER;
            if($model->save()){

                $userTime = new UserTimeSpent();
                $userTime->user_id = $model->id;
                $userTime->time_spent = 0;
                $userTime->save();

                Yii::$app->getSession()->setFlash('success', [
                    'type' => 'success',
                    'duration' => 6000,
                    'icon' => 'glyphicon glyphicons-remove',
                    'message' => 'User Created Successfully.',
                    'title' => 'Success',
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);
                return $this->redirect(['view', 'id' => $model->id]);
            }
            else{
                Yii::$app->getSession()->setFlash('danger', [
                    'type' => 'danger',
                    'duration' => 6000,
                    'icon' => 'glyphicon glyphicons-remove',
                    'message' => 'Something went wrong while creating the user.',
                    'title' => 'Success',
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post())) {

            if($model->save()){
                Yii::$app->getSession()->setFlash('success', [
                    'type' => 'success',
                    'duration' => 6000,
                    'icon' => 'glyphicon glyphicons-remove',
                    'message' => 'User Created Successfully.',
                    'title' => 'Success',
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);
                return $this->redirect(['view', 'id' => $model->id]);
            }
            else{
                Yii::$app->getSession()->setFlash('danger', [
                    'type' => 'danger',
                    'duration' => 6000,
                    'icon' => 'glyphicon glyphicons-remove',
                    'message' => 'Something went wrong while creating the user.',
                    'title' => 'Success',
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->getSession()->setFlash('success', [
            'type' => 'success',
            'duration' => 6000,
            'icon' => 'glyphicon glyphicons-remove',
            'message' => 'User Deleted Successfully.',
            'title' => 'Success',
            'positonY' => 'top',
            'positonX' => 'right'
        ]);

        return $this->redirect(['index']);
    }

    public function actionSettings()
    {
        $model = User::find()->limit(1)->all();
        $model = $model[0];

        $user_login_setting = SystemConfig::find()
        ->where(['name' => 'USER_LOGIN'])
        ->one();

        $settingsForm = new SettingsForm();
        $settingsForm->attributes = $model->attributes;
        $settingsForm->user_login = $user_login_setting->is_enabled;
        $settingsForm->password = '';

        if (Yii::$app->request->isAjax && $settingsForm->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }


        if ($settingsForm->load(Yii::$app->request->post())) {
            $model->name = $settingsForm->name;
            $model->email = $settingsForm->email;

            if ($settingsForm->password != null) {
                $model->setPassword($settingsForm->password);
            }

            $user_login_setting->is_enabled = $settingsForm->user_login;
            $user_login_setting->save();
            if($model->save()){
                Yii::$app->getSession()->setFlash('success', [
                    'type' => 'success',
                    'duration' => 6000,
                    'icon' => 'glyphicon glyphicons-remove',
                    'message' => 'Settings Updated Successfully.',
                    'title' => 'Success',
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);
            }
            else{
                $errors = implode(', ', $model->getErrorSummary(true));
                Yii::$app->getSession()->setFlash('danger', [
                    'type' => 'danger',
                    'duration' => 6000,
                    'icon' => 'glyphicon glyphicons-remove',
                    'message' => $errors,
                    'title' => 'Error',
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);
            }
        }

        return $this->render('settings', [
            'model' => $settingsForm,
        ]);
    }


    public function actionSaveTime(){

        if(Helper::isUserLoginEnabled() == 1){
            $user = User::findOne(Yii::$app->session->get('user_id'));
            $userTime = $user->userTimeSpent;
            $userTime->time_spent = $userTime->time_spent + 10;
            return $userTime->save();
        }
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
