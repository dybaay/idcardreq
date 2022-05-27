<x-app-layout>
    <x-slot name="header">
        {{ __('Print Collection Form') }}
    </x-slot>

    <div class="container">
        <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-2 my-4 md:my-0 w-full p-4 text-gray-500">
            <h2 class="max-w-sm">Enter Card Number</h2>
            <div>
                <form action="{{ route('collection-pdf') }}" method="get">
                    @csrf
                    <div class="max-w-sm">
                        <div class="w-full inline-flex border">
                            <div class="p-2 bg-opacity-50 mt-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 text-gray-400 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                </svg>
                            </div>
                            <div class="p-2 w-full border-none">
                                <input
                                    style="border: none"
                                    type="text"
                                    name="identity_number"
                                    class="p-2 focus:outline-none"
                                    placeholder="Type Card Number"
                                />
                            </div>
                        </div>
                    </div>

                    <div class="max-w-sm">
                        <div class="inline-flex">
                            <div class="p-2">
                                <button
                                    type="submit"
                                    class="text-white w-full mx-auto max-w-sm rounded-md text-center bg-blue-500 py-2 px-4 inline-flex items-center focus:outline-none md:float-right">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 text-white mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                    </svg>
                                    Download Form
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


</x-app-layout>

<div >

</div>


