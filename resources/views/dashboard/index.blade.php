@extends('layouts.templates.att.master')
@push('CSS')
    <style>
        .flip-image {
            transition: transform 0.6s;
            transform-style: preserve-3d;
        }

        .flip-image.flipped {
            transform: rotateX(180deg);
        }
    </style>
@endpush

@section('Content')
    @include('dashboard.partials.first_sec_dashboard')
    <div class="">
        <hr class="h-px my-4 bg-red-600 p-[1px] border dark:bg-red-600">
    </div>
    <div class="ml-5">
        <div class="ml-5">
            <h1 class="font-koulen text-blue-600 text-2xl">សាខា & អនុសាខា</h1>
        </div>

        {{-- Card session --}}
        <div class="mt-2 bg-gray-200 rounded-md shadow-lg p-2">
            <div class="mt-0">
                <div class="leading-relaxed">
                    <!-- Initial Cards (First 5 Cards) -->
                    <div>
                        <div id="initial-cards"
                            class="grid sm:grid-cols-1 md:grid-cols-4 lg:grid-cols-5 gap-4 font-battambang p-2">
                            @foreach ($branches as $val)

                                @if ($loop->index < 10)
                                    <div
                                        class="max-w-md mx-auto rounded-md overflow-hidden shadow-md hover:shadow-lg transition-transform duration-150 ease-in-out hover:scale-110">
                                        <div class="relative bg-white p-2 border">
                                            <div class="flex justify-center items-center">
                                                <img class="w-[150px] h-[130px] sm:w-[180px] sm:h-[160px] md:w-[200px] md:h-[170px] lg:w-[200px] lg:h-[170px]  rounded-md"
                                                    src="{{ asset($val->branch_image) }}" alt="Branch Image">
                                            </div>
                                        </div>
                                        <div class="p-2 bg-[#f1f5f9] font-battambang text-center">
                                            @if (auth()->user()->hasRole('admin'))
                                                <a href="/branch/{{ $val->branch_id }}/village"
                                                    class="block opacity-100 mb-1">{{ $val->branch_kh }}</a>
                                            @else
                                                <p class="block opacity-100 mb-1">{{ $val->branch_kh  }}</p>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            @endforeach

                        </div>
                    </div>

                    <!-- Additional Cards (Hidden Initially) -->
                    <span id="more-cards" class="hidden">
                        <div class="grid sm:grid-cols-1 md:grid-cols-4 lg:grid-cols-5 gap-4 font-battambang p-2">
                            @foreach ($branches as $val)
                                @if ($loop->index > 5)
                                    <div
                                        class="max-w-md mx-auto rounded-md overflow-hidden shadow-md hover:shadow-lg transition-transform duration-150 ease-in-out hover:scale-110">
                                        <div class="relative bg-white p-2 border">
                                            <div class="flex justify-center items-center">
                                                <img class="w-[200px] h-[170px] rounded-md" src="{{ asset($val->branch_image) }}"
                                                    alt="Branch Image">
                                            </div>
                                        </div>
                                        <div class="p-2 bg-[#f1f5f9] font-battambang text-center">
                                            @if (auth()->user()->hasRole('admin'))
                                                <a href="/branch/{{ $val->branch_id  }}/village"
                                                    class="block opacity-100 mb-1">{{ $val->branch_kh  }}</a>
                                            @else
                                                <p class="block opacity-100 mb-1">{{  $val->branch_kh }}</p>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </span>
                </div>

                <!-- Toggle Buttons -->
                <div class="flex justify-center items-center">
                    <button id="toggle-btn" class="mt-4 text-blue-500 focus:outline-none flex">
                        <img width="24" height="24" src="https://img.icons8.com/ios-filled/50/down-squared--v1.png"
                            alt="Show More" />
                    </button>
                    <button id="hide-btn" class="hidden mt-4 text-blue-500 focus:outline-none">
                        <img width="24" height="24" src="https://img.icons8.com/ios-glyphs/30/hide.png" alt="Show Less" />
                    </button>
                </div>
            </div>
        </div>

        <div class="w-full p-2 mt-4">
            <h1 class="text-center text-gray-800 font-khmer text-xl">តារាងទិន្នន័យនៃសាខា ក.ក្រ.ក្រ ២៥ រាជធានី ខេត្ត</h1>
            <div class="bg-white shadow-md rounded my-6">
                <table class="min-w-max w-full table-auto font-battambang">
                    <thead>
                        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 pl-5 text-left">សាខា</th>
                            <th class="py-3 text-center">សរុប</th>
                            <th class="py-3 text-center">ស្រី</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                        @foreach ($total_mem_branches as $total_mem_branch)
                            @include('dashboard.partials.summarized_mem_branch')
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
@endsection

    @push('JS')
        <script>
            document.getElementById('toggle-btn').addEventListener('click', function () {
                document.getElementById('more-cards').classList.remove('hidden');
                document.getElementById('toggle-btn').classList.add('hidden');
                document.getElementById('hide-btn').classList.remove('hidden');
            });

            document.getElementById('hide-btn').addEventListener('click', function () {
                document.getElementById('more-cards').classList.add('hidden');
                document.getElementById('toggle-btn').classList.remove('hidden');
                document.getElementById('hide-btn').classList.add('hidden');
            });
        </script>
        <script>
            $(document).ready(function () {
                if (isWWactive) {
                    fetchLocationAndWeather();
                }
                const apiKey = "f0a13157dae9497fa3f91905242412";
                let currentlatlong;

                function getGeolocation() {
                    return new Promise((resolve, reject) => {
                        navigator.geolocation.getCurrentPosition(resolve, reject);
                    });
                }

                async function fetchLocationAndWeather() {
                    try {

                        $("div.loader-overlay").removeClass("hidden");


                        const data = await getGeolocation();


                        const latitude = data.coords.latitude;
                        const longitude = data.coords.longitude;
                        console.log(`Latitude: ${latitude}, Longitude: ${longitude}`);

                        const weatherData = await getWeatherData(latitude, longitude);


                        console.log(weatherData);

                        const temperature = weatherData.current.temp_c;
                        const location = weatherData.location.name;
                        const timestamp = weatherData.current.last_updated;
                        $("span#currentTemp").text(`${temperature}°`);
                        $("h1#currentLoc").text(`${location}`);
                        $("p#lastupdatedat").text(`${timestamp}`);
                        // $("div.weather-temp").text(`Current temperature: ${temperature}°C`);

                        $("div.loader-overlay").addClass("hidden");
                    } catch (error) {
                        console.error("Error fetching geolocation or weather:", error);

                        $("div.loader-overlay").addClass("hidden");
                    }
                }

                async function getWeatherData(latitude, longitude) {
                    const url =
                        `https://api.weatherapi.com/v1/current.json?key=${apiKey}&q=${latitude},${longitude}`;

                    const response = await fetch(url);
                    if (!response.ok) {
                        throw new Error('Weather data fetch failed');
                    }

                    const data = await response.json();
                    return data;
                }

                $("#ww-refresh").click(function (e) {
                    fetchLocationAndWeather();
                })

                let isWWactive = localStorage.getItem('isWWactive') === 'true';

                $("#weatherwidget").toggle(isWWactive);
                $("#chkbxww").prop("checked", isWWactive);

                $("#chkbxww").click(function () {
                    $("#weatherwidget").toggle(this.checked);
                    isWWactive = this.checked;
                    if (isWWactive) {
                        fetchLocationAndWeather();
                    }
                    localStorage.setItem('isWWactive', isWWactive);
                });

            })
        </script>
    @endpush