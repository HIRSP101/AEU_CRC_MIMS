@extends('layouts.templates.att.master')
@push('CSS')
@endpush

@section('Content')
    <div class="bg-[#fff] p-2 rounded-lg max-w-1000px m-5 shadow-md font-siemreap">
       
        <div class="grid grid-cols-7 ">
            <div class=" text-2xl col-span-6 flex flex-col items-center justify-center mb-10 ml-24">
                <h1>កែប្រែសាខា</h1>
            </div>
            <div class="">
                <img class="image w-28 h-32 bg-gray-200" src="{{asset("{$bhei->image}")}}" alt="">
            </div>
        </div>
        <div class="mt-5">
            <form action="{{ route('branch.update') }}" enctype="multipart/form-data" method="POST">
                @csrf
                <input id="bhei_id" name="bhei_id" value="{{$bhei->bhei_id}}" hidden>
                <div class="container">
                    <div class="flex mb-6 mx-3">
                        <div class="block w-1/2 mb-6 md:mb-0 px-3">
                            <label class="md:w-full block uppercase tracking-wide text-gray-700 mb-2" for="branchName">
                                <h1>
                                    ឈ្មោះសាខា
                                </h1>
                            </label>
                            <input
                                class="appearance-none md:w-full bg-gray-200 text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                name="branchName" id="branchName" type="text" value="{{$bhei->institute_kh}}">
                        </div>
                        <div class="block  md:w-1/3 px-3">
                            <label class="block uppercase tracking-wide text-gray-700  mb-2" for="typOfBranch">
                                ប្រភេទស្ថាប័ន
                            </label>
                            <select name="typeofBranch" id="typOfBranch"
                                class="w-full bg-gray-200 text-gray-700 border border-gray-300 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 ">  
                                @if($bhei->type == "សាធារណះ") 
                                <option value="">---</option>
                                <option value="សាធារណះ" selected>សាធារណះ</option>
                                <option value="ឯកជន">ឯកជន</option>
                                @elseif($bhei->type == "ឯកជន")
                                <option value="">---</option>
                                <option value="សាធារណះ" >សាធារណះ</option>
                                <option value="ឯកជន" selected>ឯកជន</option>
                                @else
                                <option value="">---</option>
                                <option value="សាធារណះ">សាធារណះ</option>
                                <option value="ឯកជន">ឯកជន</option>
                                @endif

                            </select>
                        </div>
                        <div class="w-1/3 px-3 block">
                            <label class="block uppercase tracking-wide text-gray-700  mb-2" for="branchLevel">
                                កម្រិត
                            </label>
                            <select name="branchLevel" id="branchLevel"
                                class="w-full bg-gray-200 text-gray-700 border border-gray-300 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 ">
                                @if($bhei->institute_type == "សាកលវិទ្យាល័យ")
                                <option value="">---</option>
                                <option value="សាកលវិទ្យាល័យ" selected>សាកលវិទ្យាល័យ</option>
                                @else
                                <option value="">---</option>
                                <option value="សាកលវិទ្យាល័យ">សាកលវិទ្យាល័យ</option>
                                @endif
                            </select>
                        </div>
                        <div class="w-1/2 px-3 block">
                            <label class="block uppercase tracking-wide text-gray-700" for="image">
                                រូបភាព
                            </label>
                            <input
                                class="appearance-none w-full bg-gray-200 text-gray-700 border border-gray-300 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                name="image" type="file" select="image/*" id="image">
                        </div>
                    </div>
                    <hr>
                    <h1 class="m-5">
                        ទីតាំងរបស់សាខា ឬអនុសាខា
                    </h1>
                    <div class="flex mx-3 mt-3 mb-6">
                        <div class="w-1/4 block px-3">
                            <label class="block uppercase tracking-wide text-gray-700  mb-2" for="village">
                                ភូមិ
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                name="village" id="village" type="text" value="{{$bhei->village}}">
                        </div>
                        <div class="w-1/4 px-3">
                            <label class="block uppercase tracking-wide text-gray-700  mb-2" for="district">
                                ឃុំ
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                name="district" id="district" type="text" value="{{$bhei->commune_sangkat}}">
                        </div>
                        <div class="w-1/4 block px-3">
                            <label class="block uppercase tracking-wide text-gray-700  mb-2" for="communceOrKhan">
                                ស្រុក/ខណ្ឌ
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                name="communceOrKhan" id="communceOrKhan" type="text" value="{{$bhei->district_khan}}">
                        </div>
                        <div class="w-1/4 px-3">
                            <label class="block uppercase tracking-wide text-gray-700  mb-2" for="provinceOrCity">
                                ក្រុង/ខេត្ត
                            </label>
                            <select name="provinceOrCity" id="provinceOrCity"
                            class="w-full bg-gray-200 text-gray-700 border border-gray-300 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 ">
                            <option value="">---</option>
                            @foreach ($total_branches as $branch)
                                <option value="{{ $branch->branch_kh }} {{ $branch->branch_id }}" 
                                    {{ $bhei->branch_id == $branch->branch_id ? 'selected' : '' }}>
                                    {{ $branch->branch_kh }}
                                </option>
                            @endforeach
                        </select>
                        </div>
                    </div>
                    <hr>
                    <h1 class="m-5">
                        ថ្ងៃខែឆ្នាំ​ចូល និងបង្កើត
                    </h1>
                    <div class="flex mx-3 mt-3 mb-6">
                        <div class="w-1/3 block px-3">
                            <label class="block uppercase tracking-wide text-gray-700  mb-2" for="createDate">
                                ថ្ងៃខែឆ្នាំបង្កើត
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                name="createDate" id="createDate" type="date" value="{{$bhei->established_at}}">
                        </div>
                        <div class="w-1/3 px-3">
                            <label class="block uppercase tracking-wide text-gray-700  mb-2" for="recruitementDate">
                                ថ្ងៃខែឆ្នាំចូល
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                name="recruitementDate" id="recruitementDate" type="date" value="{{$bhei->registered_at}}">
                        </div>
                        <div class="w-1/3 px-3 flex mt-6">
                            <div class="w-1/2">
                                <button
                                    class="w-full border-solid m-2 border-2 bg-green-500 p-2 rounded-md hover:bg-green-600 active:bg-green-700 focus:outline-none focus:ring focus:ring-green-300"
                                    type="submit" id="submit_btn">យល់ព្រម
                                </button>
                            </div>
                            <div class="w-1/2">
                                <button
                                    class="w-full border-solid m-2 border-2 bg-red-500 p-2 rounded-md hover:bg-red-600 active:bg-red-700 focus:outline-none focus:ring focus:ring-red-300"
                                    type="button" id="clear_btn">លុប
                                </button>
                            </div>
                        </div>

                    </div>
            </form>
        </div>
    @endsection

    @push('JS')
        <script>
            $(`#image`).on('change', function(e) {
                e.preventDefault();
                var file = e.target.files;
                previewImage(file);
            });

            function previewImage(files) {
                $(`#imagepreview`).html('');
                $.each(files, function(i, file) {
                    if (file.type.startsWith('image/')) {
                        var reader = new FileReader();
                        reader.onload = function(e) {

                            $("img.image").attr('src', e.target.result);
                        };
                        reader.readAsDataURL(file);
                    }
                });
            }
        </script>
    @endpush
