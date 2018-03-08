<?php
namespace frontend\modules\frame\models;

use yii\db\ActiveRecord;
use frontend\modules\frame\Module;

class FrameParamRimType extends ActiveRecord
{
    public static function tableName()
    {
        return 'frame_param_rim_type';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'rim_type_id' => Module::t('frame', 'Rim Type ID'),
            'rim_type' => Module::t('frame', 'Rim Type'),
        ];
    }
}