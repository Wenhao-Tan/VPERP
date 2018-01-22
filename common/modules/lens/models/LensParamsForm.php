<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-05-28
 * Time: 17:09
 */

namespace app\models;

use yii\base\Model;

class LensParamsForm extends Model
{

    public $material;
    public $material_list;
    public $refractive_index;
    public $refractive_index_list;
    public $surface;
    public $surface_list;
    public $diameter;
    public $diameter_list;
    public $diopter_type;
    public $diopter_lens_type;
    public $diopter_type_list;
    public $color_type;
    public $color_type_list;
    public $color;
    public $color_list;

    public function rules()
    {
        return [
            [['material', 'material_list', 'refractive_index', 'surface', 'diameter', 'prescription_type', 'prescription_lens_type', 'color_type', 'color'], 'default'],
        ];
    }
}