<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Carbon\Carbon;
use App\Models\User;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserNew;
use App\Mail\UserUpdate;
use App\Models\Center;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    public function __construct() {

        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::whereHas('roles', function($query){
            $query->where('roles.name', '!=', 'dev');
        })->get();
        $title = 'Liste des utilisateurs';
        return view('pages.users.index', compact('title', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!isPrivate())
            abort(403);
            $centers = Center::all();
            $roles = Role::all()->sortBy('name');
            $title = 'Nouvel Utilisateur';
            return view('pages.users.create', compact('title', 'roles', 'centers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $data)
    {
        if(!isPrivate())
            abort(403);
            $data->validate([
                'fullname' => ['required', 'string', 'max:255'],
                'role' => ['required', 'string'],
                // 'center' => ['required'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'phone' => ['required', 'string', 'max:255', 'unique:users'],
                // 'password' => ['required', 'string', 'confirmed', Password::min(8)->mixedCase()->numbers()->uncompromised()]
            ]);

            if($data['role'] == 'admin')
            {
                $data->validate([
                    'center' => ['required', 'unique:model_has_roles,center_id']
                ]);
            }

            $passwordGenerate = (string) Str::random(10);

            $user = User::create([
                'status' => true,
                'name' => $data['fullname'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'email_verified_at' => true,
                'token' => null,
                'password' => Hash::make($passwordGenerate),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            $user->assignRole($data['role']);

            if($data->center != null)
            {
                DB::table('model_has_roles')->where('model_id', $user->id)->update([
                    'center_id' => $data->center
                ]);
            }

            if($user)
            {
                Mail::to($data->email)->send(new UserNew($user, $passwordGenerate));
                return redirect()->route('users.index')->with('success', 'L\'utilisateur a été enregistré avec succès.');
            }

            return back()->with('danger', 'Quelque chose s\'est mal passée !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if(!isPrivate())
            abort(403);
            // $roles = Role::all()->sortBy('name');
            $title = 'Modification de '.$user->name;
            return view('pages.users.edit', compact('title', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $data, User $user)
    {
        if(!isPrivate())
            abort(403);
            $data->validate([
                'fullname' => ['required', 'string', 'max:255'],
                // 'role' => ['required', 'string'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
                'phone' => ['required', 'string', 'max:255', 'unique:users,phone,'.$user->id],
                // 'password' => ['required', 'string', 'confirmed', Password::min(8)->mixedCase()->numbers()->uncompromised()]
            ]);

            $user->update([
                'name' => $data['fullname'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            if($user)
            {
                Mail::to($data->email)->send(new UserUpdate($user));
                return redirect()->route('users.index')->with('success', 'L\'utilisateur a été modifié avec succès');
            }

            return back()->with('danger', 'Quelque chose s\'est mal passée !');
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

    public function active(User $user)
    {
        if(!isPrivate())
            abort(403);
            if($user->token == null)
            {
                if($user->status == true)
                {
                    $user->update([
                        'status' => false,
                        'updated_at' => Carbon::now(),
                    ]);

                    return back()->with('warning', 'L\'utilisateur '.$user->name . ' a été désactivé avec succès');
                }

                $user->update([
                    'status' => true,
                    'updated_at' => Carbon::now(),
                ]);

                return back()->with('success', 'L\'utilisateur '.$user->name . ' a été activé avec succès');
            }

            return back()->with('danger', 'Cet utilisateur n\'a pas un compte valide');
    }
}
