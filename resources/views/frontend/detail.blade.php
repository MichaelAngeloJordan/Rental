<x-frontend-layout>
    <div style="background-color: #000000">
        <div class="flex gap-6 p-6">
            <div class="flex items-center">
                <a href="javascript:;" onclick="window.history.back()" class="px-4 py-2 text-white">
                    Kembali
                </a>
            </div>
        </div>
        <div class="pt-3 min-h-screen">
            <div class="flex justify-center items-center p-6">
                <img src="{{ asset('assets/pemisah.png') }}" alt="divider" class="z-0">
            </div>

            <div class="bg-white min-h-screen overflow-hidden pb-6 pt-6"
                style="margin-top: -55px; border-radius:25px 25px 0 0">
                <div class="flex items-center justify-between px-6 py-3">
                    <img src="{{ $car->image_url }}" alt="{{ $car->name }}" class="w-full p-4">
                </div>

                <div class="flex px-6 gap-2 justify-between">
                    <div>
                        <h1 class="font-semibold text-2xl">{{ $car->name }}</h1>
                        <div class="flex justify-between">
                            <div class="flex items-center">
                                <img src="{{ asset('assets/star.png') }}" alt="star" class="mx-auto mt-1"
                                    style="height: 13px; width: 13px; margin-right: 5px;">
                                <p class="text-gray-500" style="font-size: 14px;">4.8
                                    <small class="text-gray-400" style="font-size: 12px;">(150+ Review)</small>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-end mt-2">
                        <img src="{{ asset('assets/heart.png') }}" alt="heart" class="mx-auto"
                            style="height: 28.83px; width: 30.27px; margin-right: 5px;">
                    </div>
                </div>

                <div class="flex justify-center items-center p-6">
                    <img src="{{ asset('assets/line.png') }}" alt="divider" class="w-full">
                </div>

                @auth
                <div class="flex px-6 gap-2 justify-between">
                    <div class="flex items-center">
                        <img src="{{ auth()->user()->photo_profile_url }}" alt="{{ auth()->user()->name }}"
                            class="w-12 h-12 rounded-lg">
                        <div class="text-black pl-3">
                            <h5 class="font-semibold">Kimberly</h5>
                            <p>Renter</p>
                        </div>
                    </div>
                    <div class="flex items-center justify-end ml-auto">
                        <a href="#" class="px-4 py-2 rounded-lg mr-2 border border-gray-300">
                            <img src="{{ asset('assets/phone.png') }}" alt="call" class="mx-auto">
                        </a>
                        <button class="px-4 py-2 rounded-lg border border-gray-300">
                            <img src="{{ asset('assets/chat.png') }}" alt="chat" class="mx-auto">
                        </button>
                    </div>
                </div>
                <div class="flex justify-center items-center p-6">
                    <img src="{{ asset('assets/line.png') }}" alt="divider" class="w-full">
                </div>
                @endauth

                <div class="min-h-screen">

                    <div class="flex px-6 gap-2 justify-between">
                        <div>
                            <h1 class="font-semibold text-xl">Car Info</h1>
                        </div>
                    </div>
                    <div class="px-6 grid grid-cols-2 gap-6 justify-between">
                        <div class="flex pt-4 items-start">
                            <svg width="33" height="35" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" data-id="IcTransportSeatClass">
                                <path
                                    d="M6.99997 21H17M4.10496 3H4.76788C6.0927 3 7.26067 3.869 7.64136 5.13796L9.78617 12.2873C9.91307 12.7103 10.3024 13 10.744 13H16.4059C18.0152 13 19.7434 13.8444 20.5714 15.2244C21.3043 16.4459 20.4244 18 18.9999 18H7.21493C5.67368 18 4.38318 16.8321 4.22982 15.2985L3.10992 4.0995C3.05105 3.51082 3.51333 3 4.10496 3Z"
                                    stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                </path>
                                <path d="M13 10H17" stroke="#000000" stroke-width="4" stroke-linecap="round"
                                    stroke-linejoin="round">
                                </path>
                            </svg>
                            <p class="font-bold py-3 pl-4" style="font-size: 16px;">
                                {{ $car->capacity }} Chairs
                            </p>
                        </div>
                        <div class="flex items-center justify-end ml-auto pt-4">
                            <svg width="33" height="35" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" data-id="IcBagBaggage">
                                <path
                                    d="M8 7.2C8 6.07989 8 5.51984 8.21799 5.09202C8.40973 4.71569 8.71569 4.40973 9.09202 4.21799C9.51984 4 10.0799 4 11.2 4H12.8C13.9201 4 14.4802 4 14.908 4.21799C15.2843 4.40973 15.5903 4.71569 15.782 5.09202C16 5.51984 16 6.07989 16 7.2V8H8V7.2Z"
                                    stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                </path>
                                <path
                                    d="M6 8.00005V20M18 8.00005V20M2 10V18C2 19.1046 2.89543 20 4 20H20C21.1046 20 22 19.1046 22 18V10C22 8.89547 21.1046 8.00004 20 8.00004L4 8C2.89543 8 2 8.89543 2 10Z"
                                    stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                </path>
                            </svg>
                            <h3 class="font-bold py-2 pl-4" style="font-size: 16px;">
                                {{ $car->baggage }} Baggage
                            </h3>
                        </div>
                        <div class="flex pt-4 items-start">
                            <svg width="33" height="35" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" data-id="IcTripCar">
                                <path
                                    d="M6 15H8M16 15H18M21 11H19M19 11L18.3471 6.10351C18.1484 4.61309 16.8771 3.5 15.3735 3.5H8.62655C7.12294 3.5 5.85159 4.61309 5.65287 6.10351L5 11M19 11H5M3 11H5M17 18H20V19.5C20 20.3284 19.3284 21 18.5 21C17.6716 21 17 20.3284 17 19.5V18ZM4 18H7V19.5C7 20.3284 6.32843 21 5.5 21C4.67157 21 4 20.3284 4 19.5V18ZM5 18H19C20.1046 18 21 17.1046 21 16V14C21 12.3431 19.6569 11 18 11H6C4.34315 11 3 12.3431 3 14V16C3 17.1046 3.89543 18 5 18Z"
                                    stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                </path>
                            </svg>
                            <p class="font-bold py-3 pl-4" style="font-size: 16px;">
                                {{ $car->year }} or later
                            </p>
                        </div>
                        <div class="flex items-center ml-auto pt-4">
                            <svg width="33" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M6 0C2.6865 0 0 2.6865 0 6C0 9.3135 2.6865 12 6 12C9.3135 12 12 9.3135 12 6C12 2.6865 9.3135 0 6 0ZM6 1.5C7.9643 1.5 9.6234 2.75775 10.25 4.5H1.75C2.3766 2.75775 4.0357 1.5 6 1.5ZM5.25 6.25C5.25 6.66437 5.58563 7 6 7C6.41437 7 6.75 6.66437 6.75 6.25C6.75 5.83563 6.41437 5.5 6 5.5C5.58563 5.5 5.25 5.83563 5.25 6.25ZM1.5 6C3.55266 6 5.21507 8.00873 5.25 10.5C3.1256 10.1304 1.5 8.26049 1.5 6ZM6.75601 10.5C6.79094 8.00873 8.45335 6 10.506 6C10.506 8.26049 8.88041 10.1304 6.75601 10.5Z"
                                    fill="#000000"></path>
                            </svg>
                            <p class="font-bold py-3 pl-4" style="font-size: 16px;">
                                {{ $car->transmission }}
                            </p>
                        </div>
                    </div>

                    <div class="flex px-6 py-4">
                        <h1 class="font-semibold text-xl">Features</h1>
                    </div>

                    <div class="px-6 grid grid-cols-2 gap-2 justify-between">
                        @php
                        $features = explode(',', $car->features);
                        @endphp
                        @foreach ($features as $feature)
                        <button class="py-2 rounded-lg border border-gray-300">
                            {{ $feature }}
                        </button>
                        @endforeach
                    </div>

                    <div class="flex px-6 gap-2 justify-between py-4">
                        <div>
                            <h1 class="font-semibold text-xl">Policy</h1>
                        </div>
                    </div>

                    <div class="px-6 grid grid-cols-2 gap-2 justify-between">
                        {!! $car->policy !!}
                    </div>

                    <div class="flex px-6 gap-2 justify-between py-4">
                        <div>
                            <h1 class="font-semibold text-xl">Description</h1>
                        </div>
                    </div>

                    <div class="px-6 grid grid-cols-2 gap-2 justify-between">
                        {!! $car->description !!}
                    </div>
                </div>
            </div>
        </div>

        @push('modals')
        <div class="flex justify-center">
            <div class="fixed z-50 bottom-0 py-6 w-10/12">
                <a href="{{ route('checkout', $car->id) }}"
                    class="max-w-lg mx-auto justify-between h-16 font-medium border-t border-gray-200 flex gap-2 items-center px-6  dark:hover:bg-gray-800"
                    style="background-color: black; border-radius:20px">
                    <span style="color: #FF9901">Book Now</span>
                    <span class="px-3">|</span>
                    <span class="text-white text-center">
                        Rp {{ number_format($car->price, 0, ',', '.') }} <span class="text-slate-300">/day</span></span>
                </a>
            </div>
        </div>
        @endpush
    </div>
</x-frontend-layout>