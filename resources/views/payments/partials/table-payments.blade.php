<div class="px-4 sm:px-6 lg:px-8">
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-base font-semibold leading-6 text-gray-900">
                {{ __('List of all Payments') }}
            </h1>
            <p class="mt-2 text-sm text-gray-700">
                {{ __('List of all payments made by users') }}
            </p>
        </div>
    </div>
    <div class="mt-8 flow-root">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle">
                <table class="min-w-full divide-y divide-gray-300" id="dataTable">
                    <thead>
                        <tr>
                            <th
                                class="pl-4 pr-3 py-3.5 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('User') }}
                            </th>
                            <th
                                class="pr-3 py-3.5 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('Payment Number') }}
                            </th>
                            <th
                                class="pr-3 py-3.5 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('Payment Date') }}
                            </th>
                            <th
                                class="pr-3 py-3.5 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('Amount') }}
                            </th>
                            <th
                                class="pr-3 py-3.5 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('Status') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @foreach($payments as $payment)
                        <tr data-id="{{ $payment->id }}">
                            <td class="pl-4 pr-3 py-3.5 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $payment->booking->user->name }} <br /> {{ $payment->booking->user->email }}<br /> {{
                                $payment->booking->user->phone }}
                            </td>
                            <td class="pr-3 py-3.5 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $payment->payment_number }} <br /> {{ ucwords(str_replace('_',' ',
                                $payment->payment_method))
                                }} <br />
                                {{ preg_replace('/(?<!^)([A-Z]) /', ' $1' , $payment->payment_bank) }}
                            </td>
                            <td class="pr-3 py-3.5 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ date('d F Y H:i', $payment->payment_date) }}
                            </td>
                            <td class="pr-3 py-3.5 whitespace-nowrap text-sm font-medium text-gray-900">
                                Rp. {{ number_format($payment->total_payment, 2) }}
                            </td>
                            <td class="pr-3 py-3.5 whitespace-nowrap text-sm font-medium text-gray-900">
                                <select name="status" id="statusPayment" data-id="{{ $payment->id }}"
                                    class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                    <option value="pending" {{ $payment->status == 'pending' ? 'selected' : '' }}>
                                        {{ __('Pending') }}
                                    </option>
                                    <option value="paid" {{ $payment->status == 'paid' ? 'selected' : '' }}>
                                        {{ __('Paid') }}
                                    </option>
                                    <option value="cancelled" {{ $payment->status == 'cancelled' ? 'selected' : '' }}>
                                        {{ __('Cancelled') }}
                                    </option>
                                </select>
                            </td>
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
        $('#statusPayment').change(function () {
            var status = $(this).val();
            var paymentId = $(this).data('id');
            const url = `{{ route('payments.update', ':paymentId') }}`;
            axios.post(url.replace(':paymentId', paymentId), {
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