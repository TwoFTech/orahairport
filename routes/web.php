<?php

use Carbon\Carbon;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\StandController;
use App\Http\Controllers\CommissionController;
use App\Http\Controllers\ScommissionController;
use App\Http\Controllers\StripeController;

use App\Http\Controllers\SettingController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\PassengerController;
use App\Http\Controllers\ContactController;

use App\Http\Controllers\Auth\SecurityController;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\OrahaiportController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\PasswordResetsController;

use App\Http\Controllers\CenterController;

use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;

use Illuminate\Support\Facades\Mail;
// use App\Mail\TestMail;
// use App\Jobs\TestEmailJob;


// Sites
Route::get('/', [OrahaiportController::class, 'index'])->name('index');
Route::get('/about', [OrahaiportController::class, 'about'])->name('about');
Route::get('/contact', [OrahaiportController::class, 'contact'])->name('contact');
Route::get('/partenaires', [OrahaiportController::class, 'partners'])->name('partners');
Route::get('/reseau-commercial', [OrahaiportController::class, 'network'])->name('network');
Route::get('/guide-d-utilisation', [OrahaiportController::class, 'guide'])->name('guide');

// Vérification de compte (fab)
Route::get('/thank-you/{email?}', [SecurityController::class, 'thankYou'])->name('thankYou');
Route::post('/resend-email', [SecurityController::class, 'resendEmail'])->name('resendEmail');
Route::get('/email-confirm/{email}/{token}', [SecurityController::class, 'verifyEmail'])->name('verifyEmail');

// Mot de passe oublié (fab)
Route::get('forget-password', [ForgotPasswordController::class, 'forgetPassword'])->name('forget.password');

// Password Reset (fab)
Route::get('/password/reset', [HomeController::class, 'resetPassword'])->name('password.reset');
Route::post('/password/update', [HomeController::class, 'passwordUpdate'])->name('password.update');

// Authentification
Route::get('/inscription', [RegisterController::class, 'inscription'])->name('register');
Route::get('/inscription/validation', [RegisterController::class, 'validation'])->name('register.validate');
Route::post('/inscription', [RegisterController::class, 'register'])->name('registration');
Route::get('/login', [LoginController::class, 'loginForm'])->name('loginForm');
Route::post('/login', [LoginController::class, 'login'])->name('login');

// Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

//Passwords
Route::get('mot-de-passe-oublié', [PasswordResetsController::class, 'show'])->name('forget.password.get');
Route::post('mot-de-passe-oublié', [PasswordResetsController::class, 'submit'])->name('forget.password.post');
Route::get('reinitialisation-de-mot-de-passe/{token}', [PasswordResetsController::class, 'showReset'])->name('reset.password.get');
Route::post('reinitialisation-de-mot-de-passe', [PasswordResetsController::class, 'submitReset'])->name('reset.password.post');

//Points de vente
Route::get('/points-de-vente/creer/{state?}', [StandController::class, 'create'])->name('stands.create');
Route::get('/points-de-vente/consulter/{stand}/{token}', [StandController::class, 'show'])->name('stands.show');
Route::get('/points-de-vente/modifier/{stand}/{token}', [StandController::class, 'edit'])->name('stands.edit');
Route::get('/points-de-vente/contacts', [StandController::class, 'contacts'])->name('stands.contacts');
Route::post('/points-de-vente/contacts', [StandController::class, 'sendContacts'])->name('stands.contacts.send');
Route::get('/points-de-vente/valider/{stand}/{token}', [StandController::class, 'validated'])->name('stands.validated');
Route::get('/points-de-vente/deleguer/{stand}/{token}', [StandController::class, 'delegate'])->name('stands.delegate');
Route::post('/points-de-vente/deleguer/{stand}/{token}', [StandController::class, 'delegated'])->name('stands.delegated');
Route::post('/points-de-vente/creer', [StandController::class, 'store'])->name('stands.store');
Route::post('/points-de-vente/modifier/{stand}/{token}', [StandController::class, 'update'])->name('stands.update');
Route::get('/points-de-vente/paiement', [StandController::class, 'payment'])->name('stands.payment');
Route::get('/points-de-vente/paiement/singpay', [StandController::class, 'singpay'])->name('stands.singpay');
Route::post('/points-de-vente/paiement/cinetpay', [StandController::class, 'cinetpay'])->name('stands.cinetpay');
Route::get('/points-de-vente/paiement/adwapay', [StandController::class, 'adwapay'])->name('stands.adwapay');
Route::post('/points-de-vente/paiement/post', [StandController::class, 'pay'])->name('stands.pay');
Route::get('/points-de-vente', [StandController::class, 'index'])->name('stands.index');

