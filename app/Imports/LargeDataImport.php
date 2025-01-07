<?php

namespace App\Imports;

use App\Models\MasterData;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class LargeDataImport implements ToCollection, WithHeadingRow, WithChunkReading
{
    /**
     * معالجة البيانات من الـ Excel
     *
     * @param Collection $rows
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // احصل على التاريخ
            $date = $row['date'];

            if (is_numeric($date)) {
                // تحويل الرقم التسلسلي لتاريخ بتنسيق Y-m-d
                $date = Date::excelToDateTimeObject($date)->format('Y-m-d');
            }

            MasterData::create([
                'month' => $row['month'],
                'date' => isset($row['date']) && is_numeric($row['date'])
                    ? Date::excelToDateTimeObject($row['date'])->format('Y-m-d')
                    : $row['date'], // استخدام التاريخ المرسل أو القيمة البديلة
                'description' => $row['description'],
                'type' => $row['type'],
                'claim_number' => $row['claim_number'],
                'supplier' => $row['supplier'],
                'brand' => $row['brand'],
                'car_type' => $row['car_type'],
                'model' => $row['model'],
                'vin' => $row['vin'],
                'chassis_number' => !empty($row['chassis_number']) ? $row['chassis_number'] : 'N/A',               
                 'color' => $row['color'],
                'storage_location' => $row['storage_location'],
                'incoming' => $row['incoming'],
                'dealer' => $row['dealer'],
                'customer' => $row['customer'],
                'outgoing' => $row['outgoing'],
                'stock_balance' => $row['stock_balance'],
                'claim_balance' => $row['claim_balance'],
                'purchase_date' => isset($row['purchase_date']) && is_numeric($row['purchase_date'])
                ? Date::excelToDateTimeObject($row['purchase_date'])->format('Y-m-d')
                : $row['purchase_date'],
                'claim_count' => $row['claim_count'],
                'received_count' => $row['received_count'],
                'claim_date' => isset($row['claim_date']) && is_numeric($row['claim_date'])
                ? Date::excelToDateTimeObject($row['claim_date'])->format('Y-m-d')
                : $row['claim_date'],
            ]);
        }

    // تحرير الذاكرة بعد كل عملية
    gc_collect_cycles();
    }

    /**
     * حجم الدفعة الواحدة التي يتم معالجتها في الذاكرة
     */
    public function chunkSize(): int
    {
        return 1000; // عدد الصفوف التي ستتم معالجتها في كل دفعة
    }
}
