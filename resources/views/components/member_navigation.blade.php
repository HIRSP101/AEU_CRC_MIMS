<div class="flex justify-start ml-4 mt-4 mb-4 gap-3">
    <a href="{{ url('/member/' . $id)}}" id="form-detail" class="bg-green-500 text-white text-[17px] font-battambang hover:bg-green-400 focus:ring-4 focus:outline-none rounded-xl px-4 py-2.5 text-center inline-flex items-center justify-between mr-2 mb-2">
        <p>សាលាបត្រព័ត៌មានផ្ទាល់ខ្លួន</p>
    </a>
    <a href="{{ url('/member/request/' . $id)}}" id="request-from" class="bg-orange-400 text-[17px] font-battambang text-white hover:bg-orange-300 focus:ring-4 focus:outline-none rounded-xl px-4 py-2.5 text-center inline-flex items-center justify-between mr-2 mb-2 ">
        <p>សំណើរសុំផ្ទេរជីវភាព</p>
    </a>
    <a href="{{ url('/member/card/' . $id)}}" id="card" class="text-white text-[17px] bg-[#4285F4] hover:bg-[#4285F4]/90 focus:ring-4 font-battambang focus:outline-none rounded-xl px-4 py-2.5 text-center inline-flex items-center justify-between mr-2 mb-2">
        <p>ប័ណ្ណសម្គាល់ខ្លួនយុវជន</p>
    </a>
</div>