@extends('layouts.templates.att.master')
@push('CSS')
@endpush

@section('Content')
    <div class="flex justify-around">
        <div class="user-detail bg-red-400">
            <a href="{{ url('/member/' . $id)}}">សាលាបត្រព័ត៌មានផ្ទាល់ខ្លួន</a>
        </div>
        <div class="request-form">
            <a href="{{ url('/member/request/' . $id)}}">សំណើរសុំផ្ទេរជីវភាព</a>
        </div>
        <div class="card">
            <a href="{{ url('/member/card/' . $id)}}">កាត</a>
        </div>
    </div>
@endsection