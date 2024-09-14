@extends('layouts.templates.att.master')
@push('CSS')
    <style>
        thead th {
            color: #1d4ed8 !important;
            /* Tailwind's 'text-blue-500' color */
        }

        .pagination {
            display: flex;
            gap: 0.5rem;
        }

        /* Style for individual pagination buttons */
        .pagination a {
            background-color: #007bff;
            /* Change the background color */
            color: white;
            /* Change text color */
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
            border: 1px solid #007bff;
            margin: 0 2px;
        }

        /* Hover state for pagination buttons */
        .pagination a:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        /* Active page button */
        .pagination a[aria-current="page"] {
            background-color: #0056b3;
            color: white;
            font-weight: bold;
        }

        /* Disabled state for first, previous, next, and last buttons */
        .pagination a[aria-disabled="true"] {
            background-color: #e0e0e0;
            color: #808080;
            cursor: not-allowed;
        }

        /* Styling for specific buttons */
        .pagination .first,
        .pagination .last,
        .pagination .previous,
        .pagination .next {
            background-color: #6c757d;
            color: white;
        }

        /* Hover state for specific buttons */
        .pagination .first:hover,
        .pagination .last:hover,
        .pagination .previous:hover,
        .pagination .next:hover {
            background-color: #5a6268;
        }

        .dt-length select {
            background-color: #007bff;
            /* Set background color */
            color: white;
            /* Set text color */
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #007bff;
            font-size: 14px;
        }

        /* Hover state for the dropdown */
        .dt-length select:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        /* Style for the 'entries per page' label */
        .dt-length label {
            color: #333;
            /* Set text color */
            margin-left: 10px;
            font-weight: bold;
        }

        /* Style for the search input */
        .dt-search input[type="search"] {
            background-color: #f8f9fa;
            /* Set background color */
            color: #333;
            /* Set text color */
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #007bff;
            margin-left: 10px;
            width: 200px;
        }

        /* Focus state for the search input */
        .dt-search input[type="search"]:focus {
            outline: none;
            border-color: #0056b3;
            box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.25);
        }

        /* Style for the 'Search' label */
        .dt-search label {
            color: #333;
            /* Set text color */
            font-weight: bold;
        }

        #example tbody tr:nth-child(odd) {
            background-color: white;
            /* White for odd rows */
        }

        #example tbody tr:nth-child(even) {
            background-color: #f0f0f0;
            /* Light gray for even rows */
        }

        /* Optional: Enhance the hover effect */
        #example tbody tr:hover {
            background-color: #e0e0e0;
            /* Slightly darker gray on hover */
        }

        thead th {
            background-color: #f3f4f6 !important;
            /* Tailwind gray-100 equivalent */
        }
    </style>
@endpush


