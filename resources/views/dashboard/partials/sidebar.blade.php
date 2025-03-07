<div id="sidebar" class="top-0 left-0 border shadow bg-red-600">
    <div class="flex flex-col flex-1 overflow-y-auto">
        <nav class="flex-1 px-2 py-4">

            <a class="flex justify-center items-center" href="{{ route('dashboard') }}">
                <img class="logo w-20" src="{{ asset('images/Logo_of_Cambodian_Red_Cross.svg') }}">
            </a>
            <div class="mt-10">
                @if(auth()->user()->hasRole('admin'))
                    <a href="{{route('branch')}}"
                        class="flex items-center font-siemreap px-4 py-2 text-gray-800 font-semibold hover:bg-red-400 rounded">
                        <img width="23" height="23"
                            src="https://img.icons8.com/external-glyph-zulfa-mahendra/48/external-building-nature-and-ecology-2-glyph-zulfa-mahendra-3.png"
                            alt="external-building-nature-and-ecology-2-glyph-zulfa-mahendra-3"
                            class="invert brightness-200" />
                        <span class="module-content ml-2 text-white">
                            សាខា
                        </span>
                    </a>
                    <a href="{{route('institute')}}"
                        class="flex items-center font-siemreap px-4 py-2 mt-2 text-gray-800 font-semibold hover:bg-red-400 rounded">
                        <img width="23" height="23"
                            src="https://img.icons8.com/external-gradak-royyan-wijaya/24/external-building-gradak-medical-solidarity-gradak-royyan-wijaya.png"
                            alt="external-building-gradak-medical-solidarity-gradak-royyan-wijaya"
                            class="invert brightness-200" />
                        <span class="module-content ml-2 text-white">
                            គ្រឹះស្ថានឧត្តមសិក្សា
                        </span>
                    </a>
                    <a href="{{route('document')}}"
                        class="group flex items-center font-siemreap px-4 py-2 mt-2 font-semibold hover:bg-white hover:text-red-600 rounded">
                        <img width="23" height="23" src="https://img.icons8.com/ios-filled/50/ratings.png" alt="ratings"
                            class="transition-all duration-200 filter-white group-hover:filter-red" />
                        <span class="module-content ml-2 text-white group-hover:text-red-600">
                            ឯកសារដ្ឋបាល
                        </span>
                    </a>
                    <style>
                        .filter-white {
                            filter: invert(100%) brightness(200%);
                        }

                        .group:hover .filter-white {
                            filter: invert(18%) sepia(98%) saturate(7481%) hue-rotate(358deg) brightness(96%) contrast(117%);
                        }
                    </style>
                @endif
                <a href="" id="subModule-add"
                    class="flex items-center font-siemreap px-4 py-2 mt-2 text-gray-800 font-semibold hover:bg-red-400 rounded">
                    <img width="23" height="23"
                        src="https://img.icons8.com/ios-filled/50/add-user-group-man-man--v2.png"
                        alt="add-user-group-man-man--v2" class="invert brightness-200" />
                    <span
                        class="module-content ml-2 flex-1 text-left rtl:text-right whitespace-nowrap text-white">បញ្ចូលសាមាជិក</span>
                </a>
                <div id="dropdown-add" class="ml-5 dropdown_entry hidden">
                    <a href="{{ route('import') }}"
                        class=" module-content flex items-center font-siemreap px-4 py-2 mt-2 text-gray-800 font-semibold hover:bg-red-400 rounded">
                        <img width="22" height="22" src="https://img.icons8.com/ios-glyphs/30/add--v1.png" alt="add--v1"
                            class="invert brightness-200" />
                        <span class="text-white"> បញ្ជូលជា File</span>
                    </a>
                    <a href="{{ route('createmember') }}"
                        class="module-content flex items-center font-siemreap px-4 py-2 mt-2 text-gray-800 font-semibold hover:bg-red-400 rounded">
                        <img width="22" height="22" src="https://img.icons8.com/ios-glyphs/30/add--v1.png" alt="add--v1"
                            class="invert brightness-200" />
                        <span class="text-white"> បញ្ជូលតាម Form</span>
                    </a>
                </div>
                <a href="" id="subModule-create"
                    class="flex items-center font-siemreap px-4 py-2 mt-2 text-gray-800 font-semibold hover:bg-red-400 rounded">
                    <img width="23" height="23"
                        src="https://img.icons8.com/ios-filled/50/add-user-group-man-man--v2.png"
                        alt="add-user-group-man-man--v2" class="invert brightness-200" />
                    <span
                        class="module-content ml-2 flex-1 text-left rtl:text-right whitespace-nowrap text-white">បង្កើត</span>
                </a>
                <div id="dropdown-create" class="ml-5 dropdown_entry hidden">
                    <a href="{{ route('userroles') }}"
                        class=" module-content flex items-center font-siemreap px-4 py-2 mt-2 text-gray-800 font-semibold hover:bg-red-400 rounded">
                        <img width="22" height="22" src="https://img.icons8.com/ios-glyphs/30/add--v1.png" alt="add--v1"
                            class="invert brightness-200" />
                        <span class="text-white">អ្នកប្រើប្រាស់</span>
                    </a>
                    <a href="{{ route('createdistrict') }}"
                        class="module-content flex items-center font-siemreap px-4 py-2 mt-2 text-gray-800 font-semibold hover:bg-red-400 rounded">
                        <img width="22" height="22" src="https://img.icons8.com/ios-glyphs/30/add--v1.png" alt="add--v1"
                            class="invert brightness-200" />
                        <span class="text-white"> ស្រុក/ក្រុង</span>
                    </a>
                    <a href="{{ route('createschool') }}"
                        class="module-content flex items-center font-siemreap px-4 py-2 mt-2 text-gray-800 font-semibold hover:bg-red-400 rounded">
                        <img width="22" height="22" src="https://img.icons8.com/ios-glyphs/30/add--v1.png" alt="add--v1"
                            class="invert brightness-200" />
                        <span class="text-white"> គ្រឹះស្ថានសិក្សា</span>
                    </a>
                </div>
                <a href="{{route('report')}}"
                    class="flex items-center font-siemreap px-4 py-2 mt-2 text-gray-800 font-semibold hover:bg-red-400 rounded">
                    <img width="23" height="23" src="https://img.icons8.com/ios-filled/50/ratings.png" alt="ratings"
                        class="invert brightness-200" />
                    <span class="module-content ml-2 text-white">
                        របាយការណ៍
                    </span>
                </a>
                <a href="" id="subModule-expire"
                    class="flex items-center font-siemreap px-4 py-2 mt-2 text-gray-800 font-semibold hover:bg-red-400 rounded">
                    <img width="23" height="23"
                        src="https://img.icons8.com/ios-filled/50/add-user-group-man-man--v2.png"
                        alt="add-user-group-man-man--v2" class="invert brightness-200" />
                    <span
                        class="module-content ml-2 flex-1 text-left rtl:text-right whitespace-nowrap text-white">ផុតកំណត់</span>

                    <span id="expired-member-notification" class="bg-red-500 text-white rounded-full px-2 hidden">
                        0
                    </span>
                </a>
                <div id="dropdown-expire" class="ml-5 dropdown_entry hidden">
                    <a href="{{ route('expire') }}"
                        class=" module-content flex items-center font-siemreap px-4 py-2 mt-2 text-gray-800 font-semibold hover:bg-red-400 rounded">
                        <img width="22" height="22" src="https://img.icons8.com/ios-glyphs/30/add--v1.png" alt="add--v1"
                            class="invert brightness-200" />
                        <span class="text-white"> អនុវិទ្យាល័យ/វិទ្យាល័យ</span>
                    </a>
                    <a href="{{ route('institute_ex') }}"
                        class="module-content flex items-center font-siemreap px-4 py-2 mt-2 text-gray-800 font-semibold hover:bg-red-400 rounded">
                        <img width="22" height="22" src="https://img.icons8.com/ios-glyphs/30/add--v1.png" alt="add--v1"
                            class="invert brightness-200" />
                        <span class="text-white"> សាកលវិទ្យាល័យ</span>
                    </a>
                </div>
            </div>
        </nav>
    </div>
</div>
@push("JS")
    <script>
        $("#subModule-add").click((e) => {
            e.preventDefault();
            $("#dropdown-add").toggleClass('hidden', 500);
        });

        $("#subModule-create").click((e) => {
            e.preventDefault();
            $("#dropdown-create").toggleClass('hidden', 500);
        });

        $("#subModule-expire").click((e) => {
            e.preventDefault();
            $("#dropdown-expire").toggleClass('hidden', 500);
        })
        document.addEventListener("DOMContentLoaded", function () {
            fetch("{{ route('checkExpiredMembers') }}")
                .then(response => response.json())
                .then(data => {
                    if (data.expired_count > 0) {
                        let notification = document.getElementById("expired-member-notification");
                        notification.innerText = data.expired_count;
                        notification.classList.remove("hidden");
                    }
                })
                .catch(error => console.error("Error fetching expired members count:", error));
        });
    </script>

@endpush