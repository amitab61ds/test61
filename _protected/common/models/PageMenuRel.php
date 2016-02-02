<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "page_menu_rel".
 *
 * @property integer $id
 * @property integer $pageid
 * @property integer $parentid
 * @property integer $level
 *
 * @property Pages $page
 * @property Pages $parent
 */
class PageMenuRel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'page_menu_rel';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pageid', 'parentid', 'level'], 'required'],
            [['pageid', 'parentid', 'level'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pageid' => 'Pageid',
            'parentid' => 'Parentid',
            'level' => 'Level',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPage()
    {
        return $this->hasOne(Pages::className(), ['id' => 'pageid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Pages::className(), ['id' => 'parentid']);
    }

    /**
     * @inheritdoc
     * @return PageMenuRelQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PageMenuRelQuery(get_called_class());
    }

	
}
