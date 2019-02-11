<?php

namespace App\Http\Controllers;

use PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\ProviderPersonal;
use App\City;
use Illuminate\Http\Request;

class ProviderPersonalController extends Controller
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
        return view('providers_personals.main');
    }
    public function index()
    {
        $providers = ProviderPersonal::orderBy('id','DESC')->get();
        $cities = City::all();
        return [$cities, $providers];
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
            'code' => 'required|unique:provider_personals'
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
        $provider = new ProviderPersonal();
        $provider->user_id = auth()->id();
        $provider->code = $request->code;
        $provider->last_name = $request->last_name;
        $provider->first_name = $request->first_name;
        $provider->identity_card = $request->identity_card;
        $provider->city_id = $request->city_id;
        $provider->nit = $request->nit;
        $provider->nationality = $request->nationality;
        $provider->economic_activity = $request->economic_activity;
        $provider->residence_city = $request->residence_city;
        $provider->phone = $request->phone;
        $provider->address = $request->address;
        $provider->email = $request->email;
        $provider->nro_acount = $request->nro_acount;
        $provider->amount_awarded = $request->amount_awarded;
        $provider->detail_amount_awarded = $request->detail_amount_awarded;
        $provider->file_identity_card = $file_identity_card;
        $provider->file_nit = $file_nit;
        $provider->save();
        $providers = ProviderPersonal::orderBy('id','DESC')->get();
        return $providers;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProviderPersonal  $providerPersonal
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return 'Entro a show';
        $provider = ProviderPersonal::find($id);
        return $provider;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProviderPersonal  $providerPersonal
     * @return \Illuminate\Http\Response
     */
    public function edit(ProviderPersonal $providerPersonal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProviderPersonal  $providerPersonal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $provider = ProviderPersonal::find($id);
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
        $provider->user_id = auth()->id();
        $provider->code = $request->code;
        $provider->last_name = $request->last_name;
        $provider->first_name = $request->first_name;
        $provider->identity_card = $request->identity_card;
        $provider->city_id = $request->city_id;
        $provider->nit = $request->nit;
        $provider->nationality = $request->nationality;
        $provider->economic_activity = $request->economic_activity;
        $provider->residence_city = $request->residence_city;
        $provider->phone = $request->phone;
        $provider->address = $request->address;
        $provider->email = $request->email;
        $provider->nro_acount = $request->nro_acount;
        $provider->amount_awarded = $request->amount_awarded;
        $provider->detail_amount_awarded = $request->detail_amount_awarded;
        $provider->file_identity_card = $file_identity_card;
        $provider->file_nit = $file_nit;
        $provider->save();
        $providers = ProviderPersonal::orderBy('id','DESC')->get();
        return $providers;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProviderPersonal  $providerPersonal
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $provider = ProviderPersonal::find($id);
        if ($provider->file_identity_card) {
            Storage::disk('public')->delete($provider->file_identity_card);
        }
        if ($provider->file_nit) {
            Storage::disk('public')->delete($provider->file_nit);
        }
        $provider->delete();
    }
    public function search($id)
    {
        if ($provider = ProviderPersonal::where('code', $id)->first()) {
            return $provider;
        }
        else{
            abort(422);
        }
    }
    public function pdf(Request $request){
        //return $request;
        $provider = ProviderPersonal::where('code', $request->code)->first();
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
}
