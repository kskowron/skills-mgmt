<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\models;

use common\models\EmployeeFile;
use yii\data\ActiveDataProvider;


/**
 * Description of EmployeeFileSearch
 *
 * @author ksawery.skowron
 */
class EmployeeFileSearch extends EmployeeFile {
    
    public function searchByEmployee($params) {
        $query = EmployeeFile::find();
        $query->where(['owner' => $params['owner']]);
        $dataProvider = new ActiveDataProvider(['query' => $query, 'pagination' => ['pagesize' => 10]]);
        return $dataProvider;
    }
}
