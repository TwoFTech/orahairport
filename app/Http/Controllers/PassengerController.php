<?php

namespace App\Http\Controllers;

use App\Models\Passenger;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Requests\PassengerStoreRequest;
use App\Http\Requests\PassengerStudyRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PassengerController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Reservation $reservation, $token)
    {
        if (CounterInResa($reservation) == null)
        {
            return redirect()->route('reservations.show', ['reservation' => $reservation, 'token' => $reservation->token])->with('success', 'Vous avez atteint le nombre de passager pour cette réservation');
        }

        if($reservation->token === $token) {
            $title = 'Ajouter un passager';
            return view('pages/passengers/create', compact('title', 'reservation'));
        } else {
            abort(403);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PassengerStoreRequest $request, Reservation $reservation, $token)
    {
        if (CounterInResa($reservation) == null)
        {
            return redirect()->route('reservations.show', ['reservation' => $reservation, 'token' => $reservation->token])->with('success', 'Vous avez atteint le nombre de passager pour cette réservation');
        }

        if($reservation->token === $token) {
            if($request->hasfile('passport_file')) {
                $saveImage = $this->saveImage($request->passport_file, 'reservations');
            }

            if($request->formula == 'aller_retour')
            {
                
            }
            Passenger::create([
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'phone' => $request->phone,
                'email' => $request->email,
                'formula' => $request->formula,
                // 'departure_city' => $reservation->departure_city,
                // 'destination_city' => $reservation->destination_city,
                // "departure_date" => $request->departure_date,
                "return_date" => $request->return_date,
                // "company" => $reservation->company,
                "cabin" => $request->cabin,
                "category" => $request->category,
                "passport_file" => $saveImage,
                "passport_number" => $request->passport_number,
                "reservation_id" => $reservation->id,
            ]);
        } else {
            abort(403);
        }

        if($reservation->for == 'me') {
            return redirect()->route('reservations.show', ['reservation' => $reservation, 'token' => $reservation->token])->with('success', 'Passager ajouté avec succès');
        } else {
            return back()->with('success', 'Passager ajouté avec succès');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Passenger  $passenger
     * @return \Illuminate\Http\Response
     */
    public function show(Passenger $passenger, Reservation $reservation, $token)
    {
        if($reservation->token === $token) {
            $title = 'Consulter un passager';
            return view('pages/passengers/show', compact('title', 'passenger', 'reservation'));
        } else {
            abort(403);
        }
    }

    public function study(Passenger $passenger, Reservation $reservation, $token, $step = 1)
    {
        if($reservation->token === $token) {
            if($reservation->status == 'En étude') {
                $title = "Etude d'un passager";
            } elseif($reservation->status == 'Payée') {
                $step = 2;
                $title = "Définir infos billet d'avion";
            } else {
                return back()->with('danger', 'Vous ne pouvez plus effectuer cette opération.');
            }
            return view('pages/passengers/study', compact('title', 'passenger', 'reservation', 'step'));
        } else {
            abort(403);
        }
    }

    public function studyPost(PassengerStudyRequest $request, Passenger $passenger, Reservation $reservation, $token, $step = 1)
    {
        if($reservation->token === $token) {
            if($reservation->status == 'En étude') {
                $passenger->amount = $request->amount;
            } elseif($reservation->status == 'Payée') {
                $step = 2;
                $passenger->ticket_number = $request->ticket_number;
                if($request->hasfile('ticket_file')) {
                    $saveImage = $this->saveImage($request->ticket_file, 'tickets');
                    $passenger->ticket_file = $saveImage;
                }
            } else {
                return back()->with('danger', 'Vous ne pouvez plus effectuer cette opération.');
            }
            $passenger->update();

            return redirect()->route('passengers.show', ['passenger' => $passenger, 'reservation' => $reservation, 'token' => $reservation->token])->with('success', $step == 1 ? "Le montant a été bien défini." : "Les informations de billet ont bien été défini.");
        } else {
            abort(403);
        }
    }

    public function downloadTicket(Passenger $passenger, Reservation $reservation, $token)
    {
        if($reservation->token === $token) {
            if($reservation->status == 'Finalisée' && $passenger->ticket_file) {
                return response()->download(storage_path('app/public/tickets/images/') . explode('/', $passenger->ticket_file)[6]);
            } else {
                return back()->with('danger', 'Vous ne pouvez plus effectuer cette opération.');
            }
        } else {
            abort(403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Passenger  $passenger
     * @return \Illuminate\Http\Response
     */
    public function edit(Passenger $passenger)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Passenger  $passenger
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Passenger $passenger)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Passenger  $passenger
     * @return \Illuminate\Http\Response
     */
    public function destroy(Passenger $passenger, Reservation $reservation, $token)
    {
        if($reservation->token === $token) {
            if($reservation->status == 'Créée') {
                if(File::exists($passenger->ticket_file)) {
                    File::delete($passenger->ticket_file);
                }
                $passenger->delete();
                return back()->with('success', 'Passager supprimé avec succès.');
            } else {
                return back()->with('danger', 'Vous ne pouvez pas effectuer cette opération.');
            }
        } else {
            abort(403);
        }
    }
}
