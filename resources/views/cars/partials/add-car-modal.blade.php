<x-modal name="add-car-modal" :show="$errors->carsBag->isNotEmpty()" maxWidth="3xl" focusable>
    <form method="post" action="{{ route('cars.store') }}" class="p-6" enctype="multipart/form-data">
        @csrf

        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Add New Car') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Please fill the form below to add a new car.') }}
        </p>
        @if ($errors->carsBag->isNotEmpty())
        @foreach ($errors->carsBag->all() as $error)
        <div class="mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">{{ $error }}</strong>
        </div>
        @endforeach
        @endif
        <div class="mt-6 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-2">
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required
                    autofocus autocomplete />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <x-input-label for="brand_id" :value="__('Brand')" />
                <x-select-input id="brand_id" name="brand_id" class="mt-1 block w-full" required autofocus autocomplete>
                    <option value="" selected disabled>Select Brand</option>
                    @foreach ($brands as $brand)
                    <option value="{{ $brand->id }}" {{ old('brand_id')==$brand->id ? 'selected' : '' }}>
                        {{ $brand->name }}
                    </option>
                    @endforeach
                </x-select-input>
                <x-input-error class="mt-2" :messages="$errors->get('brand_id')" />
            </div>
            <div>
                <x-input-label for="type" :value="__('Type')" />
                <x-select-input id="type" name="type" class="mt-1 block w-full" required autofocus autocomplete>
                    <option value="" selected disabled>Select Brand</option>
                    @foreach ($types as $type)
                    <option value="{{ $type }}" {{ old('type')==$type ? 'selected' : '' }}>
                        {{ $type }}
                    </option>
                    @endforeach
                </x-select-input>
                <x-input-error class="mt-2" :messages="$errors->get('type')" />
            </div>

            <div>
                <x-input-label for="color" :value="__('Color')" />
                <x-text-input id="color" name="color" type="text" class="mt-1 block w-full" :value="old('color')"
                    required autofocus />
                <x-input-error class="mt-2" :messages="$errors->get('color')" />
            </div>

            <div>
                <x-input-label for="capacity" :value="__('Capacity')" />
                <x-text-input id="capacity" name="capacity" type="number" class="mt-1 block w-full"
                    :value="old('capacity')" required autofocus autocomplete min="1" />
                <x-input-error class="mt-2" :messages="$errors->get('capacity')" />
            </div>

            <div>
                <x-input-label for="baggages" :value="__('Baggages')" />
                <x-text-input id="baggages" name="baggages" type="number" class="mt-1 block w-full"
                    :value="old('baggages')" required autofocus autocomplete />
                <x-input-error class="mt-2" :messages="$errors->get('baggages')" />
            </div>

            <div>
                <x-input-label for="license_plate" :value="__('License Plate')" />
                <x-text-input id="license_plate" name="license_plate" type="text" class="mt-1 block w-full"
                    :value="old('license_plate')" required autofocus autocomplete />
                <x-input-error class="mt-2" :messages="$errors->get('license_plate')" />
            </div>

            <div>
                <x-input-label for="transmission" :value="__('Transmission')" />
                <x-select-input id="transmission" name="transmission" class="mt-1 block w-full" required autofocus
                    autocomplete>
                    <option value="" selected disabled>Select Transmission</option>
                    <option value="Automatic" {{ old('transmission')=='Automatic' ? 'selected' : '' }}>Automatic
                    </option>
                    <option value="Manual" {{ old('transmission')=='Manual' ? 'selected' : '' }}>Manual</option>
                </x-select-input>
                <x-input-error class="mt-2" :messages="$errors->get('transmission')" />
            </div>
            <div>
                <x-input-label for="year" :value="__('Year')" />
                <x-select-input id="year" name="year" class="mt-1 block w-full" required autofocus autocomplete>
                    @php
                    $years = range(date('Y'), 1900);
                    @endphp
                    @foreach ($years as $year)
                    <option value="{{ $year }}" {{ old('year')==$year ? 'selected' : '' }}>
                        {{ $year }}
                    </option>
                    @endforeach
                </x-select-input>
                <x-input-error class="mt-2" :messages="$errors->get('year')" />
            </div>

            <div>
                <x-input-label for="price" :value="__('Price')" />
                <x-text-input id="price" name="price" type="number" class="mt-1 block w-full" :value="old('price')"
                    required autofocus autocomplete />
                <x-input-error class="mt-2" :messages="$errors->get('price')" />
            </div>
        </div>

        <div class="mt-6">
            <x-input-label for="features" :value="__('Features')" />
            <x-text-input id="features" name="features" type="text" class="mt-1 block w-full" :value="old('features')"
                required autofocus autocomplete />
            <small class="text-gray-500">* Separate each feature with comma (,)</small>
            <x-input-error class="mt-2" :messages="$errors->get('features')" />
        </div>

        <div class="mt-6">
            <x-input-label for="description" :value="__('Description')" />
            <x-textarea-input id="description" name="description" class="mt-1 block w-full" :value="old('description')"
                autofocus autocomplete />
            <x-input-error class="mt-2" :messages="$errors->get('description')" />
        </div>

        <div class="mt-6">
            <x-input-label for="policy" :value="__('Policy')" />
            <x-textarea-input id="policy" name="policy" class="mt-1 block w-full" :value="old('policy')" autofocus
                autocomplete />
            <x-input-error class="mt-2" :messages="$errors->get('policy')" />
        </div>

        <div class="mt-6">
            <x-input-label for="image" :value="__('Image')" />
            <x-file-input id="image" name="image" class="mt-1 block w-full" required autofocus autocomplete />
            <x-input-error class="mt-2" :messages="$errors->get('image')" />
        </div>

        <div class="mt-6">
            <x-input-label for="available" :value="__('Available')" />
            <x-select-input id="available" name="available" class="mt-1 block w-full" required autofocus autocomplete>
                <option value="" selected disabled>Select Availability</option>
                <option value="1" {{ old('available')==1 ? 'selected' : '' }}>Available</option>
                <option value="0" {{ old('available')==0 ? 'selected' : '' }}>Not Available</option>
            </x-select-input>

            <x-input-error class="mt-2" :messages="$errors->get('available')" />
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