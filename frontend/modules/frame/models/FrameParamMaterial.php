<?php

namespace frontend\modules\frame\models;

use frontend\modules\frame\Module;

/**
 * This is the models class for table "frame_param_material".
 *
 * @property integer $material_id
 * @property string $material
 */
class FrameParamMaterial extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'frame_param_material';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['material'], 'required'],
            [['material'], 'string', 'max' => 20],
            [['material'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'material_id' => Module::t('frame', 'Material ID'),
            'material' => Module::t('frame', 'Material'),
        ];
    }
}
