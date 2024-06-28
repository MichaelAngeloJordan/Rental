<x-frontend-layout>
    <div class="w-full h-96 ">
        <div id="map" class="w-full h-full"></div>
    </div>
    <div class="mt-6 pt-3 block w-full border-0 py-1.5 z-50 h-10 bg-black  ">
        <div class="z-50" style="margin-top: -65px;">
            <div class="relative mt-2 rounded-md shadow-sm bg-black">
                <div style="background-color: #000000; border-radius: 25px;"
                    class="flex px-6 gap-2 justify-between  w-full border-0 py-1.5  text-white">
                    <div>
                        <h1 class="font-semibold text-2xl">{{ $car->name }}</h1>
                        <span class="text-gray-500" style="font-size: 14px;">
                            {{ $car->capacity }} People
                        </span>
                    </div>
                    <div class="flex items-end mt-2">
                        <div class="flex items-center">
                            <img src="{{ asset('assets/star.png') }}" alt="star" class="mx-auto mt-1"
                                style="height: 13px; width: 13px; margin-right: 5px;">
                            <p class="text-white" style="font-size: 14px;">4.8
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-6 pt-6 block w-full border-0 py-1.5 h-10 bg-white min-h-screen ">
        <div class="z-50" style="margin-top: -65px;">
            <div class="mt-2 rounded-md shadow-sm ">
                <div>
                    <h1 class="font-semibold text-lg p-2">Overview</h1>
                </div>
                <form method="POST" action="{{ route('booking', $car->id) }}" id="booking-form" class="p-3">
                    @csrf
                    <input type="hidden" name="total_price" value="{{ $car->price }}">
                    <div class="grid mt-4 grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="border rounded-lg p-4">
                            <p class="text-gray-400 text-sm mb-2">Start</p>
                            <input type="datetime-local"
                                class="w-full text-gray-500 py-2 px-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                name="pickup_time" value="{{ date('Y-m-d\TH:i') }}">
                        </div>
                        <div class="border rounded-lg p-4">
                            <p class="text-gray-400 text-sm mb-2">End</p>
                            <input type="datetime-local"
                                class="w-full text-gray-500 py-2 px-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                name="return_time" value="{{ date('Y-m-d\TH:i') }}">
                        </div>
                    </div>

                    <div class=" mt-4">
                        <div class="border p-3 rounded-lg">
                            <p class="text-gray-400 text-sm p-2">Pickup Location</p>
                            <div class="relative mt-2 rounded-md shadow-sm ">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                                    <img src="{{ asset('assets/loc.png') }}" alt="search" class="w-5 h-5">
                                </div>
                                <select name="pickup_location" id="location"
                                    class="block w-full border-0 pl-10 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 py-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm text-center rounded-md">
                                    @forelse ($locations as $location)
                                    <option value="{{ $location->location->id }}"
                                        data-long="{{ $location->location->longitude }}"
                                        data-lat="{{ $location->location->latitude }}">{{
                                        $location->location->name }}
                                    </option>
                                    @empty
                                    <option value="" disabled selected>No location available</option>
                                    @endforelse
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
                <div class=" mt-4 p-3">
                    <div class="border p-3 rounded-lg">
                        <p class="text-gray-400 text-sm p-2">Credit Card</p>
                        <div class="relative mt-2 rounded-md shadow-sm ">
                            <img src="{{ asset('assets/cc.png') }}" alt="search" class="w-full">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('modals')
    <div class="flex justify-center">
        <div class="fixed z-50 bottom-0 py-6 w-10/12">
            <button type="submit" x-data x-on:click="document.getElementById('booking-form').submit()"
                class="max-w-lg mx-auto  justify-between h-16 font-medium border-t border-gray-200 flex gap-2 items-center  px-6  dark:hover:bg-gray-800"
                style="background-color: black; border-radius:20px">
                <span style="color: #FF9901">Pay Now</span>
                <span class="px-3">|</span>
                <span class="text-white text-center">
                    Rp {{ number_format($car->price, 0, ',', '.') }} <span class="text-slate-300">/day</span></span>
            </button>
        </div>
    </div>
    @endpush

    @push('scripts')
    <script>
        let map, markers = [];
        function initMap() {
            const location = document.getElementById('location');
            var locationSelected = {
                lat: parseFloat(location.options[location.selectedIndex].getAttribute('data-lat') ?? '{{ $mylocation->latitude }}') ,
                lng: parseFloat(location.options[location.selectedIndex].getAttribute('data-long') ?? '{{ $mylocation->longitude }}')
            };
            map = L.map('map', {
                center: locationSelected,
                zoom: 13
            });

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
            initMarkers();
            map.on('click', mapClicked);
        }
        initMap();

        function initMarkers() {
            const location = document.getElementById('location');
            markers = Array.from(location.options).map((option, index) => {
                return generateMarker({
                    position: [parseFloat(option.getAttribute('data-lat')), parseFloat(option.getAttribute('data-long'))],
                    draggable: true
                }, index);
            });
            markers.forEach(marker => marker.addTo(map));
        }

        function generateMarker(data, index) {
            return L.marker(data.position, {
                    draggable: data.draggable
                })
                .on('click', (event) => markerClicked(event, index))
                .on('dragend', (event) => markerDragEnd(event, index));
        }

        function mapClicked($event) {
            console.log(map);
            console.log($event.latlng.lat, $event.latlng.lng);
        }

        function markerClicked($event, index) {
            console.log(map);
            console.log($event.latlng.lat, $event.latlng.lng);
        }

        function markerDragEnd($event, index) {
            console.log(map);
            console.log($event.target.getLatLng());
        }

        document.getElementById('location').addEventListener('change', function () {
            markers.forEach(marker => marker.remove());
            initMarkers();

            const location = document.getElementById('location');
            var locationSelected = {
                lat: parseFloat(location.options[location.selectedIndex].getAttribute('data-lat')),
                lng: parseFloat(location.options[location.selectedIndex].getAttribute('data-long'))
            };
            map.setView(locationSelected, 13);

        });
    </script>
    @endpush
</x-frontend-layout>