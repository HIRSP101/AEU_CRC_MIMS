@extends('layouts.templates.att.master')
@push('CSS')
<style>
    /* end list សាខា */

/* table member */
.selection {
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.table-controls {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
}

.table-controls label {
    font-size: 14px;
}

.table-controls select {
    margin: 0 5px;
}

.table-controls .table-buttons {
    display: flex;
    gap: 10px;
}

.table-controls button {
    padding: 5px 10px;
    border: 1px solid #ccc;
    background-color: #d8d8d8;
    border-radius: 0.4rem;
    cursor: pointer;
}

.table-controls button:hover {
    background-color: #ffbfbf;
}

.table-controls input[type="text"] {
    padding: 5px;
    border: 1px solid #e1e1e1;
    border-radius: 4px;
}

tbody tr:hover {
    background-color: #caced1;
}

.view-btn {
    background-color: #4caf50;
    color: white;
    border: none;
    padding: 5px 10px;
    cursor: pointer;
    border-radius: 3px;
}

.view-btn:hover {
    background-color: #8ec891;
}

.table-controls .custom-select {
    /* ... */
    position: relative;
    min-width: 150;
}

.table-controls .custom-select::before,
.table-controls .custom-select::after {
    --size: 0.3rem;
    position: absolute;
    content: "";
    right: 0.5rem;
    pointer-events: none;
}

.table-controls .custom-select::before {
    border-left: var(--size) solid transparent;
    border-right: var(--size) solid transparent;
    border-bottom: var(--size) solid black;
    top: 40%;
}

.table-controls select::after {
    border-left: var(--size) solid transparent;
    border-right: var(--size) solid transparent;
    border-top: var(--size) solid black;
    top: 55%;
}

.custom-select select {
    appearance: none;
    width: 100%;
    font-size: 1rem;
    padding: 0.375em 2em 0.375em 0.5em;
    background-color: #fff;
    border: 1px solid #caced1;
    border-radius: 0.25rem;
    color: #000;
    cursor: pointer;
}

/* End table */

</style>
@vite('resources/css/style.css')
@endpush

@section('Content')
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
        <form action="" method="GET">
          @csrf
          <button type="submit">Export to Excel</button>
        </form>
        <form action="" method="GET" target="_blank">
          @csrf
          <button type="submit">View PDF</button>
        </form>
        {{-- <button>Column visibility</button> --}}
        <form action="" method="GET",target="_blank">
          @csrf
          <button type="submit">Export to PDF</button>
        </form>
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
                <th class="w-1/5 py-4 px-2 text-left text-red-600 font-bold uppercase font-siemreap">លេខទូរស័ព្ទ</th>
            </tr>
        </thead>
        <tbody class="bg-white">
            <tr>
                <td class="py-4 px-2 border-b border-gray-200">1</td>
                <td class="py-4 px-2 border-b border-gray-200 truncate">សិវ ហា</td>
                <td class="py-4 px-2 border-b border-gray-200">ប្រុស</td>
                <td class="py-4 px-2 border-b border-gray-200">31/12/2025</td>
                <td class="py-4 px-2 border-b border-gray-200">សាកលវិទ្យាល័យភ្នំពេញ</td>
                <td class="py-4 px-2 border-b border-gray-200">2024</td>
                <td class="py-4 px-2 border-b border-gray-200">សែន​ សុខ សង្កាត់ភ្នំពេញថ្មី</td>
                <td class="py-4 px-2 border-b border-gray-200">ព័ត៍មានវីទ្យាល័យ</td>
                <td class="py-4 px-2 border-b border-gray-200">09877347</td>
            </tr>
            <!-- Add more rows here -->
        </tbody>
    </table>
  </div>
</div>

@endsection

@push('JS')

@endpush