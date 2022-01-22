<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use App\Helpers\Json;
use Carbon\Carbon;
use Dotenv\Loader\Value;
use Hash;
use Illuminate\Http\Request;
use php_user_filter;
use phpDocumentor\Reflection\DocBlock\Tags\InvalidTag;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $name = '%' . $request->input('name') . '%';
        $sort_by = $request->input('sort_by');
        $column = 'id';
        $direction = 'asc';
        if (is_int(strpos($sort_by, 'desc'))) {
            $direction = 'desc';
        }
        if (is_int(strpos($sort_by, 'name'))) {
            $column = 'firstName';
        }
        elseif (is_int(strpos($sort_by, 'lName'))) {
            $column = 'surname';
        }
        elseif (is_int(strpos($sort_by, 'place'))) {
            $column = 'place';
        }
        $users = User::orderBy($column, $direction)
            //controleren of de ingegeven string in de voornaam zit
            ->where(function($query) use($name){
                $query->where('firstName', 'like', $name);
            })
            //controleren of de ingegeven string in de achternaam zit
            ->orWhere(function($query) use($name){
                    $query->where('surname', 'like', $name);
            })
            ->get()
            ->transform(function ($item, $key) {
                $item->name = ucfirst($item->firstName) . ' ' . $item->surname;
                $item->address = ucfirst($item->address);
                $item->place = ucfirst($item->place);
                $item->record = ucfirst($item->firstName) . ' ' . $item->surname . ' <' . $item->email . '>; ';
                unset($item->created_at, $item->updated_at);
                return $item;
            });
        $maillist = "";
        foreach($users as $user) {
            if (!str_contains($maillist, $user->record)) {
                $maillist .= $user->record;
            }
        }

        $result = compact('users', 'maillist');
        (new \App\Helpers\Json)->dump($result);
        return view('admin.users.index', $result);
    }

    //show profile
    public function show(User $user)
    {
        $result = compact('user');
        (new \App\Helpers\Json)->dump($result);
        return view('admin.users.show', $result);
    }

    //update profile
    public function edit(User $user)
    {
        $result = compact('user');
        (new \App\Helpers\Json)->dump($result);
        return view('admin.users.edit', $result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request,[
            'firstName' => 'required|min:2|max:255|regex:/^[A-Za-zÀ-ÖØ-öø-ÿ]+$/',
            'surname' => 'required|min:2|max:255',
            'email' => "required|min:2|max:255|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix",
            'telephone' => 'required|min:8|max:12',
            'address' => 'required|min:2|max:255|regex:/^[A-z]+\s\d+$/',
            'place' => 'required|min:2|max:255|regex:/^[A-Za-zÀ-ÖØ-öø-ÿ]+$/',
            'postalCode' => 'required|digits:4',
            'sex' => 'required|min:1|max:1'
        ], [
            'surname.min' => 'De naam moet minstens 2 tekens lang zijn.',
            'surname.max' => 'De naam mag niet langer zijn dan 255 tekens.',
            'surname.regex' => 'De naam kan enkel letters bevatten.',
            'firstName.min' => 'De naam moet minstens 2 tekens lang zijn.',
            'firstName.max' => 'De naam mag niet langer zijn dan 255 tekens.',
            'firstName.regex' => 'De naam kan enkel letters bevatten.',
            'email.min' => 'De email kan niet minder dan 5 tekens bevatten.',
            'email.max' => 'De email mag niet langer zijn dan 255 tekens.',
            'email.regex' => 'De email moet valide zijn.',
            'telephone.min' => 'Het telefoonnummer moet minstens 8 cijfers lang zijn.',
            'telephone.max' => 'Het telefoonnummer mag niet langer zijn dan 16 cijfers.',
            'telephone.regex' => 'Het telefoonnummer moet valide zijn.',
            'address.min' => 'Het adres moet minstens 3 tekens lang zijn.',
            'address.max' => 'Het adres mag niet langer zijn dan 255 tekens.',
            'address.regex' => 'Het adres moet beginnen met een straatnaam eindigen met een straatnummer.',
            'place.min' => 'De plaatsnaam moet minstens 3 letters lang zijn.',
            'place.max' => 'De plaatsnaam mag niet langer zijn dan 255 letters.',
            'place.regex' => 'De plaatsnaam kan enkel letters bevatten.',
            'postalCode.digits' => 'De postcode moet 4 cijfers lang zijn.',
        ]);
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

        session()->flash('success', "De gebruiker <b>$user->firstName</b> <b>$user->surname</b> werd succesvol bijgewerkt");
        return redirect('admin/users');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $user = new User();
        $user->active = 1;
        $user->admin = 0;
        $result = compact('user');
        return view('admin.users.create', $result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $mail
     */
    public function destroy(User $user)
    {
        $user->delete();

        session()->flash('success', "De gebruiker <b>$user->firstName</b> <b>$user->surname</b> werd succesvol verwijderd");
        return redirect('admin/users');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'firstName' => 'required|min:2|max:255|regex:/^[A-Za-zÀ-ÖØ-öø-ÿ]+$/',
            'surname' => 'required|min:2|max:255',
            'email' => "required|min:2|max:255|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix",
            'telephone' => 'required|min:8|max:12',
            'address' => 'required|min:2|max:255|regex:/^[A-z]+\s\d+$/',
            'place' => 'required|min:2|max:255|regex:/^[A-Za-zÀ-ÖØ-öø-ÿ-é-à-ï-û -\-]+$/',
            'postalCode' => 'required|digits:4',
            'sex' => 'required|min:1|max:1'
        ], [
            'surname.min' => 'De naam moet minstens 2 tekens lang zijn.',
            'surname.max' => 'De naam mag niet langer zijn dan 255 tekens.',
            'surname.regex' => 'De naam kan enkel letters bevatten.',
            'firstName.min' => 'De naam moet minstens 2 tekens lang zijn.',
            'firstName.max' => 'De naam mag niet langer zijn dan 255 tekens.',
            'firstName.regex' => 'De naam kan enkel letters bevatten.',
            'email.min' => 'De email kan niet minder dan 5 tekens bevatten.',
            'email.max' => 'De email mag niet langer zijn dan 255 tekens.',
            'email.regex' => 'De email moet valide zijn.',
            'telephone.min' => 'Het telefoonnummer moet minstens 8 cijfers lang zijn.',
            'telephone.max' => 'Het telefoonnummer mag niet langer zijn dan 16 cijfers.',
            'telephone.regex' => 'Het telefoonnummer moet valide zijn.',
            'address.min' => 'Het adres moet minstens 3 tekens lang zijn.',
            'address.max' => 'Het adres mag niet langer zijn dan 255 tekens.',
            'address.regex' => 'Het adres moet beginnen met een straatnaam eindigen met een straatnummer.',
            'place.min' => 'De plaatsnaam moet minstens 3 letters lang zijn.',
            'place.max' => 'De plaatsnaam mag niet langer zijn dan 255 letters.',
            'place.regex' => 'De plaatsnaam kan enkel letters bevatten.',
            'postalCode.digits' => 'De postcode moet 4 cijfers lang zijn.',
        ]);
        $user = new User();
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
        $user->password = Hash::make($request->password);
        $user->save();

        session()->flash('success', "De nieuwe gebruiker <b>$user->firstName</b> <b>$user->surname</b> werd succesvol aangemaakt");
        return redirect('admin/users');
    }
}
