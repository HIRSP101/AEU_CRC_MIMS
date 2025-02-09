@extends('layouts.templates.att.master')

@section('Content')
    <div class="flex justify-evenly">
        <div class="relative w-[600px] h-[450px] bg-cover bg-center" style="background-image: url('{{ asset('images/users/card1.jpg') }}');">
            <p class="card-id absolute top-[310px] left-[380px] text-black text-sm font-bold">{{$memberCard->member_id}}</p>
        </div>
        <div class="relative w-[600px] h-[450px] bg-cover bg-center" style="background-image: url('{{ asset('images/users/card2.jpg') }}');">
            <p class="profile absolute top-[50px] left-[50px] text-black text-sm font-bold">{{$memberCard->image}}</p>
            <p class="name-kh absolute top-[50px] left-[300px] text-black text-sm font-bold">{{$memberCard->name_kh}}</p>
            <p class="gender absolute top-[50px] left-[530px] text-black text-sm font-bold">{{$memberCard->gender}}</p>
            <p class="name-en absolute top-[77px] left-[300px] text-black text-sm font-bold">{{$memberCard->name_en}}</p>
            <p class="dob absolute top-[105px] left-[300px] text-black text-sm font-bold">{{$memberCard->date_of_birth}}</p>
            <p class="address absolute top-[132px] left-[300px] text-black text-sm font-bold">{{$memberCard->full_current_address}}</p>
            <p class="role absolute top-[186px] left-[300px] text-black text-sm font-bold">{{$memberCard->member_type}}</p>
            <p class="school absolute top-[213px] left-[300px] text-black text-sm font-bold">{{$memberCard->school_name}}</p>
            <div class="register-date">
                <p class=" absolute top-[240px] left-[370px] text-black text-sm font-bold"></p>
                <p class=" absolute top-[240px] left-[440px] text-black text-sm font-bold"></p>
                <p class=" absolute top-[240px] left-[510px] text-black text-sm font-bold"></p>
            </div>
            <p class="phone absolute top-[250px] left-[45px] text-black text-sm font-bold">{{$memberCard->phone_number}}</p>
        </div>
    </div>
@endsection