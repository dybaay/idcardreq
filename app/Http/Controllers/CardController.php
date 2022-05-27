<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use KingFlamez\Rave\Facades\Rave as Flutterwave;


class CardController extends Controller
{

    public function index()
    {
        $user_id = Auth::id();
        $cards = Card::query()
                    ->with([
                        'cardType','faculty',
                        'department','cardProperty'
                    ])
                    ->where('user_id', $user_id)
                    ->orderByDesc('created_at')
                    ->get();
        return view('cards.my-cards', [
            'cards' => $cards
        ]);
    }

    public function view($card_code)
    {
        $user_id = Auth::id();
        $card = Card::query()
                    ->with([
                        'cardType', 'cardProperty',
                        'cardDocuments', 'transactions',
                        'faculty', 'department', 'user'
                    ])
                    ->whereHas('cardProperty', function ($query) use ($card_code){
                        return $query->where('identity_no', $card_code);
                    })
                    ->where('user_id', $user_id)
                    ->first();
        if (!$card){
            alert()->error('error','This card does not exist');
            return redirect(route('my-cards'));
        }

        return view('cards.view-card', [
            'card' => $card
        ]);
    }

    public function request_card()
    {
        return view('cards.request-card');
    }

    public function status()
    {
        return view('cards.card-status');
    }

