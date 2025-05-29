@extends('layouts.templates.att.master')
@push('CSS')
@endpush

@section('Content')

    <div class="bg-white mt-2 mx-3 shadow-lg">
        <div class="flex justify-between items-center mb-4 mt-14 px-4">
            <div class="tab_filter_container flex items-center space-x-2">
                <a href="{{ route('link-report') }}"
                    class="bg-blue-500 text-white px-4 py-2 rounded font-battambang">របាយការណ៍</a>
            </div>

            <div class="flex items-center space-x-3">
                <a href="{{ route('create-link') }}" id="delete"
                    class="bg-green-500 text-white px-4 py-2 rounded font-battambang">បង្កើត
                    Link</a>
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
                            <th class="py-3 pl-20">
                                ឆ្នាំសិក្សា
                            </th>
                            <th class="py-3 text-left pl-36">
                                Link
                            </th>
                            <th class="py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 pl-5 text-left whitespace-nowrap">
                                1
                            </td>
                            <td class="py-3 pl-20 text-center">
                                2025
                            </td>
                            <td class="py-3 text-left pl-36">
                                *************************
                            </td>
                            <td class="py-3 text-center">
                                <button class="bg-red-500 text-white px-4 py-2 rounded">លុប</button>
                            </td>
                        </tr>
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 pl-5 text-left whitespace-nowrap">
                                2
                            </td>
                            <td class="py-3 pl-20 text-center">
                                2025
                            </td>
                            <td class="py-3 text-left pl-36">
                                *************************
                            </td>
                            <td class="py-3 text-center">
                                <button class="bg-red-500 text-white px-4 py-2 rounded">លុប</button>
                            </td>
                        </tr>
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 pl-5 text-left whitespace-nowrap">
                                3
                            </td>
                            <td class="py-3 pl-20 text-center">
                                2025
                            </td>
                            <td class="py-3 text-left pl-36">
                                *************************
                            </td>
                            <td class="py-3 text-center">
                                <button class="bg-red-500 text-white px-4 py-2 rounded">លុប</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection