<?php

namespace App\Http\Controllers;

use Hash;
use App\City;
use App\User;
use App\Role;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function main(){
        return view('users.main');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = City::all();
        $users = User::with('city')->with('roles')->orderBy('id', 'DESC')->where('id', '>', 1)->get();
        $roles = Role::all();
        return [$cities, $users, $roles];
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
            'username' => 'unique:users',
        ];

        $messages = [
            'username.unique' => 'El nombre de usuario ya existe'
        ];

        $this->validate($request, $rules, $messages);
        $user = new User();
        $user->last_name = $request->last_name;
        $user->first_name = $request->first_name;
        $user->city_id = $request->city_id;
        $user->phone = $request->phone;
        $user->status = true;
        $user->gender = $request->gender;
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        if($user->save()){
            $user = User::where('username', $request->username)->first();
            $user->roles()->attach($request->roles);
        }
        $users = User::with('city')->with('roles')->where('id', '>', 1)->orderBy('id', 'DESC')->get();
        return $users;
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->roles()->detach();
    }

    public function status(Request $request){
        $user = User::find($request->id);
        $user->status = $request->status;
        $user->save();
    }

    public function verifica(Request $request){
        $user = User::find(1);
        $password = bcrypt($request->password);
        if (Hash::check($request->password, $user->password))
        {
            return response('Verificacion Correcta', 200);
        }
        else{
            return abort(422);
        }
    }
}
