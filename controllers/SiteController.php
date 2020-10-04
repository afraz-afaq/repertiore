<?php

namespace app\controllers;

use app\models\forms\RequestForm;
use app\models\Genre;
use app\models\RepertoireRuntime;
use app\models\Request;
use app\models\RequestSong;
use app\models\Song;
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\debug\models\timeline\Search;

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
        $songs = [];
        $this->layout = "index-main";

        $search = null;

        $genres = Genre::find();
        if (isset($_POST['search_query'])) {
            $search = $_POST['search_query'];
            $genres->joinWith('songs')
                ->filterWhere(['like', 'songs.name', $search])
                ->orFilterWhere(['like', 'genre.name', $search])
                ->orFilterWhere(['like', 'songs.artist', $search]);
        }

        $genres =  $genres->orderBy('name')
            ->asArray()
            ->all();




        if ($search != null) {
            foreach ($genres as $genre) {
                $sgs = Song::find();


                if (strpos($genre['name'], $search) === false) {
                    $sgs->filterWhere(['like', 'songs.name', $search])
                        ->orFilterWhere(['like', 'songs.artist', $search]);
                }

                $sgs->andWhere(['genre_id' => $genre['id']])
                    ->orderBy('name');
                $data  = $sgs->asArray()->all();

                $songs[$genre['id']] = $data;
            }
        } else {
            foreach ($genres as $genre) {
                $sgs = Song::find()
                    ->where(['genre_id' => $genre['id']])
                    ->orderBy('name')
                    ->asArray()
                    ->all();

                $songs[$genre['id']] = $sgs;
            }
        }


        if (count($genres) > 0)
            $genres = array_chunk($genres, ceil(count($genres) / 2));
        $model = new RequestForm();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post()) && Yii::$app->request->post()) {
            $songs_ids = explode(',', $_POST['songs']);
            $total_runtime = $_POST['runtime'];
            $connection = \Yii::$app->db;
            $transaction = $connection->beginTransaction();
            try {
                $request = new Request();
                $request->full_name = $model->name;
                $request->contact = $model->contact;
                $request->email = $model->email;
                $request->total_runtime = $total_runtime;
                if ($request->save()) {
                    foreach ($songs_ids as $sid) {
                        $requestedSong = new RequestSong();
                        $requestedSong->song_id = explode('-', $sid)[1];
                        $requestedSong->request_id = $request->id;
                        if (!$requestedSong->save()) {
                            $transaction->rollBack();
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
                            return $this->redirect(Url::base());
                        }
                    }
                    if (!$this->sendNotifications($request)) {
                        $transaction->rollBack();
                        Yii::$app->getSession()->setFlash('danger', [
                            'type' => 'danger',
                            'duration' => 6000,
                            'icon' => 'glyphicon glyphicons-remove',
                            'message' => "Unable to send notifications please try again.",
                            'title' => 'Error',
                            'positonY' => 'top',
                            'positonX' => 'right'
                        ]);
                        return $this->redirect(Url::base());
                    } else {
                        Yii::$app->getSession()->setFlash('success', [
                            'type' => 'success',
                            'duration' => 6000,
                            'icon' => 'glyphicon glyphicons-remove',
                            'message' => "Em breve você receberá seu repertório por e-mail. Obrigado! =)",
                            'title' => 'Enviado com sucesso!',
                            'positonY' => 'top',
                            'positonX' => 'right'
                        ]);
                        return $this->redirect(Url::base());
                    }
                } else {
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
            } catch (\Exception $e) {
                Yii::$app->getSession()->setFlash('danger', [
                    'type' => 'danger',
                    'duration' => 6000,
                    'icon' => 'glyphicon glyphicons-remove',
                    'message' => "Something went wrong while saving your record please try again.",
                    'title' => 'Error',
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);
            }
        }

        $max_runtime = RepertoireRuntime::find()->one()->runtime;

        return $this->render(
            'index',
            [
                'model' => $model,
                'genres' => $genres,
                'songs' => $songs,
                'runtime' => $max_runtime,
                'search' => $search
            ]
        );
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
     * @return bool
     */
    public function sendNotifications($request)
    {
        $model = User::find()->limit(1)->all();
        $model = $model[0];

        $check = Yii::$app->mailer
            ->compose(
                ['html' => '@app/mail/notifyUser-html'],
                ['model' => $request]
            )
            ->setFrom($model->email)
            ->setCc($model->email)
            ->setTo($request->email)
            ->setSubject('Repertório Banda Mega')
            ->send();

        return $check;
    }

    public function actionGetSongPlayer()
    {
        $id = $_GET['id'];
        $model = Song::find()->where(['id' => $id])->asArray()->one();
   
        if($model['url'])
            return $model['url'];
        else
            return $this->renderAjax(
                'music-player-layout',
                [
                    'model' => $model,
                    'id' => time()
                ]
            );
    }
}
