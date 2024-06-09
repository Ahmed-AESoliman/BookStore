<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePasswordRequest;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class CrearePasswordController extends Controller
{
    public function resetPassword(CreatePasswordRequest $createPasswordRequest)
    {
        $status = Password::reset(
            $createPasswordRequest->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) use ($createPasswordRequest) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
                $user->save();
                event(new PasswordReset($user));
            }
        );

        if ($status == Password::PASSWORD_RESET) {
            return redirect()->route('home')->with('status', __($status));
        } else {
            return view('create-password')->withErrors(['email' => [__($status)]])->with([
                'email' => $createPasswordRequest->email,
                'token' => $createPasswordRequest->token,
            ]);
        }
    }
}
