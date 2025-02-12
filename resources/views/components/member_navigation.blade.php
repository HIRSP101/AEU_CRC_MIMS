<div class="flex justify-start ml-4 mt-4 mb-4 gap-3">
    <a href="{{ url('/member/' . $id)}}" id="form-detail" class="bg-green-500 text-white hover:bg-green-400 w-auto h-[40px] text-center px-2 pt-2 rounded-xl">
        <p>សាលាបត្រព័ត៌មានផ្ទាល់ខ្លួន</p>
    </a>
    <a href="{{ url('/member/' . $id . '/request/')}}" id="request-from" class="bg-orange-400 text-white hover:bg-orange-300 w-auto h-[40px] text-center px-2 pt-2 rounded-xl">
        <p>វិញ្ញាបនបត្ររដ្ឋបាល</p>
    </a>
    <a href="{{ url('/member/' . $id. '/card/')}}" id="card" class="bg-blue-400 text-white hover:bg-blue-300 w-auto h-[40px] text-center px-2 pt-2 rounded-xl">
        <p>ប័ណ្ណសម្គាល់ខ្លួនយុវជន</p>
    </a>
</div>