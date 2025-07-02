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
        <link href="{{ asset('build/assets/app.css') }}" rel="stylesheet">
        <script src="{{ asset('build/assets/app.js') }}"></script>
        <script src="{{ asset('js/exportToPdf.js') }}"></script>
        <script src="{{asset("js/vfs_fonts.min.js")}}"></script>
        <script src="{{asset("js/pdfmake.min.js")}}"></script>
        <script src="{{ asset('js/jszip.min.js') }}"></script>
        <script src="{{ asset('js/FileSaver.min.js') }}"></script>
        <link rel="icon" type="image/x-icon" href="{{URL::asset('images/Logo_of_Cambodian_Red_Cross.svg')}}">
        @stack('CSS')
    </head>

    <body>
        <div id="loading-overlay">
            <div class="loading-spinner"></div>
        </div>
        <div class="flex h-screen">
            <div id="body" class="transition-transform flex flex-col flex-1 overflow-y-auto bg-[#F1F5F9]">
                <div class="relative h-16 bg-cover bg-no-repeat border-b border-gray-200 px-4 py-1"
                    style="background: #B30202">
                    <!-- Centered logo absolutely -->
                    <!-- Optional left/right content below -->
                    <div class="flex items-center justify-between h-full relative z-10">
                        <div class="w-20"></div> <!-- Placeholder or left content -->
                        <div class="flex-1 mx-4"></div> <!-- Center or right content -->
                    </div>
        
                    @yield('Content')


                    @stack('JS')