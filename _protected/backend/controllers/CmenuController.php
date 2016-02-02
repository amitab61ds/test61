<?php

namespace backend\controllers;

use Yii;
use common\models\Cmenus;
use common\models\CmenusSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\ParentMenus;
use yii\helpers\ArrayHelper;
use common\models\Pages;
use yii\web\Response;
use common\traits\StatusChangeTrait;
/**
 * CmenuController implements the CRUD actions for Cmenus model.
 */
class CmenuController extends BackendController
{	
	use StatusChangeTrait;


    /**
     * Lists all Cmenus models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CmenusSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Cmenus model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Cmenus model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Cmenus();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Cmenus model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
			Yii::$app->getSession()->setFlash('success', Yii::t('app', $model->name.' updated successfully'));
			return $this->redirect(['viewmenus', 'id'=>$model->parent_id]);
           
        } else {
            return $this->render('update', [
                'model' => $model,
				'parentmenu' => ParentMenus::findOne($model->parent_id),
            ]);
        }
    }

    /**
     * Deletes an existing Cmenus model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
		$model = $this->findModel($id);
		$parent_id = $model->parent_id;
		$name = $model->name;
        $model->delete();
		
		Yii::$app->getSession()->setFlash('success', Yii::t('app', $name.' deleted successfully'));
        return $this->redirect(['viewmenus', 'id'=>$parent_id]);
    }

    /**
     * Finds the Cmenus model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Cmenus the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cmenus::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	public function actionCMenu($id=0)
    {
		
        $model = new Cmenus();
		$model->parent_id = $id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
			Yii::$app->getSession()->setFlash('success', Yii::t('app', 'New menu added'));
            return $this->redirect(['viewmenus', 'id'=>$model->parent_id]);
        } else {
            return $this->render('newmenu', [
                'model' => $model,
                'parentmenu' => ParentMenus::findOne($id),
            ]);
        }
    }			
	public function actionStatus($id)    { 
		$model = $this->findModel($id);	
		if ($this->getIsActive($model)){	
			$this->inactive($model);	
			Yii::$app->getSession()->setFlash('success', Yii::t('app', '<b>'.$model->name.'</b> has been de-activated'));	
		}else{
			$this->active($model);	
			Yii::$app->getSession()->setFlash('success', Yii::t('app', '<b>'.$model->name.'</b> has been activated'));
		}     
		return $this->redirect(Yii::$app->request->referrer);
	}	
		
	public function actionValues($id=0)
	{
		$search_results = '';		
		if($id == 1){
			$menutype = Pages::find()->orderBy('name')->all();				
			if(count($menutype) > 0) {
				$search_results .= "<option value=''>-Select Page-</option>";
				foreach($menutype as $links){
				   $search_results .= "<option value='".$links->slug."'>".$links->name."</option>";
				}
			}			
		}
		Yii::$app->response->format = Response::FORMAT_JSON;
		return [
			'result'=>$search_results,
		];	
		
		
	}
	
	public function actionViewmenus($id=0)
    {
        $searchModel = new CmenusSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$id);		

        return $this->render('viewmenus', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'parentmenu' => ParentMenus::findOne($id),
        ]);
    }	
}
