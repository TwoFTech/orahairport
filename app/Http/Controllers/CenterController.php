<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Country;
use App\Models\Center;
use App\Models\User;
use Carbon\Carbon;

class CenterController extends Controller
{

    public function __construct()
    {
        return $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Liste des centres';
        $centers = Center::all();
        return view('pages.centers.index', compact('title', 'centers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Nouveau centre';
        $countries = Country::all();
        return view('pages.centers.create', compact('title', 'countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $data)
    {
        $data->validate(
            [
                'label' => 'required|string|unique:centers,name',
                'phone' => 'required|string|unique:centers',
                'email' => 'required|email|unique:centers',
                'headquarters' => 'required|string|unique:centers',
                'country' => 'required',
            ]
        );

        Center::create([
            'name' => $data->label,
            'phone' => $data->phone,
            'email' => $data->email,
            'status' => true,
            'headquarters' => $data->headquarters,
            'country_id' => $data->country,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return redirect(route('centers.index'))->with('success', 'Le centre a été ajoutée avec succès, Vous pouvez maintenant ajouter un manager business');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Center $center)
    {

        $title = 'Détails du centre '.$center->name;
        return view('pages.centers.show', compact('title', 'center'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Center $center)
    {
        $title = 'Modification du centre '.$center->name;
        $countries = Country::all();
        return view('pages.centers.edit', compact('title', 'center', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $data
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $data,Center $center)
    {
        $data->validate(
            [
                'label' => 'required|string|unique:centers,name,'.$center->id,
                'phone' => 'required|string|unique:centers,phone,'.$center->id,
                'email' => 'required|email|unique:centers,email,'.$center->id,
                'headquarters' => 'required|string|unique:centers,headquarters,'.$center->id,
                'country' => 'required',
            ]
        );

        $center->update([
            'name' => $data->label,
            'phone' => $data->phone,
            'email' => $data->email,
            'headquarters' => $data->headquarters,
            'country_id' => $data->country,
            'updated_at' => Carbon::now(),
        ]);

        return redirect(route('centers.index'))->with('success', 'Le centre a été modifié avec succès');
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

    public function newCity()
    {
        $countries = Country::all();
        $title = 'Création de ville';
        return view('pages.cities.create', compact('title', 'countries'));
    }

    public function newCityPost(Request $data)
    {
        $data->validate(
            [
                'city' => 'required|string|unique:cities,label',
                'country' => 'required',
            ]
        );

        City::create([
            'label' => $data->city,
            'country_id' => $data->country,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return redirect(route('cities.index'))->with('success', 'La ville a été ajoutée avec succès');

    }

    public function allCities()
    {
        $title = 'Liste des villes';
        $cities = City::all();
        return view('pages.cities.index', compact('title', 'cities'));
    }

    public function editCity(City $city)
    {
        $countries = Country::all();
        $title = 'Editer ville';
        return view('pages.cities.edit', compact('title', 'city', 'countries'));
    }

    public function updateCity(Request $data, City $city)
    {
        $data->validate(
            [
                'city' => 'required|string|unique:cities,label,'.$city->id,
                'country' => 'required',
            ]
        );

        $city->update([
            'label' => $data->city,
            'country_id' => $data->country,
            'updated_at' => Carbon::now(),
        ]);

        return redirect(route('cities.index'))->with('success', 'La ville a été modifiée avec succès');

    }
}
