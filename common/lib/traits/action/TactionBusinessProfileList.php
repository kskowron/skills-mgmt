<?php
namespace common\lib\traits\action;

use common\models\BusinessProfileSearch;

/**
 * 
 */
trait TactionBusinessProfileList
{
    /**
     * Action for getting user list
     * @param type $search
     * @param type $id
     * @return json ['id'=>id,'text'=>value']
     */
    public function actionBusinessProfilesList($search = null, $id = null)
    {
        $searchModel = new BusinessProfileSearch();
        return $searchModel->getBusinessProfileList($search,$id);
    }
    
}
