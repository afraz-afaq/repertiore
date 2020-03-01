<?php

namespace app\controllers;

use app\models\forms\RequestForm;
use app\models\Genre;
use app\models\RepertoireRuntime;
use app\models\Request;
use app\models\RequestSong;
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $this->layout = "index-main";
        $genres = Genre::find()->joinWith('songs')->asArray()->all();
        $genres = array_chunk($genres,2);
//        echo '<pre>';print_r($genres); die;
        $model = new RequestForm();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post()) && Yii::$app->request->post()) {
            $songs_ids = explode(',',$_POST['songs']);
            $total_runtime = $_POST['runtime'];
            $request = new Request();
            $request->full_name = $model->name;
            $request->contact = $model->contact;
            $request->email = $model->email;
            $request->total_runtime = $total_runtime;
            if($request->save()){
                foreach ($songs_ids as $sid){
                    $requestedSong = new RequestSong();
                    $requestedSong->song_id = $sid;
                    $requestedSong->request_id = $request->id;
                    if(!$requestedSong->save()){
                        $errors = implode(', ', $requestedSong->getErrorSummary(true));
                        Yii::$app->getSession()->setFlash('danger', [
                            'type' => 'danger',
                            'duration' => 6000,
                            'icon' => 'glyphicon glyphicons-remove',
                            'message' => $errors,
                            'title' => 'Error',
                            'positonY' => 'top',
                            'positonX' => 'right'
                        ]);
                        return $this->redirect(['index']);
                    }
                }
                $this->sendNotifications($request);
                Yii::$app->getSession()->setFlash('success', [
                    'type' => 'success',
                    'duration' => 6000,
                    'icon' => 'glyphicon glyphicons-remove',
                    'message' => 'Request Submitted Successfully.',
                    'title' => 'Success',
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);
                return $this->redirect(['index']);
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

        $max_runtime = RepertoireRuntime::find()->one()->runtime;
        return $this->render('index',
            [
                'model' => $model,
                    'genres' => $genres,
                    'runtime' => $max_runtime
            ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        $this->layout = "login-main";
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['/song']);
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['/song']);
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect('login');
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * @param Request $request
     */
    public function sendNotifications($request){
        $model = User::find()->limit(1)->all();
        $model = $model[0];

        Yii::$app->mailer
            ->compose(
                ['html' => '@app/mail/notifyUser-html'],
                ['model' => $request]
            )
            ->setFrom($model->email)
            ->setTo($request->email)
            ->setSubject('Repertoire Request Received')
            ->send();

        Yii::$app->mailer
            ->compose(
                ['html' => '@app/mail/notifyAdmin-html'],
                ['model' => $request]
            )
            ->setFrom($model->email)
            ->setTo($model->email)
            ->setSubject('New Repertoire Request')
            ->send();
    }
}
