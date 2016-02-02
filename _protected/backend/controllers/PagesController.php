<?php

namespace backend\controllers;

use Yii;
use common\models\Pages;
use common\models\PageMenuRel;
use common\models\PagesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Response;
use common\traits\StatusChangeTrait;
use common\models\User;
use common\components\AccessRule;

/**
 * PagesController implements the CRUD actions for Pages model.
 */
class PagesController extends BackendController
{
	use StatusChangeTrait;
    public function behaviors()
    {
	    $behaviors = parent::behaviors();
		return $behaviors;
    }

    /**
     * Lists all Pages models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PagesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pages model.
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
     * Creates a new Pages model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Pages();
		
		$menu = new PageMenuRel();
		$menus = $menu->find()->innerjoinwith('page')->where(['level'=>0])->all();
		
		if(count($menus) > 0){
			$menus = ArrayHelper::map($menus,'id','page.name');
		}else{
			$menus = array();
		}
		$menus[-1] = 'Static page';
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
			$post = Yii::$app->request->post();
			$level = 0;
			$parentid = 0;
			if(isset($post['Pages']['parentid']) && !empty($post['Pages']['parentid'])){
				$parentid = $post['Pages']['parentid'];
				$level = 1;
			}
			if($post['Pages']['parentid'] == -1){
				$parentid = 0;
				$level = -1;
			}
			if(isset($post['Pages']['subpageid']) && !empty($post['Pages']['subpageid'])){
				$parentid = $post['Pages']['subpageid'];
				$level = 2;
			}			
			
			$menu->pageid = $model->id;
			$menu->parentid = $parentid;
			$menu->level = $level;
			$menu->save();
			return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'menus' => $menus,
            ]);
        }
    }
	
    public function actionChildpage($id)
    {
        $model = new Pages();

		$menu = new PageMenuRel();
		$menus = $menu->find()->innerjoinwith('page')->where(['parentid'=>$id,'level'=>1])->all();
		$search_results = '';
		
		if(count($menus) > 0) {
		$search_results .= "<option value=''>-Select Child Page-</option>";
		  foreach($menus as $post){
			   $search_results .= "<option value='".$post->page->id."'>".$post->page->name."</option>";
		  }
		}

		Yii::$app->response->format = Response::FORMAT_JSON;
		return [
		'result'=>$search_results,
		];	
    }	
	

    /**
     * Updates an existing Pages model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$menu = new PageMenuRel();
		$menu = $menu->find()->where(['pageid' => $id])->one();
		
		$menus = $menu->find()->innerjoinwith('page')->where(['level'=>0])->all();
		
		if(count($menus) > 0){
			$menus = ArrayHelper::map($menus,'id','page.name');
		}else{
			$menus = array();
		}
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
			$menu->pageid = $id;
			$post = Yii::$app->request->post();
			if(isset($post['Pages']['parentid']) && !empty($post['Pages']['parentid']) && $menu->pageid != $post['Pages']['parentid']){
				$parentid = $post['Pages']['parentid'];
				$level = 1;
				$menu->parentid = $parentid;
				$menu->level = $level;
				$menu->save();	
			}
			else{
				$menu->parentid = $menu->pageid;
				$menu->level = $menu->level;
			}
			if(isset($post['Pages']['subpageid']) && !empty($post['Pages']['subpageid'])){
				$parentid = $post['Pages']['subpageid'];
				$level = 2;
				$menu->parentid = $parentid;
				$menu->level = $level;
				//$menu->save();	
			}	

			
			Yii::$app->getSession()->setFlash('success', Yii::t('app', $model->name.' updated successfully'));
            return $this->redirect(['index']);
			
        } else {
			$menus1 = PageMenuRel::find()->where(['pageid'=>$id])->one();			
			if($menus1->level ==0)
				$model->parentid = $menus1->parentid;
			
			if($menus1->level ==1){
				$menus2 = PageMenuRel::find()->where(['parentid'=>$menus1->parentid])->one();
				
				$model->parentid = $menus2->parentid;	

			}	

			if($menus1->level ==2){
				$menus2 = PageMenuRel::find()->where(['parentid'=>$menus1->parentid])->one();
				$menus3 = PageMenuRel::find()->where(['pageid'=>$menus2->parentid])->one();
			
				$model->parentid = $menus3->parentid;	
				$model->subpageid = $menus1->parentid;	
			}				
			$submenus = $menu->find()->innerjoinwith('page')->where(['level'=>1])->all();	
			$submenus = ArrayHelper::map($submenus,'id','page.name');			
            return $this->render('update', [
                'model' => $model,
                'menus' => $menus,
                'submenus' => $submenus,
				
            ]);
        }
    }

    /**
     * Deletes an existing Pages model.
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
     * Finds the Pages model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pages the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pages::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

