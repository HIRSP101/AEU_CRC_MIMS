@extends('layouts.templates.att.master')
@push('CSS')
@vite('resources/css/style.css')
@endpush

@section('Table')
<div class="bg-[#fff] p-8 rounded-lg max-w-1000px m-5 shadow-md flex flex-col ">
  <div class="grid sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-1">
    <div class="table-controls ">
      <div class="selection">
        <label>Show entries</label>
        <div class="custom-select">
          <select id="entries">
            <option>25</option>
            <option>50</option>
            <option>75</option>
            <option>100</option>
          </select>
        </div>
      </div>
      <div class="table-buttons">
        {{-- <button>Export to CSV</button> --}}
        <button>Export to Excel</button>
        <button>Print</button>
        {{-- <button>Column visibility</button> --}}
        <button>Export to PDF</button>
      </div>
      <input type="text" placeholder="Search..." />
    </div>
  </div> 

  <div class="shadow-sm rounded-lg mt-3.5 overflow-auto">
    <table class="w-full table-fixed">
        <thead>
            <tr class="bg-gray-100">
                <th class="w-1/12 py-4 px-2 text-left text-red-600 font-bold uppercase font-siemreap">ល.រ</th>
                <th class="w-1/4 py-4 px-2 text-left text-red-600 font-bold uppercase font-siemreap">ឈ្មោះ​ឡាតាំង</th>
                <th class="w-1/12 py-4 px-2 text-left text-red-600 font-bold uppercase font-siemreap">ភេទ</th>
                <th class="w-1/4 py-4 px-2 text-left text-red-600 font-bold uppercase font-siemreap">ថ្ងៃខែឆ្នាំកំណើត</th>
                <th class="w-1/4 py-4 px-2 text-left text-red-600 font-bold uppercase font-siemreap">គ្រិះស្ថានសិក្សា</th>
                <th class="w-1/4 py-4 px-2 text-left text-red-600 font-bold uppercase font-siemreap">ឆ្នាំសិក្សា</th>
                <th class="w-1/4 py-4 px-2 text-left text-red-600 font-bold uppercase font-siemreap">អាស័យដ្ឋានបច្ចុប្បន្ន</th>
                <th class="w-1/5 py-4 px-2 text-left text-red-600 font-bold uppercase font-siemreap">ជំនាញ</th>
                <th class="w-1/5 py-4 px-2 text-left text-red-600 font-bold uppercase font-siemreap">លេខទូរសព្ទ</th>
            </tr>
        </thead>
        <tbody class="bg-white">
            <tr>
                <td class="py-4 px-2 border-b border-gray-200">1</td>
                <td class="py-4 px-2 border-b border-gray-200 truncate">123</td>
                <td class="py-4 px-2 border-b border-gray-200">555</td>
                <td class="py-4 px-2 border-b border-gray-200">555</td>
                <td class="py-4 px-2 border-b border-gray-200">555</td>
                <td class="py-4 px-2 border-b border-gray-200">555</td>
                <td class="py-4 px-2 border-b border-gray-200">555</td>
                <td class="py-4 px-2 border-b border-gray-200">555</td>
                <td class="py-4 px-2 border-b border-gray-200">555</td>
            </tr>
            <!-- Add more rows here -->
        </tbody>
    </table>
