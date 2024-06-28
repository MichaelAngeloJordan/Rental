<x-frontend-layout>
    @push('styles')
    <style>
        body {
            background-color: #003241 !important;
        }
    </style>
    @endpush
    <div class="flex justify-center">
        <div class="z-50 py-6 ">
            <h1 class="text-3xl font-semibold text-center text-white p-3">Payment Success</h1>
            <img src="{{ asset('assets/success.gif') }}" alt="success" class="w-full mx-auto">

            <div class="bg-white p-4 rounded-lg mt-6">
                <h2 class="text-xl font-semibold text-center">Payment Details</h2>
                <div class="flex justify-between mt-4">
                    <p>Payment ID</p>
                    <p>{{ $payment->payment_id }}</p>
                </div>
                <div class="flex justify-between mt-4">
                    <p>Amount</p>
                    <p>{{ $payment->amount }}</p>
                </div>
                <div class="flex justify-between mt-4">
                    <p>Payment Status</p>
                    <p class="bg-green-500 text-white px-2 py-1 rounded-full">
                        {{ $payment->status }}
                    </p>
                </div>
                <div class="flex justify-between mt-4">
                    <p>Payment Date</p>
                    <p>{{ $payment->created_at }}</p>
                </div>
            </div>

            <div class="flex justify-center mt-6">
                <a href="{{ route('home') }}" class="bg-white text-blue-500 px-4 py-2 rounded-full text-center">Back to
                    Home</a>
            </div>


        </div>
    </div>

</x-frontend-layout>