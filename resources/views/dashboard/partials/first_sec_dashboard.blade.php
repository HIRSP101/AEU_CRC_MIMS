<?php
$i=1;
$firstEle = $total_mem_branches[0] ?? "";
$firstEle_total = $firstEle->total_mem;
?>

@php
    function translate($num) {
        $kh_num = ["1" => "១", "2" => "២", "3" => "៣", "4" => "៤", "5" => "៥", "6" => "៦", "7" => "៧", "8" => "៨", "9" => "៩", "10" => "១០"]; 
        return strtr($num, $kh_num);
    }
@endphp
<div class="p-4 bg-white">
    <div class="">
        <div class="grid sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-1 ">
            <div class="p-4 rounded-lg shadow mr-3 mb-3 ">
                <h1 class="text-blue-900 text-3xl font-koulen">សួស្តី {{explode(' ',auth()->user()->name)[1] ?? auth()->user()->name}}</h1>
                <h3 class="text-blue-900 text-xl font-siemreap mt-3.5">សូមសា្វគមន៍មកកាន់ប្រព័ន្ធគ្រប់គ្រងទិន្នន័យ​
                    សមាជិកយុវជន ក.ក្រ.ក</h3>
                    <div class="grid justify-items-end my-3 opacity-5 hover:opacity-100">
                    <label class="inline-flex items-center me-5 cursor-pointer start-0">
                        <span class="mx-3 text-sm font-medium text-gray-900 dark:text-gray-300 font-siemreap" >បិទ</span>
                        <input type="checkbox" id="chkbxww" value="" class="sr-only peer" >
                        <div
                            class="relative w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 dark:peer-focus:ring-red-800 dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-red-600">
                        </div>
                        <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300 font-siemreap">បើក</span>
                    </label>
                </div>
                <div class="flex flex-col sm:flex-col md:flex-row lg:justify-between gap-5">
                    <div class="md:w-full lg:w-full">
                        @include('dashboard.partials.weatherwidget')
                    </div>
                </div>
            </div>
            <div class="flex flex-col sm:flex-row md:flex-row lg:justify-between gap-5">
                <div class="sm:p-12 md:p-4 lg:p-20 p-2 bg-white border-2 rounded-lg shadow sm:w-[50%] md:w-[50%]">
                    <div class="flex justify-center my-5">
                        <img src="{{asset("images/branches/b-$firstEle->branch_id.jpg")}}" class="w-auto" alt="">
                    </div>
                    <div class="flex flex-row items-center justify-center gap-5">
                        <h1 class="font-koulen text-2xl text-blue-700 text-center mt-1">{{$firstEle->branch_kh}}</h1>
                        <h1 class="font-koulen text-2xl text-red-700 text-center mt-1">ចំនួន {{$firstEle->total_mem}} នាក់</h1>
                    </div>
                </div>
                <div class="p-2 bg-white border-2 rounded-lg shadow sm:w-[50%] md:w-[50%] ">
                    <h2 class="text-blue-700 text-xl font-koulen mt-3.5 text-center">ទីស្នាក់ការដែលមានសមាជិកចុះឈ្មោះថ្មី</h2>
                    <div class="mt-4 flex justify-center">
                        <table class="table font-siemreap leading-10 font-bold">
                            <tbody>
                                @foreach($total_mem_branches as $total_mem_branch)
                                <tr>
                                    @if($i <= 5)
                                    <td class="px-4 text-md">{{$i++ . '.'}}</td>
                                    <td class="text-md">{{str_replace("ខេត្ត", "",$total_mem_branch->branch_kh)}}</td>
                                    <td class="px-1 text-md">{{$total_mem_branch->total_mem}} នាក់</td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <span class="flex justify-end mt-2 p-3">
                        <a href="#"
                            class="bg-red-600 px-4 py-2 rounded text-white font-siemreap hover:bg-red-500 text-sm">មើលបន្ថែម</a>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

