<?php
/* @var $this yii\web\View */
$this->title = Yii::t('skills', 'My home page');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Congratulations!</h1>
        <p class="lead">You have successfully logged-in to Skills management application.</p>
    </div>
    <div class="functions-content">
        <div class="row">
            <div class="col-lg-4">
                <?= kartik\helpers\Html::a(Yii::t('skills', 'Browse employees'), ['search-employee/all-employees'], ['class' => 'btn btn-primary btn-block'])
                ?>
            </div>
            <div class="col-lg-4">
                <?= kartik\helpers\Html::a(Yii::t('skills', 'Search employees by skills'), ['search-employee/by-skill'], ['class' => 'btn btn-primary btn-block'])
                ?>
            </div>
            <div class="col-lg-4">
                <?= kartik\helpers\Html::a(Yii::t('skills', 'My Profile'), ['my-profile/view'], ['class' => 'btn btn-primary btn-block'])
                ?>
            </div>
        </div>
    </div>
    <div class="body-content">
        <!--
        <div class="row">
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
            </div>
        </div>
        -->

    </div>
</div>
