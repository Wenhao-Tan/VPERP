<?php
/**
 * Created by PhpStorm.
 * User: Paul
 * Date: 2017/3/28
 * Time: 13:43
 */

namespace frontend\modules\order\models;


use yii\base\Model;
use kartik\mpdf\Pdf;

class Invoice extends Model
{
    public function generateInvoice($content)
    {
        $header['center'] = '<p>Danyang Vision Point Optical Glasses Co.,Ltd</p>';
        $header['center'] .= '<p>16 Xuxi Road, Situ Town, Danyang, Jiangsu, China 212300</p>';

        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8,
            'format' => Pdf::FORMAT_A4,
            'content' => $content,
            'marginTop' => 20,
            'options' => ['title' => 'Proforma Invoice'],
            'methods' => [
                'SetHeader' => ['|'. $header['center'] .'|'],
            ],
            // 'cssFile' => '@common/modules/order/web/css/invoice.css',
        ]);

        return $pdf->render();
    }
}