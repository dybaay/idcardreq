<div>
    @include('layouts.status')
    <div class="max-w-3xl mx-auto px-4 py-10">

        @if($step === -2)
            <div class="bg-white rounded-lg p-10 flex items-center shadow justify-center">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="mb-4 h-20 w-20 text-red-600 mx-auto" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                    <h2 class="text-2xl mb-4 text-gray-800 text-center font-bold">Payment Error</h2>

                    <div class="text-gray-600 mb-8 text-center">
                        An error occurred with your payment. Please click the button below to go back.
                    </div>

                    <button
                        wire:click="back"
                        class="w-40 block mx-auto focus:outline-none py-2 px-5 rounded-lg shadow-sm text-center text-gray-600 bg-white hover:bg-gray-100 font-medium border"
                    >Go Back</button>
                </div>
            </div>
        @endif

        @if($step !== -2)
        <!-- Top Navigation -->
            <div class="border-b-2 py-4">
                <div class="uppercase tracking-wide text-xs font-bold text-gray-500 mb-1 leading-tight">
                    {{ $step }} of 2
                </div>
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div class="flex-1">
                        @if($step === 0)
                            <div class="text-lg font-bold text-gray-700 leading-tight">Select Payment Method</div>
                        @endif
                        @if($step === 1)
                            <div class="text-lg font-bold text-gray-700 leading-tight">Verify Payment Information</div>
                        @endif
                        @if($step === 2)
                            <div class="text-lg font-bold text-gray-700 leading-tight">Proceed With Payment</div>
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
                        <label for="payment_method" class="font-bold mb-1 text-gray-700 block">Select Payment Method</label>
                        <select required id="payment_method" wire:model="payment_method" class="w-full px-4 py-3 rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-gray-600 font-medium">
                            <option>Select Option</option>
                            @foreach($payment_methods as $method)
                                <option value="{{ $method }}">{{ $method }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
                @if($step === 1)
                        <div class="mb-5">
                            <div class="container my-6">
                                <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-2 my-4 md:my-0 w-full p-4 text-gray-500">
                                    <h2 class="max-w-sm">Payment Method Selected: </h2>
                                    <div class="max-w-sm">
                                        <div class="w-full border">
                                            <div class="p-2 w-full border-none p-2">
                                                {{ $payment_method }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-5">
                            <div class="container my-6">
                                <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-2 my-4 md:my-0 w-full p-4 text-gray-500">
                                    <h2 class="max-w-sm">Full Name: </h2>
                                    <div class="max-w-sm">
                                        <div class="w-full border">
                                            <div class="p-2 w-full border-none p-2">
                                                {{ get_user_full_name() }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-5">
                            <div class="container my-6">
                                <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-2 my-4 md:my-0 w-full p-4 text-gray-500">
                                    <h2 class="max-w-sm">Email Address: </h2>
                                    <div class="max-w-sm">
                                        <div class="w-full border">
                                            <div class="p-2 w-full border-none p-2">
                                                {{ get_user_email() }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-5">
                            <div class="container my-6">
                                <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-2 my-4 md:my-0 w-full p-4 text-gray-500">
                                    <h2 class="max-w-sm">Amount: </h2>
                                    <div class="max-w-sm">
                                        <div class="w-full border">
                                            <div class="p-2 w-full border-none p-2">
                                                {{ $amount }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-5">
                            <div class="container my-6">
                                <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-2 my-4 md:my-0 w-full p-4 text-gray-500">
                                    <h2 class="max-w-sm">Payment For (Card Type): </h2>
                                    <div class="max-w-sm">
                                        <div class="w-full border">
                                            <div class="p-2 w-full border-none p-2">
                                                {{ $card_type }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                @endif
                @if($step === 2)
                        @if($payment_method == 'BANK')
                            <div class="mb-5">
                                <div class="container my-6">
                                    <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-2 my-4 md:my-0 w-full p-4 text-gray-500">
                                        <h2 class="max-w-sm">Make Deposit To: </h2>
                                        <div class="max-w-sm">
                                            @foreach($bank_info as $key => $bank)
                                            <div class="w-full border">
                                                <div class="p-2 w-full border-none p-2">
                                                    {{ $key }}: {{ $bank }}
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if($proof)
                                <div class="mb-5">
                                    <div class="container my-6">
                                        <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-2 my-4 md:my-0 w-full p-4 text-gray-500">
                                            <h2 class="max-w-sm">Preview: </h2>
                                            <div class="max-w-sm">
                                                <div class="w-full border p-2">
                                                    <div class="mb-4">
                                                        <img src="{{$proof->temporaryUrl()}}" class="max-w-full h-auto rounded-lg" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="mb-5">
                                <label for="payment_proof" class="font-bold mb-1 text-gray-700 block">Upload Payment Receipt</label>
                                <input required wire:model="proof" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border
                                        border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white
                                        focus:border-blue-600 focus:outline-none" type="file" accept="image/x-png,image/gif,image/jpeg"  id="payment_proof">
                            </div>
                        @else
                            <div class="text-gray-600 mb-8 text-center">
                                You will be redirected to our payment provider to complete payment. Please click the proceed button below to continue.
                            </div>
                        @endif
                @endif
            </div>
            <!-- / Step Content -->
        @endif
    </div>

    <!-- Bottom Navigation -->
    @if($step !== -2)
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
                            >Proceed</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif
    @include('components.wizard')
</div>