// Transaction point de vente Singpay
Route::get('/callback', [StandController::class, 'callback'])->name('stands.callback');

// Transaction point de vente Cinetpay
Route::post('/callback/cinetpay', [OrahaiportController::class, 'callbackCinetpay'])->name('stands.callback.cinetpay');

Route::post('/redirect/cinetpay', [OrahaiportController::class, 'redirectCinetpay'])->name('stands.redirect.cinetpay');

// Paramètres
Route::get('/parametres', [SettingController::class, 'index'])->name('settings.index');
Route::get('/parametres/modifier/{field}', [SettingController::class, 'edit'])->name('settings.edit');
Route::post('/parametres/modifier', [SettingController::class, 'update'])->name('settings.update');

// Pays
Route::get('/pays', [CountryController::class, 'index'])->name('countries.index');
Route::get('/pays/on', [CountryController::class, 'countriesOn'])->name('countries.on');
Route::get('/pays/approuver/{country}/{state}', [CountryController::class, 'proved'])->name('countries.proved');

Route::get('/pages/stand/all', [StandController::class, 'all'])->name('stands.all');
Route::get('/pages/stand/active/{stand}/{token}', [StandController::class, 'setActiveStand'])->name('stands.active');

// Réservations
Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
Route::get('/reservations/creer/{stand?}/{token?}/{edit?}', [ReservationController::class, 'create'])->name('reservations.create');
Route::post('/reservations/creer/{stand?}/{token?}', [ReservationController::class, 'store'])->name('reservations.store');
Route::post('/reservations/{stand}/{token}/confirmer', [ReservationController::class, 'done'])->name('reservations.done');
Route::get('/reservations/{stand}/{token}/confirmer', [ReservationController::class, 'confirm'])->name('reservations.confirm');
Route::get('/reservations/consulter/{reservation}/{token}', [ReservationController::class, 'show'])->name('reservations.show');
Route::get('/reservations/{reservation}/{token}/envoyer', [ReservationController::class, 'send'])->name('reservations.send');
Route::get('/reservations/{reservation}/{token}/etudier', [ReservationController::class, 'study'])->name('reservations.study');
Route::get('/reservations/{reservation}/{token}/finaliser', [ReservationController::class, 'finalize'])->name('reservations.finalize');
Route::post('/reservations/{reservation}/{token}/finaliser', [OrahaiportController::class, 'paid'])->name('reservations.paid');
Route::post('/reservations/{reservation}/{token}/etudier', [ReservationController::class, 'studyPost'])->name('reservations.study.post');
Route::get('/reservations/{reservation}/{token}/supprimer', [ReservationController::class, 'destroy'])->name('reservations.destroy');

// Paiement client
Route::get('/reservations/{reservation}/{token}/payer', [OrahaiportController::class, 'toPay'])->name('reservations.toPay');
Route::get('/reservations/paiement/singpay/{reservation}/{token}', [OrahaiportController::class, 'singpay'])->name('reservations.singpay');

// Transaction client
Route::get('/reservations/callback/{reservation}/{token}', [OrahaiportController::class, 'callback'])->name('reservations.callback');

// Passagers
Route::get('/passagers/creer/{reservation}/{token}/{edit?}', [PassengerController::class, 'create'])->name('passengers.create');
Route::post('/passagers/creer/{reservation}/{token}', [PassengerController::class, 'store'])->name('passengers.store');
Route::get('/passagers/consulter/{passenger}/{reservation}/{token}', [PassengerController::class, 'show'])->name('passengers.show');
Route::get('/passagers/{passenger}/{reservation}/{token}/{step}/etudier', [PassengerController::class, 'study'])->name('passengers.study');
Route::get('/passagers/{passenger}/{reservation}/{token}/billet', [PassengerController::class, 'downloadTicket'])->name('passengers.downloadTicket');
Route::post('/passagers/{passenger}/{reservation}/{token}/{step}/etudier', [PassengerController::class, 'studyPost'])->name('passengers.study.post');
Route::get('/passagers/{passenger}/{reservation}/{token}/supprimer', [PassengerController::class, 'destroy'])->name('passengers.destroy');

