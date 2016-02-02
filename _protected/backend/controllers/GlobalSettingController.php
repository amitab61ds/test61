<?php

namespace backend\controllers;

use Yii;
use common\models\Globalsetting;
use common\models\GlobalSettingSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\imagine\Image;
use kartik\file\FileInput;
use yii\web\UploadedFile;
use yii\filters\AccessControl;
/**
 * GlobalSettingController implements the CRUD actions for GlobalSetting model.
 */
class GlobalSettingController extends BackendController
{
    public function behaviors()
    {
	    $behaviors = parent::behaviors();
		return $behaviors;
    }

    /**
     * Lists all GlobalSetting models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GlobalSettingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single GlobalSetting model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
      /*   return $this->render('view', [
            'model' => $this->findModel($id),
        ]); */
		 return $this->redirect(['update', 'id' => 1 ]);
		
    }

    /**
     * Creates a new GlobalSetting model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
	 public function actionCreate()
    {
        $model = new Globalsetting();
		$image = UploadedFile::getInstance($model, 'fevicon_icon');
		$himage = UploadedFile::getInstance($model, 'logo');
        if ($model->load(Yii::$app->request->post())) {
				if($image != '')
				{
					$path = '';
					$mimage= $model->updateImage($image, $model->id,$path);
					$mimage1= $model->updateImage($himage, $model->id,$path);
					if($mimage==true && $mimage1==true)
						$model->fevicon_icon = $mimage;				
						$model->logo = $mimage1;				
				}	
				

				$model->save();				
				//$imagine->thumbnail($uploadLarge, 1000, 400)->save($filename, ['quality' => 80]);				
						
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
           /*  return $this->render('create', [
                'model' => $model,
            ]); */
			 return $this->redirect(['update', 'id' => 1 ]);
        }
    }
    /**
     * Updates an existing GlobalSetting model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$image = UploadedFile::getInstance($model, 'fevicon_icon');
		$himage = UploadedFile::getInstance($model, 'logo');
		$himage_inner = UploadedFile::getInstance($model, 'innerlogo');
		$himage_video = UploadedFile::getInstance($model, 'videoPath');
        if ($model->load(Yii::$app->request->post())) {
			$path = '';
			$asdlogo = $model->getLogoFevicon();
			foreach($asdlogo as $asdlogo1 ){
				$fevicon = $asdlogo1->fevicon_icon;
				$logo = $asdlogo1->logo;
				$innerlogo = $asdlogo1->innerlogo;
			}
				if($image != '')
				{
					$imagine = new Image();		

					$mimage = 'fevicon.'. $image->extension;
					$model->fevicon_icon = "/uploads/".$mimage;	
				}
				else{
					$model->fevicon_icon = $fevicon;
				}
				if($himage != '')
				{
					$mimage1= $model->updateImage($himage, 1,$path,'logo');
					$model->logo = "/uploads/site/medium/".$mimage1;	
				}
				else{
					$model->logo = $logo;
				}		
				if($himage_inner != '')
				{
					$mimage2= $model->updateImage($himage_inner, 1,$path,'innerlogo');
					$model->innerlogo = "/uploads/site/medium/".$mimage2;
				}
				else{
					$model->innerlogo = $innerlogo;
				}


				$model->save();				
				//$imagine->thumbnail($uploadLarge, 1000, 400)->save($filename, ['quality' => 80]);				
						
            return $this->redirect(['update', 'id' => $model->id , 'save' => 'yes']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing GlobalSetting model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the GlobalSetting model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return GlobalSetting the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Globalsetting::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
