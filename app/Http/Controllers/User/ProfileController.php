<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    // Edit user profile
    public function edit()
    {
        return view('user.profile');
    }

    // Update user profile
    public function update(Request $request)
    {
        // Validate $request
        // MOET NOG AANGEPAST WORDEN
        $this->validate($request,[
            'firstName' => 'required',
            'surname' => 'required',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'telephone' => 'required|min:8|max:16',
            'address' => 'required',
            'place' => 'required',
            'postalCode' => 'required||min:4|max:4',
            'sex' => 'required|min:1|max:1',
        ]);

        // Update user in the database and redirect to previous page
        $user = User::findOrFail(auth()->id());
        $user->firstName = $request->firstName;
        $user->surname = $request->surname;
        $user->email = $request->email;
        $user->telephone = $request->telephone;
        $user->address = $request->address;
        $user->place = $request->place;
        $user->postalCode = $request->postalCode;
        $isCheckedActive = $request->has('active');
        $isCheckedAdmin = $request->has('admin');
        $user->admin = $isCheckedAdmin;
        $user->active = $isCheckedActive;
        $user->sex = $request->sex;
        $user->save();

        session()->flash('success', 'Uw profiel werd succesvol bijgewerkt');
        return back();
    }
}
