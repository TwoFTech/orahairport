<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Stand;
use App\Models\Passenger;
use App\Models\Commission;
use App\Models\Scommission;
use Illuminate\Http\Request;
use App\Http\Requests\ReservationStoreRequest;
use App\Http\Requests\ReservationStudyRequest;
use Cookie;
use Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReservationStoreMail;
use App\Mail\ReservationFinalizeMail;
use App\Mail\ReservationPaidMail;
use App\Mail\ReservationInformPaidMail;
use App\Mail\ReservationInformFinalizeMail;
use App\Mail\ReservationFinalizeClientMail;
use App\Mail\ReservationInformMail;
use App\Mail\ReservationStudyMail;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\MessageBag;
use App\Jobs\ReservationStoreMailJob;
use App\Jobs\ReservationInformMailJob;
use App\Jobs\ReservationStudyMailJob;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
//use Illuminate\Http\File;

class ReservationController extends Controller
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
        $reservations = [];
        if($role[0] === "manager" || $role[0] === "dev" || $role[0] === "resa" || $role[0] === "admin-vente") {
            $reservations = Reservation::orderBy('id', 'desc')->get();
        } else {
            if(getStandActive())
                $reservations = Reservation::where('stand_id', getStandActive()->id)->orderBy('id', 'desc')->get();
        };
        $title = 'Liste des demandes';
        return view('pages/reservations/index', compact('title', 'reservations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Stand $stand = null, $token = null, $edit = null)
    {
        if(!getStandActive())
            return back()->with('danger', "Vous devez disposer d'un point de vente actif afin de réaliser cette opération !");

        $role = Auth::user()->getRoleNames();
        // if($stand === null && $token === null && ($role[0] === "manager" || $role[0] === "resa" || $role[0] === "dev")) {
        //     $title = "Ajouter une réservation";
        //     return view('pages/reservations/create', compact('title'));
        // } else {
        if($stand->token === $token) {
            if(getStandStatus($stand) == 'on') {
                if(checkStandAvailability($stand) == true) {
                    $title = "Ajouter une réservation";
                    return view('pages/reservations/create', compact('title', 'stand', 'token'));
                } else {
                    return back()->with('danger', "L'abonnement sur le point de vente courant est arrivé à expiration!");
                }
            } else {
                return back()->with('danger', "Le point de vente courant n'est pas valide!");
            }
        } else {
            abort(403);
        }
        // }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReservationStoreRequest $request, MessageBag $messageBag, Stand $stand = null, $token = null)
    {
        if($request['for'] === 'meOthers'){
            if($request['passenger_number'] < 2){
                $messageBag->add('passenger_number', "Il y a un problème avec le nombre de passager.");
            }
        }
        if($request['for'] === 'me'){
            if($request['passenger_number'] != 1){
                $messageBag->add('passenger_number', "Il y a un problème avec le nombre de passager.");
            }
        }

        if(sizeof($messageBag->messages()) > 0)
                return back()->withErrors($messageBag)->withInput();

        $role = Auth::user()->getRoleNames();
        // if($stand === null && $token === null || ($role[0] === "manager" || $role[0] === "resa" || $role[0] === "dev")) {
        //     $reserv = Reservation::create([
        //         "firstname" => $request['firstname'],
        //         "lastname" => $request['lastname'],
        //         "phone" => $request['phone'],
        //         "email" => $request['email'],
        //         "for" => $request['for'],
        //         "departure_city" => $request['departure_city'],
        //         "destination_city" => $request['destination_city'],
        //         "departure_date" => $request['departure_date'],
        //         // "return_date" => $request['return_date'] == '' ? "1970/01/01" : $request['return_date'],
        //         "fidelity_code" => $request['fidelity_code'],
        //         "passenger_number" => $request['passenger_number'],
        //         "company" => $request['company'],
        //         "token" => Str::uuid(),
        //         "user_id" => Auth::id(),
        //     ]);
        // } else {
        if($stand->token === $token) {
            $reserv = Reservation::create([
                "firstname" => $request['firstname'],
                "lastname" => $request['lastname'],
                "phone" => $request['phone'],
                "email" => $request['email'],
                "for" => $request['for'],
                "departure_city" => $request['departure_city'],
                "destination_city" => $request['destination_city'],
                "departure_date" => $request['departure_date'],
                "fidelity_code" => $request['fidelity_code'],
                "passenger_number" => $request['passenger_number'],
                "company" => $request['company'],
                "token" => Str::uuid(),
                "stand_id" => $stand->id,
                "user_id" => Auth::id(),
            ]);
            // $images = [];
            // $reservation = new Reservation();
            // $reservation->firstname = $request['firstname'];
            // $reservation->lastname = $request['lastname'];
            // $reservation->phone = $request['phone'];
            // $reservation->email = $request['email'];
            // $reservation->description = $request['description'];

            // $reservation->files = $request['files'];
            // if($request->hasfile('files')) {
            //     foreach($request->file('files') as $image) {
            //         $saveImage = $this->saveImage($image, 'reservations');
            //         array_push($images, $saveImage);
            //     }
            //     $reservation->files = serialize($images);
            // }

            //Cookie::queue('reservation', $reservation, 60);
        } else {
            abort(403);
        }
        // }

        return redirect()->route('reservations.show', ['reservation' => $reserv, 'token' => $reserv->token])
        ->with('success', 'Réservation créée avec succès, avant de la soumettre, vous devez ajouter un/des passager(s).');
    }

    public function confirm(Stand $stand, $token)
    {
        if($stand->token === $token) {
            if(getStandStatus($stand) == 'on') {
                if(checkStandAvailability($stand) == true) {
                    if(!\Cookie::get('reservation')) {
                        Session::flash('danger', "Opération pas possible.");
                        return redirect()->route('home');
                    }
                    $reservation = json_decode(Cookie::get('reservation'), true);
                    $title = "Confirmer la réservation";
                    return view('pages/reservations/confirm', compact('title', 'stand', 'token', 'reservation'));
                } else {
                    return back()->with('danger', "L'abonnement sur le point de vente courant est arrivé à expiration!");
                }
            } else {
                return back()->with('danger', "Le point de vente courant n'est pas valide!");
            }
        } else {
            abort(403);
        }
    }

    public function done(Request $request, Stand $stand, $token) {
        if($stand->token === $token) {
            if(getStandStatus($stand) == 'on') {
                if(checkStandAvailability($stand) == true) {
                    if(!\Cookie::get('reservation')) {
                        Session::flash('danger', "Opération pas possible.");
                        return redirect()->route('home');
                    }

                    $reservation = json_decode(Cookie::get('reservation'), true);

                    $reserv = Reservation::create([
                        "firstname" => $reservation['firstname'],
                        "lastname" => $reservation['lastname'],
                        "phone" => $reservation['phone'],
                        "email" => $reservation['email'],
                        "description" => $reservation['description'],
                        "files" => $reservation['files'],
                        "token" => Str::uuid(),
                        "stand_id" => $stand->id,
                        "user_id" => Auth::id(),
                    ]);

                    $file = public_path('images/orahairport.jpeg');

                    Mail::to([['email' => Auth::user()->email, 'name' => $stand->name], ['email' => $reserv->email, 'name' => $reserv->lastname . ' ' . $reserv->firstname]])->send(new ReservationStoreMail($file));

                    Mail::to('resa@travel-orahairport.com')->cc(['ceo@travel-orahairport.com','account@travel-orahairport.com'])->send(new ReservationInformMail($file));

                    // Suppression du cookie
                    Cookie::queue('reservation', 0, 60);
                    return redirect()->route('reservations.index')->with('success', "Réservation effectuée avec succès");
                } else {
                    return back()->with('danger', "L'abonnement sur le point de vente courant est arrivé à expiration!");
                }
            } else {
                return back()->with('danger', "Le point de vente courant n'est pas valide!");
            }
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function show(Reservation $reservation, $token)
    {
        if($reservation->token === $token) {
            $title = 'Consulter une réservation';
            return view('pages/reservations/show', compact('title', 'reservation'));
        } else {
            abort(403);
        }
    }

    public function send(Reservation $reservation, $token)
    {
        if($reservation->token === $token && count($reservation->passengers) > 0) {
            $reservation->status = "En étude";
            $reservation->update();

            $file = public_path('images/orahairport.jpeg');

            if($reservation->stand) {
                //Mail::to([['email' => Auth::user()->email, 'name' => $reservation->stand->name]])->send(new ReservationStoreMail($file));
                $details1 = ['email' => Auth::user()->email, 'name' => $reservation->stand->name];
                // $job1 = (new ReservationStoreMailJob($details1, $reservation, $file))->delay(Carbon::now()->addMinutes(2));
                // dispatch($job1);
                ReservationStoreMailJob::dispatchNow($details1, $reservation, $file);
            }

            //Mail::to([['email' => $reservation->email, 'name' => $reservation->name]])->send(new ReservationStoreMail($file));
            $details2 = ['email' => $reservation->email, 'name' => $reservation->name];
            // $job2 = (new ReservationStoreMailJob($details2, $reservation, $file))->delay(Carbon::now()->addMinutes(2));
            // dispatch($job2);
            ReservationStoreMailJob::dispatchNow($details2, $reservation, $file);

            Mail::to('resa@travel-orahairport.com')->cc(['ceo@travel-orahairport.com','account@travel-orahairport.com'])->send(new ReservationInformMail($file));
            // $details3 = [['email' => 'resa@travel-orahairport.com', 'name' => 'Réservation ORAHAIRPORT Travel']];
            //$job3 = (new ReservationInformMailJob($details3, $reservation, $file))->delay(Carbon::now()->addMinutes(2));
            //dispatch($job3);
            // ReservationInformMailJob::dispatchNow($details3, $reservation, $file);

            //\Artisan::call('queue:work', ['--stop-when-empty' => true]);

            return back()->with('success', 'Dossier soumis avec succès, L\'équipe orahairport vous reviendra sous peu avec les details du billet.');
        } else {
            return back()->with('danger', "Vous ne pouvez pas soumettre cette réservation car aucun passager n'a été ajouté.");
        }
    }

    public function study(Reservation $reservation, $token)
    {
        if($reservation->token === $token && count($reservation->passengers) > 0) {
            foreach($reservation->passengers as $index => $passenger) {
                if($passenger->amount == null || $passenger->amount == 0 || $passenger->amount == '') {
                    return back()->with('danger', "Vous n'avez pas étudié tous les passagers de cette réservation !");
                }
            }
            if($reservation->pnr != null || $reservation->amount != null)
                return back()->with('danger', 'Vous avez déjà étudié cette réservation.');

            $title = 'Etudier une réservation';
            return view('pages/reservations/study', compact('title', 'reservation'));
        } else {
            abort(403);
        }
    }

    public function studyPost(ReservationStudyRequest $request, Reservation $reservation, $token)
    {
        if($reservation->token === $token) {
            if($reservation->pnr != null || $reservation->amount != null)
                return back()->with('danger', 'Vous avez déjà étudié cette réservation');

            $reservation->pnr = $request->pnr;
            $reservation->amount = $reservation->passengers->sum('amount');
            $reservation->study_id = Auth::id();
            $reservation->status = 'Traitée';

            $data = [
                'reservation' => $reservation
            ];

            $pdf = Pdf::loadView('pages.reservations.purchase', $data);
            $pdf->set_paper([0,0,400,400]);
            $name = "BON_DE_COMMANDE-" . uniqid() . ".pdf";
            Storage::disk('purchases')->put($name, $pdf->output());

            $reservation->purchase = \URL::to('/') . (!\App::environment('local') ? '/public' : '') .'/storage/purchases/docs/' . $name;

            $reservation->update();

            $file = public_path('images/orahairport.jpeg');

            try {
                $details1 = ['email' => $reservation->user->email, 'name' => $reservation->user->name];
                $details2 = ['email' => $reservation->email, 'name' => $reservation->lastname . ' ' . $reservation->firstname];
                //$job = (new ReservationInformMailJob($details1, $reservation, $file))->delay(Carbon::now()->addMinutes(2));
                //dispatch($job);
                ReservationStudyMailJob::dispatchNow($details1, $details2, $reservation, $pdf, $file);
            } catch (JWTException $exception) {
               $this->serverstatuscode = "0";
            }

            return redirect()->route('reservations.show', ['reservation' => $reservation, 'token' => $reservation->token])->with('success', 'Réservation traitée avec succès. En entendant le payement par le passager.');
        } else {
            abort(403);
        }
    }

    public function finalize(Reservation $reservation, $token)
    {
        if($reservation->token === $token && count($reservation->passengers) > 0) {
            foreach($reservation->passengers as $index => $passenger) {
                if($passenger->ticket_number == null || $passenger->ticket_file == null) {
                    return back()->with('danger', "Vous n'avez pas défini de billet pour tous les passagers de cette réservation !");
                }
            }
            if($reservation->status === 'Payée') {
                $reservation->status = 'Finalisée';
                $reservation->update();

                $file = public_path('images/orahairport.jpeg');

                if($reservation->stand)
                    Mail::to([['email' => Auth::user()->email, 'name' => $reservation->stand->name]])->send(new ReservationFinalizeMail($file));

                Mail::to([['email' => $reservation->email, 'name' => $reservation->lastname . ' ' . $reservation->firstname]])->send(new ReservationFinalizeClientMail($file, $reservation->passengers));

                Mail::to('resa@travel-orahairport.com')->cc(['ceo@travel-orahairport.com','account@travel-orahairport.com'])->send(new ReservationInformFinalizeMail($file));

                return back()->with('success', 'Vous avez finalisé avec succès cette réservation.');
            } elseif($reservation->status === 'Finalisée') {
                return back()->with('danger', 'Vous avez déjà finalisé cette réservation.');
            } else {
                return back()->with('danger', 'Vous devez regler cette réservation avant de la finaliser.');
            }
        } else {
            abort(403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation, $token)
    {
        if($reservation->token === $token) {
            if($reservation->status == 'Créée') {
                foreach($reservation->passengers as $passenger) {
                    if(File::exists($passenger->ticket_file)) {
                        File::delete($passenger->ticket_file);
                    }
                    $passenger->delete();
                }
                $reservation->delete();
                return redirect()->route('reservations.index')->with('success', 'Réservation supprimée avec succès.');
            } else {
                return back()->with('danger', 'Vous ne pouvez pas effectuer cette opération.');
            }
        } else {
            abort(403);
        }
    }
}
