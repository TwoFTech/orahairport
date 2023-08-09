<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Requests\CompanyStoreRequest;
use App\Http\Requests\CompanyUpdateRequest;

class CompanyController extends Controller
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
        $title = 'Liste des compagnies';
        $companies = Company::orderBy('name')->get();
        return view('pages.companies.index', compact('title', 'companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!isPrivate() && !isAdmin() && !isResa())
            abort(403);

        $title = 'Ajouter une compagnie';
        return view('pages.companies.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyStoreRequest $request)
    {
        if(!isPrivate() && !isAdmin() && !isResa())
            abort(403);

        Company::create([
            'name' => ucfirst($request->name)
        ]);

        return redirect()->route('companies.index')->with('success', 'Compagnie ajoutée avec succès !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        if(!isPrivate() && !isAdmin() && !isResa())
            abort(403);

        $title = 'Modifier une compagnie';
        return view('pages.companies.edit', compact('title', 'company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyUpdateRequest $request, Company $company)
    {
        if(!isPrivate() && !isAdmin() && !isResa())
            abort(403);

        $company->update([
            'name' => ucfirst($request->name)
        ]);

        return redirect()->route('companies.index')->with('success', 'Compagnie modifiée avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        if(!isPrivate() && !isAdmin() && !isResa())
            abort(403);
        
        $company->delete();
        return redirect()->route('companies.index')->with('success', 'Compagnie supprimée avec succès !');
    }
}
