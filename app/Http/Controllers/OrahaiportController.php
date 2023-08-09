<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Reservation;
use App\Models\Stand;
use App\Models\Commission;
use App\Models\Scommission;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\ReservationPaidMail;
use App\Mail\ReservationInformPaidMail;
use Cookie;

class OrahaiportController extends Controller
{
    public function index()
    {
        $title = 'Accueil';
        return view('sites/index', compact('title'));
    }

    public function about()
    {
        $title = 'A Propos';
        return view('sites/pages/about', compact('title'));
    }

    public function network()
    {
        $title = 'Notre réseau commercial';
        return view('sites/pages/network', compact('title'));
    }

    public function contact()
    {
        $title = 'Nous-Contactez';
        return view('sites/pages/contact', compact('title'));
    }

    public function partners()
    {
        $title = 'Nos partenaires';
        return view('sites/pages/partners', compact('title'));
    }

    public function guide()
    {
        return response()->download(storage_path('app/public') . '/docs/Guide.pdf');
    }

    public function toPay(Reservation $reservation, $token)
    {
        if($reservation->token === $token) {
            if($reservation->transaction_id != '') {
                return redirect()->route('index')->with('danger', "Vous avez déjà réglé cette réservation.");
            } 

            $title = 'Régler le réservation';
            return view('pages/reservations/toPay', compact('title', 'reservation'));
        }
    }

    public function paid(Request $request, Reservation $reservation, $token)
    {
        if($reservation->token === $token) {
            if($reservation->pnr == null || $reservation->amount == null)
                return back()->with('danger', "Vous n'avez pas encore étudié cette réservation");

            if($reservation->transaction_id != null)
                return redirect()->route('index')->with('danger', "Vous avez déjà reglé cette réservation");

            if($request['transaction-status'] === 'approved') {

                // DB::transaction(function() {
                    $reservation->transaction_id = $request['transaction-id'];
                    $reservation->status = 'Payée';
                    $reservation->pay_by = 'Singpay';
                    $reservation->update();

                    $commission = new Commission();
                    $commission->type = "Réservation";
                    $commission->foreign_id = $reservation->id;
                    $commission->amount = $reservation->amount * 0.01;
                    $commission->save();

                    if($reservation->stand) {
                        $scommission = new Scommission();
                        $scommission->type = "Réservation";
                        $scommission->amount = amountOfStandOnReservation($reservation->amount);
                        $scommission->reservation_id = $reservation->id;
                        $scommission->stand_id = $reservation->stand->id;
                        $scommission->save();
                    }


                    $file = public_path('images/orahairport.jpeg');

                    if($reservation->stand)
                        Mail::to([['email' => Auth::user()->email, 'name' => $reservation->stand->name]])->send(new ReservationPaidMail($file));

                    Mail::to([['email' => $reservation->email, 'name' => $reservation->lastname . ' ' . $reservation->firstname]])->send(new ReservationPaidMail($file));

                    Mail::to('resa@travel-orahairport.com')->send(new ReservationInformPaidMail($file));
                // }
                return redirect()->route('index')->with('success', 'Réservation reglée avec succès.');
            } else {
                return back()->with('danger', "Vous avez annulé la transaction.");
            }
        }
    }

    public function singpay(Reservation $reservation, $token) {
        if($reservation->token === $token) {
            $ref = mt_rand(100000, 999999);
            Cookie::queue('resf', $ref, 60);
            $amount = $reservation->amount;

            $url = "https://gateway.singpay.ga/v1/ext";

            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            $headers = array(
               "accept: */*",
               "x-client-id: 3afcb469-c076-44a1-97e9-c9596787a770",
               "x-client-secret: dcd710eb6a7818565cb75216812425de462ac5ecf831d46c5a57238c8e7e2e",
               "x-wallet: 63e3b10db4bb102c62392a35",
               "Content-Type: application/json",
            );
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

            $data = <<<DATA
            {
              "portefeuille": "63e3b10db4bb102c62392a35",
              "reference": $ref,
              "redirect_success": "https://www.travel-orahairport.com/reservations/callback/$reservation->id/$reservation->token",
              "redirect_error": "https://www.travel-orahairport.com",
              "amount": $amount,
              "disbursement": "63e3b29ab4bb102c62392a75",
              "logoURL": "https://www.travel-orahairport.com/public/storage/images/slider/orahairport.jpg"
            }
            DATA;

            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

            $resp = curl_exec($curl);
            curl_close($curl);

            return $resp;
        }
    }

