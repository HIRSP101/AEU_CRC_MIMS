@if($key > 3)
<div class=" collapsibleContent flex-shrink-0 m-2 relative overflow-hidden bg-white rounded-lg max-w-xs shadow-lg hidden">
    <div class="relative px-10 flex items-center justify-center">
        <img class="relative w-[320px] h-[280px] rounded-md" src="{{asset("images/branches/b-$key.jpg")}}" alt="">
    </div>
    <div class="relative text-black text-center bg-slate-100 px-6 pb-2 pt-2">
        <a href="/dashboard/{{$key == 28 ? 'highereduinstitutes' : 'branch?id='.$key}}" class="block opacity-100 mb-1">{{$val}}</a>
    </div>
</div>
@else
<div class="flex-shrink-0 m-2 relative overflow-hidden bg-white rounded-lg max-w-xs shadow-lg">
    <div class="relative px-10 flex items-center justify-center">
        <img class="relative w-[320px] h-[280px] rounded-md" src="{{asset("images/branches/b-$key.jpg")}}" alt="">
    </div>
    <div class="relative text-black text-center bg-slate-100 px-6 pb-2 pt-2">
        <a href='{{auth()->user()->hasRole('admin') ? "/dashboard/branch?id=$key" : ""}}' class="block opacity-100 mb-1">{{$val}}</a>
    </div>
</div>
@endif

