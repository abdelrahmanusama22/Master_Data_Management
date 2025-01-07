<?php

namespace App\Exports;

use App\Models\MasterData;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MasterDataExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $query = MasterData::query();

        // تطبيق الفلاتر بناءً على الطلب
        foreach (request()->all() as $key => $value) {
            if (!empty($value)) {
                $query->where($key, 'like', '%' . $value . '%');
            }
        }

        // استرجاع البيانات المفلترة
        return $query->get([
            'month',
            'date',
            'description',
            'type',
            'claim_number',
            'supplier',
            'brand',
            'car_type',
            'model',
            'vin',
            'chassis_number',
            'color',
            'storage_location',
            'incoming',
            'dealer',
            'customer',
            'outgoing',
            'stock_balance',
            'claim_balance',
            'purchase_date',
            'claim_count',
            'received_count',
            'claim_date',
        ]);
    }

    public function headings(): array
    {
        return [
            'month',
            'date',
            'description',
            'type',
            'claim_number',
            'supplier',
            'brand',
            'car_type',
            'model',
            'vin',
            'chassis_number',
            'color',
            'storage_location',
            'incoming',
            'dealer',
            'customer',
            'outgoing',
            'stock_balance',
            'claim_balance',
            'purchase_date',
            'claim_count',
            'received_count',
            'claim_date',
        ];
    }
}
