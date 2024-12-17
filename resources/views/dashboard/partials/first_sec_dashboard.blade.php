<?php
$i=1;
$firstEle = $total_mem_branches[0] ?? "";
$kh_num = ["1" => "១", "2" => "២", "3" => "៣", "4" => "៤", "5" => "៥", "6" => "៦", "7" => "៧", "8" => "៨", "9" => "៩", "10" => "១០"]
?>
<div class="p-4 bg-white">
    <div class="">
        <div class="grid sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-2 ">
            <div class="p-4 rounded-lg shadow mr-3 mb-3 bg-cover" style="background-image: url('https://img.freepik.com/free-photo/farmland_1112-1234.jpg?t=st=1734403690~exp=1734407290~hmac=c765d483365a2731f5b4779904abcfba065cbfabb21f7a9dced1a3232fd972ce&w=1800')">
                <h1 class="text-blue-900 text-3xl font-koulen">សួស្តី {{explode(' ',auth()->user()->name)[1] ?? auth()->user()->name}}</h1>
                <h3 class="text-blue-900 text-xl font-siemreap mt-3.5">សូមសា្វគមន៍មកកាន់ប្រព័ន្ធគ្រប់គ្រងទិន្នន័យ​
                    សមាជិកយុវជន ក.ក្រ.ក</h3>
            </div>

            <div class="flex flex-col sm:flex-col md:flex-row lg:justify-between gap-5">
                <div class="p-6 bg-white border-red-500 border-2 rounded-lg shadow">
                    <div class="flex justify-center mt-10">
                        <img src="{{asset("images/branches/b-$firstEle->branch_id.jpg")}}" class="w-auto" alt="">
                    </div>
                    <div class="flex flex-row items-center justify-center gap-5">
                        <h1 class="font-koulen text-2xl text-blue-700 text-center mt-1">{{$firstEle->branch_kh}}</h1>
                        <h1 class="font-koulen text-2xl text-red-700 text-center mt-1">ចំនួន {{$firstEle->total_mem}} នាក់</h1>
                    </div>
                </div>
                <div class="p-6 bg-white border-red-500 border-2 rounded-lg shadow">
                    <h2 class="text-blue-700 text-xl font-koulen mt-3.5 text-center">ទីស្នាក់ការដែលមានសមាជិកចុះឈ្មោះថ្មី</h2>
                    <div class="mt-4 flex justify-center">
                        <table class="table-auto font-siemreap leading-8 font-bold">
                            <tbody>
                                @foreach($total_mem_branches as $total_mem_branch)
                                <tr>
                                    <td class="px-4 text-md">{{$kh_num[$i++] . '.' ?? $i++ . '.'}}</td>
                                    <td class="text-md">{{str_replace("ខេត្ត", "",$total_mem_branch->branch_kh)}}</td>
                                    <td class="px-1 text-md">{{$total_mem_branch->total_mem}} នាក់</td>
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

