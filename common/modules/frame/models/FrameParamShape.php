<?php

namespace common\modules\frame\models;

use common\modules\frame\Module;

/**
 * This is the models class for table "frame_param_shape".
 *
 * @property integer $shape_id
 * @property string $shape
 */
class FrameParamShape extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'frame_param_shape';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['shape'], 'required'],
            [['shape'], 'string', 'max' => 20],
            [['shape'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'shape_id' => Module::t('frame', 'Shape ID'),
            'shape' => Module::t('frame', 'Shape'),
        ];
    }
}
