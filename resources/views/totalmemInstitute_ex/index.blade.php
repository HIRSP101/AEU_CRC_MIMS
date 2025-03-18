@extends('layouts.templates.att.master')
@push('CSS')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush

@section('Content')
    <?php
    $current_branch = "";
    $total_mem_detail = "";
    $member_pob = "";
                                                                        ?>
    @if(count($total_mem) > 0)
        <?php
            $current_branch = explode(' ', $total_mem[0]->full_current_address)[3] ?? "";
            $total_mem_detail = array();
            for ($i = 0; $i < count($total_mem); $i++) {
                $total_mem_detail[$i] = array(
                    $total_mem[$i]->member_id
                    ,
                    $total_mem[$i]->name_kh
                    ,
                    $total_mem[$i]->name_en
                    ,
                    $total_mem[$i]->gender
                    ,
                    $total_mem[$i]->date_of_birth
                    ,
                    $total_mem[$i]->member_type
                    ,
                    // $total_mem[$i]->branchhei_id,
                    $total_mem[$i]->institute_kh,

                    $total_mem[$i]->education_level
                    ,
                    $total_mem[$i]->registration_date
                    ,
                    $total_mem[$i]->full_current_address
                    ,
                    $total_mem[$i]->phone_number
                    ,
                    $total_mem[$i]->guardian_phone
                    ,
                    $total_mem[$i]->shirt_size
                    ,
                    $total_mem[$i]->village,
                    $total_mem[$i]->provience_city,
                    $total_mem[$i]->district_khan,
                    $total_mem[$i]->commune_sangkat,
                    $total_mem[$i]->home_no,
                    $total_mem[$i]->street_no,
                    $total_mem[$i]->village_current,
                    $total_mem[$i]->provience_city_current,
                    $total_mem[$i]->district_khan_current,
                    $total_mem[$i]->commune_sangkat_current,
                    $total_mem[$i]->home_no_current,
                    $total_mem[$i]->street_no_current,

                );
            }
                                                                                                                                                                    ?>
        <div id="loadingSpinner" class="fixed top-0 left-0 z-50 w-screen h-screen bg-gray-300 bg-opacity-50 h-full hidden">
            <p id="textload" class="hidden textload text-center font-siemreap">សូមរងចាំ...</p>
            <p id="textsucc" class="hidden textload text-center font-siemreap">ទាញយកជោគជ័យ</p>
            <div id="spinner" class="spinner hidden"></div>
            <div id="tick" class="hidden text-center text-green-500 text-6xl">✔</div>
            <div class="flex justify-center items-center mt-2">
                <button id="ok" class="hidden w-32 text-center bg-green-500 text-white px-4 py-2 rounded">OK</button>
            </div>
        </div>

        <div id="downloadoption" class="fixed top-[50%] left-[50%] w-auto h-auto z-50 bg-gray-300 bg-opacity-50 p-5 hidden ">
            <div class="flex flex-col  justify-center items-center ">
                <button id="downloadop1"
                    class=" w-[350px] text-center bg-green-500 text-white p-5 mb-2 hover:bg-green-600   rounded">ទាញយកសាលាកបត្រព័ត៌មានផ្ទាល់ខ្លួន</button>
                <button id="downloadop2"
                    class=" w-[350px] text-center bg-green-500 text-white p-5 mb-2 hover:bg-green-600 rounded">ទាញយកបណ្ណសម្គាល់ខ្លួន</button>
                <button id="downloadop3"
                    class="  w-[350px] text-center bg-green-500 text-white p-5 mb-2 hover:bg-green-600 rounded">ទាញយកសំណើសុំផ្ទេរជីវភាព</button>
            </div>
        </div>
        <div class="bg-white mt-2 mx-3 shadow-lg">
            <h1 class="text-center font-siemreap my-2 font-bold text-2xl"> បញ្ជីតារាងទិន្នន័យផុតកំណត់យុវជន
                និងអ្នកស្ម័គ្រចិត្តកាកបាទក្រហមកម្ពុជា </h1>
            <div class="flex justify-between items-center mb-4 mt-14 px-4">
                <!-- Search Bar -->
                <div class="tab_filter_container flex items-center space-x-2">
                    <input type="text" id="tab_filter_text" class="border border-gray-300 px-2 py-2 rounded"
                        placeholder="Search...">
                    <button id="tab_filter_btn" class="bg-blue-500 text-white px-4 py-2 rounded">Search</button>
                </div>

                <!-- Buttons Group -->
                <div class="flex items-center space-x-3">
                    <div class="tab_head_container flex items-center space-x-4">
                        <div class="page_limit flex items-center space-x-2">
                            <span class="font-siemreap text-sm">បង្ហាញ</span>
                            <select id="table_size"
                                class="text-gray-700 bg-gray-300 py-2 px-2 rounded w-20 font-siemreap text-sm">
                                <option value="50">50</option>
                                <option value="100">100</option>
                                <option value="200">200</option>
                                <option value="300">300</option>
                            </select>
                        </div>

                        <div class="gender_sort flex items-center space-x-2">
                            <span class="font-siemreap text-sm">ភេទ</span>
                            <select id="gender_filter"
                                class="text-gray-700 bg-gray-300 py-2 px-2 rounded w-28 font-siemreap text-sm">
                                <option value="all">ទាំងអស់</option>
                                <option value="ស្រី">ស្រី</option>
                                <option value="ប្រុស">ប្រុស</option>
                            </select>
                        </div>

                        <div class="filter_date flex items-center space-x-2">
                            <span class="font-siemreap text-sm">ឆ្នាំ</span>
                            <input id="dateRange" class="border-2 border-gray-400 rounded-md px-3 py-2 w-54" type="text"
                                placeholder="Select a date">
                        </div>
                    </div>
                    <button id="export_excel" class="bg-green-500 text-white px-4 py-2 rounded">Export Excel</button>
                    <button id="export_pdf" class="bg-green-500 text-white px-4 py-2 rounded">Export PDF</button>
                    <button id="delete" class="bg-red-500 text-white px-4 py-2 rounded">Delete Multi</button>
                </div>
            </div>

            <div class="w-full overflow-scroll mx-3 my-3 max-h-[760px]">
                <div class="w-full overflow-scroll my-3 max-h-[760px] table">
                    <table class="min-w-max w-full table-auto font-siemreap">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 pl-5 text-left">
                                    ល.រ
                                </th>
                                <th class="py-3 text-center">
                                    គោត្តមនាម-នាម
                                </th>
                                <th class="py-3 text-center">
                                    ភេទ
                                </th>
                                <th class="py-3 text-center">
                                    ថ្ងៃខែឆ្នាំកំណើត
                                </th>
                                <th class="py-3 text-center">
                                    គ្រឹះស្ថានសិក្សា
                                </th>

                                <th class="py-3 text-center">
                                    តួនាទី
                                </th>

                                <th class="py-3 text-center">
                                    កម្រិតសិក្សា
                                </th>

                                <th class="py-3 text-center">
                                    ថ្ងៃចុះឈ្មោះ
                                </th>

                                <th class="py-3 text-center">
                                    action
                                </th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                        </tbody>
                    </table>
                    <div class="flex justify-end mt-8 footer">
                        <span class="font-siemreap text-sm">Showing 1 to 10 of 60 entries</span>
                        <div class="px-7 py-15 bg-transparent cursor-pointer index_buttons"></div>
                    </div>
                </div>
            </div>
    @else
        <div class="flex flex-col items-center justify-center h-screen space-y-4">
            <img src="../images/not.png" alt="No Data" width="150" height="150">
            <p class="font-siemreap">មិនមានទិន្នន័យគ្រប់គ្រង</p>
        </div>
    @endif
