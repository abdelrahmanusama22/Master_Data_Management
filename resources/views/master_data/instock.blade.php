@extends('layout')

@section('content')
<div class="container-fluid mt-5">
    <h2 class="text-center mb-5"> InStock </h2>
    <div class="pagination-wrapper d-flex justify-content-center mt-4">
        <nav aria-label="Page navigation">
            {{ $data->appends(request()->query())->links('pagination::bootstrap-4') }}
        </nav>
    </div>
    <!-- الفلاتر -->
    <form action="{{ route('master-data.instock') }}" method="GET">
        <div class="row justify-content-center">
            <!-- فلتر التاريخ -->
            <div class="col-md-4 mb-3 text-center">
                <label for="date_filter" class="form-label d-block text-center">تاريخ</label>
                <select id="date_filter" name="date_filter" class="form-select form-select-sm mx-auto" style="width: 75%; text-align: center; text-align-last: center;" onchange="this.form.submit()">
                    <option value="">اختر تاريخ</option>
                    @foreach($dates as $date)
                        <option value="{{ $date }}" {{ request('date_filter') == $date ? 'selected' : '' }}>{{ $date }}</option>
                    @endforeach
                </select>
            </div>

            <!-- فلتر البيان -->
            <div class="col-md-4 mb-3 text-center">
                <label for="description_filter" class="form-label d-block text-center">البيان</label>
                <select id="description_filter" name="description_filter" class="form-select form-select-sm mx-auto" style="width: 75%; text-align: center; text-align-last: center;" onchange="this.form.submit()">
                    <option value="">اختر البيان</option>
                    @foreach($descriptions as $description)
                        <option value="{{ $description }}" {{ request('description_filter') == $description ? 'selected' : '' }}>{{ $description }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- زر إرسال الفلتر -->
        <div class="text-center">
            <button type="submit" class="btn btn-primary px-4">فلترة</button>
        </div>
    </form>

    <!-- عرض البيانات في الجدول -->
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
                    <th>رصيد المخزن</th>
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
                    </tr>
                @empty
                    <tr>
                        <td colspan="18" class="text-muted">لا توجد بيانات لعرضها</td>
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


</style>