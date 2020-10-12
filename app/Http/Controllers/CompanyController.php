<?php

namespace App\Http\Controllers;

use App\User;
use App\Entery;
use App\Account;
use App\Company;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::all();
        return view('dashboard.companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required | string | unique:users',
            'phone'     => 'required | string | unique:users',
            'address'   => 'required | string',
        ]);

        $account = Account::create([
            'name' => 'Company'
        ]);

        $request_data = $request->all();
        $request_data['account_id'] = $account->id;
        $company = Company::create($request_data);

        $user = User::create([
            'name'          => $request['name'],
            'phone'         => $request['phone'],
            'address'       => $request['address'],
            'company_id'    => $company->id,
            'password'      => bcrypt(123456),
        ]);

        $user->attachRole('company');


        return back()->with('success', 'تمت العملية بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        $enteries   = Entery::where('from_id', $company->account_id)->Orwhere('to_id', $company->account_id)->get();
        $debt       = Entery::debt($company->account_id);
        $cridet     = Entery::cridet($company->account_id);
        return view('dashboard.companies.show', compact('enteries', 'company', 'debt', 'cridet'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        $request->validate([
            'name'     => ['required', 'string',  Rule::unique('companies', 'name')->ignore($company->id)],
            'phone'    => ['required', 'string',  Rule::unique('companies', 'phone')->ignore($company->id)],
            'address'  => 'required | string',
        ]);

        $company->update($request->all());

        return back()->with('success', 'تمت العملية بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        //
    }
}
