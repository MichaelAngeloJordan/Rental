<div class="px-4 sm:px-6 lg:px-8">
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-base font-semibold leading-6 text-gray-900">List Cars</h1>
            <p class="mt-2 text-sm text-gray-700">
                List of all cars
            </p>
        </div>
        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
            <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'add-car-modal')"> Add
                Cars</x-primary-button>
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
                                {{ __('Car') }}
                            </th>
                            <th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">
                                {{ __('Brand') }}
                            </th>
                            <th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">
                                {{ __('Model') }}
                            </th>
                            <th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">
                                {{ __('Year') }}
                            </th>
                            <th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">
                                {{ __('Color') }}
                            </th>
                            <th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">
                                {{ __('Passenger/Baggages') }}
                            </th>
                            <th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">
                                {{ __('Available') }}
                            </th>
                            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6 lg:pr-8">
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @foreach($cars as $car)
                        <tr>
                            <td class="pl-4 pr-3 py-3.5 text-left text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 w-10 h-10">
                                        <img class="w-10 h-10 rounded-full" src="{{ $car->image_url }}"
                                            alt="{{ $car->name }}">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $car->name }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="pr-3 py-3.5 text-left text-sm font-medium text-gray-900">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 w-10 h-10">
                                        <img class="w-10 h-10 rounded-full" src="{{ $car->brand->logo_url }}"
                                            alt="{{ $car->brand->name }}">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $car->brand->name }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="pr-3 py-3.5 text-left text-sm font-medium text-gray-900">
                                {{ $car->type }}
                            </td>
                            <td class="pr-3 py-3.5 text-left text-sm font-medium text-gray-900">
                                {{ $car->year }}
                            </td>
                            <td class="pr-3 py-3.5 text-left text-sm font-medium text-gray-900">
                                {{ $car->color }}
                            </td>
                            <td class="pr-3 py-3.5 text-left text-sm font-medium text-gray-900">
                                {{ $car->capacity }} / {{ $car->baggages }}
                            </td>
                            <td class="pr-3 py-3.5 text-left text-sm font-medium text-gray-900">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{ $car->available ? 'green' : 'red' }}-100 text-{{ $car->available ? 'green' : 'red' }}-800">
                                    {{ $car->available ? 'Yes' : 'No' }}
                                </span>
                            </td>
                            <td class="pr-3 py-3.5 text-right text-sm font-medium">
                                <x-secondary-button type="button"
                                    onclick="window.location.href = '{{ route('cars.edit', ['car' => $car->id]) }}'">
                                    Edit
                                </x-secondary-button>

                                <x-danger-button type=" button"
                                    onclick="confirmDelete('{{ route('cars.destroy', $car->id) }}')">
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
@include('cars.partials.add-car-modal')
@endpush