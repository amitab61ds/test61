<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[ParentMenus]].
 *
 * @see ParentMenus
 */
class ParentMenusQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return ParentMenus[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ParentMenus|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}