@section('Content')
<h1 class="text-xl font-bold mx-3 my-3 text-center font-siemreap">តារាងទិន្នន័យគ្រឹះស្ថានសិក្សា​ ទីប្រឹក្សាយុវជន នឹងយុវជន </h1>
<h1 class="text-xl font-bold mx-3 text-center font-siemreap">នៃសាខាកាកបាទក្រហម កម្ពុជា ២៥ រាជធានី ខេត្ត</h1>
<hr class="mx-3">
    <div class="mx-3 my-3">
        <table id="example" class="display min-w-full bg-white border border-gray-300" style="width: 100%">
            <thead>
                <tr>
                    <th class="border border-gray-300 px-2 py-2 text-center w-16" rowspan="2">
                        ល.រ
                    </th>
                    <th class="border border-gray-300 px-4 py-2 text-center" rowspan="2">
                        សាខា កក្រក
                    </th>

                    <th colspan="4" class="border border-gray-300 px-4 py-2 text-center w-64">
                        បណ្ដាញយុវជនគ្រឹះស្ថានសិក្សា
                    </th>
                    <th class="border border-gray-300 px-4 py-2 text-center" rowspan="2">
                        ក្លឹបយុវជន
                    </th>

                    <th colspan="2" class="border border-gray-300 px-4 py-2 text-center">
                        ទីប្រឹក្សា​
                    </th>

                    <th colspan="2" class="border border-gray-300 px-4 py-2 text-center">
                        យុវជន
                    </th>
                </tr>
                <tr>
                    <th class="border border-gray-300 px-2 py-1 text-center">សរុប</th>
                    <th class="border border-gray-300 px-2 py-1 text-center">អនុ.វិ</th>
                    <th class="border border-gray-300 px-2 py-1 text-center">
                        វិទ្យាល័យ
                    </th>
                    <th class="border border-gray-300 px-2 py-1 text-center">
                        ឧត្តមសិក្សា
                    </th>

                    <th class="border border-gray-300 px-2 py-1 text-center">សរុប</th>
                    <th class="border border-gray-300 px-2 py-1 text-center">ស្រី</th>
                    <th class="border border-gray-300 px-2 py-1 text-center">សរុប</th>
                    <th class="border border-gray-300 px-2 py-1 text-center">ស្រី</th>
                </tr>
            </thead>
            <tbody>
                <tr class="text-center">
                    <td>៤</td>
                    <td>បន្ទាយមានជ័យ</td>
                    <td>៣០</td>
                    <td>0</td>
                    <td>៣០</td>
                    <td>0</td>
                    <td>0</td>
                    <td>៦០</td>
                    <td>១៩</td>
                    <td>៦០</td>
                    <td>១៩</td>
                </tr>
                <tr class="text-center">
                    <td>៤</td>
                    <td>បន្ទាយមានជ័យ</td>
                    <td>៣០</td>
                    <td>0</td>
                    <td>៣០</td>
                    <td>0</td>
                    <td>0</td>
                    <td>៦០</td>
                    <td>១៩</td>
                    <td>៦០</td>
                    <td>១៩</td>
                </tr>
                <tr class="text-center">
                    <td>៤</td>
                    <td>បន្ទាយមានជ័យ</td>
                    <td>៣០</td>
                    <td>0</td>
                    <td>៣០</td>
                    <td>0</td>
                    <td>0</td>
                    <td>៦០</td>
                    <td>១៩</td>
                    <td>៦០</td>
                    <td>១៩</td>
                </tr>
                <tr class="text-center">
                    <td>៤</td>
                    <td>បន្ទាយមានជ័យ</td>
                    <td>៣០</td>
                    <td>0</td>
                    <td>៣០</td>
                    <td>0</td>
                    <td>0</td>
                    <td>៦០</td>
                    <td>១៩</td>
                    <td>៦០</td>
                    <td>១៩</td>
                </tr>
                <tr class="text-center">
                    <td>៤</td>
                    <td>បន្ទាយមានជ័យ</td>
                    <td>៣០</td>
                    <td>0</td>
                    <td>៣០</td>
                    <td>0</td>
                    <td>0</td>
                    <td>៦០</td>
                    <td>១៩</td>
                    <td>៦០</td>
                    <td>១៩</td>
                </tr>
                <tr class="text-center">
                    <td>៤</td>
                    <td>បន្ទាយមានជ័យ</td>
                    <td>៣០</td>
                    <td>0</td>
                    <td>៣០</td>
                    <td>0</td>
                    <td>0</td>
                    <td>៦០</td>
                    <td>១៩</td>
                    <td>៦០</td>
                    <td>១៩</td>
                </tr>
                <tr class="text-center">
                    <td>៤</td>
                    <td>បន្ទាយមានជ័យ</td>
                    <td>៣០</td>
                    <td>0</td>
                    <td>៣០</td>
                    <td>0</td>
                    <td>0</td>
                    <td>៦០</td>
                    <td>១៩</td>
                    <td>៦០</td>
                    <td>១៩</td>
                </tr>
                <tr class="text-center">
                    <td>៤</td>
                    <td>បន្ទាយមានជ័យ</td>
                    <td>៣០</td>
                    <td>0</td>
                    <td>៣០</td>
                    <td>0</td>
                    <td>0</td>
                    <td>៦០</td>
                    <td>១៩</td>
                    <td>៦០</td>
                    <td>១៩</td>
                </tr>
                <tr class="text-center">
                    <td>៤</td>
                    <td>បន្ទាយមានជ័យ</td>
                    <td>៣០</td>
                    <td>0</td>
                    <td>៣០</td>
                    <td>0</td>
                    <td>0</td>
                    <td>៦០</td>
                    <td>១៩</td>
                    <td>៦០</td>
                    <td>១៩</td>
                </tr>
                <tr class="text-center">
                    <td>៤</td>
                    <td>បន្ទាយមានជ័យ</td>
                    <td>៣០</td>
                    <td>0</td>
                    <td>៣០</td>
                    <td>0</td>
                    <td>0</td>
                    <td>៦០</td>
                    <td>១៩</td>
                    <td>៦០</td>
                    <td>១៩</td>
                </tr>
                <tr class="text-center">
                    <td>៤</td>
                    <td>បន្ទាយមានជ័យ</td>
                    <td>៣០</td>
                    <td>0</td>
                    <td>៣០</td>
                    <td>0</td>
                    <td>0</td>
                    <td>៦០</td>
                    <td>១៩</td>
                    <td>៦០</td>
                    <td>១៩</td>
                </tr>
                <tr class="text-center">
                    <td>៤</td>
                    <td>បន្ទាយមានជ័យ</td>
                    <td>៣០</td>
                    <td>0</td>
                    <td>៣០</td>
                    <td>0</td>
                    <td>0</td>
                    <td>៦០</td>
                    <td>១៩</td>
                    <td>៦០</td>
                    <td>១៩</td>
                </tr>
                <tr class="text-center">
                    <td>៤</td>
                    <td>បន្ទាយមានជ័យ</td>
                    <td>៣០</td>
                    <td>0</td>
                    <td>៣០</td>
                    <td>0</td>
                    <td>0</td>
                    <td>៦០</td>
                    <td>១៩</td>
                    <td>៦០</td>
                    <td>១៩</td>
                </tr>
                <tr class="text-center">
                    <td>៤</td>
                    <td>បន្ទាយមានជ័យ</td>
                    <td>៣០</td>
                    <td>0</td>
                    <td>៣០</td>
                    <td>0</td>
                    <td>0</td>
                    <td>៦០</td>
                    <td>១៩</td>
                    <td>៦០</td>
                    <td>១៩</td>
                </tr>
                <tr class="text-center">
                    <td>៤</td>
                    <td>បន្ទាយមានជ័យ</td>
                    <td>៣០</td>
                    <td>0</td>
                    <td>៣០</td>
                    <td>0</td>
                    <td>0</td>
                    <td>៦០</td>
                    <td>១៩</td>
                    <td>៦០</td>
                    <td>១៩</td>
                </tr>
                <tr class="text-center">
                    <td>៤</td>
                    <td>បន្ទាយមានជ័យ</td>
                    <td>៣០</td>
                    <td>0</td>
                    <td>៣០</td>
                    <td>0</td>
                    <td>0</td>
                    <td>៦០</td>
                    <td>១៩</td>
                    <td>៦០</td>
                    <td>១៩</td>
                </tr>
                <tr class="text-center">
                    <td>៤</td>
                    <td>បន្ទាយមានជ័យ</td>
                    <td>៣០</td>
                    <td>0</td>
                    <td>៣០</td>
                    <td>0</td>
                    <td>0</td>
                    <td>៦០</td>
                    <td>១៩</td>
                    <td>៦០</td>
                    <td>១៩</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection

@push('JS')
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/fontawesome.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.datatables.net/2.1.6/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.6/js/dataTables.tailwindcss.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        new DataTable("#example");
    </script>
@endpush
