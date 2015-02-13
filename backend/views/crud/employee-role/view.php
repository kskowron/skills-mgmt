<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use kartik\datecontrol\DateControl;

 /* @var $this yii\web\View */
 /* @var $model common\models\EmployeeRole */
 
$this->title = $model->employee->fullname;
$this->params['breadcrumbs'][] = ['label' => Yii::t('skills', 'Employee Roles'),
    'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$s2helper = new \jarekkozak\widgets\Select2AjaxConfig(['url' => ['crud/employee-role/employee-list']]);
?>
<div class="employee-role-view">

    <div class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>


    <?=
    DetailView::widget([
        'model' => $model,
        'condensed' => false,
        'hover' => true,
        'mode' => Yii::$app->request->get('edit') == 't' ? DetailView::MODE_EDIT
                : DetailView::MODE_VIEW,
        'panel' => [
            'heading' => $this->title,
            'type' => DetailView::TYPE_INFO,
        ],
        'attributes' => [
            [
                'attribute' => 'employee_id',
                'value' => $model->employee!=NULL?$model->employee->fullname:NULL,
                'type' => DetailView::INPUT_SELECT2,
                'widgetOptions' => $s2helper->getConfig(),
            ],
            [
                'attribute'=>'role',
                'value'=> $model->name,
            ]
        ],
        'deleteOptions' => [
            'url' => ['delete', 'id' => $model->id],
            'data' => [
                'confirm' => Yii::t('app',
                    'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ],
        'enableEditMode' => true,
    ])
    ?>

</div>
