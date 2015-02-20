<?php
/* @var $this yii\web\View */
/* @var $employee common\models\Employee */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['my-skills/gap-list'],true);
$profilesLink = Yii::$app->urlManager->createAbsoluteUrl(['my-business-profile/index'],true);
//$resetLink = \yii\helpers\Url::to(['my-skills/gap-list']);
?>
Hello <?= $employee->fullname ?>,

<?php
if ($employee->primaryBusinessProfile != NULL) {
    echo kartik\helpers\Html::a($profilesLink,"You have defined your primary profile:" . kartik\helpers\Html::encode($employee->primaryBusinessProfile));
}else{
    echo kartik\helpers\Html::a($profilesLink,'You have not defined your primary profile!');
}
?>

<?php
if ($employee->primaryBusinessProfile != NULL) {
    echo "You have defined your secondary profiles:" . kartik\helpers\Html::encode($employee->secondaryBusinessProfiles);
}else{
    echo 'You have not defined your secondary profiles!';
}
?>

You have not provided yet your experience for the following skills:
<?php
/* @var $value \common\models\Skill */
if (count($skills) > 0) {
    foreach ($skills as $value) {
        echo \kartik\helpers\Html::encode(" - ".$value->category->name.'/'.$value->name)."\n";
    }
} else {
    echo kartik\helpers\Html::encode(Yii::t('skills',
            'Great! You have defined all skills'));
}
?>

Follow the link below to fill your experience:

<?= $resetLink ?>
