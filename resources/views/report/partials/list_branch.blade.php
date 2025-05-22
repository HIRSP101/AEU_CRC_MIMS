@extends('layouts.templates.att.master')
@push('CSS')
@endpush

@section('Content')
    <div class="bg-[#fff] p-8 rounded-lg max-w-1000px m-5 shadow-md font-battambang">
        <h2 class="text-2xl font-medium text-center font-khmer my-2 pb-3">
            {{ $title }}
        </h2>
        <div class="filter_branch flex justify-end space-x-2 mt-12 mb-5">
            <input type="text" id="filter_box" class="border border-gray-300 px-2 py-2 rounded-xl" placeholder="Search...">
            <button id="filter_branch_btn" class="bg-blue-500 text-white px-4 py-2 rounded-xl">Search</button>
        </div>
        <ul>
            @foreach ($total_mem_branches as $branch)
                <li>
                    <a href="{{ route('total.member.university', ['id' => $branch->branch_id]) }}">
                        {{ $branch->branch_kh }}
                    </a>
                </li>
            @endforeach
            <li class="border-b bg-slate-50 rounded-lg hover:bg-indigo-50 p-2 hover:ring-indigo-200 hover:rounded-lg my-2">
                <a href="{{ route('total.university') }}">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <img src="" alt="Logo" class="ml-10 w-16 mr-8 rounded-full object-cover h-16" />
                            <span class="text-lg font-battambang">គ្រឹះស្ថានឧត្តមសិក្សា</span>
                        </div>
                    </div>
                </a>
            </li>
        </ul>
    </div>
@endsection

@push('JS')
    <script>
        $("input#ogbranchswitch").change(function (e) {
            window.location = "{{ url('/') }}/branchhei"
        })
        // Filter Branch
        const array = @json($total_mem_branches);
        let originalArray = [...array];

        function updateBranchList(data) {
            const ul = $("ul");
            ul.empty();
            data.forEach((item) => {
                ul.append(`
                                                                                                                                                                                                                <li class="border-b bg-slate-50 rounded-lg hover:bg-indigo-50 p-2 hover:ring-indigo-200 hover:rounded-lg my-2">
                                                                                                                                                                                                               <a href="/total/member/university/${item.branch_id}">
                                                                                                                                                                                                                   <div class="flex justify-between items-center">
                                                                                                                                                                                                                       <div class="flex items-center">
                                                                                                                                                                                                                           <img src="${item.branch_image}" alt="Logo" class="ml-10 w-16 mr-8 rounded-full object-cover h-16" />
                                                                                                                                                                                                                           <span class="text-lg font-battambang">${item.branch_kh}</span>
                                                                                                                                                                                                                       </div>
                                                                                                                                                                                                                   </div>
                                                                                                                                                                                                               </a>
                                                                                                                                                                                                            </li>


                                                                                                                                                                                                            `)
            })
            ul.append(`
                    <li class="border-b bg-slate-50 rounded-lg hover:bg-indigo-50 p-2 hover:ring-indigo-200 hover:rounded-lg my-2">
                        <a href="/total/university">
                            <div class="flex justify-between items-center">
                                <div class="flex items-center">
                                    <span class="text-lg font-battambang ml-7 py-4">គ្រឹះស្ថានឧត្តមសិក្សា</span>
                                </div>
                            </div>
                        </a>
                    </li>
                `);
        }

        $("#filter_branch_btn").click(function () {
            const filterText = $("#filter_box").val().toLowerCase();

            const filteredArray = array.filter((item) => item.branch_kh?.toLowerCase().includes(filterText));

            updateBranchList(filteredArray);
        });

        $("#filter_box").on("input", function () {
            if ($(this).val() === "") {
                updateBranchList(originalArray);
            }
        });
        updateBranchList(originalArray);

    </script>
@endpush