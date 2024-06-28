<x-app-layout>

    <div class="relative isolate overflow-hidden pt-20">
        <div class="mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <form method="post" action="{{ route('location.update', ['location' => $location->id]) }}" class="p-6">
                    @csrf

                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Edit Location') }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-600">
                        {{ __('Edit the location data.') }}
                    </p>

                    <div class="mt-6">
                        <x-input-label for="location" :value="__('Location')" />
                        <x-text-input id="location" name="location" type="text" class="mt-1 block w-full"
                            :value="old('location', $location->name)" required autofocus autocomplete />
                        <x-input-error class="mt-2" :messages="$errors->get('location')" />
                    </div>

                    <div class="mt-6">
                        <x-input-label for="address" :value="__('Address')" />
                        <x-textarea-input id="address" name="address" class="mt-1 block w-full"
                            :value="old('address', $location->address)" required autofocus autocomplete />
                        <x-input-error class="mt-2" :messages="$errors->get('address')" />
                    </div>

                    <div class="mt-6 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                        <div>
                            <x-input-label for="province" :value="__('Province')" />
                            <x-select-input id="province" name="province" class="mt-1 block w-full" required autofocus>
                                <option value="">-- Select Province --</option>
                                @foreach ($provinces['data'] as $province)
                                <option value="{{ $province->name }}" data-id="{{ $province->code }}" {{
                                    old('province',$location->province)==$province->name ?
                                    'selected' :
                                    '' }}>
                                    {{ $province->name }}</option>
                                @endforeach
                            </x-select-input>
                            <x-input-error class="mt-2" :messages="$errors->get('province')" />
                        </div>
                        <div>
                            <x-input-label for="city" :value="__('City')" />
                            <x-select-input id="city" name="city" class="mt-1 block w-full" required autofocus>
                            </x-select-input>
                            <x-input-error class="mt-2" :messages="$errors->get('city')" />
                        </div>

                        <div>
                            <x-input-label for="zip_code" :value="__('Zip Code')" />
                            <x-text-input id="zip_code" name="zip_code" type="text" class="mt-1 block w-full"
                                :value="old('zip_code', $location->zip_code)" required autofocus autocomplete />
                            <x-input-error class="mt-2" :messages="$errors->get('zip_code')" />
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <x-secondary-button x-on:click="$dispatch('close')">
                            {{ __('Cancel') }}
                        </x-secondary-button>

                        <x-primary-button class="ms-3">
                            {{ __('Simpan') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @push('scripts')
    <script>
        $(document).ready(function () {
            var oldCity = "{{ old('city', $location->city) }}";

            function loadCities(province) {
                if (province) {
                    axios.defaults.headers.common['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr('content');
                    const url = '{{ route('cities', ':province') }}';
                    axios.get(url.replace(':province', province))
                        .then(function (response) {
                            $('#city').empty();
                            $('#city').append('<option value="">-- Select City --</option>');
                            $.each(response.data.data, function (key, value) {
                                var selected = value.name === oldCity ? ' selected' : '';
                                $('#city').append('<option value="' + value.name + '"' + selected + '>' + value.name + '</option>');
                            });
                        })
                        .catch(function (error) {
                            console.error('There was an error!', error);
                        });
                } else {
                    $('#city').empty();
                    $('#city').append('<option value="">-- Select City --</option>');
                }
            }

            $('#province').on('change', function () {
                var province = $(this).find(':selected').data('id');
                loadCities(province);
            });

            var initialProvince = $('#province').find(':selected').data('id');
            if (initialProvince) {
                loadCities(initialProvince);
            }
        });
    </script>
    @endpush
</x-app-layout>
