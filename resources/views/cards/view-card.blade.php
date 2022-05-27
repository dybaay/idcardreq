<x-app-layout>
    <x-slot name="header">
        {{ __('View Card') }}
    </x-slot>

    <div class="mt-2">
        <div class="container flex justify-center mx-auto p-4 md:p-0">
            <div class="shadow-lg flex flex-wrap w-full lg:w-4/5">
                <div class="bg-cover bg-center border w-full md:w-1/3 h-64 md:h-auto relative" style="background-image:url('/images/id.gif')">
                    <div class="absolute text-xl">
                        <i class="fa fa-heart text-white hover:text-red-light ml-4 mt-4 cursor-pointer"></i>
                    </div>
                </div>

                <div class="bg-white w-full md:w-2/3">
                    <div class="h-full mx-auto px-6 md:px-0 md:pt-6 md:-ml-6 relative">
                        <div class="bg-white lg:h-full p-6 -mt-6 md:mt-0 relative mb-4 md:mb-0 flex flex-wrap md:flex-wrap items-center">
                            <div class="w-full lg:border-right lg:border-solid text-center font-bold md:text-left">
                                <h3 class="text-center uppercase">Identity Card Information</h3>
                                <hr class="w-1/4 md:ml-0 mt-4  border lg:hidden">
                            </div>
                            <div class="w-full lg:px-3 my-12">
                                <p class="mt-4 text-lg lg:mt-0 text-justify md:text-left text-sm">
                                    <b class="text-blue-500">Name:</b> {{ $card->user->first_name }} {{ $card->user->last_name }} {{ $card->user->other_name }}
                                </p>
                                <p class="mt-4 text-lg lg:mt-0 text-justify md:text-left text-sm">
                                    <b class="text-blue-500">Faculty:</b> {{ $card->faculty->name }}
                                </p>
                                <p class="mt-4 text-lg lg:mt-0 text-justify md:text-left text-sm">
                                    <b class="text-blue-500">Department:</b> {{ $card->department->name }}
                                </p>
                                <p class="mt-4 text-lg lg:mt-0 text-justify md:text-left text-sm">
                                    <b class="text-blue-500">Type:</b> {{ $card->cardType->name }}
                                </p>
                                <p class="mt-4 text-lg lg:mt-0 text-justify md:text-left text-sm">
                                    <b class="text-blue-500">ID Number:</b> {{ $card->cardProperty->identity_no }}
                                </p>
                                <p class="mt-4 text-lg lg:mt-0 text-justify md:text-left text-sm">
                                    <b class="text-blue-500">Status:</b> {{ $card->cardProperty->status }}
                                </p>
                                <p class="mt-4 text-lg lg:mt-0 text-justify md:text-left text-sm">
                                    <b class="text-blue-500">Printed At:</b> {{ $card->cardProperty->printed_at->toDateString() }}
                                </p>
                                <p class="mt-4 text-lg lg:mt-0 text-justify md:text-left text-sm">
                                    <b class="text-blue-500">Expire At:</b> {{ $card->cardProperty->expire_at->toDateString() }}
                                </p>
                            </div>
                            @if(now() > $card->cardProperty->printed_at)
                            <div>
                                <a href="{{ route('collection-pdf', ['identity_number' => $card->cardProperty->identity_no]) }}" class="inline-flex items-center font-bold text-blue-500 hover:opacity-75 "> Download Collection Form <svg class="ml-0.5 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z"></path>
                                        <path d="M5 5a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2v-3a1 1 0 10-2 0v3H5V7h3a1 1 0 000-2H5z"></path>
                                    </svg>
                                </a>
                            </div>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-12">
        <div class="font-bold text-blue-500 mt-4 text-lg lg:mt-0 text-justify md:text-left text-sm">
            Uploaded Card Documents
        </div>
        <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                        <th class="px-4 py-3">S/N</th>
                        <th class="px-4 py-3">Document Name</th>
                        <th class="px-4 py-3">Document Type</th>
                        <th class="px-4 py-3">File Slug</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y">
                    @forelse($card->cardDocuments as $doc)
                        <tr class="text-gray-700">
                            <td class="px-4 py-3 text-sm font-bold">
                                {{$loop->iteration}}
                            </td>
                            <td class="px-4 py-3 text-sm font-bold">
                                {{ $doc->name }}
                            </td>
                            <td class="px-4 py-3 text-center text-sm font-bold">
                                {{ $doc->cardDocumentType->name }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $doc->slug }}
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center space-x-4 text-sm">
                                    <a target="_blank" href="{{ url('storage', $doc->file) }}" class="px-2 py-2 font-medium leading-5 uppercase text-blue-500 hover:underline">
                                        View Document
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr class="text-gray-700">
                            <td class="px-4 py-3">
                                <div class="flex items-center text-sm">
                                    <div>
                                        No Document.
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-12">
        <div class="font-bold text-blue-500 mt-4 text-lg lg:mt-0 text-justify md:text-left text-sm mb-4">
            Card Transactions
            @if($card->cardType->price != 0)
                <a href="{{ route('card-payment', $card->cardProperty->identity_no) }}"
                    class="m-4 focus:outline-none py-2 px-5 rounded-lg shadow-sm text-center text-gray-600 bg-white hover:bg-gray-100 font-medium border"
                >
                    Make Payment Now
                </a>
            @endif
        </div>
        <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                        <th class="px-4 py-3">S/N</th>
                        <th class="px-4 py-3">Description</th>
                        <th class="px-4 py-3">Amount</th>
                        <th class="px-4 py-3">Reference ID</th>
                        <th class="px-4 py-3">Payment Method</th>
                        <th class="px-4 py-3">Payment Date</th>
                        <th class="px-4 py-3">Status</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y">
                    @forelse($card->transactions as $transaction)
                        <tr class="text-gray-700">
                            <td class="px-4 py-3 text-sm font-bold">
                                {{$loop->iteration}}
                            </td>
                            <td class="px-4 py-3 text-sm font-bold">
                                {{ $transaction->description }}
                            </td>
                            <td class="px-4 py-3 text-sm font-bold">
                                {{ 'NGN '.number_format($transaction->amount,2) }}
                            </td>
                            <td class="px-4 py-3 text-center text-sm font-bold">
                                {{ $transaction->reference }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $transaction->payment_method }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $transaction->created_at }}
                            </td>
                            <td class="px-4 py-3 text-xs">
                                <span class="px-2 py-1 font-bold text-blue-700 bg-blue-100 rounded-full">
                                  {{ $transaction->status }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center space-x-4 text-sm">
                                    <a href="{{ route('payment-transaction', [ $card->cardProperty->identity_no, $transaction->reference]) }}" class="px-2 py-2 font-medium leading-5 uppercase text-blue-500 hover:underline">
                                        View Transaction
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr class="text-gray-700">
                            <td class="px-4 py-3">
                                <div class="flex items-center text-sm">
                                    <div>
                                        No Transaction.
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div class="items-center p-4 rounded-lg shadow-xs my-4">
        {{ $quotes['quote'] }}
        - {{ $quotes['author'] }}
    </div>

</x-app-layout>

<div >

</div>
