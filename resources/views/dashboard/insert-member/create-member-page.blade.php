@extends('layouts.templates.att.master')
@push('CSS')
@endpush

@section('Content')

    @if ($errors->any())
        <div class="text-red-500">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="p-2 md:ml-24 md:mr-24">
        <div class="flex justify-center mt-4">
            <img class="w-32" src="{{ asset('assets/images/Logo_of_Cambodian_Red_Cross.svg') }}" alt="">
        </div>
        <div class="">
            <div class="grid grid-cols-12">
                <div class="col-span-8 justify-self-end mt-5">
                    <h1 class="font-battambang text-center text-[17px]">
                        សលាកបត្រពត័មានផ្ទាល់ខ្លួន យុវជនកាកបទក្រហម
                    </h1>
                    <p class="font-battambang text-[17px]">Cambodian Red Cross Youth Individual Information</p>
                </div>
                <div class="col-span-4 flex justify-end">
                    <img  class="w-32 h-36 img" src="" alt="error">
                </div>
            </div>
        </div>

        <form class="w-full" method="POST" action="/create" enctype="multipart/form-data">
            @csrf
            @include('dashboard.insert-member.partials.personal-details')
            <hr>
            <h1 class=" font-battambang my-3">ទីកន្លែងកំណើត (Place of Birth)</h1>
            <hr>
            @include('dashboard.insert-member.partials.place-of-birth-info')
            <hr>
            <h1 class=" font-battambang my-3">អាសយដ្ធានបច្ចុប្បន្ន (Current Address)</h1>
            <hr>
            @include('dashboard.insert-member.partials.current-address-info')
            <hr>
            <hr>
            <h1 class=" font-battambang my-3">
                វគ្គបណ្តុះបណ្តាលដែលទទួលបានកន្លងមក
            </h1>
            <hr>
            @include('dashboard.insert-member.partials.education-info')
            <hr>
            <h1 class=" font-battambang my-3">
                ព័ត៍មានគ្រួសារ
            </h1>
            <hr>
            @include('dashboard.insert-member.partials.family-info')
            <div class="flex justify-end">
                <a class="text-white font-battambang bg-red-700 hover:bg-blue-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800"
                    href="/">មិនយល់ព្រម</a>
                <input
                    class="text-white font-battambang bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                    type="submit" value="យល់ព្រម">
            </div>
        </form>
    </div>
@endsection

@push('JS')
    <script>
        $("#image").change((e) => {
            var file = e.target.files;
            if (file[0].type.startsWith('image/')) {
                console.log("hello");
                var reader = new FileReader();
                reader.onload = function(e) {

                    $("img.img").attr("src", e.target.result);
                };
                reader.readAsDataURL(file[0]);
            }
        });
    </script>
@endpush
