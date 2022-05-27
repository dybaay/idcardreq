<?php

namespace App\Http\Livewire;

use App\Models\Card;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use KingFlamez\Rave\Facades\Rave as Flutterwave;
use Livewire\Component;
use Livewire\WithFileUploads;

class PaymentWizard extends Component
{
    use WithFileUploads;
    public int $step;
    public $payment_methods, $bank_info, $raw_amount, $amount, $proof, $payment_method, $card, $card_code, $card_type;

    public function mount()
    {
        $this->step = 0;
        $payment_config = config('payment');
        $this->payment_methods = $payment_config['methods'];
        $this->bank_info = $payment_config['details']['bank'];
    }

    public function updatedProof()
    {
        $this->validate([
            'proof' => 'required|image',
        ],[
            'proof.required' => 'Payment proof is required',
            'proof.image' => 'Payment proof must be an image',
        ]);
    }

    public function checks_for_step_one()
    {
        try {
            $this->validate([
                'payment_method' => 'required|in:BANK,ONLINE',
            ],[
                'payment_method.required' => 'Payment method is required',
            ]);
        }
        catch (\Exception $e){
            $this->step--;
            $this->validate([
                'payment_method' => 'required|in:BANK,ONLINE',
            ],[
                'payment_method.required' => 'Payment method is required',
            ]);
        }
    }

    public function checks_for_submit()
    {
        try {
            $this->validate([
                'proof' => 'required|image',
            ],[
                'proof.required' => 'Payment proof is required',
            ]);
        }
        catch (\Exception $e){
            $this->validate([
                'proof' => 'required|image',
            ],[
                'proof.required' => 'Payment proof is required',
            ]);
        }
    }

    public function previous()
    {
        $this->step--;
    }

    public function next()
    {
        $this->step++;

        if ($this->step == 1){
            $this->checks_for_step_one();
        }
    }

    public function complete()
    {
        if ($this->payment_method == 'BANK'){
            $this->checks_for_submit();
        }
        $this->submit_form();
    }

    public function back()
    {
        $this->step = 2;
    }

    public function submit_form()
    {
        sleep(2);
        try {
            DB::transaction(function () {

                if ($this->payment_method == 'BANK'){
                    $this->card->transactions()
                        ->create([
                            'user_id' => auth()->id(),
                            'amount' => $this->raw_amount,
                            'status' => Transaction::STATUS['Pending'],
                            'payment_method' => $this->payment_method,
                            'reference' => generate_transaction_reference(),
                            'description' => 'Payment for '.$this->card_type.' via BANK',
                            'payment_proof' => $this->proof->store('payments'),
                        ]);

                    alert()->success('Success', 'Payment submitted successfully');
                    return redirect()->to(route('view-card', $this->card->cardProperty->identity_no));
                }
                else{

                    $data = [
                        'payment_options' => 'card',
                        'amount' => $this->raw_amount,
                        'email' => get_user_email(),
                        'tx_ref' => generate_transaction_reference(),
                        'currency' => "NGN",
                        'redirect_url' => route('verify-payment', $this->card_code),
                        'customer' => [
                            'email' => get_user_email(),
                            "name" => get_user_full_name()
                        ],

                        "customizations" => [
                            "title" => 'Card Payment',
                            "description" => 'Payment for '.$this->card_type,
                        ]
                    ];

                    $payment = Flutterwave::initializePayment($data);

                    if ($payment['status'] !== 'success') {
                        $this->step = -2;
                    }

                    return redirect()->to($payment['data']['link']);
                }

            });
        }
        catch (\Exception $e){
            Log::error('Payment Error: '.$e->getMessage());
            $this->step = -2;
        }
    }

    public function render()
    {
        return view('livewire.payment-wizard');
    }
}
