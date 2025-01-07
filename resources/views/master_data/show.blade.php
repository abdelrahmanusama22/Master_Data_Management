@extends('layout')

@section('title')
    عرض تفاصيل السجل
@endsection

@section('content')
    <div class="container mt-5">
        <h2>تفاصيل السجل</h2>
        <ul class="list-group">
            <li class="list-group-item"><strong>الشهر:</strong> {{ $item->month }}</li>
            <li class="list-group-item"><strong>التاريخ:</strong> {{ $item->date }}</li>
            <li class="list-group-item"><strong>الوصف:</strong> {{ $item->description }}</li>
            <li class="list-group-item"><strong>النوع:</strong> {{ $item->type }}</li>
            <li class="list-group-item"><strong>رقم المطالبة:</strong> {{ $item->claim_number }}</li>
            <li class="list-group-item"><strong>المورد:</strong> {{ $item->supplier }}</li>
            <li class="list-group-item"><strong>العلامة التجارية:</strong> {{ $item->brand }}</li>
            <li class="list-group-item"><strong>نوع السيارة:</strong> {{ $item->car_type }}</li>
            <li class="list-group-item"><strong>الموديل:</strong> {{ $item->model }}</li>
            <li class="list-group-item"><strong>رقم الشاسيه:</strong> {{ $item->chassis_number }}</li>
            <li class="list-group-item"><strong>اللون:</strong> {{ $item->color }}</li>
            <li class="list-group-item"><strong>موقع التخزين:</strong> {{ $item->storage_location }}</li>
            <li class="list-group-item"><strong>عدد الوارد:</strong> {{ $item->incoming }}</li>
            <li class="list-group-item"><strong>التاجر:</strong> {{ $item->dealer }}</li>
            <li class="list-group-item"><strong>العميل:</strong> {{ $item->customer }}</li>
            <li class="list-group-item"><strong>عدد الصادر:</strong> {{ $item->outgoing }}</li>
            <li class="list-group-item"><strong>رصيد المخزون:</strong> {{ $item->stock_balance }}</li>
            <li class="list-group-item"><strong>رصيد المطالبة:</strong> {{ $item->claim_balance }}</li>
            <li class="list-group-item"><strong>تاريخ الشراء:</strong> {{ $item->purchase_date ? $item->purchase_date->format('Y-m-d') : 'غير محدد' }}</li>
            <li class="list-group-item"><strong>عدد المطالبات:</strong> {{ $item->claim_count }}</li>
            <li class="list-group-item"><strong>عدد المستلم:</strong> {{ $item->received_count }}</li>
            <li class="list-group-item"><strong>تاريخ المطالبة:</strong> {{ $item->claim_date ? $item->claim_date->format('Y-m-d') : 'غير محدد' }}</li>
        </ul>
        <a href="{{ route('master-data.index') }}" class="btn btn-primary mt-3">الرجوع إلى القائمة</a>
    </div>
@endsection
