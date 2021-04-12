<?php

namespace App\Http\Controllers;

//use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use function Sodium\compare;

class UserController extends Controller{

    /* This function returns user profile view */
    public function show(){
        $user = $this->getAuthUser();
        $companyTaxInformation = $user->companyTaxInformation;

        if ($companyTaxInformation) {
            if ($companyTaxInformation->settlement_form == 'JPK_V7M') {
                $companyTaxInformation->settlement_form = 'Miesięczny';
            } elseif ($companyTaxInformation->settlement_form == 'JPK_V7K') {
                $companyTaxInformation->settlement_form = 'Kwartalny';
            }
            if ($companyTaxInformation->entity_type == '1') {
                $companyTaxInformation->entity_type = 'Osoba fizyczna';
            } elseif ($companyTaxInformation->entity_type == '2') {
                $companyTaxInformation->entity_type = 'Osoba niefizyczna';
            }
        }
        return view('users.profile', compact('user', 'companyTaxInformation'));
    }

    /* This function shows edit user view */
    public function edit(){
        $user = $this->getAuthUser();

        return view('users.edit', compact('user'));
    }

    /* This function updates the user data to the database from edit form */
    public function update(Request $request){
        $user = $this->getAuthUser();

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

        $this->validator($request);
        $user->update($data);
        return redirect(route('profile'));
    }

    protected function validator($request){
        return $request->validate([
            'first_name' => ['required','regex:/^[a-zA-Z]+$/u','string', 'max:255', 'min:2'],
            'family_name' => ['required', 'string', 'max:255', 'min:2'],
            'company' => ['required', 'string', 'max:255', 'min:2'],
            'street_name' => ['required', 'string', 'min:3', 'max:255'],
            'house_number' => ['required', 'string', 'max:255'],
            'postal_code' => ['required','regex:/[0-9]{2}-[0-9]{3}/u', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'nip' => ['required', 'string', 'regex:/[0-9]{10}/u', 'size:10'],
            'birth_date' => ['required', 'string','regex:/[0-9]{2}\.[0-9]{2}\.19[0-9]{2}|200[0,1,2,3]/u', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);
    }

    /* This function shows edit user view */
    public function editPassword(){
        $user = $this->getAuthUser();
        return view('users.edit_password', compact('user'));
    }

    /* This function updates the user data to the database from edit form */
    public function updatePassword(Request $request){
        $user = $this->getAuthUser();

        if (Hash::check($request->old_password, $user->password)){
            $request->validate([
                'old_password' => ['required', 'string', 'min:8'],
                'new_password' => ['required', 'string', 'min:8'],
                'confirm_password' => ['required', 'same:new_password'],
            ]);

            $user->update([
                'password'=>bcrypt($request->new_password)
            ]);;
            return redirect(route('profile'));

        } else {
            return redirect()->back()->with('errorMsg','Hasło jest nieprawidłowe');
        }

    }

}
