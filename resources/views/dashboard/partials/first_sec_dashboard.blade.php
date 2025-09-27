<?php
$i = 1;
$user = auth()->user();
$userBranchId = \App\Models\branch_bindding_user::where('user_id', $user->id)->value('branch_id');
$branchName = \App\Models\branch::where('branch_id', $userBranchId)->value('branch_kh');
$branch_image = \App\Models\branch::where('branch_id', $userBranchId)->value('branch_image');
$institute_id = \App\Models\branch_bindding_user::where('user_id', auth()->id())->value('branch_hei_id');
$institute_kh = App\Models\branch_hei::where('bhei_id', $institute_id)->value('institute_kh');
$institute_image = App\Models\branch_hei::where('bhei_id', $institute_id)->value('image');
?>


<div class="p-5 bg-white">
    <div class="">
        <div class="grid sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-1 ">
            <div class="p-4 rounded-xl shadow-md px-3 border">
                <h1 class="text-blue-600 text-2xl font-koulen">សួស្តី
                    {{explode(' ', string: auth()->user()->name)[1] ?? auth()->user()->name}}
                </h1>
                <h3 class="text-blue-600 text-xl font-battambang mt-3.5">សូមសា្វគមន៍មកកាន់ប្រព័ន្ធគ្រប់គ្រងទិន្នន័យ​
                    សមាជិកយុវជន ក.ក្រ.ក</h3>
                <div class="grid justify-items-end my-3 opacity-5 hover:opacity-100">
                </div>
            </div>
            <div class="flex flex-col sm:flex-row md:flex-row lg:justify-between gap-5 mt-5">
                <div class="sm:p-4 p-2 bg-white border rounded-xl shadow-lg lg:w-[50%] md:w-[50%]">
                    <div class="flex mt-2 justify-center items-center">
                        @if($branchName != null && $branch_image != null)
                            <img src="{{asset($branch_image)}}" class="w-96 rounded-lg" alt="branch logo">
                        @else
                            <img src="{{asset($institute_image)}}" class="w-96 rounded-lg" alt="branch logo">
                        @endif
                    </div>
                    <div class="flex flex-row items-center justify-center ">
                        @if($branchName != null && $branch_image != null)
                            <h1 class="font-koulen text-xl text-blue-700 text-center mt-3">{{$branchName}}</h1>
                        @else
                            <h1 class="font-koulen text-xl text-blue-700 text-center mt-3">{{$institute_kh}}</h1>
                        @endif
                    </div>
                </div>
                <div class="p-2 bg-white border rounded-xl shadow-lg sm:w-[50%] md:w-[50%] ">
                    <h2 class="text-blue-700 text-2xl font-koulen mt-4 text-center">សាខាដែលមានសមាជិកចុះឈ្មោះថ្មី
                    </h2>
                    <div class="mt-4 flex justify-center">
                        <table class="table font-battambang leading-10 font-medium">
                            <tbody>

                                @if($user->hasRole('admin'))
                                    {{-- Admin see all branches --}}
                                    @foreach($total_mem_branches as $key => $total_mem_branch)
                                        <tr class="{{ $key >= 7 ? 'hidden extra-branch' : '' }}">
                                            <td class="px-2 text-xl">{{ ($key + 1) . '.'}}</td>
                                            <td class="text-xl pr-20">
                                                {{ str_replace('ខេត្ត', '', $total_mem_branch->branch_kh) }}
                                            </td>
                                            <td class="text-base pl-[40px] text-end">{{ $total_mem_branch->total_mem }} នាក់
                                            </td>
                                        </tr>
                                    @endforeach
                                @elseif($user->hasRole('user') && $branchName != null && $branch_image != null)
                                    {{-- User see their branch --}}
                                    @php
                                        $districts = DB::table('district as d')
                                            ->leftJoin('school as s', 'd.district_id', '=', 's.district_id')
                                            ->leftJoin('member_education_background as meb', 'meb.school_id', '=', 's.school_id')
                                            ->select(
                                                'd.district_name',
                                                DB::raw('COUNT(meb.member_id) as total_mem')
                                            )
                                            ->where('d.branch_id', $userBranchId)
                                            ->groupBy('d.district_name')
                                            ->get();
                                     @endphp
                                    @foreach($districts as $key => $district)
                                        <tr class="{{ $key >= 7 ? 'hidden extra-branch' : '' }}">
                                            <td class="px-2 text-xl">{{ ($key + 1) . '.' }}</td>
                                            <td class="text-xl pr-20">{{ $district->district_name }}</td>
                                            <td class="text-base pl-[40px] text-end">{{ $district->total_mem }} នាក់</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <div id="chart"></div>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <span class="flex justify-end mt-3 p-3">
                        @if(auth()->user()->hasRole('admin'))
                            <a href="/branch"
                                class="bg-blue-600 px-4 py-2 rounded-lg text-white font-battambang hover:bg-blue-500 text-[17px]">មើលបន្ថែម</a>
                        @elseif($branchName != null && $branch_image != null)
                            <a href="{{ route('village', ['id' => $userBranchId]) }}"
                                class="bg-blue-600 px-4 py-2 rounded-lg text-white font-battambang hover:bg-blue-500 text-[17px]">មើលបន្ថែម</a>
                        @endif
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('JS')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        var options = {
            series: [
                        {{ $total_mem_institute->total_mem ?? 0 }},
                        {{ $total_mem_institute->total_wm ?? 0 }},
                {{ $total_mem_institute->total_mem_expired ?? 0 }}
            ],
            chart: { type: 'pie', width: 380 },
            labels: ['សរុប', 'ស្រី', 'ផុតកំណត់'],
            colors: ['#03fc6f', '#007bff', '#dc3545'],
            plotOptions: {
                pie: {
                    customScale: 0.9,
                    expandOnClick: false,
                    dataLabels: {
                        offset: -10
                    }
                }
            },
            dataLabels: {
                enabled: true,
                formatter: function (val, opts) {
                    return opts.w.globals.series[opts.seriesIndex] + ' នាក់';
                },
                style: {
                    fontSize: '18px',
                    fontWeight: 'bold'
                }
            },
            legend: {
                position: 'bottom',
                fontSize: '14px',
                fontWeight: 'bold',
                markers: {
                    width: 12,
                    height: 12
                }
            }
        };
        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    </script>
@endpush