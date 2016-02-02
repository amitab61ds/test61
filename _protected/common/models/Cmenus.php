<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "cmenus".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property integer $type
 * @property string $name
 * @property string $link
 * @property string $class
 * @property integer $status
 *
 * @property ParentMenus $parent
 * @property MenuType $type0
 */
class Cmenus extends \yii\db\ActiveRecord
{
	public $selectdata;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cmenus';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'type', 'name', 'link'], 'required'],
            [['parent_id', 'type', 'status'], 'integer'],
            [['name', 'link', 'class_name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Parent ID',
            'type' => 'Type',
            'name' => 'Name',
            'link' => 'Link',
            'class_name' => 'Class',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(PostCategories::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenuType()
    {
        return $this->hasOne(MenuType::className(), ['id' => 'type']);
    }

    /**
     * @inheritdoc
     * @return CmenusQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CmenusQuery(get_called_class());
    }
	
	
	
	public function getMenuTypes()
	{
		$menutype = MenuType::find()->orderBy('name')->all();
		return ArrayHelper::map($menutype,'id','name');
	}	
	
	public function getMenu($id){
		$menus = Cmenus::find()->where(['parent_id'=>$id, 'status' => 1])->all();
		return $menus;		
	}	
}
