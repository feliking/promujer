<?php

namespace App\Http\Controllers;

use PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Partner;
use App\ProviderCompany;
use App\City;
use Illuminate\Http\Request;

class ProviderCompanyController extends Controller
{
    public function __contruct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function main(){
        return view('provider_companies.main');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $providers = ProviderCompany::with('partners')->orderBy('id','DESC')->get();
        $cities = City::all();
        $partners = Partner::orderBy('id','DESC')->get();
        return [$cities, $providers, $partners];
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
        $rules = [
            'code' => 'required|unique:provider_companies'
        ];

        $messages = [
            'code.required' => 'El código es obligatorio',
            'code.unique' => 'El código ya existe',
            
        ];

        $this->validate($request, $rules, $messages);

        if ($request->hasFile('file_identity_card')) {
            $image = $request->file('file_identity_card');
            $file_identity_card = $image->store('providers', 'public');
        }
        else{
            $file_identity_card = '';
        }
        if ($request->hasFile('file_nit')) {
            $image = $request->file('file_nit');
            $file_nit = $image->store('providers', 'public');
        }
        else{
            $file_nit = '';
        }
        if ($request->hasFile('file_fundaempresa')) {
            $image = $request->file('file_fundaempresa');
            $file_fundaempresa = $image->store('providers', 'public');
        }
        else{
            $file_fundaempresa = '';
        }
        if ($request->hasFile('file_other')) {
            $image = $request->file('file_other');
            $file_other = $image->store('providers', 'public');
        }
        else{
            $file_other = '';
        }
        $provider = new ProviderCompany();
        $provider->user_id = auth()->id();
        $provider->code = $request->code;
        $provider->name = $request->name;
        $provider->nit = $request->nit;
        $provider->fundaempresa = $request->fundaempresa;
        $provider->economic_activity = $request->economic_activity;
        $provider->residence_city = $request->residence_city;
        $provider->phone = $request->phone;
        $provider->address = $request->address;
        $provider->last_name = $request->last_name;
        $provider->first_name = $request->first_name;
        $provider->identity_card = $request->identity_card;
        $provider->city_id = $request->city_id;
        $provider->nationality = $request->nationality;
        $provider->personal_residence_city = $request->personal_residence_city;
        $provider->personal_phone = $request->personal_phone;
        $provider->personal_address = $request->personal_address;
        $provider->email = $request->email;
        $provider->nro_acount = $request->nro_acount;
        $provider->file_identity_card = $file_identity_card;
        $provider->file_nit = $file_nit;
        $provider->file_fundaempresa = $file_fundaempresa;
        $provider->file_others = $file_other;
        $next = $provider->save();
        if ($next) {
            $temp = ProviderCompany::where('code', $request->code)->first();
            if ($request->partners) {
                foreach(json_decode($request->partners) as $partner){
                    $new = new Partner();
                    $new->user_id = auth()->id();
                    $new->provider_company_id = $temp->id;
                    $new->full_name = $partner->full_name;
                    $new->identity_card = $partner->identity_card;
                    $new->city_id = $partner->city_id;
                    $new->participation = $partner->participation;
                    $new->save();
                }
            }
        }
        $partners = Partner::orderBy('id','DESC')->get();
        $providers = ProviderCompany::with('partners')->orderBy('id','DESC')->get();
        return [$providers,$partners];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProviderCompany  $providerCompany
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return 'Entro a show';
        $provider = ProviderCompany::find($id);
        return $provider;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProviderCompany  $providerCompany
     * @return \Illuminate\Http\Response
     */
    public function edit(ProviderCompany $providerCompany)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProviderCompany  $providerCompany
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $provider = ProviderCompany::find($id);
        if ($request->hasFile('file_identity_card_update')) {
            if ($provider->file_identity_card) {
                Storage::disk('public')->delete($provider->file_identity_card);
            }
            $doc = $request->file('file_identity_card_update');
            $file_identity_card = $doc->store('providers', 'public');
        }
        else{
            $file_identity_card = $provider->file_identity_card;
        }
        if ($request->hasFile('file_nit_update')) {
            if ($provider->file_nit) {
                Storage::disk('public')->delete($provider->file_nit);
            }
            $doc = $request->file('file_nit_update');
            $file_nit = $doc->store('providers', 'public');
        }
        else{
            $file_nit = $provider->file_nit;
        }
        if ($request->hasFile('file_fundaempresa_update')) {
            if ($provider->file_fundaempresa) {
                Storage::disk('public')->delete($provider->file_fundaempresa);
            }
            $doc = $request->file('file_fundaempresa_update');
            $file_fundaempresa = $doc->store('providers', 'public');
        }
        else{
            $file_fundaempresa = $provider->file_fundaempresa;
        }
        if ($request->hasFile('file_others_update')) {
            if ($provider->file_others) {
                Storage::disk('public')->delete($provider->file_others);
            }
            $doc = $request->file('file_others_update');
            $file_others = $doc->store('providers', 'public');
        }
        else{
            $file_others = $provider->file_others;
        }
        $provider->user_id = auth()->id();
        $provider->code = $request->code;
        $provider->name = $request->name;
        $provider->nit = $request->nit;
        $provider->fundaempresa = $request->fundaempresa;
        $provider->economic_activity = $request->economic_activity;
        $provider->residence_city = $request->residence_city;
        $provider->phone = $request->phone;
        $provider->address = $request->address;
        $provider->last_name = $request->last_name;
        $provider->first_name = $request->first_name;
        $provider->identity_card = $request->identity_card;
        $provider->city_id = $request->city_id;
        $provider->nationality = $request->nationality;
        $provider->personal_residence_city = $request->personal_residence_city;
        $provider->personal_phone = $request->personal_phone;
        $provider->personal_address = $request->personal_address;
        $provider->email = $request->email;
        $provider->nro_acount = $request->nro_acount;
        $provider->file_identity_card = $file_identity_card;
        $provider->file_nit = $file_nit;
        $provider->file_fundaempresa = $file_fundaempresa;
        $provider->file_others = $file_others;
        $provider->save();
        $providers = ProviderCompany::with('partners')->orderBy('id','DESC')->get();
        return $providers;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProviderCompany  $providerCompany
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $provider = ProviderCompany::find($id);
        if ($provider->file_identity_card) {
            Storage::disk('public')->delete($provider->file_identity_card);
        }
        if ($provider->file_nit) {
            Storage::disk('public')->delete($provider->file_nit);
        }
        if ($provider->file_fundaempresa) {
            Storage::disk('public')->delete($provider->file_fundaempresa);
        }
        if ($provider->file_others) {
            Storage::disk('public')->delete($provider->file_others);
        }
        $provider->partners()->delete();
        $provider->delete();
        $partners = Partner::orderBy('id','DESC')->get();
        $providers = ProviderCompany::with('partners')->orderBy('id','DESC')->get();
        return $providers;
    }
    public function search($id)
    {
        if ($provider = ProviderCompany::where('code', $id)->first()) {
            return $provider;
        }
        else{
            abort(422);
        }
    }
    public function pdf(Request $request){
        //return $request;
        $provider = ProviderCompany::where('code', $request->code)->first();
        $date = Carbon::now();
        // $params = array(
        //     'id' => $provider->id,
        //     'code' => $request->code,
        //     'last_name' => $request->last_name,
        //     'first_name' => $request->code,
        //     'identity_card' => $request->identity_card,
        //     'city_id' => $provider->city->name,
        //     'nit' => $request->nit,
        //     'nationality' => $request->nationality,
        //     'economic_activity' => $request->economic_activity,
        //     'residence_city' => $request->residence_city,
        //     'phone' => $request->phone,
        //     'address' => $request->address,
        //     'email' => $request->email,
        //     'nro_acount' => $request->nro_acount,
        //     'amount_awarded' => $request->amount_awarded,
        //     'detail_amount_awarded' => $request->detail_amount_awarded,
        //     'user' => auth()->user(),
        // );
        return PDF::loadView('layouts.print.print_provider_personal', compact('provider'))
				->setPaper('letter')
				->stream($request->code." ".$date.".pdf");
    }

    public function updatePartners(Request $request){
        //return $request;
        $provider = ProviderCompany::find($request->id);
        $provider->partners()->delete();
        foreach(json_decode($request->partners) as $partner){
            $new = new Partner();
            $new->user_id = auth()->id();
            $new->provider_company_id = $request->id;
            $new->full_name = $partner->full_name;
            $new->identity_card = $partner->identity_card;
            $new->city_id = $partner->city_id;
            $new->participation = $partner->participation;
            $new->save();
        }
        $providers = ProviderCompany::with('partners')->orderBy('id','DESC')->get();
        return $providers;
    }
}
