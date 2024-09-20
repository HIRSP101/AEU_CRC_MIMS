
<tr class="border-b border-gray-200 hover:bg-gray-100">
    <td class="py-3 px-6 text-left whitespace-nowrap">
        <div class="flex items-center">
            <div class="mr-2">
                <img class="w-6 h-6 rounded-full" src="{{asset("{$userb->branch[0]?->image}")}}"/>
            </div>
            <span class="font-medium">{{$userb->branch[0]?->branch_name ?? ""}}</span>
        </div>
    </td>
    <td class="py-3 px-6 text-left">
        <div class="flex items-center">
            <div class="mr-2">
                <img class="w-6 h-6 rounded-full" src="{{asset("{$userb?->image}")}}"/>
            </div>
            <span>{{$userb->name ?? ""}}</span>
        </div>
    </td>
    <td class="py-3 px-6 text-left">
        <div class="flex items-center">

            <span>{{$userb->roles[0]->name ?? ""}}</span>
        </div>
    </td>
    <td class="py-3 px-6 text-center">
        @if($userb->permissions)
                @foreach($userb->permissions as $permission)
                <span class="bg-purple-200 text-purple-600 py-1 px-3 rounded-full text-xs">{{explode(' ' ,$permission->name)[0]}}</span>
                @endforeach
            @else
            <span class="bg-purple-200 text-purple-600 py-1 px-3 rounded-full text-xs">read</span>
            <span class="bg-purple-200 text-purple-600 py-1 px-3 rounded-full text-xs">edit</span>
            <span class="bg-purple-200 text-purple-600 py-1 px-3 rounded-full text-xs">access</span>
        @endif
    </td>

    <td class="py-3 px-6 text-center">
        <div class="flex item-center justify-center">
            <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                <a class="elude" data-id="{{$userb?->id}}" b-id="{{$userb->branch[0]?->branch_id}}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                </svg>
                </a>
            </div>
            <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                <a class="delude" data-id="{{$userb?->id}}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
                </a>
            </div>
        </div>

    </td>
</tr>
