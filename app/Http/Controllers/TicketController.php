<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Stand;
use App\Models\City;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use function League\Config\reader;
use App\Models\Category;
use App\Models\Cabin;
use App\Models\Country;
use App\Models\Passenger;

class TicketController extends Controller
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
    public function create(Stand $stand)
    {
        $cities = City::orderBy('label')->get();
        return view('pages/ticketBookings/create', compact('stand', 'cities'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Stand $stand)
    {

        // dd($request->mode);

        $client = Client::select('*')
                            ->where('email', $request->email)
                            ->orwhere('phone', $request->phone)->first();

        if($client == null)
        {
            $request->validate([
                'lastname' => 'required|string',
                'firstname' => 'required|string',
                'email' => 'required|email|unique:clients',
                'phone' => 'required|string|unique:clients',
            ]);

            $client = Client::create([
                'lastname' => $request->lastname,
                'firstname' => $request->firstname,
                'phone' => $request->phone,
                'email' => $request->email,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }

        $request->validate([
            'code' => 'required|string',
            'number_passenger' => 'required|numeric',
            'date_start' => 'required',
            'date_end' => 'required',
            'provenance' => 'required',
            'destination' => 'required',
            'mode' => 'required',
            'compagny' => 'required',
            'type_reservation' => 'required',
        ]);


        $client_stand = $stand->clients()->attach($client->id);

        DB::table('client_stand')->where('client_id', $client->id)
                                                ->where('stand_id', $stand->id)
                                                ->update([
                                                    'loyalty_code' => $request->code,
                                                    'created_at' => Carbon::now(),
                                                    'updated_at' => Carbon::now()
                                                ]);

        $client_stand = DB::table('client_stand')->where('client_id', $client->id)
                                                ->where('stand_id', $stand->id)
                                                ->first();
        // dd($client_stand);
        $ticket = Ticket::create([
            'compagny' => $request->compagny,
            'client_stand_id' => $client_stand->id,
            'number_passenger' => $request->number_passenger,
            'provenance' => $request->provenance,
            'destination' => $request->destination,
            'date_start' => $request->date_start,
            'date_end' => $request->date_end,
            'code_fidelite' => $request->code,
            'status' => 'pending',
            'type_reservation' => $request->type_reservation,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        
        return redirect()
            ->route('passenger.ticket.create', ['client' => $client, 'ticket' => $ticket, 'mode' => $request->mode]);
        
    }

    public function ticketPassengerCreate(Client $client, Ticket $ticket, $mode)
    {
        $categories = Category::all();
        $cabins = Cabin::all();
        $countries = Country::all();
        return view('pages/passengers/addTicket', 
                    compact('ticket', 'client', 'mode', 'categories', 'cabins', 'countries'));
    }

    public function ticketPassengerStore(Request $request, Client $client, Ticket $ticket, $mode)
    {

        $request->validate([
            'birthday' => 'required',
            'nationalty' => 'required',
            'type_doc' => 'required',
            'doc_country' => 'required',
            'number_card' => 'required',
            'date_emission' => 'required',
            'date_expiration' => 'required',
        ]);

        $passenger = Passenger::create([
            'firstname' => $client->firstname,	
            'lastname' => $client->lastname,	
            'phone' => $client->phone,
            'sex' => $request->sex,	
            'email' => $client->email,
            'birthday' => $request->birthday,	
            'nationalty' => $request->nationalty,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('passenger_ticket')->insert([
            'ticket_id' => $ticket->id,
            'passenger_id' => $passenger->id,
            'category_id' => $request->category,	
            'cabin_id' => $request->cabin,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        return redirect()
            ->route('passenger.ticket.show', ['client' => $client, 'ticket' => $ticket, 'mode' => $request->mode, 'passenger' => $passenger]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    
    public function show(Client $client, Ticket $ticket, $mode)
    {
        return view('pages/passengers/showTicket', 
                    compact('ticket', 'client', 'mode'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        //
    }
}
