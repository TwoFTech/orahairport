<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\Inscription;

use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Str;
use Carbon\Carbon;

class SecurityController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // Fonction de la page de remerciement
    public function thankYou($email = null)
    {
        $title = 'Confirmation de compte';
        $user = User::whereEmail($email)->first();

        if($user != null)
        {
            if($user->email_verified_at == true)
            {
                return redirect()->route('loginForm')->with('message', 'Votre compte a déjà été vérifié');
            }
            return view('auth.thankYou', compact('email', 'title'));
        }

        abort(401);
    }

    // Fonction de renvoi de mail de vérification lors de l'inscription
    public function resendEmail(Request $request)
    {
        $request->validate([
            'email' => 'required | email'
        ]);

        $user = User::whereEmail($request->email)->first();

        if($user != null)
        {
            if($user->email_verified_at == true)
            {
                return redirect()->route('loginForm')->with('message', 'Votre compte a déjà été vérifié');
            }

            $file = storage_path('app/public') . '/docs/Guide.pdf';

            Mail::to($request->email)->send(new Inscription($user, $file));
            return back()->with('success', 'Un nouveau message de vérification de mail a été renvoyé à l\'adresse e-mail: '.$user->email);
        }

    }

    // Fonction de vérification de compte
    public function verifyEmail($email, $token)
    {
        $account = User::whereEmail($email)->first();

        if($account != null)
        {
            if($account->token == $token)
            {

                $account->update([
                    'token' => null,
                    'email_verified_at' => true,
                    'status' => true,
                    'updated_at' => Carbon::now(),
                ]);

                return redirect()->route('loginForm')->with('success', 'Votre compte a été bien confirmé.');

            }

            abort(403);
        }

        return redirect()->route('loginForm')->with('danger', 'Nous n\avons jamais envoyé un message de confirmation à cette adresse E-mail.');
    }

    public function adhesion($email)
    {
        $account = User::whereEmail($email)->first();

        if($account)
        {
            if($account->token != null)
            {
                $title = 'Mot de Pase d\'adhésion';
                $token = $account->token;
                return view('auth.admin.resetPassword', compact('title', 'email', 'token'));
            }

            return redirect()->route('loginForm')->with('info', 'Votre adhésion est déjà validée.');
        }

        abort(401);
    }

    public function adhesionValidate(Request $request, $email, $token)
    {
        $request->validate([
            'oldPassword' => ['required', 'string'],
            'password' => ['required', 'string', 'confirmed', Password::min(8)->mixedCase()->numbers()->uncompromised()]
        ]);

        $user = User::whereEmail($email)->first();

        $user_password = $user->password;

        if (\Hash::check($request->oldPassword, $user_password)) {

            if (!\Hash::check($request->password, $user_password)) {

                $user->update([
                    'status' => true,
                    'token' => null,
                    'email_verified_at' => true,
                    'password' => bcrypt($request->password),
                    'updated_at' => Carbon::now(),
                ]);

                return redirect()->route('loginForm')->with('success', 'Votre mot de passe a été bien modifié, connectez-vous pour continuer');
            }
            else{

                return back()->with('warning', 'Le nouveau mot de passe ne peut pas être l\'ancien mot de passe');
            }
        }
        else{

            return back()->with('danger', 'Votre ancien mot de passe ne correspond pas !');
        }
    }
}
