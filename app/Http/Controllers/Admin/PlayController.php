<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Job;
use App\Performance;
use App\Play;
use App\PlayRole;
use App\User;
use Facades\App\Helpers\Json;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class PlayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $playName = '%' . $request->input('playName') . '%';
        $sort_by = $request->input('sort_by');
        $column = 'year';
        $direction = 'asc';
        $active = 1;
        if (is_int(strpos($sort_by, 'desc'))) {
            $direction = 'desc';
        }
        if (is_int(strpos($sort_by, 'name'))) {
            $column = 'name';
        }
        elseif (is_int(strpos($sort_by, 'year'))) {
            $column = 'year';
        }
        elseif (is_int(strpos($sort_by, 'inactive'))) {
            $active = 0;
        }

        $plays = Play::orderBy($column, $direction)
            ->where(function($query) use($playName){
                $query->where('name', 'like', $playName);
            })
            ->where('active', $active)
            ->get();
        $result = compact('plays');

        return view('admin.play.index', $result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $play = new Play();
        $play->active = 1;
        $result = compact('play');
        return view('admin.play.create', $result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $isChecked = $request->has('active');
        $this->validate($request,[
            'name' => 'required|min:3|unique:plays,name|max:255',
            'description' => 'required|min:3|max:255',
            'year' => 'required|integer|digits:4',
            'playtime' => 'required|integer|min:2|max:300'
        ], [
            'name.min' => 'De naam moet minstens 3 tekens lang zijn.',
            'name.max' => 'De naam mag niet langer zijn dan 255 tekens.',
            'name.unique' => 'De naam moet uniek zijn tussen de toneelstukken.',
            'description.min' => 'De beschrijving moet minstens 3 tekens lang zijn.',
            'description.max' => 'De beschrijving mag niet langer zijn dan 255 tekens.',
            'year.digits' => 'Het jaar moet 4 cijfers bevatten.',
            'playtime.min' => 'De speeltijd kan niet korter zijn dan 2 minuten.',
            'playtime.max' => 'De speeltijd kan niet langer zijn dan 300 minuten.',
        ]);

        $play = new Play();
        $play->name = $request->name;
        $play->year = $request->year;
        $play->description = $request->description;
        $play->playtime = $request->playtime;

        $play->active = $isChecked;

        foreach ($play->performances as $performance) {
            $performance->active = $isChecked;
            $performance->save();
        }

        $play->save();

        $redirect = '/admin/play/' . (string)$play->id . '/roles';

        session()->flash('success', "Het nieuwe toneelstuk <b>$play->name</b> werd succesvol aangemaakt");
        return redirect($redirect);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Play  $play
     * @return \Illuminate\Http\Response
     */
    public function show(Play $play)
    {
        $people = User::orderby('firstname', 'asc')
            ->get()
            ->transform(function ($item, $key) {

                $item->firstName = ucfirst($item->firstName);
                $item->surname = ucfirst($item->surname);

                unset($item->created_at, $item->updated_at, $item->email, $item->email_verified_at, $item->telephone,
                    $item->telephone, $item->address, $item->place, $item->postalCode, $item->admin, $item->active);
                return $item;
            });
        $playRequest = Play::with('playRoles')
            ->with('playRoles.user')
            ->with('playRoles.job')
            ->findOrFail($play->id);
        $result = compact('playRequest', 'people');
        return view('admin.play.show', $result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Play  $play
     * @return \Illuminate\Http\Response
     */
    public function edit(Play $play)
    {
        $result = compact('play');
        Json::dump($result);
        return view('admin.play.edit', $result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Play  $play
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Play $play)
    {
        $isChecked = $request->has('active');
        $this->validate($request,[
            'name' => 'required|min:3|max:255|unique:plays,name,' . $play->id,
            'description' => 'required|min:3|max:255',
            'year' => 'required|integer|digits:4',
            'playtime' => 'required|integer|min:2|max:300'
        ], [
            'name.min' => 'De naam moet minstens 3 tekens lang zijn.',
            'name.max' => 'De naam mag niet langer zijn dan 255 tekens.',
            'name.unique' => 'De naam moet uniek zijn tussen de toneelstukken.',
            'description.min' => 'De beschrijving moet minstens 3 tekens lang zijn.',
            'description.max' => 'De beschrijving mag niet langer zijn dan 255 tekens.',
            'year.digits' => 'Het jaar moet 4 cijfers bevatten.',
            'playtime.min' => 'De speeltijd kan niet korter zijn dan 2 minuten.',
            'playtime.max' => 'De speeltijd kan niet langer zijn dan 300 minuten.',
        ]);

        $play->name = $request->name;
        $play->year = $request->year;
        $play->description = $request->description;
        $play->playtime = $request->playtime;
        $play->active = $isChecked;

        foreach ($play->performances as $performance) {
            $performance->active = $isChecked;
            $performance->save();
        }
        $play->save();
        session()->flash('success', "Het toneelstuk <b>$play->name</b> werd succesvol bijgewerkt");
        return redirect('admin/play');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Play  $play
     * @return \Illuminate\Http\Response
     */
    public function destroy(Play $play)
    {
        $performances = Performance::where('play_id', '=', $play->id)->first();
        if (!is_null($performances)) {
            session()->flash('danger', "Het toneelstuk <b>$play->name</b> kan niet verwijderd worden omdat er nog voorstellingen van bestaan");
            return redirect('admin/play');
        }
        $play->delete();
        session()->flash('success', "Het toneelstuk <b>$play->name</b> werd succesvol verwijderd");
        return redirect('admin/play');
    }

    public function showRoles(Play $play)
    {
        $people = User::orderby('firstname', 'asc')
            ->get()
            ->transform(function ($item, $key) {

                $item->firstName = ucfirst($item->firstName);
                $item->surname = ucfirst($item->surname);

                unset($item->created_at, $item->updated_at, $item->email, $item->email_verified_at, $item->telephone,
                    $item->telephone, $item->address, $item->place, $item->postalCode, $item->admin, $item->active);
                return $item;
            });

        $playRequest = Play::with('playRoles')
            ->with('playRoles.user')
            ->with('playRoles.job')
            ->findOrFail($play->id);

        $jobs = Job::get();
        $result = compact( 'people',  'jobs', 'playRequest');
        return view('admin.play.role.edit',$result);
    }

    public function saveRoles(Request $request)
    {
        $this->validate($request,[
            'character' => 'max:255',
            'play_id' => 'required',
            'role' => 'required',
            'person' => 'required'
        ]);

        $role = new PlayRole();
        $role->character = $request->character;
        $role->play_id = $request->play_id;
        $role->job_id = $request->role;
        $role->user_id = $request->person;
        $role->save();

        $redirect = '/admin/play/' . (string)$request->play_id . '/roles';
        session()->flash('success', "De nieuwe rol <b>$role->character</b> werd succesvol aangemaakt");
        return redirect($redirect);
    }

    public function destroyRoles(PlayRole $role)
    {
        $role->delete();

        session()->flash('success', "De rol <b>$role->character</b> werd succesvol verwijderd");
        return redirect()->back();
    }
}
