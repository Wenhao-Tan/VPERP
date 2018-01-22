<?php

namespace common\modules\order\models;

use yii\data\ArrayDataProvider;
use yii\db\ActiveRecord;
use yii\db\Exception;

class OrderItem extends ActiveRecord
{
    public function rules()
    {
        return [
            [['reference', 'color', 'quantity', 'unit_price'], 'required'],
            [['order_id', 'id', 'sku', 'amount'], 'safe'],
        ];
    }

    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['order_id' => 'order_id']);
    }

    public function loadExcel($filePath)
    {
        // Load Uploaded Excel File & Get Sheet
        $objPHPExcel = \PHPExcel_IOFactory::load($filePath);
        $objWorksheet = $objPHPExcel->getSheet(0);

        return $objWorksheet;
    }

    public function calculateOrderQuantity($objWorksheet)
    {
        $highestRow = $objWorksheet->getHighestRow();

        $totalQuantities = \PHPExcel_Calculation_MathTrig::SUM(
            $objWorksheet->rangeToArray('C2:C'.$highestRow)
        );

        return $totalQuantities;
    }

    public function generateItems($filePath)
    {
        $objWorksheet = $this->loadExcel($filePath);

        $tableHeader = ['reference', 'color', 'quantity', 'unit_price'];
        $items = [];
        $columns = [];
        $orderAmount = 0;

        $rowCount = 1;
        foreach ($objWorksheet->getRowIterator() as $row) {
            if ($rowCount == 1) {
                $rowCount++;
                continue;
            }

            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells();
            $colCount = 0;
            foreach ($cellIterator as $cell) {
                $header = $tableHeader[$colCount];
                $colCount++;

                $cellValue = $cell->getValue();

                switch ($header) {
                    case 'reference':
                        $cellValue = strtoupper($cellValue);
                        break;
                    case 'color':
                        $cellValue = ucfirst(strtolower($cellValue));
                        break;
                    case 'quantity':
                        if ($cellValue == 0) {
                            throw new Exception('The quantity can NOT be 0');
                        }
                        break;
                    case 'unit_price':
                        if ($cellValue == 0) {
                            throw new Exception('The unit price can NOT be 0');
                        } else {
                            $cellValue = number_format($cellValue, 2);
                        }
                        break;
                }

                $columns[$header] = $cellValue;
            }


            $columns['amount'] = $columns['quantity'] * $columns['unit_price'];
            $columns['amount'] = number_format($columns['amount'], 2);
            $items[] = $columns;

            $orderAmount += $columns['amount'];
            $rowCount++;

        }

        return $items;
    }

    public function generateDataProvider($filePath = '')
    {
        $items = [
            ['reference' => '', 'color' => '', 'quantity' => '', 'unit_price' => '', 'amount' => '']
        ];

        if ($filePath) {
            $items = $this->generateItems($filePath);
        }

        $dataProvider = new ArrayDataProvider([
            'allModels' => $items,
            'pagination' => false,
        ]);

        return $dataProvider;
    }

    public static function getTotalQuantity($items)
    {
        $total = 0;

        foreach ($items as $item) {
            $total += $item->quantity;
        }

        return $total;
    }

    public static function getTotalAmount($items)
    {
        $total = 0;

        foreach ($items as $item) {
            $total += $item->quantity * $item->unit_price;
        }

        $total = number_format((float)$total, 2);

        return $total;
    }
}