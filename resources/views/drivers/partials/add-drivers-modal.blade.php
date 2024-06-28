<x-modal name="add-drivers-modal" :show="$errors->driversDeletion->isNotEmpty()" focusable
    :show="session()->has('errors')" maxWidth="3xl">
    <form method="post" action="{{ route('drivers.store') }}" class="p-6" enctype="multipart/form-data">
        @csrf

        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Add New Driver') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Fill in the following data to add a new driver.') }}
        </p>
        @if ($errors->driversDeletion->isNotEmpty())
        @foreach ($errors->driversDeletion->all() as $error)
        <div class="mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">{{ $error }}</strong>
        </div>
        @endforeach
        @endif
        <div class="mt-6">
            <x-input-label for="location_id" :value="__('Location')" />
            <x-select-input id="location_id" name="location_id" class="mt-1 block w-full" required autofocus
                autocomplete>
                <option value="" selected disabled>-- Select Location --</option>
                @foreach($locations as $location)
                <option value="{{ $location->id }}" @if(old('location_id')==$location->id) selected @endif>
                    {{ $location->name }}
                </option>
                @endforeach
            </x-select-input>
            <x-input-error class="mt-2" :messages="$errors->get('location_id')" />
        </div>

        <div class="mt-6 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-2">
            <div>
                <x-input-label for="name" :value="__('Driver Name')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required
                    autofocus />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email')"
                    required autofocus />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />
            </div>

            <div>
                <x-input-label for="phone" :value="__('Phone Number')" />
                <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone')"
                    required autofocus />
                <x-input-error class="mt-2" :messages="$errors->get('phone')" />
            </div>

            <div>
                <x-input-label for="gender" :value="__('Gender')" />
                <x-select-input id="gender" name="gender" class="mt-1 block w-full" required autofocus autocomplete>
                    <option value="" selected disabled>--{{ __('Gender') }}--</option>
                    <option value="male" @if(old('gender')=='male' ) selected @endif>{{ __('Male') }}
                    </option>
                    <option value="female" @if(old('gender')=='female' ) selected @endif>{{ __('Female') }}
                    </option>
                </x-select-input>
                <x-input-error class="mt-2" :messages="$errors->get('gender')" />
            </div>

            <div>
                <x-input-label for="license_number" :value="__('License Number')" />
                <x-text-input id="license_number" name="license_number" type="text" class="mt-1 block w-full"
                    :value="old('license_number')" required />
                <x-input-error class="mt-2" :messages="$errors->get('license_number')" />
            </div>

            <div>
                <x-input-label for="status" :value="__('Status')" />
                <x-select-input id="status" name="status" class="mt-1 block w-full" required autofocus autocomplete>
                    <option value="" selected disabled>--{{ __('Status') }}--</option>
                    <option value="active" @if(old('status')=='active' ) selected @endif>{{ __('Active') }}
                    </option>
                    <option value="inactive" @if(old('status')=='inactive' ) selected @endif>{{ __('InActive') }}
                    </option>
                    <option value="suspended" @if(old('status')=='suspended' ) selected @endif>{{ __('Suspended') }}
                    </option>
                    <option value="banned" @if(old('status')=='banned' ) selected @endif>{{ __('Banned') }}
                    </option>
                </x-select-input>
                <x-input-error class="mt-2" :messages="$errors->get('status')" />
            </div>
        </div>

        <div class="mt-6">
            <x-input-label for="license_image" :value="__('License Image')" />
            <x-file-input id="license_image" name="license_image" class="mt-1 block w-full" required autofocus
                autocomplete accept="image/*" />
            <x-input-error class="mt-2" :messages="$errors->get('license_image')" />
        </div>

        <div class="mt-6">
            <x-input-label for="photo" :value="__('Driver Photo')" />
            <x-file-input id="photo" name="photo" class="mt-1 block w-full" required autofocus autocomplete
                accept="image/*" />
            <x-input-error class="mt-2" :messages="$errors->get('photo')" />
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