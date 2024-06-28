<div class="px-4 sm:px-6 lg:px-8">
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-base font-semibold leading-6 text-gray-900">List Location</h1>
            <p class="mt-2 text-sm text-gray-700">
                List of all locations
            </p>
        </div>
        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
            <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'add-location-modal')"> Add
                location</x-primary-button>
        </div>
    </div>
    <div class="mt-8 flow-root">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle">
                <table class="min-w-full divide-y divide-gray-300" id="dataTable">
                    <thead>
                        <tr>
                            <th scope="col"
                                class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6 lg:pl-8">
                                Name</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Address
                            </th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">City</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Province
                            </th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Zip
                            </th>
                            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6 lg:pr-8">
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @foreach($locations as $location)
                        <tr>
                            <td class="pl-4 pr-3 py-3.5 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8">
                                {{ $location->name }}
                            </td>
                            <td class="px-3 py-3.5 text-sm text-gray-500">
                                {{ $location->address }}
                            </td>
                            <td class="px-3 py-3.5 text-sm text-gray-500">
                                {{ $location->city }}
                            </td>
                            <td class="px-3 py-3.5 text-sm text-gray-500">
                                {{ $location->province }}
                            </td>
                            <td class="px-3 py-3.5 text-sm text-gray-500">
                                {{ $location->zip_code }}
                            </td>
                            <td class="pr-3 py-3.5 text-right text-sm font-medium">
                                <x-secondary-button type="button"
                                    onclick="window.location.href = '{{ route('location.edit', ['location' => $location->id]) }}'"
                                    onKeyPress="" onKeyDown="" onKeyUp="">
                                    Edit
                                </x-secondary-button>

                                <x-danger-button type="button"
                                    onclick="confirmDelete('{{ route('location.destroy', ['location' => $location->id]) }}')"
                                    onKeyPress="" onKeyDown="" onKeyUp="">
                                    Delete
                                </x-danger-button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('modals')
@include('locations.partials.add-location-modal')
@endpush
