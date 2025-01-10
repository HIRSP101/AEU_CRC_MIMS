<li class="border-b bg-slate-50 rounded-lg hover:bg-indigo-50 p-2 hover:ring-indigo-200 hover:rounded-lg my-2">
    <a href="/institute/{{$mem_br->institute_id}}">
      <div class="flex justify-between items-center">
        <div class="flex items-center">
          <img
          src="{{ asset($mem_br->image) }}"
          alt="Logo 1"
          class="ml-10 w-16 mr-8 rounded-full object-cover h-16"
          />
          <span class="text-lg siemreap-regular">{{$mem_br->name}}</span>

        </div>
        <div class="grid grid-rows-2 m-2 place-items-end content-between gap-8">

          <span class="text-xs siemreap-regular">ស.ម​ <strong>{{$mem_br->total_mem}} នាក់</strong></span>
          {{-- <span class="text-xs siemreap-regular"> {{$mem_br->total_institutes}} សាខា</span> --}}

        </div>
      </div>
    </a>
</li>
