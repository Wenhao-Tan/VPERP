<?php

namespace frontend\modules\frame\models;

use Yii;

/**
 * This is the models class for table "frame_stock".
 *
 * @property integer $sku
 * @property string $reference
 * @property string $color
 * @property integer $quantity
 * @property integer $availability
 * @property string $status
 */
class Stock extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'frame_stock';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['quantity', 'availability'], 'integer'],
            [['reference'], 'string', 'max' => 10],
            [['color', 'status'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'sku' => Yii::t('frame', 'Sku'),
            'reference' => Yii::t('frame', 'Reference'),
            'color' => Yii::t('frame', 'Color'),
            'quantity' => Yii::t('frame', 'Quantity'),
            'availability' => Yii::t('frame', 'Availability'),
            'status' => Yii::t('frame', 'Status'),
        ];
    }
}
