<x-frontend-layout>
    <div class="bg-black">
        <div class="min-h-screen flex items-center justify-center">
            <div class="text-center">
                <h1 style="color: #FF9901; font-size:42px;" class="font-bold">Rent The Car Of Your Dream</h1>
                <p class="font-bold mt-4 text-white" style="font-size: 14px">Enjoy premium luxury experience</p>
                <div class="pt-20">
                    <img src="{{ asset('assets/bg.png') }}" alt="splash" class="mx-auto">
                </div>


                <div class="mt-6" style="margin-left: 10%; margin-right:10%; margin-top:30%">
                    <a href="{{ route('home') }}"
                        class="block w-full font-bold py-2 px-4 rounded-full hover:bg-gray-200 text-white"
                        style="background-color:#1C1C1C; font-size: 24px;">
                        Let’s Go
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-frontend-layout>