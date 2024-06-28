<x-modal name="add-car-location-modal" :show="$errors->carLocationBag->isNotEmpty()" focusable>
    <form method="post" action="{{ route('cars-location.store') }}" class="p-6">
        @csrf
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Add Car Location') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Add a new car location.') }}
        </p>
        @if ($errors->carLocationBag->isNotEmpty())
        @foreach ($errors->carLocationBag->all() as $error)
        <div class="mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">{{ $error }}</strong>
        </div>
        @endforeach
        @endif
        <div class="mt-6">
            <x-input-label for="location_id" :value="__('Location')" />
            <x-select-input id="location_id" name="location_id" class="mt-1 block w-full" required autofocus>
                @foreach ($locations as $location)
                <option value="{{ $location->id }}" @if($location->id == old('location_id'))
                    selected @endif>
                    {{ $location->name }}</option>
                @endforeach
            </x-select-input>
            <x-input-error class="mt-2" :messages="$errors->get('location_id')" />
        </div>
        <div class="mt-6">
            <x-input-label for="car_id" :value="__('Car')" />
            <x-select-input id="car_id" name="car_id" class="mt-1 block w-full" :value="old('car_id')" required
                autofocus>
                @foreach ($cars as $car)
                <option value="{{ $car->id }}" @if($car->id == old('car_id'))
                    selected @endif>
                    {{ $car->name }}</option>
                @endforeach
            </x-select-input>
            <x-input-error class="mt-2" :messages="$errors->get('car_id')" />
        </div>

        <div class="mt-6 grid grid-cols-2 gap-6">
            <div>
                <x-input-label for="available_from" :value="__('Available From')" />
                <x-text-input id="available_from" name="available_from" type="datetime-local" class="mt-1 block w-full"
                    :value="old('available_from')" required autofocus min="{{ now()->format('Y-m-d\TH:i') }}" />
                <x-input-error class="mt-2" :messages="$errors->get('available_from')" />
            </div>
            <div>
                <x-input-label for="available_until" :value="__('Available Until')" />
                <x-text-input id="available_until" name="available_until" type="datetime-local"
                    class="mt-1 block w-full" :value="old('available_until')" required autofocus
                    min="{{ now()->format('Y-m-d\TH:i') }}" />
                <x-input-error class="mt-2" :messages="$errors->get('available_until')" />
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
    const element = document.querySelector('#car_id');
    const choices = new Choices(element);

    const elementLocation = document.querySelector('#location_id');
    const choicesLocation = new Choices(elementLocation);
</script>
@endpush