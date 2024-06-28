<x-modal name="add-brand-modal" :show="$errors->brandBag->isNotEmpty()" focusable :show="session()->has('errors')">
    <form method="post" action="{{ route('brands.store') }}" class="p-6" enctype="multipart/form-data">
        @csrf
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Add Brand Data') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Fill in the form below to add a new brand.') }}
        </p>
        @if ($errors->brandBag->isNotEmpty())
        @foreach ($errors->brandBag->all() as $error)
        <div class="mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">{{ $error }}</strong>
        </div>
        @endforeach
        @endif
        <div class="mt-6 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-2">
            <div>
                <x-input-label for="name" :value="__('Brand Name')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required
                    autofocus autocomplete />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <x-input-label for="country" :value="__('Country')" />
                <x-text-input id="country" name="country" type="text" class="mt-1 block w-full" :value="old('country')"
                    required autofocus autocomplete />
                <small class="text-xs text-gray-500">{{ __('Country of origin of the brand.') }}</small>
                <x-input-error class="mt-2" :messages="$errors->get('country')" />
            </div>
        </div>

        <div class="mt-6">
            <x-input-label for="description" :value="__('Description')" />
            <x-textarea-input id="description" name="description" class="mt-1 block w-full" :value="old('description')"
                required autofocus autocomplete />
            <x-input-error class="mt-2" :messages="$errors->get('description')" />
        </div>

        <div class="mt-6">
            <x-input-label for="logo" :value="__('Logo')" />
            <x-file-input id="logo" name="logo" class="mt-1 block w-full" required autofocus autocomplete
                accept="image/*" />
            <x-input-error class="mt-2" :messages="$errors->get('logo')" />
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
