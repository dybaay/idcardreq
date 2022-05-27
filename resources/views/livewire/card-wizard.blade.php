<div>
    @include('layouts.status')
    <div class="max-w-3xl mx-auto px-4 py-10">
        @if($step === -1)
            <div class="bg-white rounded-lg p-10 flex items-center shadow justify-center">
                <div>
                    <svg class="mb-4 h-20 w-20 text-green-500 mx-auto" viewBox="0 0 20 20" fill="currentColor">  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>

                    <h2 class="text-2xl mb-4 text-gray-800 text-center font-bold">Card Request Successful</h2>

                    <div class="text-gray-600 mb-8 text-center">
                        Thank you. We have emailed you your card request information. Please click the button below to continue.
                    </div>

                    <button
                        wire:click="home"
                        class="w-40 block mx-auto focus:outline-none py-2 px-5 rounded-lg shadow-sm text-center text-gray-600 bg-white hover:bg-gray-100 font-medium border"
                    >View Card Now</button>
                </div>
            </div>
        @endif

            @if($step === -2)
                <div class="bg-white rounded-lg p-10 flex items-center shadow justify-center">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="mb-4 h-20 w-20 text-red-600 mx-auto" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                        <h2 class="text-2xl mb-4 text-gray-800 text-center font-bold">Card Request Error</h2>

                        <div class="text-gray-600 mb-8 text-center">
                            An error occurred with request. Please click the button below to go back.
                        </div>

                        <button
                            wire:click="back"
                            class="w-40 block mx-auto focus:outline-none py-2 px-5 rounded-lg shadow-sm text-center text-gray-600 bg-white hover:bg-gray-100 font-medium border"
                        >Go Back</button>
                    </div>
                </div>
            @endif

        @if($step !== -1 && $step !== -2)
                <!-- Top Navigation -->
                <div class="border-b-2 py-4">
                    <div class="uppercase tracking-wide text-xs font-bold text-gray-500 mb-1 leading-tight">
                        {{ $step }} of 2
                    </div>
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                        <div class="flex-1">
                            @if($step === 0)
                                <div class="text-lg font-bold text-gray-700 leading-tight">Select Card Type</div>
                            @endif
                            @if($step === 1)
                                    <div class="text-lg font-bold text-gray-700 leading-tight">Upload Required Documents</div>
                            @endif
                            @if($step === 2)
                                    <div class="text-lg font-bold text-gray-700 leading-tight">Confirm Your Information</div>
                            @endif
                        </div>

                        <div class="flex items-center md:w-64">
                            <div class="w-full bg-white rounded-full mr-2">
                                <div class="rounded-full bg-blue-500 text-xs leading-none h-2 text-center text-white" style="width: {{ ($step/2) * 100 }}%"></div>
                            </div>
                            <div class="text-xs w-10 text-gray-600">
                                {{ round(($step/2) * 100) }}%
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Top Navigation -->

                <!-- Step Content -->
                <div class="py-10">
                    @if ($errors->any())
                        <div class="py-4">
                            <div class="font-medium text-red-600">
                                {{ __('Whoops! Something went wrong.') }}
                            </div>

                            <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                                    <li>{{ $errors->first() }}</li>
                            </ul>
                        </div>
                    @endif
                    @if($step === 0)
                        <div class="mb-5">
                            <label for="card" class="font-bold mb-1 text-gray-700 block">Select Card Type</label>
                            <select required id="card" wire:model="card" class="w-full px-4 py-3 rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-gray-600 font-medium">
                                <option>Select Option</option>
                                @foreach(\App\Models\CardType::all() as $card_type)
                                    <option value="{{ $card_type->id }}">{{ $card_type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-5">
                            <label for="faculty" class="font-bold mb-1 text-gray-700 block">Select Faculty</label>
                            <select required disabled id="faculty" wire:model="faculty" class="w-full px-4 py-3 rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-gray-600 font-medium">
                                <option>Select Option</option>
                                @foreach(\App\Models\Faculty::all() as $faculty)
                                    <option value="{{ $faculty->id }}">{{ $faculty->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-5">
                            <label for="department" class="font-bold mb-1 text-gray-700 block">Select Department</label>
                            <select disabled id="department" wire:model="department" class="w-full px-4 py-3 rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-gray-600 font-medium">
                                <option>Select Option</option>
                                @foreach(\App\Models\Department::all() as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                    @if($step === 1)
                            @if(count($card_documents) > 0)
                                <div class="py-2 font-bold text-red-600">
                                    Documents are all in jpg and of max size 2MB
                                </div>
                            @endif
                            @forelse($card_documents as $doc)
                                <div class="mb-5">
                                    <label for="{{ strtolower($doc->name) }}" class="font-bold mb-1 text-gray-700 block">Upload {{ $doc->name }}</label>
                                    <input required wire:model="card_document_{{ $doc->id }}" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border
                                        border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white
                                        focus:border-blue-600 focus:outline-none" type="file" accept="image/x-png,image/gif,image/jpeg"  id="{{ strtolower($doc->name) }}">
                                </div>
                            @empty
                                No Document Needed, Please Proceed..
                            @endforelse
                    @endif
                    @if($step === 2)
                            <div class="mb-5">
                                <div class="container my-6">
                                    <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-2 my-4 md:my-0 w-full p-4 text-gray-500">
                                        <h2 class="max-w-sm">Card Type Selected: </h2>
                                        <div class="max-w-sm">
                                            <div class="w-full border">
                                                <div class="p-2 w-full border-none p-2">
                                                    {{ get_card_type_name($card) }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @foreach($card_documents as $document)
                                <div class="mb-5">
                                    <div class="container my-6">
                                        <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-2 my-4 md:my-0 w-full p-4 text-gray-500">
                                            <h2 class="max-w-sm">{{ $document->name }} Uploaded: </h2>
                                            <div class="max-w-sm">
                                                <div class="w-full border p-2">
                                                    <div class="mb-4">
                                                        @php
                                                        $name = 'card_document_'.$document->id
                                                        @endphp
                                                        <img src="{{$$name->temporaryUrl()}}" class="max-w-full h-auto rounded-lg" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                    @endif
                </div>
                <!-- / Step Content -->
        @endif
    </div>

    <!-- Bottom Navigation -->
    @if($step !== -1 && $step !== -2)
        <div class="fixed bottom-0 left-0 right-0 py-5 bg-white shadow-md">
            <div class="max-w-3xl mx-auto px-4">
                <div class="flex justify-between">
                    <div class="w-1/2">
                        @if($step > 0)
                            <button
                                wire:click="previous"
                                class="w-32 focus:outline-none py-2 px-5 rounded-lg shadow-sm text-center text-gray-600 bg-white hover:bg-gray-100 font-medium border"
                            >Previous</button>
                        @endif
                    </div>

                    <div class="w-1/2 text-right">
                        @if($step < 2)
                            <button
                                wire:click="next"
                                class="w-32 focus:outline-none border border-transparent py-2 px-5 rounded-lg shadow-sm text-center text-white bg-blue-500 hover:bg-blue-600 font-medium"
                            >Next</button>
                        @endif
                        @if($step === 2)
                            <button
                                wire:click="complete"
                                class="w-32 focus:outline-none border border-transparent py-2 px-5 rounded-lg shadow-sm text-center text-white bg-blue-500 hover:bg-blue-600 font-medium"
                            >Complete</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif
    @include('components.wizard')
</div>
