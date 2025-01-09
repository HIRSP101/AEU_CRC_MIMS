<tr class="border-collapse border-y-2 border-x-2 border-black hover:bg-slate-300 hoverablebranch"
    data-id="{{$mem->member_id}}">
    <td class="px-2 py-4 text-sm text-center border-x-2 border-black whitespace-nowrap">
        {{$mem->member_id}}
    </td>
    <td class="px-2 py-4 text-sm text-center border-x-2 border-black whitespace-nowrap">
        {{$mem->name_kh}}
    </td>
    <td class="px-2 py-4 text-sm text-center border-x-2 border-black whitespace-nowrap">
        {{$mem->gender}}
    </td>
    <td class="px-2 py-4 text-sm text-center border-x-2 border-black whitespace-nowrap">
        {{$mem->date_of_birth}}
    </td>
    <td class="px-2 py-4 text-sm text-center border-x-2 border-black whitespace-nowrap">
        {{$mem->institute_id}}
    </td>
    <td class="px-2 py-4 text-sm text-center border-x-2 border-black whitespace-nowrap">
        {{$mem->member_type}}
    </td>
    <td class="px-2 py-4 text-sm text-center border-x-2 border-black whitespace-nowrap">
        {{$mem->education_level}}
    </td>
    <td class="px-2 py-4 text-sm text-center border-x-2 border-black whitespace-nowrap">
        {{$mem->acadmedic_year}}
    </td>
    <td class="px-2 py-4 text-sm text-center border-x-2 border-black whitespace-nowrap">
        {{$mem->full_current_address}}
    </td>
    <td class="px-2 py-4 text-sm text-center border-x-2 border-black whitespace-nowrap">
        {{$mem->phone_number}}
    </td>
    <td class="py-2 flex justify-center gap-1 ">
        <button class="bg-yellow-400 px-1 py-1 rounded-md">edit</button>
        <button class="bg-red-500 px-1 py-1 rounded-md">delete</button>
    </td>
</tr>