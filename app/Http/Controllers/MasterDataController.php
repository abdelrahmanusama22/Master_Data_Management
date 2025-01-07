<?php

namespace App\Http\Controllers;
use App\Imports\MasterDataImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Models\MasterData;
use App\Exports\MasterDataExport;
use App\Jobs\ProcessMasterDataImport;
use Illuminate\Support\Facades\Storage;
use App\Imports\LargeDataImport;


class MasterDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = MasterData::paginate(1000); // تحميل 500 سجل في كل صفحة
    return view('master_data.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('master_data.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $masterData = new MasterData();
        $masterData->month = $request->input('month') ?: null;
    $masterData->date = $request->input('date') ?: null;
    $masterData->description = $request->input('description') ?: null;
    $masterData->type = $request->input('type') ?: null;
    $masterData->claim_number = $request->input('claim_number') ?: null;
    $masterData->supplier = $request->input('supplier') ?: null;
    $masterData->brand = $request->input('brand') ?: null;
    $masterData->car_type = $request->input('car_type') ?: null;
    $masterData->model = $request->input('model') ?: null;
    $masterData->vin = $request->input('vin') ?: null;
    $masterData->chassis_number = strip_tags($request->input('chassis_number'));
    $masterData->color = $request->input('color') ?: null;
    $masterData->storage_location = $request->input('storage_location') ?: null;
    $masterData->incoming = $request->input('incoming') ?: null;
    $masterData->dealer = $request->input('dealer') ?: null;
    $masterData->customer = $request->input('customer') ?: null;
    $masterData->outgoing = $request->input('outgoing') ?: null;
    $masterData->stock_balance = $request->input('stock_balance') ?: null;
    $masterData->claim_balance = $request->input('claim_balance') ?: null;
    $masterData->purchase_date = $request->input('purchase_date') ?: null;
    $masterData->claim_count = $request->input('claim_count') ?: null;
    $masterData->received_count = $request->input('received_count') ?: null;
    $masterData->claim_date = $request->input('claim_date') ?: null;

    
    // حفظ البيانات في قاعدة البيانات
    $masterData->save();
    
        // Redirect back with a success message
        return redirect()->route('master-data.index')->with('success', 'تم إضافة البيانات بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $item = MasterData::findOrFail($id);

        // إرجاع الصفحة مع البيانات
        return view('master_data.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // جلب البيانات من قاعدة البيانات باستخدام الـ id
    $item = MasterData::findOrFail($id);
    
    // تمرير البيانات إلى الـ view
    return view('master_data.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    // Validation
    $validator = $request->validate([
        'month' => 'nullable|string|max:255',
        'date' => 'nullable|date',
        'description' => 'nullable|string|max:500',
        'type' => 'nullable|string|max:255',
        'claim_number' => 'nullable|string|max:255',
        'supplier' => 'nullable|string|max:255',
        'brand' => 'nullable|string|max:255',
        'car_type' => 'nullable|string|max:255',
        'model' => 'nullable|string|max:255',
        'vin' => 'nullable|string|max:255',
        'chassis_number' => 'nullable|string|max:255',
        'color' => 'nullable|string|max:50',
        'storage_location' => 'nullable|string|max:255',
        'incoming' => 'nullable|numeric',
        'dealer' => 'nullable|string|max:255',
        'customer' => 'nullable|string|max:255',
        'outgoing' => 'nullable|numeric',
        'stock_balance' => 'nullable|numeric',
        'claim_balance' => 'nullable|numeric',
        'purchase_date' => 'nullable|date',
        'claim_count' => 'nullable|integer',
        'received_count' => 'nullable|integer',
        'claim_date' => 'nullable|date',
    ]);

    $requiredFields = [
        'chassis_number',
    ];

    // Check if any required field is missing or empty
    foreach ($requiredFields as $field) {
        if (empty($request->input($field))) {
            return redirect()->back()
                             ->withErrors([$field => 'الرجاء ملء جميع الحقول المطلوبة.'])
                             ->withInput();
        }
    }

    // Find the record
    $item = MasterData::findOrFail($id);

    // Update the attributes with sanitized data
    $item->month = strip_tags($request->input('month'));
    $item->date = $request->input('date');
    $item->description = strip_tags($request->input('description'));
    $item->type = strip_tags($request->input('type'));
    $item->claim_number = strip_tags($request->input('claim_number'));
    $item->supplier = strip_tags($request->input('supplier'));
    $item->brand = strip_tags($request->input('brand'));
    $item->car_type = strip_tags($request->input('car_type'));
    $item->model = strip_tags($request->input('model'));
    $item->vin = strip_tags($request->input('vin'));
    $item->chassis_number = strip_tags($request->input('chassis_number'));
    $item->color = strip_tags($request->input('color'));
    $item->storage_location = strip_tags($request->input('storage_location'));
    $item->incoming = $request->input('incoming');
    $item->dealer = strip_tags($request->input('dealer'));
    $item->customer = strip_tags($request->input('customer'));
    $item->outgoing = $request->input('outgoing');
    $item->stock_balance = $request->input('stock_balance');
    $item->claim_balance = $request->input('claim_balance');
    $item->purchase_date = $request->input('purchase_date');
    $item->claim_count = $request->input('claim_count');
    $item->received_count = $request->input('received_count');
    $item->claim_date = $request->input('claim_date');

    // Save the changes
    $item->save();

    // Redirect with a success message
    return redirect()->route('master-data.index')->with('success', 'تم تعديل السجل بنجاح.');
}



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
{
    try {
        // البحث عن السجل باستخدام المعرف
        $item = MasterData::findOrFail($id);

        // حذف السجل
        $item->delete();

        // إعادة توجيه مع رسالة نجاح
        return redirect()->route('master-data.index')->with('success', 'تم حذف العنصر بنجاح.');
    } catch (\Exception $e) {
        // التعامل مع الأخطاء إذا لم يتم العثور على السجل أو حدث خطأ آخر
        return redirect()->route('master-data.index')->with('error', 'حدث خطأ أثناء محاولة حذف العنصر.');
    }
}
public function destroyAll()
{
    try {
        // حذف جميع السجلات
        MasterData::truncate();

        // إعادة توجيه مع رسالة نجاح
        return redirect()->route('master-data.index')->with('success', 'تم حذف جميع العناصر بنجاح.');
    } catch (\Exception $e) {
        // التعامل مع الأخطاء إذا حدث خطأ أثناء الحذف
        return redirect()->route('master-data.index')->with('error', 'حدث خطأ أثناء محاولة حذف جميع العناصر.');
    }
}


  
public function filter(Request $request)
{
    $brand = $request->input('brand');
    $supplier = $request->input('supplier');
    $carType = $request->input('car_type');

    // بناء استعلام الفلتر الأساسي
    $query = MasterData::query();

    // تطبيق الفلاتر بناءً على المدخلات
    if ($brand) {
        $query->where('brand', $brand);
    }
    if ($supplier) {
        $query->where('supplier', $supplier);
    }
    if ($carType) {
        $query->where('car_type', $carType);
    }

    // تحديد الأعمدة المطلوبة فقط لاستخدام GROUP BY
    $results = $query->select('brand', 'supplier', 'car_type')
                     ->groupBy('brand', 'supplier', 'car_type')
                     ->paginate(10);  // 10 عناصر لكل صفحة

    // جلب البراندات المتاحة
    $brands = MasterData::distinct()->pluck('brand');

    // جلب الموردين بناءً على البراند المختار
    $suppliers = $brand ? MasterData::where('brand', $brand)->distinct()->pluck('supplier') : [];

    // جلب أنواع السيارات بناءً على البراند والمورد المختار
    $carTypes = $supplier ? MasterData::where('supplier', $supplier)->distinct()->pluck('car_type') : [];

    // إرجاع البيانات إلى العرض
    return view('master_data.car-filter', compact('results', 'brands', 'suppliers', 'carTypes'));
}


public function import(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:xlsx,csv|max:10240', // تأكد من صحة امتداد وحجم الملف
    ]);

    // استيراد البيانات
    Excel::import(new LargeDataImport, $request->file('file'));

    return back()->with('success', 'تم الاستيراد بنجاح');
}


   

public function export(Request $request)
{
    return Excel::download(new MasterDataExport($request->all()), 'master_data.xlsx');
}
public function instock(Request $request)
{
    
    // الحصول على البيانات المميزة للتاريخ والبيان من قاعدة البيانات
    $dates = MasterData::distinct()->pluck('date');
    $descriptions = MasterData::distinct()->pluck('description');

    // تطبيق الفلاتر إذا كانت موجودة
    $query = MasterData::query();

    if ($request->has('date_filter') && $request->date_filter != '') {
        $query->where('date', $request->date_filter);
    }

    if ($request->has('description_filter') && $request->description_filter != '') {
        $query->where('description', $request->description_filter);
    }

    // استرجاع البيانات مع التصفح
    $data = $query->paginate(1000); // 10 يمثل عدد العناصر لكل صفحة

    // تمرير البيانات إلى الـ view
    return view('master_data.instock', compact('data', 'dates', 'descriptions'));
}
public function indexfilter(Request $request)
{   
    $months = MasterData::distinct()->pluck('month');
    $dates = MasterData::distinct()->pluck('date');
    $descriptions = MasterData::distinct()->pluck('description');
    $types = MasterData::distinct()->pluck('type');
    $claimNumbers = MasterData::distinct()->pluck('claim_number');
    $suppliers = MasterData::distinct()->pluck('supplier');
    $brands = MasterData::distinct()->pluck('brand');
    $carTypes = MasterData::distinct()->pluck('car_type');
    $models = MasterData::distinct()->pluck('model');
    $vins = MasterData::distinct()->pluck('vin');
    $chassisNumbers = MasterData::distinct()->pluck('chassis_number');
    $colors = MasterData::distinct()->pluck('color');
    $storageLocations = MasterData::distinct()->pluck('storage_location');
    $dealers = MasterData::distinct()->pluck('dealer');
    $customers = MasterData::distinct()->pluck('customer');
    $stockBalances = MasterData::distinct()->pluck('stock_balance');
    $claimBalances = MasterData::distinct()->pluck('claim_balance');
    $purchaseDates = MasterData::distinct()->pluck('purchase_date');
    $claimCounts = MasterData::distinct()->pluck('claim_count');
    $receivedCounts = MasterData::distinct()->pluck('received_count');
    $claimDates = MasterData::distinct()->pluck('claim_date');

    // استرجاع البيانات مع الفلاتر المحددة
    $query = MasterData::query();

    // تطبيق الفلاتر حسب الحقول المختارة
    if ($request->has('month') && $request->month != '') {
        $query->where('month', $request->month);
    }
    if ($request->has('date') && $request->date != '') {
        $query->where('date', $request->date);
    }
    if ($request->has('description') && $request->description != '') {
        $query->where('description', $request->description);
    }
    if ($request->has('type') && $request->type != '') {
        $query->where('type', $request->type);
    }
    if ($request->has('claim_number') && $request->claim_number != '') {
        $query->where('claim_number', $request->claim_number);
    }
    if ($request->has('supplier') && $request->supplier != '') {
        $query->where('supplier', $request->supplier);
    }
    if ($request->has('brand') && $request->brand != '') {
        $query->where('brand', $request->brand);
    }
    if ($request->has('car_type') && $request->car_type != '') {
        $query->where('car_type', $request->car_type);
    }
    if ($request->has('model') && $request->model != '') {
        $query->where('model', $request->model);
    }
    if ($request->has('vin') && $request->vin != '') {
        $query->where('vin', $request->vin);
    }
    if ($request->has('chassis_number') && $request->chassis_number != '') {
        $query->where('chassis_number', $request->chassis_number);
    }
    if ($request->has('color') && $request->color != '') {
        $query->where('color', $request->color);
    }
    if ($request->has('storage_location') && $request->storage_location != '') {
        $query->where('storage_location', $request->storage_location);
    }
    if ($request->has('dealer') && $request->dealer != '') {
        $query->where('dealer', $request->dealer);
    }
    if ($request->has('customer') && $request->customer != '') {
        $query->where('customer', $request->customer);
    }
    if ($request->has('stock_balance') && $request->stock_balance != '') {
        $query->where('stock_balance', $request->stock_balance);
    }
    if ($request->has('claim_balance') && $request->claim_balance != '') {
        $query->where('claim_balance', $request->claim_balance);
    }
    if ($request->has('purchase_date') && $request->purchase_date != '') {
        $query->where('purchase_date', $request->purchase_date);
    }
    if ($request->has('claim_count') && $request->claim_count != '') {
        $query->where('claim_count', $request->claim_count);
    }
    if ($request->has('received_count') && $request->received_count != '') {
        $query->where('received_count', $request->received_count);
    }
    if ($request->has('claim_date') && $request->claim_date != '') {
        $query->where('claim_date', $request->claim_date);
    }

    // استرجاع البيانات مع التصفح
    $data = $query->paginate(100);

    // تمرير البيانات إلى الـ view
    return view('master_data.index', compact(
        'data', 'months', 'dates', 'descriptions', 'types', 'claimNumbers', 'suppliers',
        'brands', 'carTypes', 'models', 'vins', 'chassisNumbers', 'colors', 'storageLocations',
        'dealers', 'customers', 'stockBalances', 'claimBalances', 'purchaseDates', 'claimCounts',
        'receivedCounts', 'claimDates'
    ));
}
}










    








    




