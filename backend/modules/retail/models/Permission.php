<?php

namespace backend\modules\retail\models;

use Yii;

/**
 * This is the models class for table "retail_permission".
 *
 * @property string $platform
 * @property string $permission
 * @property string $staff
 */
class Permission extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'retail_permission';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['platform', 'permission', 'staff'], 'required'],
            [['platform'], 'string', 'max' => 5],
            [['permission'], 'string', 'max' => 50],
            [['staff'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'platform' => Yii::t('retail', 'Platform'),
            'permission' => Yii::t('retail', 'Permission'),
            'staff' => Yii::t('retail', 'Staff'),
        ];
    }
}
