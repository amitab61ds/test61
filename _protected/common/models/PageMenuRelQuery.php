<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[PageMenuRel]].
 *
 * @see PageMenuRel
 */
class PageMenuRelQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return PageMenuRel[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return PageMenuRel|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}