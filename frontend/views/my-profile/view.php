<?php

use common\models\Employee;
use common\models\Location;
use kartik\detail\DetailView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;

 /* @var View $this */
 /* @var Employee $model */
 
if ($model->id == NULL) {
    $this->title = Yii::t('skills', 'Create your own profile');
} else {
    $this->title = Yii::t('skills', 'Your profile view');
}
$this->params['breadcrumbs'][] = ['label' => Yii::t('skills', 'Employees'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="employee-view">
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
            'lastName',
            'firstName',
            [
                'attribute' => 'location_id',
                'format' => 'raw',
                'value' => Html::encode($model->getLocationName()),
                'type' => DetailView::INPUT_SELECT2,
                'widgetOptions' => [
                    'data' => ArrayHelper::map(Location::find()->orderBy('name')->asArray()->all(),
                        'id', 'name'),
                    'options' => ['placeholder' => 'Select ...'],
                    'pluginOptions' => ['allowClear' => true]
                ],
                'inputWidth' => '40%'
            ],
        ],
//        'deleteOptions' => [
//            'url' => ['delete', 'id' => $model->id],
//            'data' => [
//                'confirm' => Yii::t('skills',
//                    'Are you sure you want to delete this item?'),
//                'method' => 'post',
//            ],
//        ],
        'enableEditMode' => true,
    ])
    ?>
</div>
