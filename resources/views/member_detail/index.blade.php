@extends('layouts.templates.att.master')
@push('CSS')
@endpush

@section('Content')
<?php
$member_addr = $member->member_current_address;
$member_edu = $member->member_education_background;
$member_regis = $member->member_registration_detail;
$member_guardian = $member->member_guardian_detail;
$member_pob = $member->member_pob_address;

?>
<div>
    <div class="ml-10 p-4 ">
        <div class="flex justify-center">
            <div>
                <div class="flex justify-center">
                    <img class="w-32" src="{{ asset('images/Logo_of_Cambodian_Red_Cross.svg') }}">
                </div>
                <div class="text-center">
                    <h1 class="text-2xl">សលាកបត្រព័ត៌មានផ្ទាល់ខ្លួន យុវជនកាកបាទក្រហមកម្ពុជា</h1>
                    <p class="text-lg">Cambodian Red Cross Youth Individual Information</p>
                </div>
            </div>
            <div class="ml-10 mb-10">
                <img class="w-32 h-36 bg-red-300 rounded-md "
                    src="{{ asset($member->image ?? "public/images/placeholder.png") }} ">
            </div>
        </div>
        <h1 class="text-xl">1-ព័ត៌មានលម្អិតផ្ទាល់ខ្លួន (Personal Detail)</h1>
        <div class="font-siemreap my-3 ">
            @include('member_detail.partials.detail')
        </div>
        <h1 class="text-xl">2-វគ្គបណ្ដុះបណ្ដាលដែលទទួលបានកន្លងមក (Training Skill)</h1>
        <div class="font-siemreap">
            @include('member_detail.partials.training_skill')
        </div>
        <h1 class="text-xl">3-ព័ត៌មានគ្រួសារ (Family Information)</h1>
        <div class="font-siemreap">
            @include('member_detail.partials.family_info')
        </div>
    </div>
    @endsection

    @push('JS')

    @endpush