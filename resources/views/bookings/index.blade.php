<x-app-layout>
    <div class="relative isolate overflow-hidden pt-20">
        <div class="mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                @include('bookings.partials.table-bookings')
            </div>
        </div>
    </div>
</x-app-layout>