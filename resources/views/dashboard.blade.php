<x-app-layout>
    <div class="relative isolate overflow-hidden pt-16">
        <!-- Stats -->
        <div class="border-b border-b-gray-900/10 lg:border-t lg:border-t-gray-900/5">
            <dl class="mx-auto grid max-w-7xl grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 lg:px-2 xl:px-0">
                <div
                    class="flex items-baseline flex-wrap justify-between gap-y-2 gap-x-4 border-t border-gray-900/5 px-4 py-10 sm:px-6 lg:border-t-0 xl:px-8 ">
                    <dt class="text-sm font-medium leading-6 text-gray-500">Revenue</dt>
                    <dd class="w-full flex-none text-3xl font-medium leading-10 tracking-tight text-gray-900">
                        Rp. {{ number_format($revenue, 0, ',', '.') }}
                    </dd>
                </div>
                <div
                    class="flex items-baseline flex-wrap justify-between gap-y-2 gap-x-4 border-t border-gray-900/5 px-4 py-10 sm:px-6 lg:border-t-0 xl:px-8 sm:border-l">
                    <dt class="text-sm font-medium leading-6 text-gray-500">Overdue invoices</dt>
                    <dd class="w-full flex-none text-3xl font-medium leading-10 tracking-tight text-gray-900">
                        Rp. {{ number_format($overdueInvoice, 0, ',', '.') }}</dd>
                    </dd>
                </div>
                <div
                    class="flex items-baseline flex-wrap justify-between gap-y-2 gap-x-4 border-t border-gray-900/5 px-4 py-10 sm:px-6 lg:border-t-0 xl:px-8 lg:border-l">
                    <dt class="text-sm font-medium leading-6 text-gray-500">
                        Expenses
                    </dt>
                    <dd class="w-full flex-none text-3xl font-medium leading-10 tracking-tight text-gray-900">
                        Rp. {{ number_format($expenses, 0, ',', '.') }}</dd>
                    </dd>
                </div>
                <div
                    class="flex items-baseline flex-wrap justify-between gap-y-2 gap-x-4 border-t border-gray-900/5 px-4 py-10 sm:px-6 lg:border-t-0 xl:px-8 sm:border-l">
                    <dt class="text-sm font-medium leading-6 text-gray-500">Expenses</dt>
                    <dd class="w-full flex-none text-3xl font-medium leading-10 tracking-tight text-gray-900">
                        Rp. {{ number_format($expenses, 0, ',', '.') }}
                    </dd>
                </div>

            </dl>
        </div>

        <div class="absolute left-0 top-full -z-10 mt-96 origin-top-left translate-y-40 -rotate-90 transform-gpu opacity-20 blur-3xl sm:left-1/2 sm:-ml-96 sm:-mt-10 sm:translate-y-0 sm:rotate-0 sm:transform-gpu sm:opacity-50"
            aria-hidden="true">
            <div class="aspect-[1154/678] w-[72.125rem] bg-gradient-to-br from-[#FF80B5] to-[#9089FC]"
                style="clip-path: polygon(100% 38.5%, 82.6% 100%, 60.2% 37.7%, 52.4% 32.1%, 47.5% 41.8%, 45.2% 65.6%, 27.5% 23.4%, 0.1% 35.3%, 17.9% 0%, 27.7% 23.4%, 76.2% 2.5%, 74.2% 56%, 100% 38.5%)">
            </div>
        </div>
    </div>

    <div class="space-y-16 py-16 xl:space-y-20">
        <!-- Recent activity table -->
        <div>
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <h2 class="mx-auto max-w-2xl text-base font-semibold leading-6 text-gray-900 lg:mx-0 lg:max-w-none">
                    Recent activity</h2>
            </div>
            <div class="mt-6 overflow-hidden border-t border-gray-100">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="mx-auto max-w-2xl lg:mx-0 lg:max-w-none">
                        <table class="w-full text-left">
                            <thead class="sr-only">
                                <tr>
                                    <th>Amount</th>
                                    <th class="hidden sm:table-cell">Client</th>
                                    <th>More details</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($activity as $key => $item)
                                <tr class="text-sm leading-6 text-gray-900">
                                    <th scope="colgroup" colspan="3" class="relative isolate py-2 font-semibold">
                                        <time datetime="2023-03-21">
                                            {{ $key }}
                                        </time>
                                        <div
                                            class="absolute inset-y-0 right-full -z-10 w-screen border-b border-gray-200 bg-gray-50">
                                        </div>
                                        <div
                                            class="absolute inset-y-0 left-0 -z-10 w-screen border-b border-gray-200 bg-gray-50">
                                        </div>
                                    </th>
                                </tr>
                                @foreach ($item as $activity)
                                <tr>
                                    <td class="relative py-5 pr-6">
                                        <div class="flex gap-x-6">
                                            <svg class="hidden h-6 w-5 flex-none text-gray-400 sm:block"
                                                viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd"
                                                    d="M15.312 11.424a5.5 5.5 0 01-9.201 2.466l-.312-.311h2.433a.75.75 0 000-1.5H3.989a.75.75 0 00-.75.75v4.242a.75.75 0 001.5 0v-2.43l.31.31a7 7 0 0011.712-3.138.75.75 0 00-1.449-.39zm1.23-3.723a.75.75 0 00.219-.53V2.929a.75.75 0 00-1.5 0V5.36l-.31-.31A7 7 0 003.239 8.188a.75.75 0 101.448.389A5.5 5.5 0 0113.89 6.11l.311.31h-2.432a.75.75 0 000 1.5h4.243a.75.75 0 00.53-.219z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            <div class="flex-auto">
                                                <div class="flex items-start gap-x-3">
                                                    <div class="text-sm font-medium leading-6 text-gray-900">
                                                        Rp. {{ number_format($activity['total_price'], 0, ',', '.') }}
                                                    </div>
                                                    @if ($activity['status'] == 'paid')
                                                    <div
                                                        class="rounded-md py-1 px-2 text-xs font-medium ring-1 ring-inset text-green-700 bg-green-50 ring-green-600/20">
                                                        Paid
                                                    </div>
                                                    @elseif($activity['status'] == 'pending')
                                                    <div
                                                        class="rounded-md py-1 px-2 text-xs font-medium ring-1 ring-inset text-yellow-700 bg-yellow-50 ring-yellow-600/20">
                                                        Pending
                                                    </div>
                                                    @elseif ($activity['due_date'] < now()) <div
                                                        class="rounded-md py-1 px-2 text-xs font-medium ring-1 ring-inset text-red-700 bg-red-50 ring-red-600/10">
                                                        Overdue
                                                </div>
                                                @elseif($activity['status'] == 'canceled')
                                                <div
                                                    class="rounded-md py-1 px-2 text-xs font-medium ring-1 ring-inset text-red-700 bg-red-50 ring-red-600/10">
                                                    Canceled
                                                </div>
                                                @elseif($activity['status'] == 'approved')
                                                <div
                                                    class="rounded-md py-1 px-2 text-xs font-medium ring-1 ring-inset text-green-700 bg-green-50 ring-green-600/20">
                                                    Approved
                                                </div>
                                                @elseif ($activity['status'] == 'completed')
                                                <div
                                                    class="rounded-md py-1 px-2 text-xs font-medium ring-1 ring-inset text-green-700 bg-green-50 ring-green-600/20">
                                                    Completed
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                    </div>
                    <td class="hidden py-5 pr-6 sm:table-cell">
                        <div class="text-sm leading-6 text-gray-900">
                            {{ $activity['car']['name'] }}
                        </div>
                        <div class="mt-1 text-xs leading-5 text-gray-500">
                            {{ $activity['car']['license_plate'] }} - {{ $activity['car']['year'] }}
                        </div>
                    </td>
                    <td class="hidden py-5 pr-6 sm:table-cell">
                        <div class="text-sm leading-6 text-gray-900">
                            {{ $activity['user']['name'] }}
                        </div>
                        <div class="mt-1 text-xs leading-5 text-gray-500">
                            {{ $activity['user']['email'] }}
                        </div>
                    </td>
                    <td class="py-5 text-right">
                        <div class="flex justify-end">
                            <a href="{{ route('invoices', $activity['id']) }}"
                                class="text-sm font-medium leading-6 text-indigo-600 hover:text-indigo-500">Download<span
                                    class="hidden sm:inline"> Invoice</span>
                                <span class="sr-only">,
                                    Invoice {{ '#'. $activity['payment']['payment_number'] ?: '-' }}
                                </span>
                            </a>
                        </div>
                        <div class="mt-1 text-xs leading-5 text-gray-500">Invoice <span class="text-gray-900">{{ '#'.
                                $activity['payment']['payment_number'] ?: '-' }}</span>
                        </div>
                    </td>
                    </tr>
                    @endforeach
                    @endforeach

                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>