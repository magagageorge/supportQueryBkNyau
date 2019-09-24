<?php

namespace frontend\controllers;

use Yii;
use app\models\UserProfile;
use app\models\UserProfileSearch;
use yii\rest\ActiveController;
use yii\rest\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
//use sizeg\jwt\JwtHttpBearerAuth;
use yii\filters\auth\QueryParamAuth;

/**
 * AccountController implements the CRUD actions for UserProfile model.
 */
class AccountController extends Controller
{
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];
    
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
    $behaviors = parent::behaviors();
    $behaviors['contentNegotiator'] = [
       'class' => \yii\filters\ContentNegotiator::className(),
       'formats' => [
           'application/json' => \yii\web\Response::FORMAT_JSON,
       ],
    ];  
        
    $behaviors['authenticator'] = [
        'class' => CompositeAuth::className(),
        'only' => ['index','view','create','update','delete'],
        'authMethods' => [
            //JwtHttpBearerAuth::className(),
            //HttpBasicAuth::className(),
            HttpBearerAuth::className(),
            //QueryParamAuth::className(),
        ],
    ];

    // remove authentication filter
    $auth = $behaviors['authenticator'];
    unset($behaviors['authenticator']);
    
    // add CORS filter
    $behaviors['corsFilter'] = [
        'class' => \yii\filters\Cors::className(),
        'cors' => [
            // restrict access to
            //'Origin' => ['http://localhost:4200'],
            'Access-Control-Request-Method' => ['POST', 'GET','PUT','DELETE'],
            // Allow only POST and PUT methods
            'Access-Control-Request-Headers' => ['*'],
            // Allow only headers 'X-Wsse'
            // 'Access-Control-Allow-Credentials' => true,
            // Allow OPTIONS caching
            'Access-Control-Max-Age' => 3600,
            // Allow the X-Pagination-Current-Page header to be exposed to the browser.
            'Access-Control-Expose-Headers' => ['X-Pagination-Current-Page'],
        ],      
    ];
    
    // re-add authentication filter
    $behaviors['authenticator'] = $auth;
    // avoid authentication on CORS-pre-flight requests (HTTP OPTIONS method)
    $behaviors['authenticator']['except'] = ['options'];

    return $behaviors;
    }

    /**
     * Lists all UserProfile models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserProfileSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

       return $dataProvider;
    }

    /**
     * Displays a single UserProfile model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView()
    {
       return $this->findModel();
    }

    /**
     * Creates a new UserProfile model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UserProfile();
         $response=['done'=>false,'data'=>''];
        if ($model->load(Yii::$app->getRequest()->getBodyParams(),'')) {
           $model->created_by=Yii::$app->user->identity->id;
           $model->updated_by=Yii::$app->user->identity->id;
           $model->created_at=date('Y-m-d');
           $model->updated_at=date('Y-m-d');
           if($model->save()){
            $response['done']=true;
           }
        }
        $model->validate();
        $response['data']=$model;
        return $response;
    }

    /**
     * Updates an existing UserProfile model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel();

         $response=['done'=>false,'data'=>''];
        if ($model->load(Yii::$app->getRequest()->getBodyParams(),'')) {
           $model->updated_by=Yii::$app->user->identity->id;
           $model->updated_at=date('Y-m-d');
           if($model->save()){
            $response['done']=true;
           }
        }
        $model->validate();
        $response['data']=$model;
        return $response;
    }


    /**
     * Finds the UserProfile model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserProfile the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel()
    {
        if (($model = UserProfile::findOne(Yii::$app->user->identity->id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
