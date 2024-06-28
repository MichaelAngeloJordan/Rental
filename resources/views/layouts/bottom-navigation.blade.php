<div
    class="flex justify-between w-full fixed bottom-0 z-50   h-16 font-medium bg-white border-t border-gray-200 dark:bg-gray-700 dark:border-gray-600 ">
    <a href=" {{ route('home') }}"
        class="flex items-center justify-center px-6 hover:bg-gray-50 dark:hover:bg-gray-800">
        <img src="{{ asset('assets/icon1.png') }}" alt="home"
            class="w-6 h-6 mb-1 text-gray-500 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-500">
    </a>
    <button type="button" class="flex items-center justify-center px-6 hover:bg-gray-50 dark:hover:bg-gray-800">
        <img src="{{ asset('assets/icon2.png') }}" alt="home"
            class="w-6 h-6 mb-1 text-gray-500 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-500">
    </button>
    <a href="{{ route('bookings') }}"
        class="flex items-center justify-center px-6 hover:bg-gray-50 dark:hover:bg-gray-800">
        <img src="{{ asset('assets/icon3.png') }}" alt="home"
            class="w-6 h-6 mb-1 text-gray-500 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-500">
    </a>
    <a href="{{ route('profile.edit') }}"
        class="flex items-center justify-center px-6 hover:bg-gray-50 dark:hover:bg-gray-800">
        <img src="{{ asset('assets/icon4.png') }}" alt="home"
            class="w-6 h-6 mb-1 text-gray-500 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-500">
    </a>
</div>