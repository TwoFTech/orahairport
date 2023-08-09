<?php
use Carbon\Carbon;
use App\Models\User;
use App\Models\Stand;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Ticket;
use App\Models\Passenger;
use App\Models\Category;
use App\Models\Cabin;
use App\Models\Country;
use App\Models\Setting;
use App\Models\City;
use App\Models\Commission;
use App\Models\Scommission;
use App\Models\Reservation;
use App\Models\Company;

function getFormattedPrice($price) {
    $price = floatval($price);
    return number_format($price, 0, '.', ' ');
}

// Rôle Super Admin => Accès à tous le système
function isPrivate()
{
    return Auth::user()->hasRole(['manager', 'dev']);
}

// Rôle Dev
function isDev()
{
    return Auth::user()->hasRole(['dev']);
}

// Rôle Account Manager => Accès à toute la comptabilité
function isAccountManager()
{
    return Auth::user()->hasRole(['account-manager']);
}

// Rôle Admin Vente => Contrôle les agents de résservation + business development
function isAdmin()
{
    return Auth::user()->hasRole(['admin-vente']);
}

// Rôle Agent de réservation => traite et finalise les réservations
function isResa()
{
    return Auth::user()->hasRole(['resa']);
}

// Rôle Business Development => Gérer les point marchants de son pays uniquement
function isBusinessDev()
{
    return Auth::user()->hasRole(['admin']);
}

// Rôle Client Marchant => Créer des réservation
function isMerchant()
{
    return Auth::user()->hasRole(['merchant']);
}

// Rôle Client Marchant => Créer des réservation
function isPassenger()
{
    return Auth::user()->hasRole(['passenger']);
}


function getStandAmount() {
    $standAmount = Setting::first()->stand_amount * (\Cookie::get('contacts') && count(unserialize(\Cookie::get('contacts'))) ? 0.8 : 1);
    return $standAmount;
}

function userStandCount($user_id) {
    $count = DB::table('stand_user')->where('user_id', $user_id)->count();
    return $count;
}

function getStandCount() {
    $standCount = Stand::count();
    return $standCount;
}

function getStandValidatedCount() {
    $standValidated = Stand::whereStatus(true)->count();
    return $standValidated;
}

function getStandTotal() {
    return Subscription::sum('amount');
}

function getDevCommissionsTotal() {
    $total = Commission::sum('amount');
    return getFormattedPrice($total) . ' F';
}

function getStandCommissionsTotal() {
    $total = Scommission::sum('amount');
    return getFormattedPrice($total) . ' F';
}

function getUserName($userId) {
    return User::find($userId)->name;
}

function getUserMail($userId) {
    return User::find($userId)->email;
}

function getCurrency() {
    $currency = Setting::first()->currency;
    return $currency;
}

function getDevCommission() {
    $dev_commission_on_point = Setting::first()->dev_commission_on_point;
    return $dev_commission_on_point;
}

function getUsers() {
    $users = User::where('id', '!=', Auth::id())->orderBy('name')->get();
    return $users;
}

function getCountries() {
    $countries = Country::whereStatus(true)->orderBy('name')->get();
    return $countries;
}

function getCities() {
    $cities = City::orderBy('label')->get();
    return $cities;
}

function getCity($id) {
    $city = City::find($id)->first();
    return $city->label;
}

function getSubscriptionDelay(Stand $stand) {
    $subscription = Subscription::whereStandId($stand->id)->orderBy('id', 'desc')->first();
    $diff = floor(abs((strtotime($subscription->end) - strtotime(now())) / (60 * 60 * 24)));
    return $diff;
}

function getStandValidatorName(Stand $stand) {
    $subscription = Subscription::whereStandId($stand->id)->orderBy('id', 'desc')->first();
    $standValidatorName = User::find($subscription->validator_id)->name;
    return $standValidatorName;
}

function getStandOwner(Stand $stand) {
    $owner_id = DB::table('stand_user')->whereRole('proprietaire')->whereStandId($stand->id)->first();
    return $owner_id->user_id;
}

function temps()
{
    $dat = Carbon::now();
    return $dat;
}

function getCategory(Passenger $passenger, Ticket $ticket)
{
    $reservation = DB::table('passenger_ticket')->select('*')
                                ->where('ticket_id', $ticket->id)
                                ->where('passenger_id', $passenger->id)
                                ->first();
    $category = Category::find($reservation->category_id);
    $cabin = Cabin::find($reservation->cabin_id);

    return ['category' => $category, 'cabin' => $cabin];
}

function alertColor()
{
    if(session('info'))
    {
        return 'info';
    }
    if(session('warning'))
    {
        return 'warning';
    }
    if(session('success'))
    {
        return 'success';
    }
    if(session('danger'))
    {
        return 'danger';
    }

    return null;
}

function alertMessage()
{
    if(session('info'))
    {
        return session('info');
    }
    if(session('warning'))
    {
        return session('warning');
    }
    if(session('success'))
    {
        return session('success');
    }
    if(session('danger'))
    {
        return session('danger');
    }

    return null;
}

