<?php

namespace frontend\modules\frame\models;

use frontend\modules\frame\Module;
/**
 * This is the models class for table "frame_price".
 *
 * @property integer $reference
 * @property string $purchase_price
 * @property string $wholesale_price_cny
 * @property string $wholesale_min_price_cny
 * @property string $wholesale_price_usd
 * @property string $wholesale_min_price_usd
 * @property string $retailing_price_cny
 * @property string $retailing_price_usd
 */
class Price extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'frame_price';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['purchase_price', 'wholesale_price_cny', 'wholesale_min_price_cny', 'wholesale_price_usd', 'wholesale_min_price_usd', 'retailing_price_cny', 'retailing_price_usd'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'reference' => Module::t('frame', 'Reference'),
            'purchase_price' => Module::t('frame', 'Purchase Price'),
            'wholesale_price_cny' => Module::t('frame', 'Wholesale Price (CNY)'),
            'wholesale_min_price_cny' => Module::t('frame', 'Wholesale Min Price (CNY)'),
            'wholesale_price_usd' => Module::t('frame', 'Wholesale Price (USD)'),
            'wholesale_min_price_usd' => Module::t('frame', 'Wholesale Min Price (USD)'),
            'retailing_price_cny' => Module::t('frame', 'Retailing Price (CNY)'),
            'retailing_price_usd' => Module::t('frame', 'Retailing Price (USD)'),
        ];
    }
}
