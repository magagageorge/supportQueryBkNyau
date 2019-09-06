<?php

namespace frontend\controllers;

use Yii;
use common\models\User;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use common\models\LoginForm;



/**
 * AuthController implements the CRUD actions for User model.
 */
class AuthController extends ActiveController
{
	public $modelClass=User::class;
	
	/*
    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;	
        if (Yii::$app->getRequest()->getMethod() === 'OPTIONS') {
            // End it, otherwise a 401 will be shown.
            Yii::$app->end();
        }
        return true;
    }	
	*/
    /**
     * @inheritdoc
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
		'only' => ['index','reset-password','logout'],
        'authMethods' => [
            HttpBasicAuth::className(),
            HttpBearerAuth::className(),
            QueryParamAuth::className(),
        ],
    ];
	
	
    //$behaviors['authenticator'] = [
        //'class' => \sizeg\jwt\JwtHttpBasicAuth::className(),
    //];	

    // remove authentication filter
    $auth = $behaviors['authenticator'];
    unset($behaviors['authenticator']);
    
    // add CORS filter
    $behaviors['corsFilter'] = [
        'class' => \yii\filters\Cors::className(),
        'cors' => [
            // restrict access to
            //'Origin' => ['http://localhost:5000'],
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
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
      $model = new LoginForm();
      Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;	
      if($model->load(Yii::$app->getRequest()->getBodyParams(), '')) {
		   if($user=$model->login()){
        return ['token' => $user->getJWT()];			
		   }
      }
        $model->validate();
        return $model;		
    }	

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionLogout()
    {
      Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;			
		$data['success']=true;
      Yii::$app->user->logout();
	 return $data;
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