function getStandActive(){

    if(Auth::check()){
        if(count(Auth::user()->stands) > 0){

            $getUserStand = DB::table('stand_user')->where('user_id', Auth::id());
            $user_stand = $getUserStand->where('default', true)->first();


            if($user_stand != null)
            {
                $stand = Stand::where('id', $user_stand->stand_id)->first();
                return $stand;
            }

            else
            {
                $b = DB::table('stand_user')->where('stand_id', Auth::id())->first();

                $getActiveStand = DB::table('stand_user')->where('id', $b->id)->update([
                    'default' => true,
                ]);

                $stand = Stand::where('id', $b->stand_id)->first();

                return $stand;

            }

            return null;
        }

        return null;
    }

    return null;
}

function getStandStatus(Stand $stand) {
    $getStandSubscription = Subscription::whereStandId($stand->id)->orderBy('id', 'desc')->first();
    return $getStandSubscription->state;
}

function checkStandAvailability(Stand $stand) {
    $available = false;
    if(getStandStatus($stand) == 'on') {
        $getStandSubscription = Subscription::whereStandId($stand->id)->orderBy('id', 'desc')->first();
        if(strtotime(now()) > strtotime($getStandSubscription->begin) && strtotime(now()) < strtotime($getStandSubscription->end)) {
            $available = true;
        } else {
            $stand->status = false;
            $getStandSubscription->state = 'off';
        }
    }
    return $available;
}

function amountOfStandOnReservation($amount) {
    $commission = 0;
    if($amount > 1000000) {
        $commission = 15000;
    } elseif($amount > 500000) {
        $commission = 12000;
    } elseif($amount > 300000) {
        $commission = 10000;
    } elseif($amount > 200000) {
        $commission = 8000;
    } else {
        $commission = 5000;
    }

    return $commission;
}

// Afficheur de rôle

function showRole($role)
{
    if ($role == 'manager') {

        return 'CEO Général';
    }

    elseif($role == 'dev')
    {
        return 'Informaticien';
    }

    elseif($role == 'support')
    {
        return 'Service Client';
    }

    elseif($role == 'admin-vente')
    {
        return 'Admin Vente';
    }

    elseif($role == 'account-manager')
    {
        return 'Manager Comptable';
    }

    elseif($role == 'customer-manager')
    {
        return 'Customer Manager';
    }

    elseif($role == 'resa')
    {
        return 'Agent Réservation';
    }

    elseif($role == 'admin')
    {
        return 'Businnes Development';
    }

    elseif($role == 'marketing')
    {
        return 'Chef Commercial & Marketing';
    }

    elseif($role == 'merchant')
    {
        return 'Agent Marchant';
    }

    elseif($role == 'passenger')
    {
        return 'Passager';
    }

    else
    {
        return $role;
    }

}

function getMyResavation()
{
    $reservations = [];
    if(isMerchant()) {
        if(getStandActive())
            $reservations = Reservation::where('stand_id', getStandActive()->id)->orderBy('id', 'desc')->paginate(10);
    } else {
        $reservations = Reservation::orderBy('id', 'desc')->paginate(5);

    };
    return  $reservations;
}

function setStatusResa($status)
{
    if($status == "Créée")
    {
        return 'bg-primary';
    }
    elseif($status == "En étude")
    {
        return 'bg-info';
    }

    elseif($status == "Traitée")
    {
        return 'bg-warning';
    }

    elseif($status == "Payée")
    {
        return 'bg-success';
    }

    elseif($status == "Finalisée")
    {
        return 'bg-success';
    }
    else
    {
        return 'bg-dark';
    }
}

function getPersonalList()
{
    $users = User::whereHas('roles', function($query){
        $query->where('roles.name', '!=', 'dev')
            ->where('roles.name', '!=', 'merchant')
            ->where('roles.name', '!=', 'passenger');
    })->get();

    return $users;
}

function setExp()
{
    $start = Carbon::now()->year - 2015;
    return $start;
}

function getCounterCountry()
{
    $countries = count(Country::where('status', true)->get());
    return $countries;
}

function getCounterStand()
{
    $stands = count(Stand::where('status', true)->get()) + getCounterCountry();
    return $stands;
}

function getCounterTicket()
{
    $tickets = count(Reservation::where('status', 'Finalisée')->get()) + 1200;
    return $tickets;
}

function PassengerInResa(Reservation $reservation)
{
    if($reservation->for == 'me')
    {
        if(count($reservation->passengers) < 1)
        {

            return true;
        }

        return false;
    }
    else
    {
        if(count($reservation->passengers) < $reservation->passenger_number)
        {
            return true;
        }

        return false;
    }
}

function CounterInResa(Reservation $reservation)
{
    if (count($reservation->passengers) < $reservation->passenger_number) {

        $counter = count($reservation->passengers) % $reservation->passenger_number +1;

        return $counter;
    }

    return null;
}

function CopyPassengerInfo(Reservation $reservation)
{
    if($reservation->for != 'others')
    {
        if(count($reservation->passengers) >= 1)
        {
            return false;
        }

        return true;
    }

    return false;
}


function ActiveButSubMitResa(Reservation $reservation)
{
    $passengerStuded = Passenger::where('amount', null)->where('reservation_id', $reservation->id)->get();
    if(count($passengerStuded) > 0)
    {
        return false;
    }

    return true;
}

function getCompanies() {
    $companies = Company::orderBy('name')->get();
    return $companies;
}


