<?php

namespace app\models\search;

use app\models\History;
use app\widgets\Export\HistoryExport;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;

/**
 * HistorySearch represents the model behind the search form about `app\models\History`.
 *
 * @property array $objects
 */
class HistorySearch extends History
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [];
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
     * Creates base data provider instance with query applied (default).
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    private function getBaseDP(ActiveQuery $query): ActiveDataProvider {
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'defaultOrder' => [
                'ins_ts' => SORT_DESC,
                'id' => SORT_DESC
            ],
        ]);

        return $dataProvider;
    }
    /**
     * Creates base query.
     */
    private function getBaseQuery(): ActiveQuery {
        $query = History::find();
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            $query->where('0=1');
            return $query;
        }

        // $this->load($params);

        $query->addSelect('history.*');
        $query->with([
            'customer',
            'user',
            'sms',
            'task',
            'call',
            'fax',
        ]);

        return $query;
    }

    /**
     * Tailor dataprovider and query for various cases.
     * 
     * | | | | |
     * v v v v v
     */

    public function full($params) {
        return $this->search($params);
    }
    
    public function chunk($params) {
        $chunk_size = $params["chunk_size"];
        $chunk = $params["chunk"];

        $offset = $chunk_size * ($chunk - 1);
        $limit = $chunk_size;

        $query = $this->getBaseQuery();
        $query->offset($offset);
        $query->limit($limit);

        $dataProvider = $this->getBaseDP($query);
        $dataProvider->setPagination(false);

        return $dataProvider;
    }

    public function search($params)
    {
        $query = $this->getBaseQuery();
        $dataProvider = $this->getBaseDP($query);

        return $dataProvider;
    }
}
