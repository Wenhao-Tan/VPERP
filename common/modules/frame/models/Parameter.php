<?php

namespace common\modules\frame\models;

use common\modules\frame\Module;
use common\modules\frame\models\Price;

/**
 * This is the models class for table "frame_parameter".
 *
 * @property string $reference
 * @property string $front_material
 * @property string $temple_material
 * @property string $rim_type
 * @property string $shape
 * @property integer $lens_width
 * @property integer $bridge_width
 * @property integer $temple_length
 * @property integer $frame_width
 * @property integer $lens_height
 * @property integer $spring_hinge
 * @property integer $clip_on
 */
class Parameter extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'frame_parameter';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                ['lens_width', 'bridge_width', 'temple_length', 'frame_width', 'lens_height'], 'integer'
            ],
            [
                ['reference', 'lens_width', 'bridge_width', 'temple_length', 'frame_width', 'lens_height',
                'spring_hinge', 'clip_on'], 'required'
            ],
            [
                ['reference', 'front_material', 'temple_material', 'rim_type', 'shape'], 'string', 'max' => 20
            ],
            [
                ['reference'], 'filter', 'filter' => 'strtoupper',
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'reference' => Module::t('frame', 'Reference'),
            'front_material' => Module::t('frame', 'Front Material'),
            'temple_material' => Module::t('frame', 'Temple Material'),
            'rim_type' => Module::t('frame', 'Rim Type'),
            'shape' => Module::t('frame', 'Shape'),
            'lens_width' => Module::t('frame', 'Lens Width'),
            'bridge_width' => Module::t('frame', 'Bridge Width'),
            'temple_length' => Module::t('frame', 'Temple Length'),
            'frame_width' => Module::t('frame', 'Frame Width'),
            'lens_height' => Module::t('frame', 'Lens Height'),
            'spring_hinge' => Module::t('frame', 'Spring Hinge'),
            'clip_on' => Module::t('frame', 'Clip On'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function afterSave($insert, $changedAttributes)
    {
        if ($insert == true) {
            $this->created_at = date('Y-m-d');
            $this->save();

            $price = new Price();

            $price->reference = $this->reference;
            $price->save();
        }
    }

    public function afterDelete()
    {
        $price = Price::findOne($this->reference);

        if ($price) {
            $price->delete();
        }
        
    }

    public function getStocks()
    {
        return $this->hasMany(Stock::className(), ['reference' => 'reference']);
    }
}
