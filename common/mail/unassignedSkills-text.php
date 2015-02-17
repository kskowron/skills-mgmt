<?php
/* @var $this yii\web\View */
/* @var $employee common\models\Employee */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['my-skills/gap-list'],true);
//$resetLink = \yii\helpers\Url::to(['my-skills/gap-list']);
?>
Hello <?= $employee->fullname ?>,

You have not provided yet your experience for the following skills:
<?php
/* @var $value \common\models\Skill */
foreach ($skills as $value) {
    echo \kartik\helpers\Html::encode(" - ".$value->category->name.'/'.$value->name)."\n";
}
?>

Follow the link below to fill your experience:

<?= $resetLink ?>
