<!DOCTYPE html>
<html lang="en">

<head>
    <title>ប្រព័ន្ធគ្រប់គ្រងព័ត៍មានសមាជិក</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('js/handlemodal.js') }}"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" type="image/x-icon" href="{{URL::asset('images/Logo_of_Cambodian_Red_Cross.svg')}}">
    @stack('CSS')
</head>

<body class="bg-gray-100">
    <div class="h-16 bg-cover bg-no-repeat border-b border-gray-200" style="background: #B30202"></div>
    @yield('Content')
    @stack('JS')
</body>