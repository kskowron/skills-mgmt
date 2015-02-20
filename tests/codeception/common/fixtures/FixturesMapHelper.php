<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace tests\codeception\common\fixtures;

use yii\helpers\ArrayHelper;

/**
 * Prepares map of all fixtures
 *
 * @author Jarosław Kozak <jaroslaw.kozak68@gmail.com>
 */
class FixturesMapHelper
{

    protected static function getDefault()
    {
        return [
            'employee' => [
                'class' => EmployeeFixture::className(),
            ],
            'category' => [
                'class' => CategoryFixture::className(),
            ],
            'businessProfile' => [
                'class' => BusinessProfileFixture::className(),
            ],
            'employeeBusinessProfile' => [
                'class' => EmployeeBusinessProfileFixture::className(),
            ],
            'skillLevel' => [
                'class' => SkillLevelFixture::className(),
            ],
            'skill' => [
                'class' => SkillFixture::className(),
            ],
            'employeeSkill' => [
                'class' => EmployeeSkillFixture::className(),
            ],
            'location' => [
                'class' => LocationFixture::className(),
            ],
            'user' => [
                'class' => UserFixture::className(),
            ]
        ];
    }

    public static function getFixtures(array $config = [])
    {
        return ArrayHelper::merge(self::getDefault(),
                $config);
    }

    public static function getFixturesReset(array $config=[]){

        $out = [];
        foreach (self::getDefault() as $key => $value) {
            $value['dataFile']=FALSE;
            $out[$key] = $value;
        }
        return ArrayHelper::merge($out,$config);
    }
    
}