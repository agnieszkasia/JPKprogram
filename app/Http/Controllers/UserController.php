<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){
        $user = Auth::user();
        return view('users/profile', compact('user'));
    }

    public function create(){
        //
    }

    public function store(Request $request){
        //
    }

    public function show($id){
        //
    }

    public function edit(){
        $user = Auth::user();

        return view('users/edit', compact('user'));
    }

    public function update(Request $request){
        $user = Auth::user();

        $data = ([
            'first_name' => $request->input('first_name'),
            'family_name' => $request->input('family_name'),
            'company' => $request->input('company'),
            'street_name' => $request->input('street_name'),
            'house_number' => $request->input('house_number'),
            'postal_code' => $request->input('postal_code'),
            'city' => $request->input('city'),
            'nip' => $request->input('nip'),
            'birth_date' => $request->input('birth_date'),
            'email' => $request->input('email'),
        ]);

        $user->update($data);
        return redirect(route('profile'));
    }

    public function destroy($id){
        //
    }

}
