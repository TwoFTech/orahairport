<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Stripe;
use Cookie;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Stand;
use App\Models\User;
use App\Models\Country;
use App\Models\Commission;
use App\Models\Subscription;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;
use App\Mail\StandStoreMail;
use App\Mail\StandInformMail;


class StripeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePayment()
    {
        $title = "Paiement";
         return view('pages.stands.asks.stripe.payment', compact('title'));
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        try {
            if(!\Cookie::get('stand')) {
                Session::flash('danger', "Opération pas possible.");
                return redirect()->route('home');
            }

            if($request->reduc === 'on') {
                if(!\Cookie::get('contacts')) {
                    Session::flash('danger', "Opération pas possible.");
                    return redirect()->route('home');
                }
            }

            $error = "Le paiement n'a pas abouti.";

            $stand = json_decode(Cookie::get('stand'), true);
            if($request->reduc === 'on') {
                $contacts = unserialize(Cookie::get('contacts'));
            }

            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        
            if(isset($request->stripeToken)) {
                $customer = Stripe\Customer::create(array(
                    "address" => [
                        "line1" => $stand['name'],
                        "postal_code" => "00000",
                        "city" => $stand['city'],
                        "state" => $stand['rue'],
                        "country" => $stand['country'],
                    ],
                    "email" => Auth::user()->email,
                    "name" => Auth::user()->name,
                    "source" => $request->stripeToken
                ));

                $charge = Stripe\Charge::create ([
                    "amount" => getStandAmount(),
                    "customer" => $customer->id,
                    "currency" => "xof",
                    "description" => "Paiement Stripe." 
                ]);

                if($charge->status === 'succeeded') {
                    $standStore = Stand::create([
                        "name" => $stand['name'],
                        "country_id" => $stand['country'],
                        "phone" => $stand['phone'],
                        "city_id" => $stand['city'],
                        "quartier" => $stand['quartier'],
                        "rue" => $stand['rue'],
                        "reduc" => $stand['reduc'],
                        // "id_transfert" => $request['transaction-id'],
                        "id_transfert" => $charge->id,
                        "pay_by" => "Stripe",
                        "token" => Str::uuid()
                    ]);

                    $subscription = new Subscription();
                    $subscription->amount = 0;
                    $subscription->stand_id = $standStore->id;
                    $subscription->validator_id = Auth::id();
                    $subscription->save();

                    $standStore->users()->attach(Auth::user(), ['role' => 'Propriétaire', 'created_at' => now(), 'updated_at' => now(), 'default' => userStandCount(Auth::id()) == 0 ? true : false]);

                    // Suppression des cookies
                    Cookie::queue('stand', 0, 60);
                    Cookie::queue('contacts', 0, 60);

                    $file = public_path('images/orahairport.jpeg');

                    Mail::to(Auth::user()->email)->send(new StandStoreMail($standStore, $file));
                    Mail::to('resa@travel-orahairport.com')->cc(['ceo@travel-orahairport.com','account@travel-orahairport.com'])->send(new StandInformMail($file));

                    return redirect()->route('stands.index')->with('success', 'Point de vente créé avec succès.');
                }
            }

        } catch (\Stripe\Exception\CardException $e) {

            error_log("Une erreur de paiement s'est produite: {$e->getError()->message}");

            if($e->getError()->code == 'card_declined')
                $error = 'Votre carte a été rejetée.';

            if($e->getError()->code == 'expired_card')
                $error = 'Votre carte a expiré.';

            if($e->getError()->code == 'incorrect_cvc')
                $error = 'Le code CVC de votre carte est incorrecte.';

            if($e->getError()->code == 'processing_error')
                $error = "Une erreur s'est produite, le paiement n'a pas abouti.";

            if($e->getError()->code == 'incorrect_number')
                $error = "Le numéro de votre carte est incorrecte.";

        } catch (\Stripe\Exception\InvalidRequestException $e) {

            error_log("Une demande invalide s'est produite.");

        } catch (Exception $e) {

            error_log("Un autre problème est survenu, peut-être sans rapport avec Stripe.");

        }

        return back()->with('error', $error);
    }
}
