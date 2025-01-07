@extends('layout')

@section('content')
<div class="container mt-4">
    <h1 class="text-center mb-4">تعديل بيانات الماستر</h1>

    <!-- عرض رسالة نجاح أو خطأ -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('master-data.update', $item->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="month" class="form-label">الشهر</label>
                    <input type="text" class="form-control" id="month" name="month" value="{{ old('month', $item->month) }}" >
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="date" class="form-label">التاريخ</label>
                    <input type="date" class="form-control" id="date" name="date" value="{{ old('date', $item->date) }}" >
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">البيان</label>
            <select class="form-select" id="description" name="description" >
                <option value="" disabled selected>اختر البيان</option>
                <option value="مطالبات">مطالبات</option>
                <option value="مشتريات">مشتريات</option>
                <option value="تحويل مخازن">تحويل مخازن</option>
                <option value="مبيعات">مبيعات</option>
                <option value="بضاعه امانة">بضاعه امانة</option>
                <option value="خروج للصيانه">خروج للصيانه</option>
                <option value="صيانه">صيانه</option>
                <option value="رجوع من الصيانه">رجوع من الصيانه</option>
                <option value="امانات من الغير">امانات من الغير</option>
                <option value="خروج PDI">خروج PDI</option>
                <option value="PDI">PDI</option>
                <option value="رجوع من PDI">رجوع من PDI</option>
                <option value="Assets">Assets</option>
                <option value="خروج تجهيزات">خروج تجهيزات</option>
                <option value="تحت التجهيز">تحت التجهيز</option>
                <option value="اكتمال التجهيزات">اكتمال التجهيزات</option>
                <option value="لاغى">لاغى</option>
                <option value="مردود مشتريات">مردود مشتريات</option>
                <option value="مرتجع">مرتجع</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">النوع</label>
            <select class="form-select" id="type" name="type" >
                <option value="" disabled selected>اختر النوع</option>
                <option value="سكوتر">سكوتر</option>
                <option value="سيارات">سيارات</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="claim_number" class="form-label">رقم المطالبة الموحد</label>
            <input type="text" class="form-control" id="claim_number" name="claim_number" value="{{ old('claim_number', $item->claim_number) }}" >
        </div>

        <div class="mb-3">
            <label for="supplier" class="form-label">المورد</label>
            <input type="text" class="form-control" id="supplier" name="supplier" value="{{ old('supplier', $item->supplier) }}" >
        </div>

        <div class="mb-3">
            <label for="brand" class="form-label">براند</label>
            <input type="text" class="form-control" id="brand" name="brand" value="{{ old('brand', $item->brand) }}" >
        </div>

        <div class="mb-3">
            <label for="car_type" class="form-label">نوع السيارة</label>
            <input type="text" class="form-control" id="car_type" name="car_type" value="{{ old('car_type', $item->car_type) }}" >
        </div>

        <div class="mb-3">
            <label for="model" class="form-label">الموديل</label>
            <input type="text" class="form-control" id="model" name="model" value="{{ old('model', $item->model) }}" >
        </div>

        <div class="mb-3">
            <label for="vin" class="form-label">VIN</label>
            <input type="text" class="form-control" id="vin" name="vin" value="{{ old('vin', $item->vin) }}" >
        </div>

        <div class="mb-3">
            <label for="chassis_number" class="form-label">رقم الشاسيه</label>
            <input type="text" class="form-control" id="chassis_number" name="chassis_number" value="{{ old('chassis_number', $item->chassis_number) }}" >
            @error('chassis_number')
            <div class="text-danger">{{ $message }}</div>
             @enderror
        </div>

        <div class="mb-3">
            <label for="color" class="form-label">اللون</label>
            <input type="text" class="form-control" id="color" name="color" value="{{ old('color', $item->color) }}" >
        </div>

        <div class="mb-3">
            <label for="storage_location" class="form-label">مكان التخزين</label>
            <select class="form-select" id="storage_location" name="storage_location" >
                <option value="" disabled selected>اختر مكان التخزين</option>
                <option value="المطار">المطار</option>
                <option value="القبارى">القبارى</option>
                <option value="القريه الذكيه">القريه الذكيه</option>
                <option value="اكتوبر">اكتوبر</option>
                <option value="ابو رواش">ابو رواش</option>
                <option value="مركز خدمه">مركز خدمه</option>
                <option value="مخزن امانات">مخزن امانات</option>
                <option value="كارفور">كارفور</option>
                <option value="مول العرب">مول العرب</option>
                <option value="نيسان">نيسان</option>
                <option value="طنطا">طنطا</option>
                <option value="العجوزه">العجوزه</option>
                <option value="سبورتنج">سبورتنج</option>
                <option value="م.خدمه نيسان">م.خدمه نيسان</option>
                <option value="مصطفى كامل">مصطفى كامل</option>
                <option value="سيدى بشر">سيدى بشر</option>
                <option value="محطه الرمل">محطه الرمل</option>
                <option value="الحرفيين">الحرفيين</option>
                <option value="مرور">مرور</option>
                <option value="نقطه شركه محرم بيه">نقطه شركه محرم بيه</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="incoming" class="form-label">الوارد</label>
            <input type="number" class="form-control" id="incoming" name="incoming" value="{{ old('incoming', $item->incoming) }}" >
        </div>

        <div class="mb-3">
            <label for="dealer" class="form-label">التاجر</label>
            <input type="text" class="form-control" id="dealer" name="dealer" value="{{ old('dealer', $item->dealer) }}" >
        </div>

        <div class="mb-3">
            <label for="customer" class="form-label">العميل</label>
            <input type="text" class="form-control" id="customer" name="customer" value="{{ old('customer', $item->customer) }}" >
        </div>

        <div class="mb-3">
            <label for="outgoing" class="form-label">الصادر</label>
            <input type="number" class="form-control" id="outgoing" name="outgoing" value="{{ old('outgoing', $item->outgoing) }}" >
        </div>

        <div class="mb-3">
            <label for="stock_balance" class="form-label">رصيد المخزون</label>
            <input type="number" class="form-control" id="stock_balance" name="stock_balance" value="{{ old('stock_balance', $item->stock_balance) }}" >
        </div>

        <div class="mb-3">
            <label for="claim_balance" class="form-label">رصيد المطالبة</label>
            <input type="number" class="form-control" id="claim_balance" name="claim_balance" value="{{ old('claim_balance', $item->claim_balance) }}" >
        </div>

        <div class="mb-3">
            <label for="purchase_date" class="form-label">تاريخ الشراء</label>
            <input type="date" class="form-control" id="purchase_date" name="purchase_date" value="{{ old('purchase_date', $item->purchase_date) }}" >
        </div>

        <div class="mb-3">
            <label for="claim_count" class="form-label">عدد المطالبات</label>
            <input type="number" class="form-control" id="claim_count" name="claim_count" value="{{ old('claim_count', $item->claim_count) }}" >
        </div>

        <div class="mb-3">
            <label for="received_count" class="form-label">عدد المستلم</label>
            <input type="number" class="form-control" id="received_count" name="received_count" value="{{ old('received_count', $item->received_count) }}" >
        </div>

        <div class="mb-3">
            <label for="claim_date" class="form-label">تاريخ المطالبة</label>
            <input type="date" class="form-control" id="claim_date" name="claim_date" value="{{ old('claim_date', $item->claim_date) }}" >
        </div>

        <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
    </form>
</div>
@endsection
