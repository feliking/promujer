<?php

namespace App\Http\Controllers;

use App\City;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //$providers = ProviderPersonal::all();
        $cities = City::all()->pluck('name', 'id');
        //return $providers;
        //return view('provider_personals.index', compact('providers', 'cities'));
        return view('providers.index', compact('cities'));
    }
}
