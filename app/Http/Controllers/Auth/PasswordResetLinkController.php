<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'identity' => ['required']
        ]);
        $user = User::select('email')->where('email', $request->identity)
            ->orWhere('identity_no', $request->identity)->first();

        if (!$user) {
            return back()
                ->withInput($request->only('identity'))
                ->withErrors(['identity' => 'This user does not exist']);

        }
        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            ['email' => $user->email]
        );

        return $status == Password::RESET_LINK_SENT
                    ? back()->with('status', 'We have emailed your password reset link to '.$user->email)
                    : back()->withInput($request->only('identity'))
                            ->withErrors(['identity' => __($status)]);
    }
}
