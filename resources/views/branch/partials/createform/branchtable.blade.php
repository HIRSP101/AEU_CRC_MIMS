<tr class="border-collapse border-y-2 border-x-2 border-black hover:bg-slate-300 hoverablebranch" data-id="{{$bhei->bhei_id}}">
    <td class="px-2 py-4 text-sm text-center border-x-2 border-black whitespace-nowrap">
        {{$bhei->bhei_id}}
    </td>
    <td class="px-2 py-4 text-sm text-center border-x-2 border-black whitespace-nowrap">
        {{$bhei->institute_kh}}
    </td>
    <td class="px-2 py-4 text-sm text-center border-x-2 border-black whitespace-nowrap">
        {{$bhei->type}}
    </td>
    <td class="px-2 py-4 text-sm text-center border-x-2 border-black whitespace-nowrap">
        {{$bhei->institute_type}}
    </td>
    <td class="px-2 py-4 text-sm text-center border-x-2 border-black whitespace-nowrap">
        {{ $bhei->village . ' ' . $bhei->commune_sangkat . ' ' . $bhei->district_khan . ' ' . $bhei->provience_city }}
    </td>    
    <td class="px-2 py-4 text-sm text-center border-x-2 border-black whitespace-nowrap">
        {{explode(' ' ,$bhei->established_at)[0]}}
    </td>
    <td class="px-2 py-4 text-sm text-center border-x-2 border-black whitespace-nowrap">
        {{explode(' ', $bhei->registered_at)[0]}}
    </td>
    <td class="px-2 py-4 text-sm text-center border-x-2 border-black whitespace-nowrap">
        <img src="{{asset("{$bhei->image}")}}" class="object-contain">
    </td>
    <td class="py-2 flex justify-center gap-1 ">
        <button class="bg-yellow-400 px-1 py-1 rounded-md">edit</button>
        <button class="bg-red-500 px-1 py-1 rounded-md">delete</button>
    </td>
</tr>
