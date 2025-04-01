<?php
$i = 1;
$firstEle = $total_mem_branches[0] ?? "";
$firstEle_total = $firstEle->total_mem;
?>


<div class="p-5 bg-white">
    <div class="">
        <div class="grid sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-1 ">
            <div class="p-4 rounded-xl shadow-md px-3 mb-3 border">
                <h1 class="text-blue-900 text-2xl font-khmer">សួស្តី
                    {{explode(' ', string: auth()->user()->name)[1] ?? auth()->user()->name}}</h1>
                <h3 class="text-blue-900 text-xl font-battambang mt-3.5">សូមសា្វគមន៍មកកាន់ប្រព័ន្ធគ្រប់គ្រងទិន្នន័យ​
                    សមាជិកយុវជន ក.ក្រ.ក</h3>
                <div class="grid justify-items-end my-3 opacity-5 hover:opacity-100">
                </div>
            </div>

            <div class="flex flex-col sm:flex-row md:flex-row lg:justify-between gap-5 mt-3 h-96">
                <div class="sm:p-4 p-2 bg-white border rounded-xl shadow-lg sm:w-[50%] md:w-[50%]">
                    <div class="flex justify-center mt-2">
                        <img src="{{asset("images/branches/b-$firstEle->branch_id.jpg")}}" class="w-96 rounded-lg"
                            alt="">
                    </div>
                    <div class="flex flex-row items-center justify-center ">
                        <h1 class="font-khmer text-xl text-blue-700 text-center mt-3">{{$firstEle->branch_kh}}</h1>
                        {{-- <h1 class="font-koulen text-2xl text-red-700 text-center mt-1">ចំនួន
                            {{translate($firstEle->total_mem)}} នាក់</h1> --}}
                    </div>
                </div>
                <div class="p-2 bg-white border rounded-xl shadow-lg sm:w-[50%] md:w-[50%] ">
                    <h2 class="text-blue-700 text-xl font-khmer mt-4 text-center">ទីស្នាក់ការដែលមានសមាជិកចុះឈ្មោះថ្មី
                    </h2>
                    <div class="mt-4 flex justify-center">
                        <table class="table font-battambang leading-10 font-medium">
                            <tbody>
                                @foreach($total_mem_branches as $total_mem_branch)
                                    <tr>
                                        @if($i <= 5)
                                            <td class="px-4 text-xl">{{$i++ . '.'}}</td>
                                            <td class="text-xl">{{str_replace("ខេត្ត", "", $total_mem_branch->branch_kh)}}</td>
                                            {{-- <td class="px-1 text-base">{{translate($total_mem_branch->total_mem)}} នាក់
                                            </td> --}}
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <span class="flex justify-end mt-3 p-3">
                        <a href="#"
                            class="bg-blue-600 px-4 py-2 rounded-lg text-white font-battambang hover:bg-blue-500 text-[17px]">មើលបន្ថែម</a>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>