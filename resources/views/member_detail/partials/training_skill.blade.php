{{-- <div class="flex flex-wrap mx-3 my-3 gap-4">
    <div class="flex w-full md:w-full  mb-6 md:mb-0">
        <h3>
            ជំនាញភាសាបរទេស(Language Skill) ៖<span>{{$member_edu->language}}</span>
        </h3>
    </div>
    <div class="flex w-full md:w-full   mb-6 md:mb-0">
        <h3>
            ជំនាញកុំព្យូទ័រ(Computer Skill) ៖
        </h3>
        <P>{{$member_edu->computer_skill}}</P>
    </div>
    <div class="flex w-full md:w-full  mb-6 md:mb-0">
        <h3>
            ជំនាញផ្សេងៗ (Other Skill) ៖ <span>{{$member_edu->misc_skill}}</span>
        </h3>
    </div>
    <div class="flex w-full md:w-full  mb-6 md:mb-0">
        <h3>
            ជំនាញផ្សេងៗ (Other Skill) ៖
        </h3>
        <P>{{$member->misc}}</P>

    </div>
</div> --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="">
        <p>ជំនាញភាសាបរទេស(Language Skill) ៖<span>{{$member_edu->language}}</span></p>
        <p>ជំនាញកុំព្យូទ័រ(Computer Skill) ៖ {{$member_edu->computer_skill}}</p>
        <p>ជំនាញផ្សេងៗ (Other Skill) ៖ <span>{{$member_edu->misc_skill}}</span></p>
        <p>ជំនាញផ្សេងៗ (Other Skill) ៖ {{$member->misc}}</p>
    </div>
</body>
</html>
