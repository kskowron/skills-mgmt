<?php
Yii::setAlias('common', dirname(__DIR__));
Yii::setAlias('frontend', dirname(dirname(__DIR__)).'/frontend');
Yii::setAlias('backend', dirname(dirname(__DIR__)).'/backend');
Yii::setAlias('console', dirname(dirname(__DIR__)).'/console');
// Own aliases
Yii::setAlias('jk', dirname(dirname(__DIR__)).'/common/lib/jk');

// Register dependency
\jk\sys\DependencyManager::register(
    yii\helpers\ArrayHelper::merge(
        require(__DIR__.'/dependency.php'),
        require(__DIR__.'/dependency-local.php')
));
