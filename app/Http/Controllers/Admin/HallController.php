<?php

namespace App\Http\Controllers\Admin;

use App\Hall;
use App\Http\Controllers\Controller;
use App\Performance;
use Facades\App\Helpers\Json;
use Illuminate\Http\Request;

class HallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $halls = Hall::orderBy('name')->get();
        $result = compact('halls');
        Json::dump($result);
        return view('admin.halls.index', $result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.halls.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|min:3|max:255',
            'address' => array(
                'required',
                'min:2',
                'max:255',
                'regex:/\w+\s+\d{1,5}/'
            ),
            'place' => 'required|min:2|max:255|regex:/^[A-Za-zÀ-ÖØ-öø-ÿ]+$/',
            'postalCode' => 'required|digits:4',
            'capacity' => 'required|min:0'
        ], [
            'name.min' => 'De naam moet minstens 3 letters lang zijn.',
            'name.max' => 'De naam mag niet langer zijn dan 255 letters.',
            'place.min' => 'De plaatsnaam moet minstens 3 letters lang zijn.',
            'place.max' => 'De plaatsnaam mag niet langer zijn dan 255 letters.',
            'place.regex' => 'De plaatsnaam kan enkel letters bevatten.',
            'address.min' => 'Het adres moet minstens 3 tekens lang zijn.',
            'address.max' => 'Het adres mag niet langer zijn dan 255 tekens.',
            'address.regex' => 'Het adres moet beginnen met een straatnaam eindigen met een straatnummer.',
            'postalCode.digits' => 'De postcode moet 4 cijfers lang zijn.',
            'capacity.min' => 'De capaciteit mag niet negatief zijn.'
        ]);
        $hall = new Hall();
        $hall->name = $request->name;
        $hall->address = $request->address;
        $hall->place = $request->place;
        $hall->postalCode = $request->postalCode;
        $hall->capacity = $request->capacity;
        $hall->save();

        session()->flash('success', "De nieuwe zaal <b>$hall->name</b> werd succesvol aangemaakt");
        return redirect('admin/halls');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Hall  $hall
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show(Hall $hall)
    {
        return redirect('admin/halls');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Hall  $hall
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit(Hall $hall)
    {
        $result = compact('hall');
        Json::dump($result);
        return view('admin.halls.edit', $result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Hall  $hall
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Hall $hall)
    {
        $this->validate($request,[
            'name' => 'required|min:3|max:255',
            'address' => array(
                'required',
                'min:2',
                'max:255',
                'regex:/\w+\s+\d{1,5}/'
            ),
            'place' => 'required|min:2|max:255|regex:/^[A-Za-zÀ-ÖØ-öø-ÿ]+$/',
            'postalCode' => 'required|digits:4',
            'capacity' => 'required|min:0'
        ], [
            'name.min' => 'De naam moet minstens 3 letters lang zijn.',
            'name.max' => 'De naam mag niet langer zijn dan 255 letters.',
            'place.min' => 'De plaatsnaam moet minstens 3 letters lang zijn.',
            'place.max' => 'De plaatsnaam mag niet langer zijn dan 255 letters.',
            'place.regex' => 'De plaatsnaam kan enkel letters bevatten.',
            'address.min' => 'Het adres moet minstens 3 tekens lang zijn.',
            'address.max' => 'Het adres mag niet langer zijn dan 255 tekens.',
            'address.regex' => 'Het adres moet beginnen met een straatnaam eindigen met een straatnummer.',
            'postalCode.digits' => 'De postcode moet 4 cijfers lang zijn.',
            'capacity.min' => 'De capaciteit mag niet negatief zijn.'
        ]);
        $hall->name = $request->name;
        $hall->address = $request->address;
        $hall->place = $request->place;
        $hall->postalCode = $request->postalCode;
        $hall->capacity = $request->capacity;
        $hall->save();

        session()->flash('success', "De zaal <b>$hall->name</b> werd succesvol bijgewerkt");
        return redirect("admin/halls");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Hall  $hall
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy(Hall $hall)
    {
        // Abort deletion + show alert message if there are still performances given in this hall
        $performances = Performance::where('hall_id', '=', $hall->id)->first();
        if (!is_null($performances)) {
            session()->flash('danger', "De zaal <b>$hall->name</b> kan niet verwijderd worden omdat er nog voorstellingen in gegeven worden");
            return redirect('admin/halls');
        }

        $hall->delete();

        session()->flash('success', "De zaal <b>$hall->name</b> werd succesvol verwijderd");
        return redirect('admin/halls');
    }
}
