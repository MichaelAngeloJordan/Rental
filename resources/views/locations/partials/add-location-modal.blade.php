<x-modal name="add-location-modal" :show="$errors->userDeletion->isNotEmpty()" focusable
    :show="session()->has('errors')">
    <form method="post" action="{{ route('location.store') }}" class="p-6">
        @csrf

        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Add Location Data') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Fill in the form below to add a new location.') }}
        </p>

        <div class="mt-6">
            <x-input-label for="location" :value="__('Location')" />
            <x-text-input id="location" name="location" type="text" class="mt-1 block w-full" :value="old('location')"
                required autofocus autocomplete />
            <x-input-error class="mt-2" :messages="$errors->get('location')" />
        </div>

        <div class="mt-6">
            <x-input-label for="address" :value="__('Address')" />
            <x-textarea-input id="address" name="address" class="mt-1 block w-full" :value="old('address')" required
                autofocus autocomplete />
            <x-input-error class="mt-2" :messages="$errors->get('address')" />
        </div>

        <div class="mt-6 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
            <div>
                <x-input-label for="province" :value="__('Province')" />
                <x-select-input id="province" name="province" class="mt-1 block w-full" required autofocus>
                    <option value="">-- Select Province --</option>
                    @foreach ($provinces['data'] as $province)
                    <option value="{{ $province->name }}" data-id="{{ $province->code }}" {{
                        old('province')==$province->name ? 'selected' :
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
                    :value="old('zip_code')" required autofocus autocomplete />
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
</x-modal>

@push('scripts')
<script>
    $(document).ready(function () {
        $('#province').on('change', function () {
            var province = $(this).find(':selected').data('id');
              if (province) {
                    axios.defaults.headers.common['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr('content');
                    const url = '{{ route('cities', ':province') }}';
                    axios.get(url.replace(':province', province))
                        .then(function (response) {
                            $('#city').empty();
                            $('#city').append('<option value="">-- Select City --</option>');
                            $.each(response.data.data, function (key, value) {
                                $('#city').append('<option value="' + value.name + '">' + value.name + '</option>');
                            });
                        })
                        .catch(function (error) {
                            console.error('There was an error!', error);
                        });
                } else {
                $('#city').empty();
                $('#city').append('<option value="">-- Select City --</option>');
            }
        });
    });
</script>

@endpush
