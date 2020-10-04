<?php

namespace app\controllers;

use Yii;
use app\models\Song;
use app\models\search\SongSearch;
use app\models\forms\SongForm;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\web\UploadedFile;
use yii\widgets\ActiveForm;
use app\config\Helper;

/**
 * SongController implements the CRUD actions for Song model.
 */
class SongController extends Controller
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
     * Lists all Song models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SongSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Song model.
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
     * Creates a new Song model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SongForm();
        $model->song_check = true;
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post())) {


            $model->uploaded_song = UploadedFile::getInstance($model, 'song_url');
            $model->uploaded_cover = UploadedFile::getInstance($model, 'song_cover');

            $name = trim($model->name);

            $model->link_name = preg_replace('/[[:space:]]+/', '-', Helper::clean(trim($model->link_name)));
            $time = time();
            $linkName =  $model->link_name.'-'.$time;
            $songModel = new Song();
            $songModel->name = $name;
            $songModel->artist = trim($model->artist);
            $songModel->duration = $model->duration;
            $songModel->genre_id = $model->genre_id;
            $songModel->link_name = $linkName;
            $songModel->url = $model->url;
            if (!$songModel->url)
                if ($model->uploaded_song) {
                    $path = Yii::$app->getBasePath() . '/web/uploads/songs/' . $songModel->link_name . '.' . $model->uploaded_song->extension;
                    $filename = '/uploads/songs/' . $songModel->link_name . '.' . $model->uploaded_song->extension;
                    $model->uploaded_song->saveAs($path);
                }

            // if (!$songModel->url  && !$model->uploaded_song)
            //     Yii::$app->getSession()->setFlash('danger', [
            //         'type' => 'danger',
            //         'duration' => 6000,
            //         'icon' => 'glyphicon glyphicons-remove',
            //         'message' => "Either upload or provide url of song",
            //         'title' => 'Error',
            //         'positonY' => 'top',
            //         'positonX' => 'right'
            //     ]);
            // else {
            if ($model->uploaded_cover) {
                $path = Yii::$app->getBasePath() . '/web/uploads/song-covers/' . $songModel->link_name . '.' . $model->uploaded_cover->extension;
                $filename = '/uploads/song-covers/' . $songModel->link_name . '.' . $model->uploaded_cover->extension;
                $model->uploaded_cover->saveAs($path);
            }
            if ($songModel->save()) {
                Yii::$app->getSession()->setFlash('success', [
                    'type' => 'success',
                    'duration' => 6000,
                    'icon' => 'glyphicon glyphicons-remove',
                    'message' => 'Song Created Successfully.',
                    'title' => 'Success',
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);
                return $this->redirect(['view', 'id' => $songModel->id]);
            } else {
                $errors = implode(', ', $songModel->getErrorSummary(true));
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
            // }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Song model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Song model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        // if (!$model->url)
        //     unlink(Yii::$app->getBasePath() . '/web/uploads/songs/' . $model->link_name  . '.mp3');

        // unlink(Yii::$app->getBasePath() . '/web/uploads/song-covers/' . $model->link_name . Helper::SONG_COVER_EXT);
        $model->delete();


        Yii::$app->getSession()->setFlash('success', [
            'type' => 'success',
            'duration' => 6000,
            'icon' => 'glyphicon glyphicons-remove',
            'message' => 'Song Deleted Successfully.',
            'title' => 'Success',
            'positonY' => 'top',
            'positonX' => 'right'
        ]);


        return $this->redirect(['index']);
    }

    /**
     * Finds the Song model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Song the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Song::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
