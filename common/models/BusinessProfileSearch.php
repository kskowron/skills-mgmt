<?php

namespace common\models;

use common\models\BusinessProfile;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\helpers\Json;

/**
 * BusinessProfileSearch represents the model behind the search form about `common\models\BusinessProfile`.
 */
class BusinessProfileSearch extends BusinessProfile
{
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = BusinessProfile::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }

    /**
     * Search business profile by his name or id. Returns array of
     * business profiles limited to 20 items
     *
     * [
     *   0=>['id'=>id, 'text'=>value ]
     *   ...
     * ]
     *
     * @param string $search part of the name
     * @param int $id business profile id
     * @param boolean $json if true result is json encoded
     * @return array|string
     */
    public function getBusinessProfileList($search, $id = NULL,$json=TRUE)
    {
        $out = ['more' => false];
        if (!is_null($search)) {
            $query = new Query;
            $query->select([ 'id'=>'id','text'=>'name'])
                ->from(BusinessProfile::tableName())
                ->orFilterWhere(['like', 'name', $search])
                ->limit(20);
            $command = $query->createCommand();
            $data    = $command->queryAll();
            $out['results'] = array_values($data);
        } elseif ($id > 0 && ($profile = BusinessProfile::findOne($id)) !== null) {
            $out['results'] = ['id' => $id, 'text' => $profile->name];
        } else {
            $out['results'] = ['id' => 0, 'text' => Yii::t('skills', 'No business profiles')];
        }
        return $json?Json::encode($out):$out;
    }

}
