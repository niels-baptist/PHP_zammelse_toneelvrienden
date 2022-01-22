<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    // Edit user password
    public function edit()
    {
        return view('user.password');
    }

    // Update and encrypt user password
    public function update(Request $request)
    {
        // Validate $request
        $this->validate($request,[
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::findOrFail(auth()->id());

        // Show alert if the current password doesn't match the password in the database
        if (!Hash::check($request->current_password, $user->password)) {
            session()->flash('danger', "Huidig wachtwoord komt niet overeen met het wachtwoord in de database");
            return back();
        }

        // Update encrypted user password in the database
        $user->password = Hash::make($request->password);
        $user->save();

        // Send user back to login screen
        Auth::logout();
        return redirect('login');
    }
}
