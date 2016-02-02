<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "parent_menus".
 *
 * @property integer $id
 * @property string $name
 * @property integer $status
 * @property string $description
 */
class ParentMenus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'parent_menus';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description'], 'required'],
            [['status'], 'integer'],
			[['description'], 'string', 'max' => 1000],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'status' => 'Status',
            'description' => 'Description',
        ];
    }

    /**
     * @inheritdoc
     * @return ParentMenusQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ParentMenusQuery(get_called_class());
    }

}
