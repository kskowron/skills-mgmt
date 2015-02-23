<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $employee common\models\Employee */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['my-skills/gap-list'],true);
$profilesLink = Yii::$app->urlManager->createAbsoluteUrl(['my-business-profile/index'],true);

?>
<div class="skills-fill">
    <p>Hello <?= Html::encode($employee->fullname) ?>,</p>
    <p>
    <?php
if ($employee->primaryBusinessProfile != NULL) {
    echo kartik\helpers\Html::a($profilesLink,"You have defined your primary profile:" . kartik\helpers\Html::encode($employee->primaryBusinessProfile));
}else{
    echo kartik\helpers\Html::a($profilesLink,'You have not defined your primary profile!');
}
?>
    </p>
    <p>
<?php
if ($employee->primaryBusinessProfile != NULL) {
    echo "You have defined your secondary profiles:" . kartik\helpers\Html::encode($employee->secondaryBusinessProfiles);
}else{
    echo 'You have not defined your secondary profiles!';
}
?>
    </p>

    <p>You have not provided yet your experience for the following skills:</p>
<?php
/* @var $value \common\models\Skill */
foreach ($skills as $value) {
    echo  "<p>".\kartik\helpers\Html::encode(" - ".$value->category->name.'/'.$value->name)."</p>";
}
?>

    <p>Follow the link below to fill your experience:</p>

    <p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>
</div>
