<?php

use common\models\Location;
use kartik\detail\DetailView;
use kartik\grid\GridView;
use kartik\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this View */
/* @var $model common\models\Employee */
/* @var $businessProfiles \common\models\EmployeeBusinessProfile[] */

if ($model->id == NULL) {
    $this->title = Yii::t('skills', 'Create your own profile');
} else {
    $this->title = Yii::t('skills', 'My profile view');
}
$this->params['breadcrumbs'][] = $this->title;

$files = [];
foreach ($model->getAllFiles() as $file) {
    array_push($files, Html::a($file->filename, ['my-files/get', 'fileId' => (string)$file->_id]));
}
$links = implode(', ', $files);
?>

<div class="employee-view">
    <div class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <div class="row">
        <div class="col-md-3">
            <?= common\lib\util\ImageHelper::businessPhoto($model); ?>
        </div>
        <div class="col-md-9">
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
                    [
                        'attribute'=> 'primaryBusinessProfile',
                        'displayOnly'=>true
                    ],
                    [
                        'attribute'=> 'secondaryBusinessProfiles',
                        'displayOnly'=>true
                    ],
                    [
                        'label' => Yii::t('skills', 'Files'), 
                        'value' => $links, 
                        'format' => 'raw'
                    ]
                ],
                'enableEditMode' => true,
            ])
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
        </div>
        <div class="col-lg-9">
<?php

?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
        </div>
        <div class="col-lg-3">
            <?= $model->id==NULL?'':Html::a(Yii::t('skills',
                    'Edit My Skills'), ['my-skills/list'],
                ['class' => 'btn btn-primary btn-block'])
            ?>
        </div>
        <div class="col-lg-3">
            <?= $model->id==NULL?'':Html::a(Yii::t('skills',
                    'Edit Business Profile'), ['my-business-profile/index'],
                ['class' => 'btn btn-primary btn-block'])
            ?>
        </div>
        <div class="col-lg-3">
            <?= $model->id==NULL?'':Html::a(Yii::t('skills', 'My Files'), ['my-files/view'],
                ['class' => 'btn btn-primary btn-block'])
            ?>
        </div>
    </div>
</div>
