<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Cmenus]].
 *
 * @see Cmenus
 */
class CmenusQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Cmenus[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Cmenus|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}