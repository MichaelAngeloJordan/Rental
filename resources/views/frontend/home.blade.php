<x-frontend-layout>
    <div style="background-color: #000000">
        @include('layouts.partials.header')

        <div class="p-6">
            <div class="flex items center justify-between py-6">
                <h1 class="font-semibold py-6" style="color: #FF9901; font-size:32px">Find Your Favorite Car.</h1>
            </div>

            <div class="mt-6 pt-3">
                <form action="" method="GET" class="z-50">
                    <div class="relative mt-2 rounded-md shadow-sm ">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                            <img src="{{ asset('assets/shape.png') }}" alt="search" class="w-5 h-5">
                        </div>
                        <input type="search" name="search" id="search" style="height: 56px; border-radius: 30px;"
                            class="block w-full border-0 py-1.5 pl-10 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 text-center"
                            placeholder="Search Vehicle...">
                    </div>
                </form>

            </div>

        </div>

        <div class="bg-white pb-6 py-6" style="border-radius: 20px; margin-top: -55px">
            <div class="flex items-center justify-between px-6" style="padding-top: 2.5rem;">
                <h1 class="font-semibold">Popular Cars</h1>
            </div>

            <div class="swiper swiper-brand flex gap-3 px-6 pt-3">
                <div class="swiper-wrapper">
                    @foreach ($brands as $brand)
                    <div class="swiper-slide rounded-lg bg-white">
                        <img src="{{ $brand->logo_url }}" alt="{{ $brand->name }}"
                            class="w-full h-59 rounded-t-lg object-cover">
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="flex items-center justify-between px-6" style="padding-top: 2.5rem;">
                <h1 class="font-semibold">Near You</h1>
            </div>

            <div class="swiper swiper-container flex gap-3 pt-4">
                <div class="swiper-wrapper">
                    @foreach ($cars as $car)
                    <a href="{{ route('detail', $car->id) }}" class="swiper-slide rounded-lg bg-white shadow-md mx-2">
                        <img src="{{ $car->image_url }}" alt="car" class="w-full h-59 rounded-t-lg object-cover">
                        <div class="p-4">
                            <h1 class="font-semibold">
                                {{ $car->name }}
                            </h1>
                            <div class="flex items center justify-between">
                                <div class="flex items center">
                                    <img src="{{ asset('assets/star.png') }}" alt="star" class="mx-auto mt-1"
                                        style="height: 13px; width:13px">
                                    <p class="text-gray-500" style="font-size: 14px">4.8
                                        <small class="text-gray-400" style="font-size: 12px">(150+ Review)</small>
                                    </p>
                                </div>
                            </div>

                            <div class="flex items center justify-between">
                                <div class="flex items center">
                                    <p class="text-gray-500" style="font-size: 14px">
                                        <span class="font-semibold text-black">Rp.
                                            {{ number_format($car->price, 0, ',', '.') }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    @push('styles')
    <style>
        html,
        body {
            position: relative;
            height: 100%;
        }

        .swiper {
            width: 100%;
            height: 100%;
        }

        .swiper-slide {
            width: 70%;
            padding-left: 5%
        }
    </style>
    @endpush

    @push('scripts')
    <script>
        const swiper = new Swiper('.swiper-container', {
            slidesPerView: "auto",
            spaceBetween: 30,
            loop: true,
            autoplay: {
                delay: 5000,
            },

        });

        const swiperBrand = new Swiper('.swiper-brand', {
            slidesPerView: 4,
            spaceBetween: 30,
            loop: true,
            autoplay: {
                delay: 5000,
            },

        });
    </script>
    @endpush
</x-frontend-layout>
