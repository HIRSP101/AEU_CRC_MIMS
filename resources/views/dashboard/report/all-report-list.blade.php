@extends('layouts.templates.att.master')
@push('CSS')
@endpush

@section('Content')

<div class="p-4 shadow">
   <div class="bg-white rounded-md h-screen">
    <h1 class="text-xl font-moul text-gray-900 text-center py-5">របាយការណ៍</h1>
     {{-- card list of all reports --}}
     <div class="py-1 px-5">
        <a href="{{ route('branch') }}" class="block max-w-full p-6 bg-gray-50 border-gray-200 rounded-lg border hover:bg-gray-100">
            <p class="font-semibold text-gray-700 dark:text-gray-600 font-battambang text-[16px]">បញ្ជីរបាយការណ៍សមាជិកនៃសាខា កាកបាទក្រហម ប្រចាំសាខានីមួយៗ</p>
        </a>
     </div>
     <div class="py-1 px-5">
        <a href="{{ route('data-chart') }}" class="block max-w-full p-6 bg-gray-50 border-gray-200 rounded-lg border hover:bg-gray-100">
            <p class="font-semibold text-gray-700 dark:text-gray-600 font-battambang text-[16px]">បញ្ជីរបាយការណ៍សមាជិកនៃសាខា កាកបាទក្រហម ប្រចាំសាខានីមួយៗ</p>
        </a>
     </div>

    <div class="py-1 px-5">
        <details class="mb-2 details-dropdown">
            <summary class="cursor-pointer block max-w-full p-6 bg-gray-50 border-gray-200 rounded-lg border hover:bg-gray-100">
                <span class="font-semibold font-battambang text-gray-700">តារាងទិន្នន័យបច្ចុប្បន្នភាព​ សាមាជិកយុជនតាមគ្រឹះស្ថានឧត្តមសិក្សា</span>
                <span class="dropdown-icon transition-transform duration-300 transform rotate-0 inline-block ml-2 text-red-600">▼</span>
            </summary>
    
            <ul class="ml-8 space-y-2 mt-2">
                <li>
                    <div class="cursor-pointer block max-w-full p-5 bg-gray-50 border-gray-200 rounded-lg border hover:bg-gray-100">
                        <p class="text-gray-700 font-battambang text-[16px] font-semibold">គ្រឹះស្ថានឧត្តមសិក្សា សរុប</p>
                    </div>
                </li>
                <li>
                    <div class="cursor-pointer block max-w-full p-5 bg-gray-50 border-gray-200 rounded-lg border hover:bg-gray-100">
                        <p class="text-gray-700 font-battambang text-[16px] font-semibold">គ្រឹះស្ថានឧត្តមសិក្សា​ សាធារណៈ</p>
                    </div>
                </li>
                <li>
                    <div class="cursor-pointer block max-w-full p-5 bg-gray-50 border-gray-200 rounded-lg border hover:bg-gray-100">
                        <p class="text-gray-700 font-battambang text-[16px] font-semibold">គ្រឹះស្ថានឧត្តមសិក្សា ឯកជន</p>
                    </div>
                </li>
            </ul>
        </details>
    </div>
    
    {{--end card list of all reports --}}
   </div>
</div>

@endsection

@push('JS')
@endpush