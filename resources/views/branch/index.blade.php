@extends('layouts.templates.att.master')
@push('CSS')
@endpush

@section('Content')
    <div class="bg-[#fff] p-8 rounded-lg max-w-1000px m-5 shadow-md font-siemreap">
        <h2 class="text-2lg font-bold text-center siemreap-regular my-2 pb-3">សាខា កាកបាទក្រហមកម្ពុជា 25 រាជធានី-​ខេត្ត</h2>
        <label class="inline-flex items-center me-5 cursor-pointer">
            <span class="mx-3 text-sm font-medium text-gray-900 dark:text-gray-300">ខេត្ត</span>
            <input type="checkbox" id="ogbranchswitch" value="" class="sr-only peer">
            <div
                class="relative w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 dark:peer-focus:ring-red-800 dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-red-600">
            </div>
            <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">វិទ្យាស្ថានកម្រិតខ្ពស់</span>
            
            {{-- search bar --}}
            <div class="filter_branch flex items-center ml-[600px]">
                <input type="text" id="filter_box" class="border border-gray-300 px-2 py-2 rounded" placeholder="Search...">
                <button id="filter_branch_btn" class="bg-blue-500 text-white px-4 py-2 rounded">Search</button>
            </div>

        </label>
        <ul>
            @foreach ($total_mem_branches as $mem_br)
                @include('branch.partials.listbranch')
            @endforeach
        </ul>
    </div>
@endsection

@push('JS')
    <script>
        $("input#ogbranchswitch").change(function(e) {
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
                   <a href="/branch/${item.branch_id}">
                       <div class="flex justify-between items-center">
                           <div class="flex items-center">
                               <img src="${item.image}" alt="Logo" class="ml-10 w-16 mr-8 rounded-full object-cover h-16" />
                               <span class="text-lg siemreap-regular">${item.branch_kh}</span>
                           </div>
                           <div class="grid grid-rows-2 m-2 place-items-end content-between gap-8">
                               <span class="text-xs siemreap-regular">ស.ម <strong>${item.total_mem} នាក់</strong></span>
                               <span class="text-xs siemreap-regular">${item.total_institutes} សាខា</span>
                           </div>
                       </div>
                   </a>
                </li>
                `)
            })
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
