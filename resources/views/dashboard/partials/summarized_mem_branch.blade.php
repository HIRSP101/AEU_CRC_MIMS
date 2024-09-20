<tr class="border-b border-gray-200 hover:bg-gray-100">
    <td class="py-3 px-6 text-left whitespace-nowrap">
        <div class="flex flex-row">
            <div class="mr-2">
                <img class="w-6 h-6 rounded-full" src="{{asset("images/branches/b-$total_mem_branch->branch_id.jpg")}}"/>
            </div>
            <div class="ml-2">
                <p> {{$total_mem_branch->branch_kh}} </p>
            </div>
        </div>
    </td>
    <td class="py-3 px-6 text-center">
        <p>{{ $total_mem_branch->total_mem }}</p>
    </td>
    <td class="py-3 px-6 text-center">
        <p>{{ $total_mem_branch->total_wm }}</p>
    </td>

</tr>
