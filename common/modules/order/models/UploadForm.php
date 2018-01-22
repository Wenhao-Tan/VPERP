<?php
/**
 * Created by PhpStorm.
 * User: Paul
 * Date: 2017/10/25
 * Time: 8:35
 */

namespace common\modules\order\models;


use yii\base\Model;

class UploadForm extends Model
{
    public $imageFile;

    public function rules()
    {
        return [
            [
                ['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, xlsx',
            ],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->imageFile->saveAs('uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return true;
        } else {
            return false;
        }
    }
}