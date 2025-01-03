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
        <h1 class="font-koulen text-blue-600 text-2xl">សាខា & អនុសាខា</h1>
    </div>
    <div class="mt-2 bg-gray-200 rounded-md shadow-lg">
        <div class="flex flex-wrap justify-around
         font-siemreap">
            @foreach ($branches as $key => $val)
                @if ($key == 4)
                    <div class="flex flex-wrap justify-around">
                @endif
                @include('dashboard.partials.branch_card')
            @endforeach
        </div>
    </div>
    <div class="relative">
        <div class="flex justify-center p-2">
            <img id="toggleButton" class="flip-image w-[32px] h-[32px]" src="{{ asset('images/icons/dropdown.svg') }}" />
        </div>
    </div>
    </div>
    <div class="">
        <hr class="h-px my-4 bg-red-600 p-[1px] border dark:bg-red-600">
    </div>
    <div class="flex items-center justify-center font-sans mt-5">
        <div class="w-full ">
            <h1 class="text-center font-siemreap font-black text-2xl">តារាងទិន្នន័យនៃសាខា ក.ក្រ.ក្រ ២៥ រាជធានី ខេត្ត</h1>
            <div class="bg-white shadow-md rounded my-6">
                <table class="min-w-max w-full table-auto font-siemreap">
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
            $(document).ready(function() {
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

                $("#ww-refresh").click(function(e) {
                    fetchLocationAndWeather();
                })

                let isWWactive = localStorage.getItem('isWWactive') === 'true';

                $("#weatherwidget").toggle(isWWactive);
                $("#chkbxww").prop("checked", isWWactive);

                $("#chkbxww").click(function() {
                    $("#weatherwidget").toggle(this.checked);
                    isWWactive = this.checked;
                    if (isWWactive) {
                        fetchLocationAndWeather();
                    }
                    localStorage.setItem('isWWactive', isWWactive);
                });
                if (isWWactive) {
                    fetchLocationAndWeather();
                }
            })
        </script>
    @endpush
