<?php

namespace App\Http\Controllers;

use App\Models\CardProperty;
use Illuminate\Http\Request;

class CardCollectionFormController extends Controller
{
    public function search(Request $request)
    {
        $request->validate(['identity' => 'required']);
        $search = $request->input('identity');
        $card_prop = CardProperty::query()->where('identity_no', 'LIKE', "%{$search}%")->first();
        if (!$card_prop) {
            return back()->with('error', 'There is no card with this number');
        }
return view('print_out', [
    'card_prop' => $card_prop
]);
    }

}
