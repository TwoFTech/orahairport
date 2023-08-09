<?php

namespace App\Http\Controllers;

use App\Models\PasswordResets;
use App\Http\Requests\ResetPasswordRequest;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Models\User;
use Mail;
use Hash;
use Illuminate\Support\Str;

class PasswordResetsController extends Controller
{
    /**
       * Write code on Method
       *
       * @return response()
       */
      public function show() {

        $title = "Réinitialisation de mot de passe";
         return view('auth.forgetPassword', compact('title'));
      }

      /**
       * Write code on Method
       *
       * @return response()
       */
    public function submit(ResetPasswordRequest $request) {

        $token = Str::random(64);
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send('emails.users.forgetPassword', ['token' => $token], function($message) use($request){
            $message->to($request->email);
            $message->subject('réinitialiser le mot de passe');
        });

        return back()->with('message', 'Nous avons envoyé votre lien de réinitialisation de mot de passe par email!');
      }

      /**
       * Write code on Method
       *
       * @return response()
       */
      public function showReset($token) {

        $title = 'Réinitialisation de mot de passe';
         return view('auth.forgetPasswordLink', ['token' => $token, 'title' => $title]);
      }

      /**
       * Write code on Method
       *
       * @return response()
       */
        public function submitReset(Request $request) {

            $request->validate([
                'email' => 'required|email|exists:users',
                'password' => 'required|string|min:6|confirmed',
                'password_confirmation' => 'required'
            ]);


        //   $updatePassword = DB::table('password_resets')
        //                       ->where([
        //                         'email' => $request->email,
        //                         'token' => $request->token
        //                       ])
        //                       ->first();

        //   if(!$updatePassword) {
        //       return back()->withInput()->with('error', 'Invalid token!');
        //   }

        $user = User::where('email', $request->email)
                    ->update(['password' => Hash::make($request->password)]);

        DB::table('password_resets')->where(['email'=> $request->email])->delete();

        return redirect('/login')->with('message', 'Votre mot de passe a été changé!');
      }
}
