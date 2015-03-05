<?php
/* @var $this yii\web\View */
$this->title = \Yii::$app->name;
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Welcome to the Skills Management Suite!</h1>


        <p></p>
        <p>
            <?= kartik\helpers\Html::a(\Yii::t('skills','Get started with Skills Management'),  \yii\helpers\Url::to(['site/login']),['class'=>"btn btn-lg btn-success"]) ?>
        </p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Skills search</h2>

                <p> You can search your employee database by sets of skills and skill level.</p>

                <p>
                    <?= kartik\helpers\Html::a(\Yii::t('skills','Search by skill ...').'&raquo;',  \yii\helpers\Url::to(['search-employee/by-skill']),['class'=>"btn btn-default"]) ?>
                </p>
            </div>
            <div class="col-lg-4">
                <h2>Browse employees</h2>

                <p>You can browse list of your emplyees with detailed profile view.</p>

                <p>
                    <?= kartik\helpers\Html::a(\Yii::t('skills','Browse employees ...').'&raquo;',  \yii\helpers\Url::to(['search-employee/all-employees']),['class'=>"btn btn-default"]) ?>
                </p>
            </div>
            <div class="col-lg-4">
                <h2>My Profile</h2>

                <p>If you are employee you can update you profile add new skills or change you current skills levels.</p>

                <p>
                    <?= kartik\helpers\Html::a(\Yii::t('skills','My Profile ...').'&raquo;',  \yii\helpers\Url::to(['my-profile/view']),['class'=>"btn btn-default"]) ?>
                </p>
            </div>
        </div>

    </div>
</div>
