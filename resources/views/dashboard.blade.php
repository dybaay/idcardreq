<x-app-layout>
    <x-slot name="header">
        {{ __('Dashboard') }}
    </x-slot>

    <div class="p-2 border-l-4 border-blue-500">
         {!! $salutation !!}
    </div>

    <div class="mt-2 grid gap-6 mb-8 md:grid-cols-1 xl:grid-cols-2">
        <div class="p-2">
            <a href="{{ route('request-card') }}" class="my-6 flex items-center p-4 bg-white rounded-lg shadow-xs hover:bg-gray-100">
                <!-- Nav Icon -->
                <div class="rounded-xl bg-blue-100 px-3">
                    <svg class="w-16 h-16 text-blue-500" aria-hidden="true" fill="none" stroke-linecap="round"
                         stroke-linejoin="round" stroke-width="1" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                </div>
                <!-- Text -->
                <div class="grow flex flex-col pl-5 pt-2">
                    <div class="font-bold text-blue-500 text-lg group-hover:underline">
                        Request ID Card
                    </div>
                    <div class="font-semibold text-sm
                            text-gray-400 group-hover:text-gray-500
                            transition-all duration-200 delay-100">
                        Make request for a new, lost or stolen card.
                    </div>
                </div>
                <!-- Chevron -->
                <svg xmlns="http://www.w3.org/2000/svg" class="mt-4 ml-4 h-6 w-6 mdi mdi-chevron-right text-gray-400 mdi-24px my-auto pr-2
                        group-hover:text-gray-700 transition-all duration-200 delay-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                </svg>
            </a>
        </div>

        <div class="p-2">
            <a href="{{ route('card-status') }}" class="my-6 flex items-center p-4 bg-white rounded-lg shadow-xs  hover:bg-gray-100">
                <!-- Nav Icon -->
                <div class="rounded-xl bg-blue-100 px-3">
                    <svg class="w-16 h-16 text-blue-500" aria-hidden="true" fill="none" stroke-linecap="round"
                         stroke-linejoin="round" stroke-width="1" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                    </svg>
                </div>
                <!-- Text -->
                <div class="grow flex flex-col pl-5 pt-2">
                    <div class="font-bold text-blue-500 text-lg group-hover:underline">
                        Check Card Status
                    </div>
                    <div class="font-semibold text-sm text-gray-400 group-hover:text-gray-500
                            transition-all duration-200 delay-100">
                        Check card status.
                    </div>
                </div>
                <!-- Chevron -->
                <svg xmlns="http://www.w3.org/2000/svg" class="mt-4 ml-4 h-6 w-6 mdi mdi-chevron-right text-gray-400 mdi-24px my-auto pr-2
                        group-hover:text-gray-700 transition-all duration-200 delay-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                </svg>
            </a>
        </div>

        <div class="p-2">
            <a href="#" class="my-6 flex items-center p-4 bg-white rounded-lg shadow-xs hover:bg-gray-100">
                <!-- Nav Icon -->
                <div class="rounded-xl bg-blue-100 px-3">
                    <svg class="w-16 h-16 text-blue-500" aria-hidden="true" fill="none" stroke-linecap="round"
                         stroke-linejoin="round" stroke-width="1" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                    </svg>
                </div>
                <!-- Text -->
                <div class="grow flex flex-col pl-5 pt-2">
                    <div class="font-bold text-blue-500 text-lg group-hover:underline">
                        Print Collection Form
                    </div>
                    <div class="font-semibold text-sm text-gray-400 group-hover:text-gray-500
                            transition-all duration-200 delay-100">
                        Print ID Card Collection form seamlessly
                    </div>
                </div>
                <!-- Chevron -->
                <svg xmlns="http://www.w3.org/2000/svg" class="mt-4 ml-4 h-6 w-6 mdi mdi-chevron-right text-gray-400 mdi-24px my-auto pr-2
                        group-hover:text-gray-700 transition-all duration-200 delay-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                </svg>
            </a>
        </div>

        <div class="p-2">
            <a href="{{ route('profile.show') }}" class="my-6 flex items-center p-4 bg-white rounded-lg shadow-xs hover:bg-gray-100">
                <!-- Nav Icon -->
                <div class="rounded-xl bg-blue-100 px-3">
                    <svg class="w-16 h-16 text-blue-500" aria-hidden="true" fill="none" stroke-linecap="round"
                         stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <!-- Text -->
                <div class="grow flex flex-col pl-5 pt-2">
                    <div class="font-bold text-blue-500 text-lg group-hover:underline">
                        My Profile
                    </div>
                    <div class="font-semibold text-sm text-gray-400 group-hover:text-gray-500
                            transition-all duration-200 delay-100">
                       View and update your profile.
                    </div>
                </div>
                <!-- Chevron -->
                <svg xmlns="http://www.w3.org/2000/svg" class="mt-4 ml-4 h-6 w-6 mdi mdi-chevron-right text-gray-400 mdi-24px my-auto pr-2
                        group-hover:text-gray-700 transition-all duration-200 delay-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                </svg>
            </a>
        </div>

    </div>

    <div class="items-center p-4 rounded-lg shadow-xs">
        {{ $quotes['quote'] }}
        - {{ $quotes['author'] }}
    </div>

</x-app-layout>

<div >

</div>
