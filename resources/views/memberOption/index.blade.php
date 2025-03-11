{{-- @extends('layouts.templates.att.master')
@push('CSS')
@endpush

@section('Content')
<div class="flex justify-center mt-12 gap-3">
    <a href="{{ url('/member/' . $id)}}">
        <div
            class="user-detail bg-green-500 font-siemreap text-white hover:bg-green-400 w-[250px] h-[50px] text-center pt-3 rounded-sm">
            <p>សាលាបត្រព័ត៌មានផ្ទាល់ខ្លួន</p>
        </div>
    </a>
    <a href="{{ url('/member/request/' . $id)}}">
        <div
            class="request-form bg-orange-400 font-siemreap text-white hover:bg-orange-300 w-[250px] h-[50px] text-center pt-3 rounded-sm">
            <p>សំណើរសុំផ្ទេរជីវភាព</p>
        </div>
    </a>
    <a href="{{ url('/member/card/' . $id)}}">
        <div
            class="card bg-blue-400 text-white font-siemreap hover:bg-blue-300 w-[250px] h-[50px] text-center pt-3 rounded-sm">
            <p>ប័ណ្ណសម្គាល់ខ្លួនយុវជន</p>
        </div>
    </a>
</div>
@endsection --}}