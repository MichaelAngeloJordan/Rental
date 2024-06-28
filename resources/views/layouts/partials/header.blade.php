<div class="flex gap-6 p-6">
    <div class="flex items-center">
        <img src="{{ asset('assets/location.png') }}" alt="splash" class="pr-3">
        <div class="text-white">
            <h5 class="font-semibold">Your Location</h5>
            <p>
                {{ $mylocation->regionName ? $mylocation->cityName : ($mylocation->countryName ?? 'Unknown')}}
            </p>
        </div>
    </div>
    <div class="flex items-center justify-end ml-auto">
        @auth
        <img src="{{ auth()->user()->photo_profile_url }}" alt="{{ auth()->user()->name }}"
            class="w-12 h-12 rounded-lg">
        @else
        <a href="{{ route('login') }}" class="bg-white text-black px-4 py-2 rounded-lg font-semibold text-sm">Login</a>
        @endauth
    </div>
</div>
