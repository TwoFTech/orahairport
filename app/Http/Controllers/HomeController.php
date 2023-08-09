<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Carbon\Carbon;
use App\Models\User;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {

        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        $title = 'Tableau de bord';
        return view('home', compact('title'));
    }

    public function profil() {
        $title = 'Profil';
        return view('pages/profil.profil', compact('title'));
    }

    public function logout() {
        Session::flush();
        Auth::logout();
        return back();
    }

    public function profilUpdate(Request $request)
    {
        $request->validate([
            'name' => 'required|string'
        ]);
        if(Auth::user()->name != $request->name)
        {

            Auth::user()->update([
                'name' => $request->name,
                'updated_at' => Carbon::now(),
            ]);
            return back()->with('success', 'Votre nom a été bien modifié');
        }

        return back()->with('danger', 'Veuillez changer votre nom pour effectuer cette operation');
    }

    public function resetPassword()
    {
        $title = 'Réinitialiser mot de passe';
        return view('auth/passwords/reset', compact('title'));
    }

    public function passwordUpdate(Request $request, User $user)
    {
        $request->validate([
            'oldPassword' => ['required', 'string'],
            'password' => ['required', 'string', 'confirmed', Password::min(8)->mixedCase()->numbers()->uncompromised()]
        ]);

        $user_password = Auth::user()->password;

        if (\Hash::check($request->oldPassword, $user_password)) {

            if (!\Hash::check($request->password, $user_password)) {
                $user = User::find(Auth::user()->id);

                $user->update([
                    'password' => bcrypt($request->password),
                    'updated_at' => Carbon::now(),
                ]);

                Session::flush();
                Auth::logout();
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

    public function cgv() {
        $title = 'Les Conditions Générales de Vente';
        return view('pages.rgpd.cgv', compact('title'));
    }
}
