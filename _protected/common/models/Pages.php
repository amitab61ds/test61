<?php

namespace common\models;
use common\models\PageMenuRel;
use yii\db\Query;
use Yii;

/**
 * This is the model class for table "pages".
 *
 * @property integer $id
 * @property string $title
 * @property string $url
 * @property string $content
 * @property integer $status
 * @property string $meta_keywords
 * @property string $meta_desc
 */
class Pages extends \yii\db\ActiveRecord
{
	public $parentid;
	public $level;
	public $subpageid;
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'slug', 'status'], 'required'],
            [['description'], 'string'],
            [['status'], 'integer'],
            [['name', 'slug', 'meta_keywords', 'meta_desc'], 'string', 'max' => 255],
            [['slug'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Title',
            'slug' => 'Slug',
            'parentid' => 'Parent Page',
            'subpageid' => 'Child Page',
            'description' => 'Description',
            'status' => 'Status',
            'meta_keywords' => 'Meta Keywords',
            'meta_desc' => 'Meta Desc',
        ];
    }

    /**
     * @inheritdoc
     * @return PagesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PagesQuery(get_called_class());
    }
	
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRel()
    {
        return $this->hasOne(PageMenuRel::className(), ['pageid' => 'id']);
    }
	
	public static function loadModelSlug($slug)
	{
		$page = new Pages();
		$model = $page->find()->where(['slug'=>$slug])->one();
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}	
	
	public function getChildMenus($id = 0)
    {
		$model1 = new PageMenuRel();
		$menus  = $this->find()->select('name, slug')->innerjoinwith('rel')->where(['page_menu_rel.parentid'=>$id,'status' =>1])->all();	
        return $menus;
    }
	public function getParentMenu($id = 0)
    {
		$model1 = new PageMenuRel();
		$menus  = $this->find()->innerjoinwith('rel')->where(['page_menu_rel.pageid'=>$id,'status' =>1,'level'=>0])->all();	
        return $menus;
    }
	public function getParentName($id = 0)
    {	
		$pages = new pages();	
		$page = $pages->find()->where(['id'=>$id])->one();

		if(!$page['name'] || $page['name'] == ''){
			$page['name'] = 'Root Page';
		}
		return $page['name'];
    }
	public function getMenu($id=0,$level=0){

		$menu = new PageMenuRel();
		if(!isset($level) && !isset($id)){		
			$menus = $menu->find()->innerjoinwith('page')->where(['level'=>0 ,'status'=>1])->all();
		
		}elseif($level != 0){
			$menus = $menu->find()->innerjoinwith('page')->where(['status'=>1])->all();
		}else{			
			$menus = $menu->find()->innerjoinwith('page')->where(['parentid'=>$id ,'status'=>1])->all();
		}
		
		return $menus;		
	}	
	public function getMainMenu()
    {
		$pages = new Pages();
		$query = new Query();
		$parentids = $query->select(['pageid'])->from('page_menu_rel')->distinct()->where(['level'=>0])->all();
		$newarray = array();
		foreach($parentids as $parentid){
			
			$page = $this->find()->where(['id'=>$parentid])->one();

			$cpages = $pages->getChildMenus($parentid);
			$newarray[$parentid['pageid']]['child'] = $cpages;
			$newarray[$parentid['pageid']]['name'] = $page['name'];
			$newarray[$parentid['pageid']]['slug'] = $page['slug'];
		}

        return $newarray;
    }	
}
