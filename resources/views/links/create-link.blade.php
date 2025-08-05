@extends('layouts.templates.att.master')
@push('CSS')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
@endpush
@php
    use Carbon\Carbon;
@endphp
@section('Content')
<div class="m-5 bg-gray-100 font-battambang">
    @if ($title == 'បង្កើត Link')
        <div class="p-5 bg-white shadow-md rounded-lg">
            <div class="grid grid-cols-6 ">
                <div class="col-span-5 flex flex-col items-center justify-center mb-10 ml-44">
                    <h1 class="text-2xl font-medium text-center font-koulen text-blue-600">
                        {{ $title }}
                    </h1>
                </div>
            </div>

            @csrf
            <div class="flex flex-wrap -mx-3 mt-3 mb-6">
                <div class="w-full md:w-1/3 px-3">
                    <label class="block uppercase tracking-wide text-gray-700  mb-2">
                        ឆ្នាំសិក្សា
                    </label>
                    <select id="year" name="year"
                        class="appearance-none block w-full text-sm bg-gray-50 text-gray-700 border border-gray-400 rounded mb-3 py-3 px-4leading-tight focus:outline-none focus:bg-white">
                        <option value="">សូមេជ្រើរើសឆ្នាំសិក្សា</option>
                    </select>
                </div>
                <div class="w-full md:w-1/3 px-3">
                    <label class="block uppercase tracking-wide text-gray-700  mb-2">
                        ថ្ងៃចាប់ផ្តើមទទួលពាក្យ
                    </label>
                    <input id="startDate"
                        class="appearance-none block w-full text-sm bg-gray-50 text-gray-700 border border-gray-400 rounded mb-3 py-3 px-4leading-tight focus:outline-none focus:bg-white"
                        type="date" required>
                </div>
                <div class="w-full md:w-1/3 px-3">
                    <label class="block uppercase tracking-wide text-gray-700  mb-2">
                        ថ្ងៃឈប់ទទួលពាក្យ
                    </label>
                    <input id="endDate"
                        class="appearance-none block w-full text-sm bg-gray-50 text-gray-700 border border-gray-400 rounded mb-3 py-3 px-4leading-tight focus:outline-none focus:bg-white"
                        type="date" required>
                </div>
            </div>
            <div class="flex justify-center">
                <button id="create-link" class="bg-green-500 text-white px-10 py-2 rounded font-battambang">បង្កើត
                </button>
            </div>
            <div class="grid grid-cols-3 hidden" id="link-generate">
                <div class="w-full col-span-2 px-3">
                    <input type="text" id="link-generated"
                        class="mt-10 pl-5 appearance-none block w-full text-sm bg-gray-200 text-gray-700 border-gray-400 rounded mb-3 py-3 px-4leading-tight focus:outline-none focus:bg-white"
                        value="" readonly>
                </div>
                <div class="w-full">
                    <button id="copy_btn"
                        class="bg-gray-500 text-white px-7 mt-10 py-2 rounded font-battambang">Copy</button>
                </div>
                <div class="mt-7 ml-4">
                    <a href="{{ route('link-member') }}"
                        class="bg-gray-500 text-white px-7 py-2 rounded font-battambang">Back</a>
                </div>
            </div>
        </div>
        @endsection
        @push('JS')
            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    const currentYear = new Date().getFullYear();
                    const yearSelect = document.getElementById('year');
                    for (let i = currentYear; i <= currentYear + 10; i++) {
                        const option = document.createElement('option');
                        option.value = `${i}-${i + 1}`;
                        option.textContent = `${i} - ${i + 1}`;
                        yearSelect.appendChild(option);
                    }
                    $("#create-link").on("click", function (e) {
                        e.preventDefault();
                        const academic_year = $('#year').val();
                        const starts_at = $('#startDate').val();
                        const expires_at = $('#endDate').val();
                        if (academic_year === "") {
                            alert("សូមជ្រើសរើសឆ្នាំសិក្សា");
                            return;
                        }
                        if (starts_at === "") {
                            alert("សូមជ្រើសរើសថ្ងៃចាប់ផ្តើមទទួលពាក្យ");
                            return;
                        }
                        if (expires_at === "") {
                            alert("សូមជ្រើសរើសថ្ងៃឈប់ទទួលពាក្យ");
                            return;
                        }
                        if (new Date(starts_at) > new Date(expires_at)) {
                            alert("ថ្ងៃចាប់ផ្តើមទទួលពាក្យ មិនអាចធំជាង ថ្ងៃឈប់ទទួលពាក្យ");
                            return;
                        }
                        $.ajax({
                            url: "{{ route('create-link.store') }}",
                            type: "POST",
                            data: {
                                academic_year,
                                starts_at,
                                expires_at,
                            },
                            headers: {
                                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                            },
                            success: function (response) {
                                if (response.status === 200) {
                                    alert(response.message);
                                    const link = `${window.location.origin}/member-registration/${response.token}`;
                                    $("#link-generate").removeClass("hidden");
                                    $("#link-generated").val(link);
                                }
                                else if (response.status === 409) {
                                    alert(response.message);
                                }
                            },
                            error: function (xhr, status, error) {
                                console.error(error);
                            }
                        })
                    });

                    $("#copy_btn").on("click", function () {
                        const $input = $("#link-generated");
                        $input.select();
                        $input[0].setSelectionRange(0, 99999);
                        document.execCommand("copy");
                        alert("Link បានចម្លងទៅ clipboard រួចហើយ!");
                    });

                })

            </script>
        @endpush
    @else
        <div class="p-5 bg-white shadow-md rounded-lg">
            <div class="grid grid-cols-6 ">
                <div class="col-span-5 flex flex-col items-center justify-center mb-10 ml-44">
                    <h1 class="mb-1 text-[18px] font-khmer mt-9">{{$title}}</h1>
                </div>
            </div>

            @csrf
            <div class="flex flex-wrap -mx-3 mt-3 mb-6">
                <div class="w-full md:w-1/3 px-3">
                    <label class="block uppercase tracking-wide text-gray-700  mb-2">
                        ឆ្នាំសិក្សា
                    </label>
                    <select id="year" name="year" disabled
                        class="appearance-none block w-full text-sm bg-gray-50 text-gray-700 border border-gray-400 rounded mb-3 py-3 px-4leading-tight focus:outline-none focus:bg-white">
                        <option value="{{$tokenEntry->academic_year}}">{{$tokenEntry->academic_year}} </option>
                    </select>
                </div>
                <div class="w-full md:w-1/3 px-3">
                    <label class="block uppercase tracking-wide text-gray-700  mb-2">
                        ថ្ងៃចាប់ផ្តើមទទួលពាក្យ
                    </label>
                    <input id="startDate"
                        class="appearance-none block w-full text-sm bg-gray-50 text-gray-700 border border-gray-400 rounded mb-3 py-3 px-4leading-tight focus:outline-none focus:bg-white"
                        type="date" required value="{{ Carbon::parse($tokenEntry->starts_at)->format('Y-m-d') }}">
                </div>
                <div class="w-full md:w-1/3 px-3">
                    <label class="block uppercase tracking-wide text-gray-700  mb-2">
                        ថ្ងៃឈប់ទទួលពាក្យ
                    </label>
                    <input id="endDate"
                        class="appearance-none block w-full text-sm bg-gray-50 text-gray-700 border border-gray-400 rounded mb-3 py-3 px-4leading-tight focus:outline-none focus:bg-white"
                        type="date" required value="{{ Carbon::parse($tokenEntry->expires_at)->format('Y-m-d') }}">
                </div>
            </div>
            <div class="flex justify-center">
                <button id="update-link" class="bg-green-500 text-white px-10 py-2 rounded font-battambang">កែប្រែ
                </button>
            </div>
            <div class="grid grid-cols-3 hidden" id="link-generate">
                <div class="w-full col-span-2 px-3">
                    <input type="text" id="link-generated"
                        class="mt-10 pl-5 appearance-none block w-full text-sm bg-gray-200 text-gray-700 border-gray-400 rounded mb-3 py-3 px-4leading-tight focus:outline-none focus:bg-white"
                        value="" readonly>
                </div>
                <div class="w-full">
                    <button id="copy_btn"
                        class="bg-gray-500 text-white px-7 mt-10 py-2 rounded font-battambang">Copy</button>
                </div>
                <div class="mt-7 ml-4">
                    <a href="{{ route('link-member') }}"
                        class="bg-gray-500 text-white px-7 py-2 rounded font-battambang">Back</a>
                </div>
            </div>
        </div>
        @endsection
        @push('JS')
            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    $("#update-link").on("click", function (e) {
                        e.preventDefault();
                        const starts_at = $('#startDate').val();
                        const expires_at = $('#endDate').val();
                        if (starts_at === "") {
                            alert("សូមជ្រើសរើសថ្ងៃចាប់ផ្តើមទទួលពាក្យ");
                            return;
                        }
                        if (expires_at === "") {
                            alert("សូមជ្រើសរើសថ្ងៃឈប់ទទួលពាក្យ");
                            return;
                        }
                        if (new Date(starts_at) > new Date(expires_at)) {
                            alert("ថ្ងៃចាប់ផ្តើមទទួលពាក្យ មិនអាចធំជាង ថ្ងៃឈប់ទទួលពាក្យ");
                            return;
                        }
                        $.ajax({
                            url: "{{ route('link-member.update') }}",
                            type: "POST",
                            data: {
                                id: "{{ $tokenEntry->id }}",
                                starts_at,
                                expires_at,
                            },
                            headers: {
                                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                            },
                            success: function (response) {
                                if (response.status === 200) {
                                    alert(response.message);
                                    const link = `${window.location.origin}/member-rigistration/${response.data}`;
                                    $("#link-generate").removeClass("hidden");
                                    $("#link-generated").val(link);
                                }
                            },
                            error: function (xhr, status, error) {
                                if (xhr.responseJSON.message.includes("user_form_tokens.user_form_tokens_academic_year_unique")) {
                                    alert("Link សម្រាប់ឆ្នាំសិក្សានេះ មានរួចហើយ។ សូមបង្កើត Link សម្រាប់ឆ្នាំសិក្សាថ្មី។");
                                    return;
                                }
                                console.error(error);
                            }
                        })
                    });

                    $("#copy_btn").on("click", function () {
                        const $input = $("#link-generated");
                        $input.select();
                        $input[0].setSelectionRange(0, 99999);
                        document.execCommand("copy");
                        alert("Link បានចម្លងទៅ clipboard រួចហើយ!");
                    });

                })

            </script>
        @endpush
    @endif