{{-- <div class="flex flex-wrap mx-3 my-3 gap-4">
    <div class="flex w-full md:w-1/2  mb-6 md:mb-0">
        <h3>
            ឈ្មោះឪពុក(Father Name) ៖
        </h3>
        <P>{{$member_guardian->father_name}}</P>
    </div>
    <div class="flex w-full md:w-1/2  mb-6 md:mb-0">
        <h3>
            ថ្ងៃខែឆ្នាំកំណើត ៖
        </h3>
        <P>{{$member_guardian->father_dob}}</P>
    </div>
    <div class="flex w-full md:w-full  mb-6 md:mb-0">
        <h3>
            អាសយដ្ឋាន និងមុខរបរ (Current Address & Job) ៖
        </h3>
        <P>{{$member_guardian->father_current_address}} {{$member_guardian->father_occupation}}</P>
    </div>
    <div class="flex w-full md:w-1/2  mb-6 md:mb-0">
        <h3>
            ឈ្មោះម្ដាយ(Mother Name) ៖
        </h3>
        <P>{{$member_guardian->mother_name}}</P>
    </div>
    <div class="flex w-full md:w-1/2  mb-6 md:mb-0">
        <h3>
            ថ្ងៃខែឆ្នាំកំណើត ៖
        </h3>
        <P>{{$member_guardian->mother_dob}}</P>
    </div>
    <div class="flex-1 w-full md:w-full  mb-6 md:mb-0">
        <h3>
            អាសយដ្ឋាន និងមុខរបរ (Current Address & Job) ៖
        </h3>
        <P>{{$member_guardian->mother_current_address}} {{$member_guardian->mother_occupation}}</P>

    </div>
    <div class="flex w-full md:w-full  mb-6 md:mb-0">
        <h3>
            លេខទូរសព្ទអាណាព្យាបាល (Protector Number) ៖
        </h3>
        <P>{{$member_guardian->guardian_phone}}</P>
    </div>
</div> --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .content1 {
            display: grid;
            grid-template-columns: auto auto auto;
        }
        .content2 {
            display: grid;
            grid-template-columns: auto auto auto;
            margin-top: 10px;
        }
        .phone {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="content1"> 
            <div>
                ឈ្មោះឪពុក(Father Name) ៖ {{$member_guardian->father_name}}
            </div>
            <div>
                ថ្ងៃខែឆ្នាំកំណើត ៖ {{$member_guardian->father_dob}}
            </div>
            <div>
                អាសយដ្ឋាន និងមុខរបរ (Current Address & Job) ៖ {{$member_guardian->father_current_address}} {{$member_guardian->father_occupation}}
            </div>
    </div>
    
    <div class="content2">
        
            <div>
                ឈ្មោះម្ដាយ(Mother Name) ៖ {{$member_guardian->mother_name}}
            </div>
            <div>
                ថ្ងៃខែឆ្នាំកំណើត ៖ {{$member_guardian->mother_dob}}
            </div>
            <div>
                អាសយដ្ឋាន និងមុខរបរ (Current Address & Job) ៖ {{$member_guardian->mother_current_address}} {{$member_guardian->mother_occupation}}
            </div>
    </div>
    <div class="phone">
        <div>
            លេខទូរសព្ទអាណាព្យាបាល (Protector Number) ៖ {{$member_guardian->guardian_phone}}
        </div>
    </div>            
</body>
</html>