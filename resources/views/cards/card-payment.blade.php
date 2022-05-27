<x-app-layout>
    <x-slot name="header">
        {{ __('Make Payment') }}
    </x-slot>

    <div class="mt-2">
        @livewire('payment-wizard', [
        'card_code' => $card_code,
        'card' => $card,
        'raw_amount' => $raw_amount,
        'amount' => $amount,
        'card_type' => $card_type
        ])
    </div>

</x-app-layout>

<div >

</div>
