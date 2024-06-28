<x-modal name="add-users-modal" :show="$errors->usersDeletion->isNotEmpty()" focusable maxWidth="3xl">
    <form method="post" action="{{ route('users.store') }}" class="p-6" enctype="multipart/form-data">
        @csrf

        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Add New User') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Fill in the form below to add a new user.') }}
        </p>
        @if ($errors->usersDeletion->isNotEmpty())
        @foreach ($errors->usersDeletion->all() as $error)
        <div class="mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">{{ $error }}</strong>
        </div>
        @endforeach
        @endif
        <div class="mt-6 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-2">
            <div>
                <x-input-label for="name" :value="__('Name')" />
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
                    <option value="M" @if(old('gender')=='M' ) selected @endif>{{ __('Male') }}
                    </option>
                    <option value="F" @if(old('gender')=='F' ) selected @endif>{{ __('Female') }}
                    </option>
                </x-select-input>
                <x-input-error class="mt-2" :messages="$errors->get('gender')" />
            </div>
            <div>
                <x-input-label for="role" :value="__('Role')" />
                <x-select-input id="role" name="role" class="mt-1 block w-full" required autofocus autocomplete>
                    <option value="" selected disabled>--{{ __('Role') }}--</option>
                    @foreach($roles as $role)
                    <option value="{{ $role->id }}" @if(old('role')==$role->id ) selected @endif>{{ $role->name }}
                    </option>
                    @endforeach
                </x-select-input>
                <x-input-error class="mt-2" :messages="$errors->get('role')" />
            </div>
        </div>

        <div class="mt-6">
            <x-input-label for="photo" :value="__('Photo')" />
            <x-file-input id="photo" name="photo" class="mt-1 block w-full" autofocus autocomplete accept="image/*" />
            <x-input-error class="mt-2" :messages="$errors->get('photo')" />
        </div>

        <div class="mt-6">
            <x-input-label for="address" :value="__('Address')" />
            <x-textarea-input id="address" name="address" class="mt-1" :value="old('address')" />
            <x-input-error class="mt-2" :messages="$errors->get('address')" />
        </div>

        <div class="mt-6">
            <x-input-label for="update_password_password" :value="__('New Password')" />
            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full"
                autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div class="mt-6">
            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password"
                class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
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
