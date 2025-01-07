<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterData extends Model
{
    use HasFactory;
    protected $fillable = [
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
    protected static function boot()
    {
        parent::boot();

        // Calculate stock_balance before creating a record
        static::creating(function ($model) {
            $model->stock_balance = $model->incoming - $model->outgoing;
        });

        // Calculate stock_balance before updating a record
        static::updating(function ($model) {
            $model->stock_balance = $model->incoming - $model->outgoing;
        });
    }
    public function setClaimBalanceAttribute($value)
    {
        // Use the description column to determine the value of claim_balance
        if ($this->description == "مشتريات" || $this->description == "امانات من الغير" || $this->description == "اكتمال التجهيزات") {
            $this->attributes['claim_balance'] = $this->incoming - $this->outgoing;
        } elseif ($this->description == "مبيعات") {
            $this->attributes['claim_balance'] = 0;
        } elseif ($this->description == "مطالبات" || $this->description == "تحت التجهيز" || $this->description == "مردودات مشتريات") {
            $this->attributes['claim_balance'] = 1;
        } else {
            $this->attributes['claim_balance'] = 0;
        }
    }
    public function setPurchaseDateAttribute($value)
    {
        // تطبيق المعادلة على حسب القيمة الموجودة في description
        if ($this->description == "مشتريات" || $this->description == "اكتمال التجهيزات" || $this->description == "امانات من الغير") {
            $this->attributes['purchase_date'] = $value; // تعيين القيمة كما هي (B66620)
        } else {
            $this->attributes['purchase_date'] = '1900-01-01'; // إذا لم تكن الشروط تنطبق
        }
    }
    public function setClaimCountAttribute($value)
    {
        // التحقق من القيمة في description
        if ($this->description == "مطالبات" || $this->description == "تحت التجهيز") {
            $this->attributes['claim_count'] = 1; // إذا كانت "مطالبات" أو "تحت التجهيز" تعيين القيمة 1
        } else {
            $this->attributes['claim_count'] = 0; // خلاف ذلك تعيين القيمة 0
        }
    }
    public function setReceivedCountAttribute($value)
    {
        // التحقق من القيمة في description
        if ($this->description == "مشتريات" || $this->description == "اكتمال التجهيزات") {
            $this->attributes['received_count'] = 1; // إذا كانت "مشتريات" أو "اكتمال التجهيزات" تعيين القيمة 1
        } elseif ($this->description == "مردود مشتريات") {
            $this->attributes['received_count'] = -1; // إذا كانت "مردودات مشتريات" تعيين القيمة -1
        } else {
            $this->attributes['received_count'] = 0; // خلاف ذلك تعيين القيمة 0
        }
    }
    public function setClaimDateAttribute($value)
    {
        // إذا كانت القيمة في description هي "مطالبات" أو "امانات من الغير"
        if ($this->description == "مطالبات" || $this->description == "امانات من الغير") {
            // تعيين claim_date إلى التاريخ المدخل في B66620
            // هنا سنقوم بتعيين التاريخ الحالي على سبيل المثال
            $this->attributes['claim_date'] = now(); // أو يمكن تعيين تاريخ محدد حسب الحاجة
        } else {
            // خلاف ذلك تعيين القيمة 0 (أو تاريخ فارغ)
            $this->attributes['claim_date'] = null;
        }
    }
}
