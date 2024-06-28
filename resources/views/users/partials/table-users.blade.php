<div class="px-4 sm:px-6 lg:px-8">
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-base font-semibold leading-6 text-gray-900">
                {{ __('Users') }}
            </h1>
            <p class="mt-2 text-sm text-gray-700">
                {{ __('List of users') }}
            </p>
        </div>
        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
            <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'add-users-modal')">
                {{ __('Add User') }}
            </x-primary-button>
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
                                {{ __('Name') }}
                            </th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                {{ __('Gender') }}
                            </th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                {{ __('Phone') }}
                            </th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                {{ __('Role') }}
                            </th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                {{ __('Created At') }}
                            </th>
                            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6 lg:pr-8">
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @foreach($users as $user)
                        <tr>
                            <td class="pl-4 pr-3 py-3.5 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8">
                                <div class="flex items-center space-x-2">
                                    <div class="flex-shrink-0 w-10 h-10">
                                        <img class="w-10 h-10 rounded-full" src="{{ $user->photo_profile_url }}"
                                            alt="{{ $user->name }}">
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $user->name }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ $user->email }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-3 py-3.5 text-sm text-gray-500">
                                {{ ucwords($user->gender) }}
                            </td>
                            <td class="px-3 py-3.5 text-sm text-gray-500">
                                {{ $user->phone }}
                            </td>
                            <td class="px-3 py-3.5 text-sm text-gray-500">
                                {{ $user->role->name }}
                            </td>
                            <td class="px-3 py-3.5 text-sm text-gray-500">
                                {{ $user->created_at->diffForHumans() }}
                            </td>

                            <td class="pr-3 py-3.5 text-right text-sm font-medium">
                                <x-secondary-button type="button"
                                    onclick="window.location.href = '{{ route('users.edit', $user->id) }}'">
                                    Edit
                                </x-secondary-button>

                                <x-danger-button type="button"
                                    onclick="confirmDelete('{{ route('users.destroy', $user->id) }}')">
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
@include('users.partials.add-users-modal')
@endpush