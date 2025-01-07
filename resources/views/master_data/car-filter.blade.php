@extends('layout')
@section('content')

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فلترة السيارات</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Centering the form container */
        .form-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        /* Styling the select input */
        .form-select {
            font-size: 0.9rem;
            padding: 5px 10px;
        }

        /* Button hover effect */
        .btn-primary {
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        /* Styling table */
        .table {
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h4 class="text-center mb-4">فلترة السيارات</h4>

            <form action="{{ route('car.filter.results') }}" method="get">
                <!-- قائمة منسدلة للبراندات -->
                <div class="mb-3">
                    <label for="brand" class="form-label">البراند</label>
                    <select id="brand" name="brand" class="form-select text-center" onchange="this.form.submit()">
                        <option value="">اختر البراند</option>
                        @foreach($brands as $brand)
                            <option value="{{ $brand }}" {{ request('brand') == $brand ? 'selected' : '' }}>{{ $brand }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- زر إرسال الفلتر -->
                <div class="text-center">
                    <button type="submit" class="btn btn-primary px-4">فلترة</button>
                </div>
            </form>
            
        </div>

        <!-- عرض النتائج -->
        <div>
            <h5 class="text-center mt-5">النتائج</h5>
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>البراند</th>
                        <th>المورد</th>
                        <th>نوع السيارة</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($results as $result)
                        <tr>
                            <td>{{ $result->brand }}</td>
                            <td>{{ $result->supplier }}</td>
                            <td>{{ $result->car_type }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted">لا توجد نتائج مطابقة</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

@endsection