@endsection

    @push('JS')
        <script type="module">
            import { handleTotalmemInstitute } from "{{ asset('js/handleTotalmemInstitute.js') }}";
            document.addEventListener('DOMContentLoaded', function () {
                var array = @json($total_mem);
                handleTotalmemInstitute(array);
                if (array.length > 0) {
                    exportToExcel(@json($current_branch), @json($total_mem_detail));
                }

                $("#export_pdf").on("click", async () => {

                    var instituteId = window.location.pathname;
                    $("#downloadoption").toggle(500);
                    $('#downloadop1').on('click', () => {
                        $("#downloadoption").hide();
                        $("#loadingSpinner").show();
                        $("#textload").show();
                        $("#spinner").show();
                        $("#textsucc").hide();
                        $("#tick").hide();
                        $("#ok").hide();
                        $.ajax({
                            url: '/generate-report/' + instituteId.split('/')[2],
                            method: 'GET',
                            xhrFields: {
                                responseType: 'blob'  // Ensures the response is treated as a binary file
                            },
                            success: function (response) {
                                $("#loadingSpinner").show();
                                $("#textload").hide();
                                $("#spinner").hide();
                                $("#textsucc").show();
                                $("#tick").show();
                                $("#ok").show();
                                $("#ok").on("click", function () {
                                    $("#loadingSpinner").hide();
                                    $("#textload").hide();
                                    $("#spinner").hide();
                                    $("#textsucc").hide();
                                    $("#tick").hide();
                                    $("#ok").hide();
                                });
                                // Create a URL for the blob
                                var link = document.createElement('a');
                                var blob = new Blob([response], { type: 'application/zip' }); // Use 'application/pdf' for PDFs
                                var url = URL.createObjectURL(blob);
                                link.href = url;
                                link.click();
                            },
                            error: function (xhr, status, error) {
                                $("#loadingSpinner").hide();
                                console.error("Error generating report:", error);
                            }
                        });
                    });
                    $('#downloadop2').on('click', () => {
                        $("#downloadoption").hide();
                        $("#loadingSpinner").show();
                        $("#textload").show();
                        $("#spinner").show();
                        $("#textsucc").hide();
                        $("#tick").hide();
                        $("#ok").hide();
                        console.log("op2");
                    });
                    $('#downloadop3').on('click', () => {
                        $("#downloadoption").hide();
                        $("#loadingSpinner").show();
                        $("#textload").show();
                        $("#spinner").show();
                        $("#textsucc").hide();
                        $("#tick").hide();
                        $("#ok").hide();
                        console.log("op3");
                    });

                });
            });
        </script>
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    @endpush