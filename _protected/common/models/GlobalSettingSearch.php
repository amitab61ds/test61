<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\GlobalSetting;

/**
 * GlobalSettingSearch represents the model behind the search form about `app\modules\admin\models\GlobalSetting`.
 */
class GlobalSettingSearch extends GlobalSetting
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['site_title', 'meta_tag', 'meta_desc', 'fevicon_icon', 'logo'], 'safe'],
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
        $query = GlobalSetting::find();

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
        ]);

        $query->andFilterWhere(['like', 'site_title', $this->site_title])
            ->andFilterWhere(['like', 'meta_tag', $this->meta_tag])
            ->andFilterWhere(['like', 'meta_desc', $this->meta_desc])
            ->andFilterWhere(['like', 'fevicon_icon', $this->fevicon_icon])
            ->andFilterWhere(['like', 'logo', $this->logo]);

        return $dataProvider;
    }
}