    public function callback($reservation, $token)
    {
        $reservation = Reservation::find($reservation);
        if($reservation->token === $token) {
            if($reservation->pnr == null || $reservation->amount == null)
                return back()->with('danger', "Vous n'avez pas encore étudié cette réservation");

            if($reservation->transaction_id != null)
                return redirect()->route('index')->with('danger', "Vous avez déjà reglé cette réservation");

            if(!\Cookie::get('resf')) {
                Session::flash('danger', "Opération pas possible.");
                return redirect()->route('home');
            }

            $ref = json_decode(Cookie::get('resf'), true);

            $url = "https://gateway.singpay.ga/v1/transaction/api/search/by-reference/$ref";

            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            $headers = array(
               "accept: */*",
               "x-client-id: 3afcb469-c076-44a1-97e9-c9596787a770",
               "x-client-secret: dcd710eb6a7818565cb75216812425de462ac5ecf831d46c5a57238c8e7e2e",
               "x-wallet: 63e3b10db4bb102c62392a35",
            );
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

            //for debug only!
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

            $resp = curl_exec($curl);
            curl_close($curl);

            $data = json_decode($resp);

            if($data->status === "Terminate") {
                $reservation->transaction_id = $data->_id;
                $reservation->status = 'Payée';
                $reservation->pay_by = 'Singpay';
                $reservation->update();

                $commission = new Commission();
                $commission->type = "Réservation";
                $commission->foreign_id = $reservation->id;
                $commission->amount = $reservation->amount * 0.01;
                $commission->save();

                if($reservation->stand) {
                    $scommission = new Scommission();
                    $scommission->type = "Réservation";
                    $scommission->amount = amountOfStandOnReservation($reservation->amount);
                    $scommission->reservation_id = $reservation->id;
                    $scommission->stand_id = $reservation->stand->id;
                    $scommission->save();
                }

                $file = public_path('images/orahairport.jpeg');

                if($reservation->stand)
                    Mail::to([['email' => Auth::user()->email, 'name' => $reservation->stand->name]])->send(new ReservationPaidMail($file));

                Mail::to([['email' => $reservation->email, 'name' => $reservation->lastname . ' ' . $reservation->firstname]])->send(new ReservationPaidMail($file));

                Mail::to('resa@travel-orahairport.com')->send(new ReservationInformPaidMail($file));
                return redirect()->route('index')->with('success', 'Réservation reglée avec succès.');

            } else {
                return back()->with('danger', "Vous avez annulé la transaction.");
            }
        } else {
            return back()->with('danger', "Il y a un problème.");
        }
    }

    public function callbackCinetpay()
    {
        // if(!\Cookie::get('ref')) {
        //     Session::flash('danger', "Opération pas possible.");
        //     return redirect()->route('home');
        // }

        // if(!\Cookie::get('stand')) {
        //     Session::flash('danger', "Opération pas possible.");
        //     return redirect()->route('home');
        // }

        // $ref = json_decode(Cookie::get('ref'), true);

        Stand::create([
            "name" => $stand['name'],
            "country_id" => $stand['country'],
            "phone" => $stand['phone'],
            "city_id" => $stand['city'],
            "quartier" => $stand['quartier'],
            "rue" => $stand['rue'],
            "reduc" => $stand['reduc'],
            "id_transfert" => 1,
            "pay_by" => "Singpay",
            "token" => Str::uuid()
        ]);

        // if($data->status === "Terminate") {
        //     $stand = json_decode(Cookie::get('stand'), true);
        //     $standStore = Stand::create([
        //         "name" => $stand['name'],
        //         "country_id" => $stand['country'],
        //         "phone" => $stand['phone'],
        //         "city_id" => $stand['city'],
        //         "quartier" => $stand['quartier'],
        //         "rue" => $stand['rue'],
        //         "reduc" => $stand['reduc'],
        //         "id_transfert" => $data->_id,
        //         "pay_by" => "Singpay",
        //         "token" => Str::uuid()
        //     ]);

        //     $subscription = new Subscription();
        //     $subscription->amount = 0;
        //     $subscription->stand_id = $standStore->id;
        //     $subscription->validator_id = Auth::id();
        //     $subscription->save();

        //     $standStore->users()->attach(Auth::user(), ['role' => 'Propriétaire', 'created_at' => now(), 'updated_at' => now(), 'default' => userStandCount(Auth::id()) == 0 ? true : false]);

        //     // Suppression des cookies
        //     Cookie::queue('stand', 0, 60);
        //     Cookie::queue('contacts', 0, 60);

        //     $file = public_path('images/orahairport.jpeg');

        //     Mail::to(Auth::user()->email)->send(new StandStoreMail($standStore, $file));
        //     Mail::to('resa@travel-orahairport.com')->send(new StandInformMail($file));

        //     return redirect()->route('stands.index')->with('success', 'Point de vente créé avec succès.');
        // } else {
        //     return back()->with('danger', "Vous n'avez pas finalisé votre demande.");
        // }
    }

    public function redirectCinetpay()
    {
        return redirect()->route('stands.index')->with('success', 'Point de vente créé avec succès.');
    }
}
