<div class="px-4 sm:px-6 lg:px-8">
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-base font-semibold leading-6 text-gray-900">
                {{ __('Bookings') }}
            </h1>
            <p class="mt-2 text-sm text-gray-700">
                {{ __('List of all bookings') }}
            </p>
        </div>
    </div>
    <div class="mt-8 flow-root">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle">
                <table class="min-w-full divide-y divide-gray-300" id="dataTable">
                    <thead>
                        <tr>
                            <th scope="col"
                                class="pl-4 pr-3 py-3.5 text-left text-xs font-medium text-gray-500 uppercase tracking-wider sm:pl-6 lg:pl-8">
                                {{ __('User') }}
                            </th>
                            <th scope="col"
                                class="pr-3 py-3.5 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('Car') }}
                            </th>
                            <th scope="col"
                                class="pr-3 py-3.5 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('Pickup Date') }}
                            </th>
                            <th scope="col"
                                class="pr-3 py-3.5 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('Return Date') }}
                            </th>
                            <th scope="col"
                                class="pr-3 py-3.5 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('Status') }}
                            </th>
                            <th scope="col" class="pr-3 py-3.5 text-right text-xs font-medium text-gray-500 uppercase">

                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @foreach($bookings as $booking)
                        <tr data-id="{{ $booking->id }}">
                            <td
                                class="pl-4 pr-3 py-3.5 whitespace-nowrap text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8">
                                {{ $booking->user->name }} <br /> {{ $booking->user->email }}<br /> {{
                                $booking->user->phone }}
                            </td>

                            <td class="pr-3 py-3.5 whitespace-nowrap text-sm text-gray-500">
                                {{ $booking->car->name }} ({{ $booking->car->brand->name }})
                                <br /> {{ $booking->car->capacity }} People <br /> Rp. {{
                                number_format($booking->car->price, 2) }} / day
                            </td>
                            <td class="pr-3 py-3.5 whitespace-nowrap text-sm text-gray-500">
                                {{ date('d F Y H:i',$booking->pickup_date) }}
                            </td>
                            <td class="pr-3 py-3.5 whitespace-nowrap text-sm text-gray-500">
                                {{ date('d F Y H:i',$booking->return_date) }}
                            </td>
                            <td class="pr-3 py-3.5 whitespace-nowrap text-sm text-gray-500">
                                <select name="status" id="status"
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
                            </td>
                            <td class="pr-3 py-3.5 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end">
                                    <a href="{{ route('bookings.show', $booking->id) }}"
                                        class="text-indigo-600 hover:text-indigo-900 px-2">{{ __('View') }}</a>
                                    <a href="{{ route('invoices', $booking->id) }}"
                                        class="text-green-600 hover:text-green-900 px-2">{{ __('Invoice') }}</a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function () {
        $('select[name="status"]').on('change', function () {
            var status = $(this).val();
            var bookingId = $(this).closest('tr').data('id');
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