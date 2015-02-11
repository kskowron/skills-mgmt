<?php
namespace common\lib\traits\action;

use common\models\EmployeeSearch;

/**
 * 
 */
trait TactionEmployeeList
{
    /**
     * Action for getting user list
     * @param type $search
     * @param type $id
     * @return json ['id'=>id,'text'=>value']
     */
    public function actionEmployeeList($search = null, $id = null)
    {
        $searchModel = new EmployeeSearch();
        return $searchModel->getEmployeeList($search,$id);
    }
    
}
