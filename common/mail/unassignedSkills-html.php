<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $employee common\models\Employee */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['my-skills/gap-list'],true);
//$resetLink = \yii\helpers\Url::to(['my-skills/gap-list']);

?>
<div class="skills-fill">
    <p>Hello <?= Html::encode($employee->fullname) ?>,</p>
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