</div>


      <tbody>
            {{-- <tr class="bg-white border-b text-gray-700 hover:bg-[#caced1]">
                <td class="px-6 py-4">
                  សរសេរ តាមចិត្ត
                </td>
                <td class="px-6 py-4">
                    Silver
                </td>
                <td class="px-6 py-4">
                  ប្រុស
                </td>
                <td class="px-6 py-4">
                    20/5/2025
                </td>
                <td class="px-6 py-4">
                  សមាជិក យុវជន
                </td>
                <td class="px-6 py-4">
                  សាកលវិទ្យាល័យអាស៊ី អ៊ឺរ៉ុប
                </td>
                <td class="px-6 py-4">
                    2
                </td>
                <td class="px-6 py-4">
                  31/12/2025
                </td>
                <td class="px-6 py-4">
                  ខណ្ឌឫស្សីកែវ ភ្នំពេញ
                </td>
                <td class="px-6 py-4">
                  ព័ត៍មានវិទ្យា
                </td>
                <td class="px-6 py-4">
                  065897124
                </td>
                <td class="px-6 py-4">
                    L
                </td>
                <td class="px-6 py-4 text-right">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">View</a>
                </td>
            </tr>
            <tr class="bg-white border-b text-gray-700 hover:bg-[#caced1]">
                <td class="px-6 py-4">
                  សរសេរ តាមចិត្ត
                </td>
                <td class="px-6 py-4">
                    Silver
                </td>
                <td class="px-6 py-4">
                  ប្រុស
                </td>
                <td class="px-6 py-4">
                    20/5/2025
                </td>
                <td class="px-6 py-4">
                  សមាជិក យុវជន
                </td>
                <td class="px-6 py-4">
                  សាកលវិទ្យាល័យអាស៊ី អ៊ឺរ៉ុប
                </td>
                <td class="px-6 py-4">
                    2
                </td>
                <td class="px-6 py-4">
                  31/12/2025
                </td>
                <td class="px-6 py-4">
                  ខណ្ឌឫស្សីកែវ ភ្នំពេញ
                </td>
                <td class="px-6 py-4">
                  ព័ត៍មានវិទ្យា
                </td>
                <td class="px-6 py-4">
                  065897124
                </td>
                <td class="px-6 py-4">
                    L
                </td>
                <td class="px-6 py-4 text-right">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">View</a>
                </td>
            </tr>
            <tr class="bg-white border-b text-gray-700 hover:bg-[#caced1]">
                <td class="px-6 py-4">
                  សរសេរ តាមចិត្ត
                </td>
                <td class="px-6 py-4">
                    Silver
                </td>
                <td class="px-6 py-4">
                  ប្រុស
                </td>
                <td class="px-6 py-4">
                    20/5/2025
                </td>
                <td class="px-6 py-4">
                  សមាជិក យុវជន
                </td>
                <td class="px-6 py-4">
                  សាកលវិទ្យាល័យអាស៊ី អ៊ឺរ៉ុប
                </td>
                <td class="px-6 py-4">
                    2
                </td>
                <td class="px-6 py-4">
                  31/12/2025
                </td>
                <td class="px-6 py-4">
                  ខណ្ឌឫស្សីកែវ ភ្នំពេញ
                </td>
                <td class="px-6 py-4">
                  ព័ត៍មានវិទ្យា
                </td>
                <td class="px-6 py-4">
                  065897124
                </td>
                <td class="px-6 py-4">
                    L
                </td>
                <td class="px-6 py-4 text-right">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">View</a>
                </td>
            </tr>
            <tr class="bg-white border-b text-gray-700 hover:bg-[#caced1]">
                <td class="px-6 py-4">
                  សរសេរ តាមចិត្ត
                </td>
                <td class="px-6 py-4">
                    Silver
                </td>
                <td class="px-6 py-4">
                  ប្រុស
                </td>
                <td class="px-6 py-4">
                    20/5/2025
                </td>
                <td class="px-6 py-4">
                  សមាជិក យុវជន
                </td>
                <td class="px-6 py-4">
                  សាកលវិទ្យាល័យអាស៊ី អ៊ឺរ៉ុប
                </td>
                <td class="px-6 py-4">
                    2
                </td>
                <td class="px-6 py-4">
                  31/12/2025
                </td>
                <td class="px-6 py-4">
                  ខណ្ឌឫស្សីកែវ ភ្នំពេញ
                </td>
                <td class="px-6 py-4">
                  ព័ត៍មានវិទ្យា
                </td>
                <td class="px-6 py-4">
                  065897124
                </td>
                <td class="px-6 py-4">
                    L
                </td>
                <td class="px-6 py-4 text-right">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">View</a>
                </td>
            </tr>
            <tr class="bg-white border-b text-gray-700 hover:bg-[#caced1]">
                <td class="px-6 py-4">
                  សរសេរ តាមចិត្ត
                </td>
                <td class="px-6 py-4">
                    Silver
                </td>
                <td class="px-6 py-4">
                  ប្រុស
                </td>
                <td class="px-6 py-4">
                    20/5/2025
                </td>
                <td class="px-6 py-4">
                  សមាជិក យុវជន
                </td>
                <td class="px-6 py-4">
                  សាកលវិទ្យាល័យអាស៊ី អ៊ឺរ៉ុប
                </td>
                <td class="px-6 py-4">
                    2
                </td>
                <td class="px-6 py-4">
                  31/12/2025
                </td>
                <td class="px-6 py-4">
                  ខណ្ឌឫស្សីកែវ ភ្នំពេញ
                </td>
                <td class="px-6 py-4">
                  ព័ត៍មានវិទ្យា
                </td>
                <td class="px-6 py-4">
                  065897124
                </td>
                <td class="px-6 py-4">
                    L
                </td>
                <td class="px-6 py-4 text-right">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">View</a>
                </td>
            </tr>
            <tr class="bg-white border-b text-gray-700 hover:bg-[#caced1]">
                <td class="px-6 py-4">
                  សរសេរ តាមចិត្ត
                </td>
                <td class="px-6 py-4">
                    Silver
                </td>
                <td class="px-6 py-4">
                  ប្រុស
                </td>
                <td class="px-6 py-4">
                    20/5/2025
                </td>
                <td class="px-6 py-4">
                  សមាជិក យុវជន
                </td>
                <td class="px-6 py-4">
                  សាកលវិទ្យាល័យអាស៊ី អ៊ឺរ៉ុប
                </td>
                <td class="px-6 py-4">
                    2
                </td>
                <td class="px-6 py-4">
                  31/12/2025
                </td>
                <td class="px-6 py-4">
                  ខណ្ឌឫស្សីកែវ ភ្នំពេញ
                </td>
                <td class="px-6 py-4">
                  ព័ត៍មានវិទ្យា
                </td>
                <td class="px-6 py-4">
                  065897124
                </td>
                <td class="px-6 py-4">
                    L
                </td>
                <td class="px-6 py-4 text-right">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">View</a>
                </td>
            </tr>
            <tr class="bg-white border-b text-gray-700 hover:bg-[#caced1]">
                <td class="px-6 py-4">
                  សរសេរ តាមចិត្ត
                </td>
                <td class="px-6 py-4">
                    Silver
                </td>
                <td class="px-6 py-4">
                  ប្រុស
                </td>
                <td class="px-6 py-4">
                    20/5/2025
                </td>
                <td class="px-6 py-4">
                  សមាជិក យុវជន
                </td>
                <td class="px-6 py-4">
                  សាកលវិទ្យាល័យអាស៊ី អ៊ឺរ៉ុប
                </td>
                <td class="px-6 py-4">
                    2
                </td>
                <td class="px-6 py-4">
                  31/12/2025
                </td>
                <td class="px-6 py-4">
                  ខណ្ឌឫស្សីកែវ ភ្នំពេញ
                </td>
                <td class="px-6 py-4">
                  ព័ត៍មានវិទ្យា
                </td>
                <td class="px-6 py-4">
                  065897124
                </td>
                <td class="px-6 py-4">
                    L
                </td>
                <td class="px-6 py-4 text-right">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">View</a>
                </td>
            </tr>
            <tr class="bg-white border-b text-gray-700 hover:bg-[#caced1]">
                <td class="px-6 py-4">
                  សរសេរ តាមចិត្ត
                </td>
                <td class="px-6 py-4">
                    Silver
                </td>
                <td class="px-6 py-4">
                  ប្រុស
                </td>
                <td class="px-6 py-4">
                    20/5/2025
                </td>
                <td class="px-6 py-4">
                  សមាជិក យុវជន
                </td>
                <td class="px-6 py-4">
                  សាកលវិទ្យាល័យអាស៊ី អ៊ឺរ៉ុប
                </td>
                <td class="px-6 py-4">
                    2
                </td>
                <td class="px-6 py-4">
                  31/12/2025
                </td>
                <td class="px-6 py-4">
                  ខណ្ឌឫស្សីកែវ ភ្នំពេញ
                </td>
                <td class="px-6 py-4">
                  ព័ត៍មានវិទ្យា
                </td>
                <td class="px-6 py-4">
                  065897124
                </td>
                <td class="px-6 py-4">
                    L
                </td>
                <td class="px-6 py-4 text-right">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">View</a>
                </td>
            </tr>
            <tr class="bg-white border-b text-gray-700 hover:bg-[#caced1]">
                <td class="px-6 py-4">
                  សរសេរ តាមចិត្ត
                </td>
                <td class="px-6 py-4">
                    Silver
                </td>
                <td class="px-6 py-4">
                  ប្រុស
                </td>
                <td class="px-6 py-4">
                    20/5/2025
                </td>
                <td class="px-6 py-4">
                  សមាជិក យុវជន
                </td>
                <td class="px-6 py-4">
                  សាកលវិទ្យាល័យអាស៊ី អ៊ឺរ៉ុប
                </td>
                <td class="px-6 py-4">
                    2
                </td>
                <td class="px-6 py-4">
                  31/12/2025
                </td>
                <td class="px-6 py-4">
                  ខណ្ឌឫស្សីកែវ ភ្នំពេញ
                </td>
                <td class="px-6 py-4">
                  ព័ត៍មានវិទ្យា
                </td>
                <td class="px-6 py-4">
                  065897124
                </td>
                <td class="px-6 py-4">
                    L
                </td>
                <td class="px-6 py-4 text-right">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">View</a>
                </td>
            </tr> --}}
</div>
@endsection

@push('JS')

@endpush