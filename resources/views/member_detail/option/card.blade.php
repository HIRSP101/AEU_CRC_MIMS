@php
    $address_parts = explode(' ', $member->full_current_address ?? "");
    $current_address_all = trim(($address_parts[1] ?? "") . " " . ($address_parts[2] ?? "") . " " . ($address_parts[3] ?? ""));
@endphp
<div id="card" class="hidden">
    <div class="text-center">
        <h1 class="text-2xl font-siemreap font-bold">ប័ណ្ណសម្គាល់ខ្លួនយុវជន</h1>
    </div>
    <div class="flex justify-evenly mt-12">
        <div class="relative w-[600px] h-[450px] bg-cover bg-center"
            style="background-image: url('{{ asset('images/users/card1.jpg') }}');">
            <p class="card-id absolute top-[310px] left-[380px] text-black text-sm font-bold font-siemreap">
                {{$member->member_id}}
            </p>
        </div>
        <div class="relative w-[600px] h-[450px] bg-cover bg-center"
            style="background-image: url('{{ asset('images/users/card2.jpg') }}');">
            <p class="profile absolute top-[50px] left-[50px] text-black text-sm">
                {{$member->image}}
            </p>
            <p class="name-kh absolute top-[50px] left-[300px] text-black text-sm font-bold font-siemreap">
                {{$member->name_kh}}
            </p>
            <p class="gender absolute top-[50px] left-[530px] text-black text-sm font-bold font-siemreap">
                {{$member->gender}}
            </p>
            <p class="name-en absolute top-[77px] left-[300px] text-black text-sm font-bold font-siemreap">
                {{$member->name_en}}
            </p>
            <p class="dob absolute top-[105px] left-[300px] text-black text-sm font-bold font-siemreap">
                {{$member->date_of_birth}}
            </p>
            <p class="address absolute top-[132px] left-[300px] text-black text-sm font-bold font-siemreap">
                {{-- {{$member->full_current_address}} --}}
                {{$current_address_all}}
            </p>
            <p class="role absolute top-[186px] left-[300px] text-black text-sm font-bold font-siemreap">
                {{$member->member_type}}
            </p>
            <p class="school absolute top-[213px] left-[300px] text-black text-sm font-bold font-siemreap">
                {{$member->school_name}}
            </p>
            <div class="register-date">
                <p class=" absolute top-[240px] left-[370px] text-black text-sm font-bold"></p>
                <p class=" absolute top-[240px] left-[440px] text-black text-sm font-bold"></p>
                <p class=" absolute top-[240px] left-[510px] text-black text-sm font-bold"></p>
            </div>
            <p class="phone absolute top-[250px] left-[45px] text-black text-sm font-bold font-siemreap">
                {{$member->phone_number}}
            </p>
        </div>
    </div>
</div>