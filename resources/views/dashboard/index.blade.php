@extends('layouts.templates.att.master')
@push('CSS')
@endpush

@section('Content')
    <!-- section  -->
    <div class="p-8">
        <div class="">
            <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                <div class="p-4">
                    <h1 class="text-blue-700 text-3xl font-koulen">សួស្តី បងប្រុស</h1>
                    <h3 class="text-blue-700 text-xl font-siemreap mt-3.5">សូមសា្វគមន៍មកកាន់ប្រព័ន្ធគ្រប់គ្រងទិន្នន័យ​
                        សមាជិកយុវជន ក.ក្រ.ក</h3>
                </div>
                <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow">
                    <div class="flex justify-center mt-10">
                        <img src="../assets/images/ខេត្ត កំពង់ស្ពឺ.jpg" class="w-52" alt="">
                    </div>
                    <div class="p-2.5">
                        <h1 class="font-koulen text-2xl text-blue-700 text-center mt-4">ខេត្ត កំពង់ស្ពឺ​</h1>
                    </div>
                </div>
                <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow">
                    <div​ class="flex justify-center">
                        <h2​ class="text-blue-700 text-xl font-koulen mt-3.5 justify-center">ខេត្តដែលមានសមាជិកចុះឈ្មោះថ្មី</h2>
                            <div class="mt-4 flex justify-center">
                                <table class="table-auto font-siemreap font-bold">
                                    <tbody>
                                        <tr>
                                            <td class="px-7">1.</td>
                                            <td>ខេត្ត </td>
                                            <td>កំពត</td>
                                            <td class="px-4">10​ នាក់</td>
                                        </tr>
                                        <tr>
                                            <td class="px-7">2.</td>
                                            <td>ខេត្ត </td>
                                            <td>កំពង់ស្ពឺ​</td>
                                            <td class="px-4">19 នាក់</td>
                                        </tr>
                                        <tr>
                                            <td class="px-7">3.</td>
                                            <td>ខេត្ត </td>
                                            <td>តាកែវ</td>
                                            <td class="px-4">75 នាក់</td>
                                        </tr>
                                        <tr>
                                            <td class="px-7">4.</td>
                                            <td>ខេត្ត </td>
                                            <td>កណ្តាល</td>
                                            <td class="px-4">17 នាក់</td>
                                        </tr>
                                        <tr>
                                            <td class="px-7">5.</td>
                                            <td>ខេត្ត </td>
                                            <td>កំពង់ចាម</td>
                                            <td class="px-4">19 នាក់</td>
                                        </tr>
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
            <div class="">
                <hr class="h-px my-8 bg-red-600 p-[1px] border dark:bg-red-600">
            </div>
            <div class="">
                <h1 class="font-koulen text-blue-600 text-2xl">សាខា & អនុសាខា</h1>
            </div>
            <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mt-5">
                <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow">
                    <div class="flex justify-center mt-6">
                        <img src="../assets/images/ខេត្ត កំពង់ស្ពឺ.jpg" class="w-52" alt="">
                    </div>
                    <div class="p-2.5">
                        <h1 class="font-koulen text-2xl text-blue-700 text-center mt-4">ខេត្ត កំពង់ស្ពឺ​</h1>
                    </div>
                </div>
                <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow">
                    <div class="flex justify-center mt-6">
                        <img src="../assets/images/ខេត្ត តាកែវ.png" class="w-52" alt="">
                    </div>
                    <div class="p-2.5">
                        <h1 class="font-koulen text-2xl text-blue-700 text-center mt-4">ខេត្ត តាកែវ</h1>
                    </div>
                </div>
                <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow">
                    <div class="flex justify-center mt-6">
                        <img src="../assets/images/ខេត្ត កំពង់ចាម.jpg" class="w-52" alt="">
                    </div>
                    <div class="p-2.5">
                        <h1 class="font-koulen text-2xl text-blue-700 text-center mt-4">ខេត្ត កំពង់ចាម​</h1>
                    </div>
                </div>
                <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow">
                    <div class="flex justify-center mt-6">
                        <img src="../assets/images/ខេត្ត កំពង់ស្ពឺ.jpg" class="w-52" alt="">
                    </div>
                    <div class="p-2.5">
                        <h1 class="font-koulen text-2xl text-blue-700 text-center mt-4">ខេត្ត កំពង់ស្ពឺ​</h1>
                    </div>
                </div>
                <div class="rounded-xl h-52 bg-white shadow-md">
                    <div class="flex justify-center mt-6">
                        <img src="../assets/images/ខេត្ត កំពង់ស្ពឺ.jpg" class="w-52" alt="">
                    </div>
                    <div class="p-2.5">
                        <h1 class="font-koulen text-2xl text-blue-700 text-center mt-4">ខេត្ត កំពង់ស្ពឺ​</h1>
                    </div>
                </div>
                <div class="rounded-xl h-52 bg-white shadow-md">
                    <div class="flex justify-center mt-6">
                        <img src="../assets/images/ខេត្ត កំពង់ស្ពឺ.jpg" class="w-52" alt="">
                    </div>
                    <div class="p-2.5">
                        <h1 class="font-koulen text-2xl text-blue-700 text-center mt-4">ខេត្ត កំពង់ស្ពឺ​</h1>
                    </div>
                </div>
            </div>
            <!-- read more -->
            <div class="flex justify-end p-3 mr-2">
                <a href="#"
                    class="bg-red-600 px-4 py-2 rounded text-white font-siemreap hover:bg-red-500 text-sm">មើលបន្ថែម</a>
            </div>
            <!--./ read more -->
            <div class="">
                <hr class="h-px my-8 bg-red-600 p-[1px] border dark:bg-red-600">
            </div>

            <div class=" pb-5">
                <h2 class="font-koulen text-lg text-blue-600">តារាងទិន្នន័យ នៃសាខា​ ក.ក្រ.ក ២៥ រាជធានី​ ខេត្ត</h2>
                <div class="shadow-lg rounded-lg mt-3.5 overflow-hidden">
                    <table class="w-full table-fixed">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="w-1/4 py-4 px-6 text-left text-red-600 font-bold uppercase font-siemreap">ល.រ</th>
                                <th class="w-1/2 py-4 px-6 text-left text-red-600 font-bold uppercase font-siemreap">សាខា​
                                    កាកបាទក្រហមកម្ពុជា</th>
                                <th class="w-1/4 py-4 px-6 text-left text-red-600 font-bold uppercase font-siemreap">សមាជិកសរុប
                                </th>
                                <th class="w-1/5 py-4 px-6 text-left text-red-600 font-bold uppercase font-siemreap">ស្រី</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            <tr class="hover:bg-slate-100">
                                <td class="py-4 px-6 border-b border-gray-200">1</td>
                                <td class="py-4 px-6 border-b border-gray-200 truncate">123</td>
                                <td class="py-4 px-6 border-b border-gray-200">555-555-5555</td>
                                <td class="py-4 px-6 border-b border-gray-200">555</td>
                            </tr>
                            <tr class="hover:bg-slate-100">
                                <td class="py-4 px-6 border-b border-gray-200">2</td>
                                <td class="py-4 px-6 border-b border-gray-200">145</td>
                                <td class="py-4 px-6 border-b border-gray-200">555-555-5555</td>
                                <td class="py-4 px-6 border-b border-gray-200">555</td>
                            </tr>
                            <tr class="hover:bg-slate-100">
                                <td class="py-4 px-6 border-b border-gray-200">3</td>
                                <td class="py-4 px-6 border-b border-gray-200">365</td>
                                <td class="py-4 px-6 border-b border-gray-200">555-555-5555</td>
                                <td class="py-4 px-6 border-b border-gray-200">555</td>
                            </tr>
                            <tr class="hover:bg-slate-100">
                                <td class="py-4 px-6 border-b border-gray-200">4</td>
                                <td class="py-4 px-6 border-b border-gray-200">456</td>
                                <td class="py-4 px-6 border-b border-gray-200">555-555-5555</td>
                                <td class="py-4 px-6 border-b border-gray-200">555</td>
                            </tr>
                            <!-- Add more rows here -->
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- footer -->
            <div class="">
                <hr class="h-px my-3 bg-red-600 p-[1px] border dark:bg-red-600">
            </div>
            <span class="block text-sm text-gray-500 sm:text-center pb-3 dark:text-gray-400">©2024
                <a href="#" class="hover:underline">Red Cross Cambodia</a>. All Rights Reserved.</span>
        </div>
    </div>

    <!-- ./section -->
@endsection

@push('JS')
@endpush
