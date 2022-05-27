<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function show()
    {
        return view('auth.profile');
    }

    public function update(Request $request): \Illuminate\Http\RedirectResponse
    {
        $validator = Validator::make($request->all(), [
           'old_password' => 'required|string',
           'password' => 'required|string|confirmed'
        ]);

        $user = auth()->user();

        if ($validator->fails()){
            alert()->error('error',$validator->messages()->first());
            return back();
        }

        if (!Hash::check($request->old_password, $user->password)){
            alert()->error('error','Invalid old password, try again');
            return back();
        }

        $user->update(['password' => Hash::make($request->password)]);

        alert()->success('success', 'Password updated.');
        return redirect()->back();
    }
}
