<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Pages;
use yii\helpers\ArrayHelper;
use yii\db\Query;

/**
 * PagesSearch represents the model behind the search form about `common\models\Pages`.
 */
class PagesSearch extends Pages
{
	public $parentid;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status'], 'integer'],
            [['slug','parentid', 'description', 'meta_keywords', 'meta_desc'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
		$query = Pages::find()->joinWith('rel');
		
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'parentid' => $this->parentid,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'meta_keywords', $this->meta_keywords])
            ->andFilterWhere(['like', 'meta_desc', $this->meta_desc]);

        return $dataProvider;
    }
	
    public function getParentList()
    {
		$pages = new Pages();
		$pagerel = new PageMenuRel();
		$query = new Query();
		$parentids = $query->select(['parentid'])->from('page_menu_rel')->distinct()->all();
		$newarray = array();
		foreach($parentids as $parentid){
			$newarray[] = $parentid['parentid'];
		}

		$pages  = $pages->find()->where(['id'=>$newarray])->all();	
	
		$pageslist = ArrayHelper::map($pages,'id','name');
        return $pageslist;
    }	
	
}
