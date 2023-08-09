<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StandStoreRequest;
use App\Http\Requests\ContactStoreRequest;
use App\Http\Requests\StandUpdateRequest;
use App\Http\Requests\DelegateStandRequest;
use Cookie;
use App\Models\Stand;
use App\Models\User;
use App\Models\Country;
use App\Models\Commission;
use App\Models\Subscription;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\StandStoreMail;
use App\Mail\StandInformMail;
use App\Mail\StandValidatedMail;
use App\Mail\StandAddingManagerMail;
use Illuminate\Support\Str;
use Session;
use Illuminate\Support\MessageBag;

class StandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = Auth::user()->getRoleNames();
        $stands = [];
        if($role[0] === "manager" || $role[0] === "dev" || $role[0] === "resa" || $role[0] === "admin" || $role[0] === "account-manager") {
            $stands = Stand::orderBy('id', 'desc')->get();
        } else if($role[0] === "merchant") {
            $stands = Auth::user()->stands->sortByDesc('id');
        } else {
            Stand::orderBy('id', 'desc')->get();
        };
        $title = 'Liste des demandes';
        return view('pages/stands/asks/index', compact('title', 'stands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($state = null)
    {
        $standExists = Auth::user()->stands()->whereStatus(false)->exists();
        if($standExists)
            return back()->with('danger', 'Vous avez une demande de point de vente en cours.');

        //if(Auth::user()->getRoleNames()[0] == 'admin' || Auth::user()->getRoleNames()[0] == 'dev' || Auth::user()->getRoleNames()[0] == 'admin-vente' || Auth::user()->getRoleNames()[0] == 'manager')
        //if(Auth::user()->getRoleNames()[0] == 'dev')
            //return back()->with('danger', 'Vous devez faire une demande de point de vente avec un compte non dev.');

        if(userStandCount(Auth::id()) >= 3) {
            return back()->with('danger', "Vous avez déjà atteint le nombre maximal de point de vente.");
        } else {
            $title = 'Demande de point de Vente';
            $stand = ['name' => null, 'phone' => null, 'country' => null, 'rue' => null, 'city' => null, 'quartier' => null, 'reduc' => null];
            if(\Cookie::get('stand') && $state == "edit") {
                $stand = json_decode(Cookie::get('stand'), true);
                // dd($stand);
            } else {
                Cookie::queue('stand', 0, 60);
                Cookie::queue('contacts', 0, 60);
            }
        }

        return view('pages/stands/asks/create', compact('title', 'stand'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StandStoreRequest $request)
    {
        $stand = new Stand();
        $stand->name = $request['enseigne'];
        $stand->phone = $request['phone'];
        $stand->country = $request['country'];
        $stand->city = $request['city'];
        $stand->quartier = $request['quartier'];
        $stand->rue = $request['rue'];
        $stand->reduc = $request['reduc'];

        Cookie::queue('stand', $stand, 60);

        if($stand->reduc === "on") {
            return redirect()->route('stands.contacts');
        } else {
            return redirect()->route('stands.payment');
        }
    }

    public function contacts() {
        if(!\Cookie::get('stand')) {
            Session::flash('danger', "Opération pas possible.");
            return redirect()->route('home');
        }

        if(\Cookie::get('contacts') && count(unserialize(\Cookie::get('contacts'))) >= 5) {
            return redirect()->route('stands.payment');
        }

        $stand = json_decode(Cookie::get('stand'), true);

        $title = "Renseignez les 5 contacts pour bénéficier de la réduction";
        return view('pages/stands/asks/contacts', compact('title', 'stand'));
    }

    public function sendContacts(ContactStoreRequest $request, MessageBag $messageBag) {
        if(!\Cookie::get('stand')) {
            Session::flash('danger', "Opération pas possible.");
            return redirect()->route('home');
        }

        $contact = $request->name . '@xfokl' . $request->phone;

        if(!\Cookie::get('contacts')) {
            $contacts = [];
        } else {
            $contacts = unserialize(Cookie::get('contacts'));

            if(count($contacts) >= 3) {
                return redirect()->route('stands.payment')->with('success', "Vous avez déjà fourni les 3 contacts !");
            }

            $stand = json_decode(Cookie::get('stand'), true);
            for($i = 0; $i < count($contacts); $i++) {
                if(strpos($contacts[$i], $request->phone) !== false){
                    $messageBag->add('phone', "Vous avez déjà renseigné ce numéro de téléphone.");
                    break;
                }
            }

            if(sizeof($messageBag->messages()) > 0)
                return back()->withErrors($messageBag)->withInput();
        }
        array_push($contacts, $contact);

        Cookie::queue('contacts', serialize($contacts), 60);

        if(count($contacts) >= 3) {
            return redirect()->route('stands.payment');
            return back()->with('success', "Les 5 contacts ont été bien pris en compte !");
            Session::flash('success', "Les 5 contacts ont été bien pris en compte !");
        }

        Session::flash('success', "Contact ajouté avec succès.");
        return back()->with('success', 'Contact ajouté avec succès');

    }

    public function payment() {
        if(!\Cookie::get('stand')) {
            Session::flash('danger', "Opération pas possible.");
            return redirect()->route('home');
        }

        $stand = json_decode(Cookie::get('stand'), true);

        if($stand['reduc'] === "on")
            $title = "Payez pour obtenir un abonnement d'un an sur votre demande (avec 20% réduction)";
        else
            $title = "Payez pour obtenir un abonnement d'un an sur votre demande (sans réduction)";

        return view('pages/stands/asks/payments', compact('title', 'stand'));
    }

    public function pay(Request $request) {
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

        if($request['transaction-status'] === 'approved') {
            $stand = json_decode(Cookie::get('stand'), true);
            if($request->reduc === 'on') {
                $contacts = unserialize(Cookie::get('contacts'));
            }

            // /* Remplacez VOTRE_CLE_API par votre véritable clé API */
            // \FedaPay\FedaPay::setApiKey("pk_live_3C2-et5Xf21F8qqLsm8hIoex");

            // /* Précisez si vous souhaitez exécuter votre requête en mode test ou live */
            // \FedaPay\FedaPay::setEnvironment('sandbox'); //ou setEnvironment('live');

            // /* Créer un dépôt */
            // \FedaPay\Payout::create(array(
            //   "amount" => 6000,
            //   // "currency" : {"iso" : "XOF"},
            //   "mode" => "mtn",
            //   "customer" => [
            //       "firstname" => "Forester",
            //       "lastname" => "CODJO",
            //       "email" => "resa@travel-orahairport.com",
            //       "phone_number" => [
            //           "number" => "+22962691850",
            //           "country" => "bj"
            //       ]
            //   ]
            // ));

            // Envoi du dépôt maintenant
            //$payout->sendNow();

            // DB::transaction(function() {
                $standStore = Stand::create([
                    "name" => $stand['name'],
                    "country_id" => $stand['country'],
                    "phone" => $stand['phone'],
                    "city_id" => $stand['city'],
                    "quartier" => $stand['quartier'],
                    "rue" => $stand['rue'],
                    "reduc" => $stand['reduc'],
                    // "id_transfert" => $request['transaction-id'],
                    "id_transfert" => 'null',
                    "pay_by" => "Fedapay",
                    "token" => Str::uuid()
                ]);

                $subscription = new Subscription();
                $subscription->amount = 0;
                $subscription->stand_id = $standStore->id;
                $subscription->validator_id = Auth::id();
                $subscription->save();

                if($request->reduc === 'on') {
                    foreach ($contacts as $index => $contact) {
                        Contact::create([
                            'name' => explode('@xfokl', $contact)[0],
                            'phone' => explode('@xfokl', $contact)[1],
                            'subscription_id' => $subscription->id,
                        ]);
                    }
                }

                $standStore->users()->attach(Auth::user(), ['role' => 'Propriétaire', 'created_at' => now(), 'updated_at' => now(), 'default' => userStandCount(Auth::id()) == 0 ? true : false]);

                // Suppression des cookies
                Cookie::queue('stand', 0, 60);
                Cookie::queue('contacts', 0, 60);

                $file = public_path('images/orahairport.jpeg');

                Mail::to(Auth::user()->email)->send(new StandStoreMail($standStore, $file));
                Mail::to('resa@travel-orahairport.com')->cc(['ceo@travel-orahairport.com','account@travel-orahairport.com'])->send(new StandInformMail($file));

            // }
            return redirect()->route('stands.index')->with('success', 'Point de vente créé avec succès.');
        } else {
            return back()->with('danger', "Vous n'avez pas finalisé votre demande.");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Stand $stand, $token)
    {
        if($stand->token === $token) {
            $title = 'Consulter un point de vente';
            return view('pages/stands/asks/show', compact('title', 'stand'));
        } else {
            abort(403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Stand $stand, $token)
    {
        if($stand->token === $token) {
            if($stand->status)
            return redirect()->route('stands.index')->with('danger', 'Vous ne pouvez plus modifier ce point de vente !');

            $title = 'Consulter un point de vente';
            return view('pages/stands/asks/edit', compact('title', 'stand'));
        } else {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StandUpdateRequest $request, Stand $stand, $token)
    {
        if($stand->token === $token) {
            if(isResa() || isBusinessDev() || isPrivate())
            {

                $stand->update([
                    'name' => $request['enseigne'],
                    'phone' => $request['phone'],
                    'country_id' => $request['country'],
                    'city_id' => $request['city'],
                    'quartier' => $request['quartier'],
                    'rue' => $request['rue']
                ]);

               return redirect()->route('stands.show', ['stand' => $stand, 'token' => $stand->token])->with('success', 'Modification effectuée avec succès !');

            } else {
                abort(403);
            }
        } else {
            abort(403);
        }
    }

    public function validated(Stand $stand, $token) {
        if($stand->token === $token) {
            if(isResa() || isBusinessDev() || isPrivate())
            {
                if($stand->status)
                    return back()->with('danger', 'Vous avez déjà validé ce point de vente !');

                $subscription = Subscription::whereStandId($stand->id)->orderBy('id', 'desc')->first();

                if($subscription) {
                    $subscription->state = 'on';
                    $subscription->begin = now();
                    $subscription->end = date('Y-m-d', strtotime(now() . '+ 1 years'));
                    $subscription->update();

                    $stand->update([
                        'status' => true
                    ]);

                    $commission = new Commission();
                    $commission->type = "Point de vente";
                    $commission->foreign_id = $subscription->id;
                    $commission->amount = "6000";
                    $commission->save();
                }

                $file = public_path('images/orahairport.jpeg');

                Mail::to(getUserMail($stand->users->first()->pivot->user_id))->send(new StandValidatedMail($stand, $file));

                return redirect()->route('stands.show', ['stand' => $stand, 'token' => $stand->token])->with('success', 'Le point de vente est validé avec succès !');
            }
            else
            {
                abort(403);
            }
        } else {
            abort(403);
        }
    }

    public function delegate(Stand $stand, $token) {
        if($stand->token === $token) {
            if(!$stand->status)
                return back()->with('danger', "Ce point de vente n'est pas encore approuvé !");

            if (getStandOwner($stand) !== Auth::id())
                return back()->with('danger', "Vous n'avez pas le droit d'effectuer cette action !");

            $title = 'Délégation du point de vente';
            return view('pages/stands/asks/delegate', compact('title', 'stand'));
        } else {
            abort(403);
        }
    }

    public function delegated(DelegateStandRequest $request, Stand $stand, $token)
    {
        if($stand->token === $token) {
            $user = User::find($request->user);
            if($user->stands()->where('stand_id', $stand->id)->exists())
                return back()->with('danger', 'Vous avez déjà ajouté cet utilisateur !');

            $stand->users()->attach($user, ['role' => 'Gérant', 'token' => Str::uuid(), 'created_at' => now(), 'updated_at' => now()]);

            $file = public_path('images/orahairport.jpeg');

            Mail::to($user->email)->send(new StandAddingManagerMail($stand, $file));

            return back()->with('success', 'Ajout effectué avec succès !');
        } else {
            abort(403);
        }
    }

    public function all()
    {
        $title = 'Mes Stands';
        return view('pages/stands/asks/all', compact('title'));
    }

    public function setActiveStand(Stand $stand, $token)
    {
        if($stand->token === $token) {
            $getActiveStand = DB::table('stand_user')->where('stand_id', getStandActive()->id)->update([
                'default' => false,
            ]);;

            $setActiveStand = DB::table('stand_user')->where('stand_id', $stand->id)->update([
                'default' => true,
            ]);

            Session::flash('success', "Point de vente activé avec succès.");

        } else {
            abort(403);
        }

        // dd($setActiveStand->default);
        // $setActiveStand->default = true;
        // $setActiveStand->update_at = Carbon::now();

        // $setActiveStand->save();

        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function singpay() {
        $ref = mt_rand(100000, 999999);
        Cookie::queue('ref', $ref, 60);
        $amount =  getStandAmount();

        $url = "https://gateway.singpay.ga/v1/ext";

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
           "accept: */*",
           "x-client-id: 3afcb469-c076-44a1-97e9-c9596787a770",
           "x-client-secret: dbdcd710eb6a7818565cb75216812425de462ac5ecf831d46c5a57238c8e7e2e",
           "x-wallet: 63e3b10db4bb102c62392a35",
           "Content-Type: application/json",
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        $data = <<<DATA
        {
          "portefeuille": "63e3b10db4bb102c62392a35",
          "reference": $ref,
          "redirect_success": "https://www.travel-orahairport.com/callback",
          "redirect_error": "https://www.travel-orahairport.com/points-de-vente/paiement",
          "amount": $amount,
          "disbursement": "63e3b29ab4bb102c62392a75",
          "logoURL": "https://www.travel-orahairport.com/public/storage/images/slider/orahairport.jpg"
        }
        DATA;

        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

        //for debug only!
        //curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        //curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $resp = curl_exec($curl);
        curl_close($curl);

        return $resp;
    }

    public function cinetpay(Request $request) {
        return $request;
    }

    public function adwapay()
    {
        if(!\Cookie::get('ref')) {
            Session::flash('danger', "Opération pas possible.");
            return redirect()->route('home');
        }

        if(!\Cookie::get('stand')) {
            Session::flash('danger', "Opération pas possible.");
            return redirect()->route('home');
        }

        $ref = json_decode(Cookie::get('ref'), true);

        // $url = "https://twsv03.adwapay.com/getADPToken";

        // $curl = curl_init($url);

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://twsv03.adwapay.com/getADPToken',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>'  {
            "application": "ORAHAIRPORTTRAVEL"
          }',
          CURLOPT_HTTPHEADER => array(
            'Authorization: Basic T1I2QktKVTFEM1hYRUxBUDZCS0pVMUQzWFhNU1FYNg==',
            'Content-Type: text/plain'
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;

        // $data = json_decode($response);

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
        //     Mail::to('resa@travel-orahairport.com')->cc(['ceo@travel-orahairport.com','account@travel-orahairport.com'])->send(new StandInformMail($file));

        //     return redirect()->route('stands.index')->with('success', 'Point de vente créé avec succès.');
        // } else {
        //     return back()->with('danger', "Vous n'avez pas finalisé votre demande.");
        // }
    }

    public function callback()
    {
        if(!\Cookie::get('ref')) {
            Session::flash('danger', "Opération pas possible.");
            return redirect()->route('home');
        }

        if(!\Cookie::get('stand')) {
            Session::flash('danger', "Opération pas possible.");
            return redirect()->route('home');
        }

        $ref = json_decode(Cookie::get('ref'), true);

        $url = "https://gateway.singpay.ga/v1/transaction/api/search/by-reference/$ref";

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
           "accept: */*",
           "x-client-id: 3afcb469-c076-44a1-97e9-c9596787a770",
           "x-client-secret: dbdcd710eb6a7818565cb75216812425de462ac5ecf831d46c5a57238c8e7e2e",
           "x-wallet: 63e3b10db4bb102c62392a35",
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        //for debug only!
        // curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        // curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $resp = curl_exec($curl);
        curl_close($curl);

        $data = json_decode($resp);

        if($data->status === "Terminate") {
            $stand = json_decode(Cookie::get('stand'), true);
            $standStore = Stand::create([
                "name" => $stand['name'],
                "country_id" => $stand['country'],
                "phone" => $stand['phone'],
                "city_id" => $stand['city'],
                "quartier" => $stand['quartier'],
                "rue" => $stand['rue'],
                "reduc" => $stand['reduc'],
                "id_transfert" => $data->_id,
                "pay_by" => "Singpay",
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
        } else {
            return back()->with('danger', "Vous n'avez pas finalisé votre demande.");
        }
    }

    public function callbackCinetpay(Request $request)
    {
        $user = User::find(1);
        if(isset($user)){
            Auth::login($user);
            $request->session()->regenerate();
            return $request;
        }

        if (isset($request->cpm_trans_id)) {
            // $VerifyStatusCmd = "1"; // valeur du statut à récupérer dans votre base de donnée
            // if ($VerifyStatusCmd == '00') {
            //     // La commande a été déjà traité
            //     // Arret du script
            //     die();
            // }

            $cinetpay_check = [
                "apikey" => "467610211639b1fbfa16535.87195747",
                "site_id" => "670781",
                "transaction_id" => $request->cpm_trans_id
            ];

            $response = $this->getPayStatus($cinetpay_check);

            $response_body = json_decode($response, true);
            if($response_body['code'] == '00') {
                echo 'Felicitation, votre paiement a été effectué avec succès';
            } else {
                echo 'Null';
            }
        } else{
            echo 'Bof';
        }
        // if(!\Cookie::get('ref')) {
        //     Session::flash('danger', "Opération pas possible.");
        //     return redirect()->route('home');
        // }

        // if(!\Cookie::get('stand')) {
        //     Session::flash('danger', "Opération pas possible.");
        //     return redirect()->route('home');
        // }

        // $ref = json_decode(Cookie::get('ref'), true);

        // Stand::create([
        //     "name" => $stand['name'],
        //     "country_id" => $stand['country'],
        //     "phone" => $stand['phone'],
        //     "city_id" => $stand['city'],
        //     "quartier" => $stand['quartier'],
        //     "rue" => $stand['rue'],
        //     "reduc" => $stand['reduc'],
        //     "id_transfert" => 1,
        //     "pay_by" => "Singpay",
        //     "token" => Str::uuid()
        // ]);

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

    public function redirectCinetpay(Request $request)
    {
        $user = User::find(1);
        if(isset($user)){
            Auth::login($user);
            $request->session()->regenerate();
            return $request;
        }
        
        if (isset($request->transaction_id) || isset($request->token)) {
            $cinetpay_check = [
                "apikey" => "467610211639b1fbfa16535.87195747",
                "site_id" => "670781",
                "transaction_id" => $request->cpm_trans_id
            ];

            $response = $this->getPayStatus($cinetpay_check);
            $response_body = json_decode($response, true);
            if($response_body['code'] == '00') {
                return redirect()->route('stands.index')->with('success', 'Point de vente créé avec succès.');
            } else {
                return back();
            }
        }
    }
}
