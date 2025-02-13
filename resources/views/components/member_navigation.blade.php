<div class="flex justify-start ml-4 mt-4 mb-4 gap-3">
    <a href="{{ url('/member/' . $id)}}" id="form-detail" class="bg-green-500 text-white hover:bg-green-400 w-auto h-[40px] text-center px-2 pt-2 rounded-xl">
        <p>សាលាបត្រព័ត៌មានផ្ទាល់ខ្លួន</p>
    </a>
    <a href="{{ url('/member/request/' . $id)}}" id="request-from" class="bg-orange-400 text-white hover:bg-orange-300 w-auto h-[40px] text-center px-2 pt-2 rounded-xl">
        <p>សំណើរសុំផ្ទេរជីវភាព</p>
    </a>
    <a href="{{ url('/member/card/' . $id)}}" id="card" class="bg-blue-400 text-white hover:bg-blue-300 w-auto h-[40px] text-center px-2 pt-2 rounded-xl">
        <p>ប័ណ្ណសម្គាល់ខ្លួនយុវជន</p>
    </a>
</div>