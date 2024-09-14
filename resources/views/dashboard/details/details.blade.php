@extends('layouts.templates.att.master')
@push('CSS')
@endpush

@section('Content')
<div class="mx-20 p-4">
    <div class="flex justify-center">
        <img class="w-20 " src="{{ asset('images/Logo_of_Cambodian_Red_Cross.svg') }}">
    </div>

    <div class="text-center text-lg">
        <h1>សលាកបត្រព័ត៌មានផ្ទាល់ខ្លួន យុវជនកាកបាទក្រហមកម្ពុជា</h1>
        <p>Cambodian Red Cross Youth Individual Information</p>
    </div>
    <h1 class="text-xl">1-ព័ត៌មានលម្អិតផ្ទាល់ខ្លួន (Personal Detail)</h1>
    @include('dashboard.partials.detail_component.detail')
    <h1 class="text-xl">2-វគ្គបណ្ដុះបណ្ដាលដែលទទួលបានកន្លងមក (Training Skill)</h1>
    @include('dashboard.partials.detail_component.training_skill')
    <h1 class="text-xl">3-ព័ត៌មានគ្រួសារ (Family Information)</h1>
    @include('dashboard.partials.detail_component.family_info')
    @endsection

    @push('JS')

    @endpush