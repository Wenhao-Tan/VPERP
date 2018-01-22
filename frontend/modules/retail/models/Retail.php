<?php

namespace frontend\modules\retail\models;

use Yii;

/**
 * This is the models class for table "retail".
 *
 * @property integer $id
 * @property string $date
 * @property string $platform
 * @property string $currency
 * @property string $amount
 */
class Retail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'retail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'platform', 'currency', 'amount'], 'required'],
            [['date'], 'safe'],
            [['amount'], 'number'],
            [['platform', 'currency'], 'string', 'max' => 5],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('retail', 'ID'),
            'date' => Yii::t('retail', 'Date'),
            'platform' => Yii::t('retail', 'Platform'),
            'currency' => Yii::t('retail', 'Currency'),
            'amount' => Yii::t('retail', 'Amount'),
        ];
    }
}