    public function check_status(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'identity_number' => 'required|exists:card_properties,identity_no'
        ]);

        if ($validator->fails()){
            alert()->error('error', $validator->messages()->first());
            return back();
        }

        $identity_number = $request->identity_number;
        $user_id = Auth::id();
        $card = Card::query()
                ->with([
                    'cardDocuments' => function($query){
                        return $query->with(['cardDocumentType']);
                    },
                    'transactions','cardType', 'cardProperty',
                    'faculty', 'department', 'user'
                ])
                ->whereHas('cardProperty', function ($query) use ($identity_number){
                    return $query->where('identity_no', $identity_number);
                })
                ->where('user_id', $user_id)
                ->first();

        if (!$card){
            alert()->error('error', 'This card doesn\'t belong to you.');
            return back();
        }

        return view('cards.view-card', [
            'card' => $card
        ]);
    }

    public function payment($card_code)
    {
        $user_id = auth()->id();
        $card = Card::query()
            ->with([
                'transactions','cardType',
                'cardProperty',
            ])
            ->whereHas('cardProperty', function ($query) use ($card_code) {
                return $query->where('identity_no', $card_code);
            })
            ->where('user_id', $user_id)
            ->first();

        if (!$card){
            alert()->error('Error', 'This card does not exist');
            return redirect()->to(route('my-cards'));
        }

        $a_success_transaction_exists = $card->transactions()
            ->where('status', Transaction::STATUS['Successful'])
            ->exists();

        if ($a_success_transaction_exists){
            alert()->error('Error', 'This card already have a successful payment, contact support for more info');
            return redirect()->to(route('view-card', $card->cardProperty->identity_no));
        }

        $raw_amount = $card->cardType->price;

        if ($raw_amount == 0){
            alert()->error('Error', 'This card does not require payment');
            return redirect()->to(route('my-cards'));
        }
        $card_type = $card->cardType->name;
        $amount = 'NGN '.number_format($raw_amount,2);

        return view('cards.card-payment', [
            'card_code' => $card_code,
            'card' => $card,
            'raw_amount' => $raw_amount,
            'amount' => $amount,
            'card_type' => $card_type,
        ]);
    }

    public function verify_payment(Request $request, $card_code)
    {
        $status = $request->status;
        $user_id = auth()->id();
        $card = Card::query()
            ->with([
                'cardProperty','cardType'
            ])
            ->whereHas('cardProperty', function ($query) use ($card_code) {
                return $query->where('identity_no', $card_code);
            })
            ->where('user_id', $user_id)
            ->first();

        if (!$card){
            alert()->error('Error', 'This card does not exist, contact support');
            return redirect(route('my-cards'));
        }

        if ($status ==  'successful') {

            try {
                $transactionID = Flutterwave::getTransactionIDFromCallback();
                $payment = Flutterwave::verifyTransaction($transactionID);

                DB::transaction(function () use ($card, $payment) {

                    $card->transactions()->updateOrCreate(
                        [
                            'reference' => $payment['data']['tx_ref'],
                        ],
                        [
                            'user_id' => auth()->id(),
                            'amount' => $payment['data']['amount'],
                            'status' => ucwords($payment['data']['status']),
                            'payment_method' => 'ONLINE',
                            'reference' => $payment['data']['tx_ref'],
                            'description' => 'Payment for '.$card->cardType->name.' via '.$payment['data']['payment_type'],
                            'payment_proof' => null,
                        ]);

                });

                alert()->success('Success', 'Payment successful');
                return redirect(route('view-card', $card_code));
            }
            catch (\Exception $e){
                Log::error('Payment Transaction Error: '.$e->getMessage());

                alert()->error('Error', 'An error occurred with payment, contact support');
                return redirect(route('view-card', $card_code));
            }

        }
        elseif ($status ==  'cancelled'){
            alert()->error('Error', 'Payment was canceled');
            return redirect(route('view-card', $card_code));
        }
        else{
            alert()->error('Error', 'Payment not successful');
            return redirect(route('view-card', $card_code));
        }
    }

    public function payment_transaction($card_code, $ref)
    {
        $user_id = auth()->id();
        $card = Card::query()
            ->with([
                'cardProperty','cardType',
                'transactions' => function($query) use ($ref) {
                    return $query->where('reference', $ref);
                }
            ])
            ->whereHas('cardProperty', function ($query) use ($card_code) {
                return $query->where('identity_no', $card_code);
            })
            ->whereHas('transactions', function ($query) use ($ref) {
                return $query->where('reference', $ref);
            })
            ->where('user_id', $user_id)
            ->first();

        if (!$card){
            alert()->error('Error', 'This card/transaction does not exist, contact support');
            return redirect(route('my-cards'));
        }

        $transaction = $card->transactions->first();

        return view('cards.transaction', [
            'card' => $card,
            'transaction' => $transaction
        ]);
    }

    public function download_transaction($card_code, $ref)
    {
        $user_id = auth()->id();
        $card = Card::query()
            ->with([
                'cardProperty','cardType',
                'transactions' => function($query) use ($ref) {
                    return $query->where('reference', $ref);
                }
            ])
            ->whereHas('cardProperty', function ($query) use ($card_code) {
                return $query->where('identity_no', $card_code);
            })
            ->whereHas('transactions', function ($query) use ($ref) {
                return $query->where('reference', $ref);
            })
            ->where('user_id', $user_id)
            ->first();

        if (!$card){
            alert()->error('Error', 'This card/transaction does not exist, contact support');
            return back();
        }

        $transaction = $card->transactions->first();

        $data = [
            'card' => $card,
            'transaction' => $transaction
        ];

        $pdf = PDF::loadView('cards.pdf.transaction-pdf', $data);

        return $pdf->download($transaction->reference.'-transaction.pdf');
    }

    public function check_collection()
    {
        return view('cards.card-collection');
    }

    public function download_collection(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'identity_number' => 'required|exists:card_properties,identity_no'
        ]);

        if ($validator->fails()){
            alert()->error('error', $validator->messages()->first());
            return back();
        }

        $identity_number = $request->identity_number;
        $user_id = Auth::id();
        $card = Card::query()
            ->with(['cardType', 'cardProperty',
                'faculty', 'department'
            ])
            ->whereHas('cardProperty', function ($query) use ($identity_number){
                return $query->where('identity_no', $identity_number);
            })
            ->where('user_id', $user_id)
            ->first();

        if (!$card){
            alert()->error('error', 'This card doesn\'t belong to you.');
            return back();
        }

        $data = [
            'card' => $card
        ];

        $pdf = PDF::loadView('cards.pdf.collection-pdf', $data);

        return $pdf->download($identity_number.'-collection.pdf');
    }
}
