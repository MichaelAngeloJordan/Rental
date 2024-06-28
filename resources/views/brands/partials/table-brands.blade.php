<div class="px-4 sm:px-6 lg:px-8">
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-base font-semibold leading-6 text-gray-900">Brands List</h1>
            <p class="mt-2 text-sm text-gray-700">
                List of brands that are available in the system.
            </p>
        </div>
        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
            <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'add-brand-modal')"> Add
                Brands</x-primary-button>
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
                                {{ __('Logo') }}
                            </th>
                            <th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">
                                {{ __('Brand') }}
                            </th>
                            <th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">
                                {{ __('Country') }}
                            </th>
                            <th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">
                                {{ __('Description') }}
                            </th>
                            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6 lg:pr-8">
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @foreach($brands as $brand)
                        <tr>
                            <td class="pl-4 pr-3 py-3.5 text-left text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8">
                                <img src="{{ $brand->logo_url }}" alt="{{ $brand->name }}"
                                    class="h-10 w-10 object-cover rounded-full">
                            </td>
                            <td class="pr-3 py-3.5 text-left text-sm font-medium text-gray-900">
                                {{ $brand->name }}
                            </td>
                            <td class="pr-3 py-3.5 text-left text-sm font-medium text-gray-900">
                                {{ $brand->country }}
                            </td>
                            <td class="pr-3 py-3.5 text-left text-sm font-medium text-gray-900">
                                {{ Str::limit($brand->description, 50) ?: '-' }}
                            </td>

                            <td class="pr-3 py-3.5 text-right text-sm font-medium">
                                <x-secondary-button type="button"
                                    onclick="window.location.href = '{{ route('brands.edit', $brand->id) }}'"
                                    onKeyPress="" onKeyDown="" onKeyUp="">
                                    Edit
                                </x-secondary-button>

                                <x-danger-button type="button" x-data=""
                                    onclick="confirmDelete('{{ route('brands.destroy', $brand->id) }}')">
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
@include('brands.partials.add-brand-modal')
@endpush
