<x-app-layout>
    <div class="relative isolate overflow-hidden pt-20">
        <div class="mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <form method="post" action="{{ route('brands.update', $brand->id) }}" class="p-6"
                    enctype="multipart/form-data">
                    @csrf
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Edit Brand') }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-600">
                        {{ __('Edit the brand data.') }}
                    </p>
                    @if ($errors->brandBag->isNotEmpty())
                    @foreach ($errors->brandBag->all() as $error)
                    <div class="mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                        role="alert">
                        <strong class="font-bold">{{ $error }}</strong>
                    </div>
                    @endforeach
                    @endif
                    <div class="mt-6 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-2">
                        <div>
                            <x-input-label for="name" :value="__('Brand Name')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                :value="old('name',$brand->name)" required autofocus autocomplete />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div>
                            <x-input-label for="country" :value="__('Country')" />
                            <x-text-input id="country" name="country" type="text" class="mt-1 block w-full"
                                :value="old('country',$brand->country)" required autofocus autocomplete />
                            <small class="text-xs text-gray-500">{{ __('Country of origin of the brand.') }}</small>
                            <x-input-error class="mt-2" :messages="$errors->get('country')" />
                        </div>
                    </div>

                    <div class="mt-6">
                        <x-input-label for="description" :value="__('Description')" />
                        <x-textarea-input id="description" name="description" class="mt-1 block w-full"
                            :value="old('description',$brand->description)" required autofocus autocomplete />
                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                    </div>

                    <div class="mt-6">
                        <x-input-label for="logo" :value="__('Logo')" />
                        @if ($brand->logo)
                        <div class="mt-2">
                            <img src="{{ $brand->logo_url }}" alt="{{ $brand->name }}"
                                class="h-10 w-10 object-cover rounded-full">
                        </div>
                        @endif
                        <x-file-input id="logo" name="logo" class="mt-1 block w-full" autofocus autocomplete
                            accept="image/*" />
                        <x-input-error class="mt-2" :messages="$errors->get('logo')" />
                    </div>

                    <div class="mt-6 flex justify-end">
                        <x-primary-button class="ms-3">
                            {{ __('Simpan') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
