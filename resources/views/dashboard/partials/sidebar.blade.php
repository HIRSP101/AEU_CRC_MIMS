<div id="sidebar" class="top-0 left-0 border shadow bg-white w-64">
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
                            alt="external-building-nature-and-ecology-2-glyph-zulfa-mahendra-3" />
                        <span class="module-content ml-2">
                            សាខា
                        </span>
                    </a>
                    <a href="{{route('institute')}}"
                        class="flex items-center font-siemreap px-4 py-2 mt-2 text-gray-800 font-semibold hover:bg-red-400 rounded">
                        <img width="23" height="23"
                            src="https://img.icons8.com/external-gradak-royyan-wijaya/24/external-building-gradak-medical-solidarity-gradak-royyan-wijaya.png"
                            alt="external-building-gradak-medical-solidarity-gradak-royyan-wijaya" />
                        <span class="module-content ml-2">
                            គ្រឹះស្ថានឧត្តមសិក្សា
                        </span>
                    </a>
                    <a href="{{route('document')}}"
                        class="group flex items-center font-siemreap px-4 py-2 mt-2 font-semibold hover:bg-red-400 rounded">
                        <img width="23" height="23" src="https://img.icons8.com/ios-filled/50/ratings.png" alt="ratings"
                            class="transition-all duration-200 filter-white group-hover:filter-red" />
                        <span class="module-content ml-2">
                            ឯកសារដ្ឋបាល
                        </span>
                    </a>


                    <a href="" id="subModule-add"
                        class="flex items-center font-siemreap px-4 py-2 mt-2 text-gray-800 font-semibold hover:bg-red-400 rounded">
                        <img width="23" height="23"
                            src="https://img.icons8.com/ios-filled/50/add-user-group-man-man--v2.png"
                            alt="add-user-group-man-man--v2" />
                        <span
                            class="module-content ml-2 flex-1 text-left rtl:text-right whitespace-nowrap">បញ្ចូលសាមាជិក</span>
                    </a>
                    <div id="dropdown-add" class="ml-5 dropdown_entry hidden">
                        <a href="{{ route('import') }}"
                            class=" module-content flex items-center font-siemreap px-4 py-2 mt-2 text-gray-800 font-semibold hover:bg-red-400 rounded">
                            <img width="22" height="22" src="https://img.icons8.com/ios-glyphs/30/add--v1.png"
                                alt="add--v1" />
                            <span> បញ្ជូលជា File</span>
                        </a>
                        <a href="{{ route('createmember') }}"
                            class="module-content flex items-center font-siemreap px-4 py-2 mt-2 text-gray-800 font-semibold hover:bg-red-400 rounded">
                            <img width="22" height="22" src="https://img.icons8.com/ios-glyphs/30/add--v1.png"
                                alt="add--v1" />
                            <span> បញ្ជូលតាម Form</span>
                        </a>
                    </div>
                    <a href="" id="subModule-create"
                        class="flex items-center font-siemreap px-4 py-2 mt-2 text-gray-800 font-semibold hover:bg-red-400 rounded">
                        <img width="23" height="23"
                            src="https://img.icons8.com/ios-filled/50/add-user-group-man-man--v2.png"
                            alt="add-user-group-man-man--v2" />
                        <span class="module-content ml-2 flex-1 text-left rtl:text-right whitespace-nowrap">បង្កើត</span>
                    </a>
                    <div id="dropdown-create" class="ml-5 dropdown_entry hidden">
                        <a href="{{ route('userroles') }}"
                            class=" module-content flex items-center font-siemreap px-4 py-2 mt-2 text-gray-800 font-semibold hover:bg-red-400 rounded">
                            <img width="22" height="22" src="https://img.icons8.com/ios-glyphs/30/add--v1.png"
                                alt="add--v1" />
                            <span>អ្នកប្រើប្រាស់</span>
                        </a>
                        <a href="{{ route('createdistrict') }}"
                            class="module-content flex items-center font-siemreap px-4 py-2 mt-2 text-gray-800 font-semibold hover:bg-red-400 rounded">
                            <img width="22" height="22" src="https://img.icons8.com/ios-glyphs/30/add--v1.png"
                                alt="add--v1" />
                            <span> ស្រុក/ក្រុង</span>
                        </a>
                        <a href="{{ route('createschool') }}"
                            class="module-content flex items-center font-siemreap px-4 py-2 mt-2 text-gray-800 font-semibold hover:bg-red-400 rounded">
                            <img width="22" height="22" src="https://img.icons8.com/ios-glyphs/30/add--v1.png"
                                alt="add--v1" />
                            <span> គ្រឹះស្ថានសិក្សា</span>
                        </a>
                    </div>
                    <a href="{{route('report')}}"
                        class="flex items-center font-siemreap px-4 py-2 mt-2 text-gray-800 font-semibold hover:bg-red-400 rounded">
                        <img width="23" height="23" src="https://img.icons8.com/ios-filled/50/ratings.png" alt="ratings" />
                        <span class="module-content ml-2">
                            របាយការណ៍
                        </span>
                    </a>

                    <a href="" id="subModule-expire"
                        class="flex items-center font-siemreap px-4 py-2 mt-2 text-gray-800 font-semibold hover:bg-red-400 rounded">
                        <img width="23" height="23"
                            src="https://img.icons8.com/ios-filled/50/add-user-group-man-man--v2.png"
                            alt="add-user-group-man-man--v2" />
                        <span class="module-content ml-2 flex-1 text-left rtl:text-right whitespace-nowrap">
                            ផុតកំណត់
                        </span>
                        <span id="total-expired-notification"
                            class="bg-red-500 text-white rounded-full px-2 hidden">0</span>
                    </a>

                    <div id="dropdown-expire" class="ml-5 dropdown_entry hidden">
                        <a href="{{ route('expire') }}"
                            class=" module-content flex items-center font-siemreap px-4 py-2 mt-2 text-gray-800 font-semibold hover:bg-red-400 rounded">
                            <img width="22" height="22" src="https://img.icons8.com/ios-glyphs/30/add--v1.png"
                                alt="add--v1" />
                            <span> វិទ្យាល័យ</span>
                            <span id="expired-member-highschool"
                                class="bg-red-500 text-white rounded-full px-2 hidden">0</span>
                        </a>
                        <a href="{{ route('institute_ex') }}"
                            class="module-content flex items-center font-siemreap px-4 py-2 mt-2 text-gray-800 font-semibold hover:bg-red-400 rounded">
                            <img width="22" height="22" src="https://img.icons8.com/ios-glyphs/30/add--v1.png"
                                alt="add--v1" />
                            <span> សាកលវិទ្យាល័យ</span>
                            <span id="expired-member-institute"
                                class="bg-red-500 text-white rounded-full px-2 hidden">0</span>
                        </a>
                    </div>
                @else
                    <a href="" id="subModule-add"
                        class="flex items-center font-siemreap px-4 py-2 mt-2 text-gray-800 font-semibold hover:bg-red-400 rounded">
                        <img width="23" height="23"
                            src="https://img.icons8.com/ios-filled/50/add-user-group-man-man--v2.png"
                            alt="add-user-group-man-man--v2" />
                        <span
                            class="module-content ml-2 flex-1 text-left rtl:text-right whitespace-nowrap">បញ្ចូលសាមាជិក</span>
                    </a>
                    <div id="dropdown-add" class="ml-5 dropdown_entry hidden">
                        <a href="{{ route('import') }}"
                            class=" module-content flex items-center font-siemreap px-4 py-2 mt-2 text-gray-800 font-semibold hover:bg-red-400 rounded">
                            <img width="22" height="22" src="https://img.icons8.com/ios-glyphs/30/add--v1.png"
                                alt="add--v1" />
                            <span> បញ្ជូលជា File</span>
                        </a>
                        <a href="{{ route('createmember') }}"
                            class="module-content flex items-center font-siemreap px-4 py-2 mt-2 text-gray-800 font-semibold hover:bg-red-400 rounded">
                            <img width="22" height="22" src="https://img.icons8.com/ios-glyphs/30/add--v1.png"
                                alt="add--v1" />
                            <span> បញ្ជូលតាម Form</span>
                        </a>
                    </div>
                    <a href="" id="subModule-create"
                        class="flex items-center font-siemreap px-4 py-2 mt-2 text-gray-800 font-semibold hover:bg-red-400 rounded">
                        <img width="23" height="23"
                            src="https://img.icons8.com/ios-filled/50/add-user-group-man-man--v2.png"
                            alt="add-user-group-man-man--v2" />
                        <span class="module-content ml-2 flex-1 text-left rtl:text-right whitespace-nowrap">បង្កើត</span>
                    </a>
                    <div id="dropdown-create" class="ml-5 dropdown_entry hidden">
                        <a href="{{ route('createdistrict') }}"
                            class="module-content flex items-center font-siemreap px-4 py-2 mt-2 text-gray-800 font-semibold hover:bg-red-400 rounded">
                            <img width="22" height="22" src="https://img.icons8.com/ios-glyphs/30/add--v1.png"
                                alt="add--v1" />
                            <span> ស្រុក/ក្រុង</span>
                        </a>
                        <a href="{{ route('createschool') }}"
                            class="module-content flex items-center font-siemreap px-4 py-2 mt-2 text-gray-800 font-semibold hover:bg-red-400 rounded">
                            <img width="22" height="22" src="https://img.icons8.com/ios-glyphs/30/add--v1.png"
                                alt="add--v1" />
                            <span> គ្រឹះស្ថានសិក្សា</span>
                        </a>
                    </div>
                    <a href="{{route('report')}}"
                        class="flex items-center font-siemreap px-4 py-2 mt-2 text-gray-800 font-semibold hover:bg-red-400 rounded">
                        <img width="23" height="23" src="https://img.icons8.com/ios-filled/50/ratings.png" alt="ratings" />
                        <span class="module-content ml-2">
                            របាយការណ៍
                        </span>
                    </a>

                    <a href="" id="subModule-expire"
                        class="flex items-center font-siemreap px-4 py-2 mt-2 text-gray-800 font-semibold hover:bg-red-400 rounded">
                        <img width="23" height="23"
                            src="https://img.icons8.com/ios-filled/50/add-user-group-man-man--v2.png"
                            alt="add-user-group-man-man--v2" />
                        <span class="module-content ml-2 flex-1 text-left rtl:text-right whitespace-nowrap">
                            ផុតកំណត់
                        </span>
                        <span id="total-expired-notification"
                            class="bg-red-500 text-white rounded-full px-2 hidden">0</span>
                    </a>

                    <div id="dropdown-expire" class="ml-5 dropdown_entry hidden">
                        <a href="{{ route('expire') }}"
                            class=" module-content flex items-center font-siemreap px-4 py-2 mt-2 text-gray-800 font-semibold hover:bg-red-400 rounded">
                            <img width="22" height="22" src="https://img.icons8.com/ios-glyphs/30/add--v1.png"
                                alt="add--v1" />
                            <span> វិទ្យាល័យ</span>
                            <span id="expired-member-highschool"
                                class="bg-red-500 text-white rounded-full px-2 hidden">0</span>
                        </a>
                    </div>
                @endif
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

            let notification = document.getElementById("total-expired-notification");
            // let notiSchool = document.getElementById("expired-member-highschool");
            // let notiInsitute = document.getElementById("expired-member-institute");

            // if (localStorage.getItem("notificationClicked") === "true") {
            //     notification.style.display = "none";
            // }
            // document.getElementById("subModule-expire").addEventListener("click", function () {
            //     notification.style.display = "none";
            //     localStorage.setItem("notificationClicked", "true");
            // })

            async function fetchExpiredCounts() {
                try {
                    let highschoolResponse = await fetch("{{ route('checkExpiredMembers') }}");
                    let instituteResponse = await fetch("{{ route('checkExpiredMemberInstitute') }}");

                    let highschoolData = await highschoolResponse.json();
                    let instituteData = await instituteResponse.json();

                    let highschoolCount = highschoolData.count || 0;
                    let instituteCount = instituteData.count || 0;
                    let totalCount = highschoolCount + instituteCount;

                    // Update counts in sidebar
                    let highschoolNotification = document.getElementById("expired-member-highschool");
                    let instituteNotification = document.getElementById("expired-member-institute");
                    let totalNotification = document.getElementById("total-expired-notification");

                    if (highschoolCount > 0) {
                        highschoolNotification.textContent = highschoolCount;
                        highschoolNotification.classList.remove("hidden");
                    } else {
                        highschoolNotification.classList.add("hidden");
                    }

                    if (instituteCount > 0) {
                        instituteNotification.textContent = instituteCount;
                        instituteNotification.classList.remove("hidden");
                    } else {
                        instituteNotification.classList.add("hidden");
                    }

                    if (totalCount > 0) {
                        totalNotification.textContent = totalCount;
                        totalNotification.classList.remove("hidden");
                    } else {
                        totalNotification.classList.add("hidden");
                    }
                } catch (error) {
                    console.error("Error fetching expired members:", error);
                }
            }
            fetchExpiredCounts();

            document.getElementById("subModule-expire").addEventListener("click", function () {
                document.getElementById("total-expired-notification").classList.add("hidden");
            });

            document.getElementById("expired-member-highschool").parentElement.addEventListener("click", function () {
                document.getElementById("expired-member-highschool").classList.add("hidden");
            });

            document.getElementById("expired-member-institute").parentElement.addEventListener("click", function () {
                document.getElementById("expired-member-institute").classList.add("hidden");
            });
        });
    </script>
@endpush