@extends('layouts.templates.att.master')
@push('CSS')
@vite('resources/css/style.css')
@endpush

@section('Table')
<div class="container">
  <div class="table-controls">
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
  <table>
    <thead>
      <tr class="bg-red-300">
        <th>លរ</th>
        <th>គោត្តនាម-នាម</th>
        <th>ឈ្មោះឡាតាំង</th>
        <th>ភេទ</th>
        <th>ថ្ងៃខែឆ្នាំកំណើត</th>
        <th>តួនាទី</th>
        <th>គ្រឹះស្ថានសិក្សា</th>
        <th>អាស័យដ្ឋានបច្ចុប្បន្ន</th>
        <th>ជំនាញ</th>
        <th>លេខទូរសព្ទ័</th>
        <th>ទំហំអាវ</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>2944</td>
        <td>សរសេរ តាមចិត្ត</td>
        <td>ប្រុស</td>
        <td>សមាជិក យុវជន</td>
        <td>សាកលវិទ្យាល័យអាស៊ី អ៊ឺរ៉ុប</td>
        <td>2</td>
        <td>31/12/2025</td>
        <td>ខណ្ឌឫស្សីកែវ ភ្នំពេញ</td>
        <td>ព័ត៍មានវិទ្យា</td>
        <td>065897124</td>
        <td>L</td>
        <td><button class="view-btn">View</button></td>
      </tr>
      <tr>
        <td>2944</td>
        <td>សរសេរ តាមចិត្ត</td>
        <td>ប្រុស</td>
        <td>សមាជិក យុវជន</td>
        <td>សាកលវិទ្យាល័យអាស៊ី អ៊ឺរ៉ុប</td>
        <td>2</td>
        <td>31/12/2025</td>
        <td>ខណ្ឌឫស្សីកែវ ភ្នំពេញ</td>
        <td>ព័ត៍មានវិទ្យា</td>
        <td>065897124</td>
        <td>L</td>
        <td><button class="view-btn">View</button></td>
      </tr>
      <tr>
        <td>2944</td>
        <td>សរសេរ តាមចិត្ត</td>
        <td>ប្រុស</td>
        <td>សមាជិក យុវជន</td>
        <td>សាកលវិទ្យាល័យអាស៊ី អ៊ឺរ៉ុប</td>
        <td>2</td>
        <td>31/12/2025</td>
        <td>ខណ្ឌឫស្សីកែវ ភ្នំពេញ</td>
        <td>ព័ត៍មានវិទ្យា</td>
        <td>065897124</td>
        <td>L</td>
        <td><button class="view-btn">View</button></td>
      </tr>
      <tr>
        <td>2944</td>
        <td>សរសេរ តាមចិត្ត</td>
        <td>ប្រុស</td>
        <td>សមាជិក យុវជន</td>
        <td>សាកលវិទ្យាល័យអាស៊ី អ៊ឺរ៉ុប</td>
        <td>2</td>
        <td>31/12/2025</td>
        <td>ខណ្ឌឫស្សីកែវ ភ្នំពេញ</td>
        <td>ព័ត៍មានវិទ្យា</td>
        <td>065897124</td>
        <td>L</td>
        <td><button class="view-btn">View</button></td>
      </tr>
      <tr>
        <td>2944</td>
        <td>សរសេរ តាមចិត្ត</td>
        <td>ប្រុស</td>
        <td>សមាជិក យុវជន</td>
        <td>សាកលវិទ្យាល័យអាស៊ី អ៊ឺរ៉ុប</td>
        <td>2</td>
        <td>31/12/2025</td>
        <td>ខណ្ឌឫស្សីកែវ ភ្នំពេញ</td>
        <td>ព័ត៍មានវិទ្យា</td>
        <td>065897124</td>
        <td>L</td>
        <td><button class="view-btn">View</button></td>
      </tr>
      <tr>
        <td>2944</td>
        <td>សរសេរ តាមចិត្ត</td>
        <td>ប្រុស</td>
        <td>សមាជិក យុវជន</td>
        <td>សាកលវិទ្យាល័យអាស៊ី អ៊ឺរ៉ុប</td>
        <td>2</td>
        <td>31/12/2025</td>
        <td>ខណ្ឌឫស្សីកែវ ភ្នំពេញ</td>
        <td>ព័ត៍មានវិទ្យា</td>
        <td>065897124</td>
        <td>L</td>
        <td><button class="view-btn">View</button></td>
      </tr>
      <tr>
        <td>2944</td>
        <td>សរសេរ តាមចិត្ត</td>
        <td>ប្រុស</td>
        <td>សមាជិក យុវជន</td>
        <td>សាកលវិទ្យាល័យអាស៊ី អ៊ឺរ៉ុប</td>
        <td>2</td>
        <td>31/12/2025</td>
        <td>ខណ្ឌឫស្សីកែវ ភ្នំពេញ</td>
        <td>ព័ត៍មានវិទ្យា</td>
        <td>065897124</td>
        <td>L</td>
        <td><button class="view-btn">View</button></td>
      </tr>
      <tr>
        <td>2944</td>
        <td>សរសេរ តាមចិត្ត</td>
        <td>ប្រុស</td>
        <td>សមាជិក យុវជន</td>
        <td>សាកលវិទ្យាល័យអាស៊ី អ៊ឺរ៉ុប</td>
        <td>2</td>
        <td>31/12/2025</td>
        <td>ខណ្ឌឫស្សីកែវ ភ្នំពេញ</td>
        <td>ព័ត៍មានវិទ្យា</td>
        <td>065897124</td>
        <td>L</td>
        <td><button class="view-btn">View</button></td>
      </tr>
      <tr>
        <td>2944</td>
        <td>សរសេរ តាមចិត្ត</td>
        <td>ប្រុស</td>
        <td>សមាជិក យុវជន</td>
        <td>សាកលវិទ្យាល័យអាស៊ី អ៊ឺរ៉ុប</td>
        <td>2</td>
        <td>31/12/2025</td>
        <td>ខណ្ឌឫស្សីកែវ ភ្នំពេញ</td>
        <td>ព័ត៍មានវិទ្យា</td>
        <td>065897124</td>
        <td>L</td>
        <td><button class="view-btn">View</button></td>
      </tr>
      <tr>
        <td>2944</td>
        <td>សរសេរ តាមចិត្ត</td>
        <td>ប្រុស</td>
        <td>សមាជិក យុវជន</td>
        <td>សាកលវិទ្យាល័យអាស៊ី អ៊ឺរ៉ុប</td>
        <td>2</td>
        <td>31/12/2025</td>
        <td>ខណ្ឌឫស្សីកែវ ភ្នំពេញ</td>
        <td>ព័ត៍មានវិទ្យា</td>
        <td>065897124</td>
        <td>L</td>
        <td><button class="view-btn">View</button></td>
      </tr>
      <tr>
        <td>2944</td>
        <td>សរសេរ តាមចិត្ត</td>
        <td>ប្រុស</td>
        <td>សមាជិក យុវជន</td>
        <td>សាកលវិទ្យាល័យអាស៊ី អ៊ឺរ៉ុប</td>
        <td>2</td>
        <td>31/12/2025</td>
        <td>ខណ្ឌឫស្សីកែវ ភ្នំពេញ</td>
        <td>ព័ត៍មានវិទ្យា</td>
        <td>065897124</td>
        <td>L</td>
        <td><button class="view-btn">View</button></td>
      </tr>
    </tbody>
  </table>
</div>
@endsection

@push('JS')

@endpush