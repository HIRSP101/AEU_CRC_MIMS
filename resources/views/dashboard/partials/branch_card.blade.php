{{-- @if($key > 3)
<div class="collapsibleContent flex-shrink-0 m-2 relative overflow-hidden bg-white rounded-lg  shadow-lg hidden">
    <div class="relative px-10 flex items-center justify-center">
        <img class="w-[170px] h-[170px] rounded-md" src="{{asset("images/branches/b-$key.jpg")}}" alt="">
    </div>
    <div class="relative text-black text-center bg-slate-100 px-6 pb-2 pt-2">
        <a href="/dashboard/{{$key == 28 ? 'highereduinstitutes' : 'branch/'.$key}}" class="block opacity-100 mb-1">{{$val}}</a>
    </div>
</div>
@else
<div class="flex-shrink-0 m-2 relative overflow-hidden bg-white rounded-lg shadow-lg">
<div class="flex-shrink-0 m-2 relative overflow-hidden bg-white rounded-lg shadow-lg">
    <div class="relative px-10 flex items-center justify-center">
        <img class="relative w-[170px] h-[170px] rounded-md" src="{{asset("images/branches/b-$key.jpg")}}" alt="">
    </div>
    <div class="relative text-black text-center bg-slate-100 px-6 pb-2 pt-2">
        @if(auth()->user()->hasRole('admin'))
        <a href='{{auth()->user()->hasRole('admin') ? "/branch/$key" : ""}}' class="block opacity-100 mb-1">{{$val}}</a>
        @else
        <p class="block opacity-100 mb-1">{{$val}}</p>
        @endif
    </div>
</div>
@endif
 --}}
