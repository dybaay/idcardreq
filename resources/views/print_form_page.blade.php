<x-app-layout>
    <x-slot name="header">
        {{ __('Print Card Collection Form') }}
    </x-slot>

    <h2 class="mb-4 text-gray-600">Input the card number you would like to print it's form</h2>
    <div class="my-8">
        <form method="post" action="{{ route('collection_form.search') }}">
            @csrf

            <div class="mx-auto w-fit flex">
                <input name="identity" class="mr-0" type="search" placeholder="Card number" required>
                <div class="">
                    <button type="submit" class="text-white mx-auto max-w-sm ml-0  text-center bg-blue-500 py-2 px-4  focus:outline-none md:float-right">
                        <svg
                            class="h-6 w-6" fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </div>
            </div>
        </form>
    </div>
    <div class="items-center p-4 rounded-lg shadow-xs">
        {{ $quotes['quote'] }}
        - {{ $quotes['author'] }}
    </div>

</x-app-layout>

<div >

</div>
