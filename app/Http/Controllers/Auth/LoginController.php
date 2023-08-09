<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use Session;
use Validator,Redirect,Response;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use Carbon\Carbon;
// use function Spatie\FlareClient\view;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function loginForm()
    {
        $title = "Connexion";
        return view('auth/login', compact('title'));
    }

    function login(Request $request){

        $request->validate([

            'email' => 'required|email',
            'password' => 'required|min:8|max:12',
        ]);

        $compte = User::whereEmail($request->email)->first();

        if($compte){

            if ($compte->email_verified_at == true) {
                if($compte->status == true){

                    $credentials = $request->only('email', 'password');

                    if(Auth::attempt($credentials)){
                        return redirect()->route('home')
                                        ->with('success',
                                        'Vous êtes bien connecté '.Auth::user()->name.' en tant que '.showRole(Auth::user()->getRoleNames()[0]).' d\'ORAHAIRPORT Travel');
                    }

                    else{

                        return back()->with('warning', 'Le mot de passe est incorrecte');
                    }

                }

                abort(403);
            }

            else
            {
                return redirect()->route('thankYou')->with('warning', 'Votre compte n\'est pas encore vérifié !');
            }

        }
        else{

            return back()->with('warning', 'Nous n\'avons pas pu trouver un compte pour votre adresse E-mail');
        }
    }
}
