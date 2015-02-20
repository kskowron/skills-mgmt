<?php

namespace common\models\base;

use yii\mongodb\file\ActiveRecord;

/**
 * Description of Asset
 *
 * @author jarek
 */

/**
 * Class Asset
 * @package common\models
 * @property string $_id MongoId
 * @property array $filename
 * @property string $uploadDate
 * @property string $length
 * @property string $chunkSize
 * @property string $md5
 * @property array $file
 * @property string $newFileContent
 * Must be application/pdf, image/png, image/gif etc...
 * @property string $contentType
 * @property string $description
 * @property string $owner Description
 */
class EmployeeFile extends ActiveRecord
{

    public static function collectionName()
    {
        return 'files';
    }

    public function rules()
    {
        return[
            [['description', 'contentType'], 'required'],
        ];
    }

    public function attributes()
    {
        return array_merge(
                parent::attributes(), ['contentType', 'description','owner']
        );
    }

}