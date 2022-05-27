<?php

use Illuminate\Support\Str;

if (!function_exists('str'))
{
    function str($string): \Illuminate\Support\Stringable
    {
        return \Illuminate\Support\Str::of($string);
    }
}

if (!function_exists('user_department_id'))
{
    function user_department_id()
    {
        return \Illuminate\Support\Facades\Auth::user()->department_id;
    }
}

if (!function_exists('user_department_name'))
{
    function user_department_name()
    {
        return \Illuminate\Support\Facades\Auth::user()->department->name;
    }
}

if (!function_exists('user_faculty_id'))
{
    function user_faculty_id()
    {
        return \Illuminate\Support\Facades\Auth::user()->faculty_id;
    }
}

if (!function_exists('user_faculty_name'))
{
    function user_faculty_name(): string
    {
        return \Illuminate\Support\Facades\Auth::user()->faculty->name ?? 'Not Available';
    }
}

if (!function_exists('get_card_type_name'))
{
    function get_card_type_name($id): string
    {
        return \App\Models\CardType::find($id)->name ?? 'Not Available';
    }
}

if (!function_exists('get_faculty_name'))
{
    function get_faculty_name($id): string
    {
        return \App\Models\Faculty::find($id)->name ?? 'Not Available';
    }
}

if (!function_exists('get_department_name'))
{
    function get_department_name($id): string
    {
        return \App\Models\Department::find($id)->name ?? 'Not Available';
    }
}

if (!function_exists('get_card_data_documents'))
{
    function get_card_data_documents($card_type_id)
    {
        return \App\Models\CardDocumentType::query()
                    ->where('card_type_id', $card_type_id)
                    ->get();
    }
}

if (!function_exists('generate_card_number'))
{
    function generate_card_number(): string
    {
        $card_config = config('card');
        $number = $card_config['card_prefix'].Str::random(5);
        $check = \App\Models\CardProperty::query()
                    ->where('identity_no', $number)
                    ->exists();
        if ($check){
            generate_card_number();
        }

        return $number;
    }
}

if (!function_exists('get_user_first_name'))
{
    function get_user_first_name()
    {
        return \Illuminate\Support\Facades\Auth::user()->first_name;
    }
}

if (!function_exists('get_user_last_name'))
{
    function get_user_last_name()
    {
        return \Illuminate\Support\Facades\Auth::user()->last_name;
    }
}

if (!function_exists('get_user_other_name'))
{
    function get_user_other_name()
    {
        return \Illuminate\Support\Facades\Auth::user()->other_name;
    }
}

if (!function_exists('get_user_full_name'))
{
    function get_user_full_name(): string
    {
        return get_user_first_name().' '.get_user_last_name().' '.get_user_other_name();
    }
}

if (!function_exists('get_user_identity_no'))
{
    function get_user_identity_no()
    {
        return \Illuminate\Support\Facades\Auth::user()->identity_no;
    }
}

if (!function_exists('get_user_email'))
{
    function get_user_email()
    {
        return \Illuminate\Support\Facades\Auth::user()->email;
    }
}

if (!function_exists('generate_transaction_reference'))
{
    function generate_transaction_reference(): string
    {
        $payment_config = config('payment');
        $number = $payment_config['payment_prefix'].Str::random(7);
        $check = \App\Models\Transaction::query()
            ->where('reference', $number)
            ->exists();
        if ($check){
            generate_transaction_reference();
        }
        return $number;
    }
}
