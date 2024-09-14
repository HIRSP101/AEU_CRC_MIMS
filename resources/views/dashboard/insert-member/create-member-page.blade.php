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
    
    <div class="p-5 md:ml-24 md:mr-24">
        <form class="w-full" method="POST" action="/create" enctype="multipart/form-data">
            @csrf
            @include('dashboard.insert-member.partials.personal-details')
            <hr>
            <h1 class="my-3">ទីកន្លែងកំណើត (Place of Birth)</h1>
            <hr>
            @include('dashboard.insert-member.partials.place-of-birth-info')
            <hr>
            <h1 class="my-3">អាសយដ្ធានបច្ចុប្បន្ន (Current Address)</h1>
            <hr>
            @include('dashboard.insert-member.partials.current-address-info')
            <hr>
            <hr>
            <h1 class="my-3">
                វគ្គបណ្តុះបណ្តាលដែលទទួលបានកន្លងមក
            </h1>
            <hr>
            @include('dashboard.insert-member.partials.education-info')
            <hr>
            <h1 class="my-3">
                ព័ត៍មានគ្រួសារ
            </h1>
            <hr>
            @include('dashboard.insert-member.partials.family-info')
            <div class="flex justify-end">
                <a class="border-solid m-2 border-2 bg-red-400 p-2 rounded-md hover:bg-red-500 active:bg-red-600 focus:outline-none focus:ring focus:ring-red-300"
                    href="/">មិនយល់ព្រម</a>
                <input
                    class="border-solid m-2 border-2 bg-green-500 p-2 rounded-md hover:bg-green-600 active:bg-green-700 focus:outline-none focus:ring focus:ring-green-300"
                    type="submit" value="យល់ព្រម">
            </div>
        </form>
    </div>
@endsection

@push('JS')
@endpush
