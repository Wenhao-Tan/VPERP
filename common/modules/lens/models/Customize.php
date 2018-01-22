<?php

namespace common\modules\lens\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "lens_custom".
 *
 * @property integer $id
 * @property string $created_at
 * @property string $ordered_at
 * @property string $finished_at
 * @property string $custom_number
 * @property string $ref_number
 * @property string $order_rep
 * @property string $supplier
 * @property string $status
 * @property string $material
 * @property string $refractive_index
 * @property string $prescription
 * @property string $prescription_lens_type
 * @property string $surface
 * @property integer $diameter
 * @property string $color_type
 * @property string $color
 * @property string $coating
 * @property string $r_sph
 * @property string $r_cyl
 * @property integer $r_axs
 * @property string $r_add
 * @property integer $r_prism_diopter
 * @property string $r_prism_direction
 * @property string $l_sph
 * @property string $l_cyl
 * @property integer $l_axs
 * @property string $l_add
 * @property integer $l_prism_diopter
 * @property string $l_prism_direction
 * @property string $quantity
 * @property string $remark
 */
class Customize extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lens_custom';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'ordered_at', 'finished_at'], 'safe'],
            [['diameter', 'r_axs', 'r_prism_diopter', 'l_axs', 'l_prism_diopter'], 'integer'],
            [['r_sph', 'r_cyl', 'r_add', 'l_sph', 'l_cyl', 'l_add', 'quantity'], 'number'],
            [['frame_model', 'remark'], 'string'],
            [['custom_number', 'ref_number', 'order_rep', 'supplier', 'status', 'material', 'prescription_type', 'prescription_lens_type', 'surface', 'color_type', 'color'], 'string', 'max' => 20],
            [['refractive_index', 'r_prism_direction', 'l_prism_direction'], 'string', 'max' => 10],
            [['r_pd', 'l_pd', 'coating'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('lens', 'Lens Custom ID'),
            'created_at' => Yii::t('lens', 'Created At'),
            'ordered_at' => Yii::t('lens', 'Ordered At'),
            'finished_at' => Yii::t('lens', 'Finished At'),
            'custom_number' => Yii::t('lens', 'Custom Number'),
            'ref_number' => Yii::t('lens', 'Ref Number'),
            'order_rep' => Yii::t('lens', 'Order Rep'),
            'supplier' => Yii::t('lens', 'Supplier'),
            'status' => Yii::t('lens', 'Status'),
            'material' => Yii::t('lens', 'Material'),
            'refractive_index' => Yii::t('lens', 'Refractive Index'),
            'prescription_type' => Yii::t('lens', 'Prescription Type'),
            'prescription_lens_type' => Yii::t('lens', 'Prescription Lens Type'),
            'surface' => Yii::t('lens', 'Surface'),
            'diameter' => Yii::t('lens', 'Diameter'),
            'color_type' => Yii::t('lens', 'Color Type'),
            'color' => Yii::t('lens', 'Color'),
            'coating' => Yii::t('lens', 'Coating'),
            'r_sph' => Yii::t('lens', 'R Sph'),
            'r_cyl' => Yii::t('lens', 'R Cyl'),
            'r_axs' => Yii::t('lens', 'R Axs'),
            'r_add' => Yii::t('lens', 'R Add'),
            'r_prism_diopter' => Yii::t('lens', 'R Prism Diopter'),
            'r_prism_direction' => Yii::t('lens', 'R Prism Direction'),
            'l_sph' => Yii::t('lens', 'L Sph'),
            'l_cyl' => Yii::t('lens', 'L Cyl'),
            'l_axs' => Yii::t('lens', 'L Axs'),
            'l_add' => Yii::t('lens', 'L Add'),
            'l_prism_diopter' => Yii::t('lens', 'L Prism Diopter'),
            'l_prism_direction' => Yii::t('lens', 'L Prism Direction'),
            'quantity' => Yii::t('lens', 'Quantity'),
            'remark' => Yii::t('lens', 'Remark'),
        ];
    }

    public function beforeSave($insert)
    {
        return true;
    }

    public function insertRecords()
    {

        $this->created_at = date('Y-m-d H:i:s');
        $this->custom_number = 'LC' . implode('', explode('-', date('Y-m-d-H-i-s'))); // 'LC' => 'Lens Custom'
        $this->coating = serialize($this->coating);
        $this->supplier = '';
        $this->status = 'Created';

        if(!$this->color_type) {
            $this->color_type = '';
        }
        
        if ($this->r_cyl != 0.00 && $this->r_axs == null) {
            $this->r_axs = 180;
        }

       
        if ($this->l_cyl != 0.00 && $this->l_axs == null) {
            $this->l_axs = 180;
        }
        
        $this->save();
    }

    /**
     * @param $column
     * @param $value
     * @param $pks
     */
    public function updateRecords($column, $value, $pks)
    {
        if (is_array($pks)) {
            foreach ($pks as $pk) {
                Customize::updateOneRecord($column, $value, $pk);
            }
        }
    }

    public function updateOneRecord($column, $value, $pk)
    {
        $record = Customize::findOne($pk);
        $record->$column = $value;

        if ($column == 'supplier') {
            $record->status = 'Ordered';
            $record->ordered_at = date('Y-m-d H:i:s');
        }

        if ($column == 'status') {
            if ($value == 'Ordered') {
                $record->ordered_at = date('Y-m-d H:i:s');
            }
            if ($value == 'Finished') {
                $record->finished_at = date('Y-m-d H:i:s');
            }

        }

        $record->save();
    }
}