// Commissions développeurs
Route::get('/dcommissions', [CommissionController::class, 'index'])->name('dCommissions.index');

// Commissions points de vente
Route::get('/scommissions', [ScommissionController::class, 'index'])->name('sCommissions.index');
Route::get('/scommissions/specifiques', [ScommissionController::class, 'specific'])->name('sCommissions.specific');

// Contacts
Route::get('/contacts/{category?}', [ContactController::class, 'index'])->name('contacts.index');

// Profil
Route::get('/profil', [HomeController::class, 'profil'])->name('users.profil');
Route::post('/profil/update', [HomeController::class, 'profilUpdate'])->name('users.profil.up');

// Utilisateurs
Route::get('/users/index', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
Route::get('/users/edit/{user}', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/update/{user}', [UserController::class, 'update'])->name('users.update');
Route::get('/users/active/{user}', [UserController::class, 'active'])->name('users.active');

Route::get('/users/adhesion/{email}', [SecurityController::class, 'adhesion'])->name('adhesion');
Route::post('/users/adhesion/validate/{email}/{token}', [SecurityController::class, 'adhesionValidate'])->name('adhesion.validate');

// Compagnies
Route::get('/companies/index', [CompanyController::class, 'index'])->name('companies.index');
Route::get('/companies/create', [CompanyController::class, 'create'])->name('companies.create');
Route::post('/companies/store', [CompanyController::class, 'store'])->name('companies.store');
Route::get('/companies/edit/{company}', [CompanyController::class, 'edit'])->name('companies.edit');
Route::put('/companies/update/{company}', [CompanyController::class, 'update'])->name('companies.update');
Route::delete('/companies/delete/{company}', [CompanyController::class, 'destroy'])->name('companies.destroy');


// Route::get('/email', function() {
// 	$file = public_path('images/orahairport.jpeg');
// 	dispatch(new App\Jobs\TestEmailJob($file));
//     return 1;
// });

Route::get('politiques-de-confidentialités', function() {
	return view('rgpd.policies');
})->name('rgpd.policies');

// Centre

    // 1 - centres
Route::get('/centers/index', [CenterController::class, 'index'])->name('centers.index');
Route::get('/centers/create', [CenterController::class, 'create'])->name('centers.create');
Route::post('/centers/store', [CenterController::class, 'store'])->name('centers.store');
Route::get('/centers/show/{center}', [CenterController::class, 'show'])->name('centers.show');
Route::get('/centers/edit/{center}', [CenterController::class, 'edit'])->name('centers.edit');
Route::put('/centers/update/{center}', [CenterController::class, 'update'])->name('centers.update');

    // 2 - villes
Route::get('/centers/ville/index', [CenterController::class, 'allCities'])->name('cities.index');
Route::get('/centers/ville/create', [CenterController::class, 'newCity'])->name('cities.create');
Route::post('/centers/ville/store', [CenterController::class, 'newCityPost'])->name('cities.store');
Route::get('/centers/ville/edit/{city}', [CenterController::class, 'editCity'])->name('cities.edit');
Route::put('/centers/ville/update/{city}', [CenterController::class, 'updateCity'])->name('cities.update');

// Roles et Permissions
    // 1 - rôles
Route::get('/services/role/index', [RoleController::class, 'index'])->name('roles.index');
Route::get('/services/role/create', [RoleController::class, 'create'])->name('roles.create');
Route::post('/services/role/store', [RoleController::class, 'store'])->name('roles.store');
Route::get('/services/role/edit/{role}', [RoleController::class, 'edit'])->name('roles.edit');
Route::put('/services/role/update/{role}', [RoleController::class, 'update'])->name('roles.update');
    // 2 - permissions

Route::get('/users/roles/permissions/create', [PermissionController::class, 'rolePermissionManager'])->name('permission_manager');

// Route::get('a', function() {
//     $reservation = null;
//     return view('pages.reservations.purchase', compact('reservation'));
// });


// Dernières mises à jour
Route::get('/conditions-generales-de-ventes', [HomeController::class, 'cgv'])->name('cgv');

Route::get('/paiement-stripe', [StripeController::class, 'stripePayment'])->name('stripe.payment');
Route::post('/paiement-stripe', [StripeController::class, 'stripePost'])->name('stripe.post');