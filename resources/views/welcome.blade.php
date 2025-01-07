@extends('layout')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <h1 class="welcome-title">Welcome to Warehouse El-Tarek</h1>
                <p class="lead welcome-text">We are happy to have you here.</p>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        /* تأثير حركة الدخول للنص */
        .welcome-title {
            font-size: 3rem; 
            font-weight: 600;
            color: #4CAF50; 
            opacity: 0;
            animation: fadeInUp 1.5s ease-out forwards;
        }

        .welcome-text {
            font-size: 1.5rem;
            color: #666;
            opacity: 0;
            animation: fadeInUp 2s ease-out 0.5s forwards; /* تأخير لتأثير النص */
        }

        /* تأثير الحركة للظهور */
        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* تأثير تحريك الصفحة */
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
    </style>
@endsection
