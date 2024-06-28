<x-app-layout>
    <div class="relative isolate pt-20">
        <div class="mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-semibold leading-6 text-gray-900">
                    {{ __('Booking Detail') }}
                </h1>
                <div class="flex items-center space-x-2">
                    <a href="{{ route('bookings') }}"
                        class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 bg-grey-600 rounded-md text-black hover:bg-gray-500 focus:outline-none focus:bg-gray-500 transition duration-150 ease-in-out shadow-md">
                        {{ __('Back') }}
                    </a>
                    <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 bg-red-600 rounded-md text-white hover:bg-red-500 focus:outline-none focus:bg-red-500 transition duration-150 ease-in-out shadow-md">
                            {{ __('Delete') }}
                        </button>
                    </form>
                    <a href="{{ route('invoices', $booking->id) }}"
                        class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 bg-green-600 rounded-md text-white hover:bg-green-500 focus:outline-none focus:bg-green-500 transition duration-150 ease-in-out shadow-md">
                        {{ __('Download Invoice') }}
                    </a>
                </div>
            </div>

            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6">
                    <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">
                                {{ __('User') }}
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                {{ $booking->user->name }} <br /> {{ $booking->user->email }}<br /> {{
                                $booking->user->phone }}
                            </dd>
                        </div>
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">
                                {{ __('Car') }}
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                {{ $booking->car->name }} ({{ $booking->car->brand->name }})
                                <br /> {{ $booking->car->capacity }} People <br /> Rp. {{
                                number_format($booking->car->price, 2) }} / day
                            </dd>
                        </div>
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">
                                {{ __('Pickup Date') }}
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                {{ date('d F Y H:i',$booking->pickup_date) }}
                            </dd>
                        </div>
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">
                                {{ __('Return Date') }}
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                {{ date('d F Y H:i',$booking->return_date) }}
                            </dd>
                        </div>
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">
                                {{ __('Status') }}
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                <select name="status" id="statusBooking" data-id="{{ $booking->id }}"
                                    class="form-select rounded-md shadow-sm mt-1 block w-full">
                                    <option value="pending" {{ $booking->status == 'pending' ? 'selected' : ''
                                        }}>Pending</option>
                                    <option value="approved" {{ $booking->status == 'approved' ? 'selected' : ''
                                        }}>Approved</option>
                                    <option value="rejected" {{ $booking->status == 'rejected' ? 'selected' : ''
                                        }}>Rejected</option>
                                    <option value="completed" {{ $booking->status == 'completed' ? 'selected' : ''
                                        }}>Completed</option>
                                    <option value="canceled" {{ $booking->status == 'canceled' ? 'selected' : ''
                                        }}>Canceled</option>
                                </select>
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <div class="relative isolate overflow-hidden pt-20">
        <div class="mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                @include('payments.partials.table-payments')
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        $(document).ready(function () {
            $('#statusBooking').on('change', function () {
                var status = document.getElementById('statusBooking').value;
                var bookingId = document.getElementById('statusBooking').getAttribute('data-id');
                const url = `{{ route('bookings.update', ':bookingId') }}`;
                axios.post(url.replace(':bookingId', bookingId), {
                    status: status
                }).then(response => {
                    alert(response.data.message);
                    window.location.reload();
                }).catch(error => {
                    alert(error.response.data.message);
                });
            });
        });
    </script>
    @endpush

</x-app-layout>