@extends('layout')
<link href="{{ url('css/view.css') }}" rel="stylesheet">

@section('title')
    البيانات الرئيسية
@endsection

@section('content')
<div class="container-fluid mt-5">
    <h2 class="text-center mb-5"> Master Data</h2>

    <!-- أزرار الإضافة والاستيراد والتصدير -->
    <div class="mt-1">
        <form action="{{ route('master-data.import') }}" method="POST" enctype="multipart/form-data" class="d-inline-block">
            @csrf
            <div class="input-group mb-2">
                <input type="file" name="file" class="form-control" aria-label="Upload">
                <button class="btn btn-primary">رفع الملف</button>
            </div>
        </form>
    
        <div class="d-flex justify-content-start gap-2">
            <!-- زر تصدير البيانات -->
            <a href="{{ route('master-data.export') }}" class="btn btn-success w-auto">تصدير البيانات</a>
        
            <!-- زر إضافة جديد -->
            <a href="{{ route('master-data.create') }}" class="btn btn-primary w-auto">إضافة جديد</a>
        
            <!-- نموذج لحذف جميع العناصر -->
            <form action="{{ route('master-data.destroyAll') }}" method="POST" style="display:inline-block;" onsubmit="return confirm('هل أنت متأكد أنك تريد حذف جميع العناصر؟');">
                @csrf
                <button type="submit" class="btn btn-danger w-auto">حذف جميع العناصر</button>
            </form>
        </div>
        
        <div class="d-flex justify-content-center mt-4">
            <nav aria-label="Page navigation">
                {{ $data->links('pagination::bootstrap-5') }}
            </nav>
        </div>
        {{-- <form action="{{ route('indexfilter') }}" method="GET">
            <div class="row">
                @foreach(['month', 'date', 'description', 'type', 'claim_number', 'supplier', 'brand', 'car_type', 'model', 'vin', 'chassis_number', 'color', 'storage_location', 'dealer', 'customer', 'stock_balance', 'claim_balance', 'purchase_date', 'claim_count', 'received_count', 'claim_date'] as $field)
                    <div class="col-md-4 mb-3 text-center">
                        <label for="{{ $field }}_filter" class="form-label">{{ ucfirst(str_replace('_', ' ', $field)) }}</label>
                        <select id="{{ $field }}_filter" name="{{ $field }}_filter" class="form-select form-select-sm mx-auto" onchange="this.form.submit()">
                            <option value="">اختر {{ str_replace('_', ' ', $field) }}</option>
                            @foreach(${$field.'s'} as $item)
                                <option value="{{ $item }}" {{ request($field.'_filter') == $item ? 'selected' : '' }}>{{ $item }}</option>
                            @endforeach
                        </select>
                    </div>
                @endforeach
            </div>
        
            <!-- زر إرسال الفلتر -->
            <div class="text-center">
                <button type="submit" class="btn btn-primary px-4">فلترة</button>
            </div>
        </form>
        
        <div class="mt-4">
            @foreach($data as $item)
                <p>{{ $item->description }}</p>
            @endforeach
        
    
        <a href="{{ route('master-data.export', request()->all()) }}" class="btn btn-success btn-sm px-2">
            تصدير إلى Excel
        </a>
    </div> --}}

    <!-- جدول عرض البيانات -->
    <div class="table-responsive mt-4">
        <table class="table table-bordered text-center w-100">
            <thead class="table-dark">
                <tr>
                    <th>الشهر</th>
                    <th>التاريخ</th>
                    <th>البيان</th>
                    <th>النوع</th>
                    <th>رقم المطالبة الموحد</th>
                    <th>المورد</th>
                    <th>براند</th>
                    <th>نوع السيارة</th>
                    <th>الموديل</th>
                    <th>VIN</th>
                    <th>رقم الشاسيه</th>
                    <th>اللون</th>
                    <th>مكان التخزين</th>
                    <th>الوارد</th>
                    <th>التاجر</th>
                    <th>العميل</th>
                    <th>الصادر</th>
                    <th>رصيد المخزون</th>
                    <th>رصيد المطالبة</th>
                    <th>تاريخ الشراء</th>
                    <th>عدد المطالبات</th>
                    <th>عدد المستلم</th>
                    <th>تاريخ المطالبة</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $item)
                    <tr>
                        <td>{{ $item->month }}</td>
                        <td>{{ $item->date }}</td>
                        <td>{{ $item->description }}</td>
                        <td>{{ $item->type }}</td>
                        <td>{{ $item->claim_number }}</td>
                        <td>{{ $item->supplier }}</td>
                        <td>{{ $item->brand }}</td>
                        <td>{{ $item->car_type }}</td>
                        <td>{{ $item->model }}</td>
                        <td>{{ $item->vin }}</td>
                        <td>{{ $item->chassis_number }}</td>
                        <td>{{ $item->color }}</td>
                        <td>{{ $item->storage_location }}</td>
                        <td>{{ $item->incoming }}</td>
                        <td>{{ $item->dealer }}</td>
                        <td>{{ $item->customer }}</td>
                        <td>{{ $item->outgoing }}</td>
                        <td>{{ $item->stock_balance }}</td>
                        <td>{{ $item->claim_balance }}</td>
                        <td>{{ $item->purchase_date }}</td>
                        <td>{{ $item->claim_count }}</td>
                        <td>{{ $item->received_count }}</td>
                        <td>{{ $item->claim_date }}</td>
                        <td>
                            <div class="d-flex justify-content-center gap-3">
                                <a href="{{ route('master-data.show', $item->id) }}" class="btn btn-info btn-sm" style="width: 100px; text-align: center;">عرض التفاصيل</a>

                                <a href="{{ route('master-data.edit', $item->id) }}" class="btn btn-warning btn-sm" style="width: 100px; text-align: center;">تعديل</a>
                               
                                <form action="{{ route('master-data.destroy', $item->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد أنك تريد حذف هذا العنصر؟');" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" style="width: 100px; text-align: center;">حذف</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="24" class="text-muted text-center">لا توجد بيانات لعرضها</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

<style>
    .table-responsive {
        overflow-x: auto;
        width: 100%;
    }

    th, td {
        white-space: nowrap;
        text-overflow: ellipsis;
    }

    table {
        table-layout: auto;
    }

    .table-bordered td, .table-bordered th {
        border: 1px solid #dee2e6;
    }

    th {
        font-size: 14px;
        text-align: center;
    }

    td {
        font-size: 12px;
        text-align: center;
    }

    .table th, .table td {
        padding: 10px 15px;
    }
   
    .btn:hover {
        opacity: 0.9;
        transition: opacity 0.3s;
    }
    .form-label {
    font-size: 0.9rem;
    margin-bottom: 0.2rem;
}
.form-select, .btn {
    padding: 0.2rem 0.5rem;
}



</style>
