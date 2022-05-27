<x-app-layout>
    <x-slot name="header">
        {{ __('My ID Cards') }}
    </x-slot>

    <div class="mt-2">
        <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                        <th class="px-4 py-3">S/N</th>
                        <th class="px-4 py-3">Faculty and Department Issued For</th>
                        <th class="px-4 py-3">Card Type</th>
                        <th class="px-4 py-3">Card ID Number</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Date Requested</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y">
                    @forelse($cards as $card)
                        <tr class="text-gray-700">
                            <td class="px-4 py-3 text-sm font-bold">
                                {{$loop->iteration}}
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center text-sm">
                                    <div>
                                        <p class="font-semibold">Faculty: {{ $card->faculty->name }}</p>
                                        <p class="text-xs text-gray-600">
                                            Department: {{ $card->department->name }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-sm font-bold">
                                {{ $card->cardType->name }}
                            </td>
                            <td class="px-4 py-3 text-center text-sm font-bold">
                                {{ $card->cardProperty->identity_no }}
                            </td>
                            <td class="px-4 py-3 text-xs">
                                <span class="px-2 py-1 font-bold text-blue-700 bg-blue-100 rounded-full">
                                  {{ $card->cardProperty->status }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $card->created_at->diffForHumans() }}
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center space-x-4 text-sm">
                                    <a href="{{ route('view-card', $card->cardProperty->identity_no) }}" class="px-2 py-2 font-medium leading-5 uppercase text-blue-500 hover:font-bold">
                                        View Card
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr class="text-gray-700">
                            <td class="px-4 py-3">
                                <div class="flex items-center text-sm">
                                    <div>
                                       No Card.
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
