<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\EmployeeSkill $model
 * @var \common\models\Skill $skill
 *
 */
$this->title = Yii::t('skills', 'Update {modelClass} - {skill}',
    ['modelClass' => 'Employee Skill','skill'=>$skill->name]);

$this->params['breadcrumbs'][] = ['label' => Yii::t('skills', 'My Profile'),'url' => ['my-profile/view']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('skills', 'My skills'),'url' => ['list']];

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee-skill-create">
    <div class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <?=
    $this->render('_form',
        [
        'model' => $model,
        'years_of_experience' => $years_of_experience,
        'levels' => $levels,
        'last_activity' => $last_activity
    ])
    ?>
</div>
