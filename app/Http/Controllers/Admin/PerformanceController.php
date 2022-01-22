<?php

namespace App\Http\Controllers\Admin;

use App\Hall;
use App\Http\Controllers\Controller;
use App\Performance;
use App\Play;
use App\Ticket;
use Carbon\Carbon;
use Facades\App\Helpers\Json;
use Illuminate\Http\Request;
use SebastianBergmann\Environment\Console;

class PerformanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $play_id = $request->input('play_id') ?? '%';
        $hall_id = $request->input('hall_id') ?? '%';

        $sort_by = $request->input('sort_by');

        $column = 'dateTime';
        $direction = 'asc';
        $active = 1;

        if (is_int(strpos($sort_by, 'desc'))) {
            $direction = 'desc';
        }

        if (is_int(strpos($sort_by, 'date'))) {
            $column = 'dateTime';
        }
        elseif (is_int(strpos($sort_by, 'price'))) {
            $column = 'price';
        }
        elseif (is_int(strpos($sort_by, 'tickets_count'))) {
            $column = 'tickets_count';
        }
        elseif (is_int(strpos($sort_by, 'inactive'))) {
            $active = 0;
        }

        $performances = Performance::with('play', 'hall')
            // tickets_count = amount of ACTIVE and RESERVED tickets (seats)
            ->withCount(['tickets' => function ($query) {
                $query->where('active', true)->where('reservation_id', '!=', null);
            }])
            ->where('play_id', 'like', $play_id)
            ->where('hall_id', 'like', $hall_id)
            ->where('active', $active)
            ->orderBy($column, $direction)
            ->get()
            ->transform(function ($item, $key) {

                // Create separate attributes for date & time
                $item->date = Carbon::parse($item->dateTime)->format("d/m/Y");
                $item->time = Carbon::parse($item->dateTime)->format("H:i");

                // Get all INACTIVE tickets for the performance
                $inactive_tickets = Ticket::where('performance_id', $item->id)->where('active', false)->get();

                // Subtract amount of inactive tickets (seats) from capacity
                $item->active_tickets = $item->hall->capacity - count($inactive_tickets);
                $item->available_tickets = $item->active_tickets - $item->tickets_count;

                // leave out unused data
                unset(
                    $item->created_at, $item->updated_at, $item->dateTime, $item->tickets_count,
                    $item->play->created_at, $item->play->updated_at, $item->play->description, $item->play->playtime, $item->play->year, $item->play->active,
                    $item->hall->created_at, $item->hall->updated_at, $item->hall->address, $item->hall->place, $item->hall->postalCode
                );

                return $item;
            });
        $plays = Play::orderBy('year', 'desc')
            ->get()
            ->transform(function ($item, $key) {
                // leave out unused data
                unset(
                    $item->created_at, $item->updated_at, $item->description, $item->playtime,$item->active
                );
                return $item;
            });

        $halls = Hall::orderBy('name')
            ->get()
            ->transform(function ($item, $key) {
                // leave out unused data
                unset(
                    $item->created_at, $item->updated_at, $item->capacity, $item->address, $item->place, $item->postalCode
                );
                return $item;
            });

        $result = compact('performances', 'plays', 'halls');
        Json::dump($result);
        return view("admin.performances.index", $result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $performance = new Performance();
        /* Check active checkbox by default when creating a new performance */
        $performance->active = 1;

        $plays = Play::orderBy('year', 'desc')
            ->get()
            ->transform(function ($item, $key) {
                // leave out unused data
                unset(
                    $item->created_at, $item->updated_at, $item->description, $item->playtime, $item->active, $item->year
                );
                return $item;
            });

        $halls = Hall::orderBy('name')
            ->get()
            ->transform(function ($item, $key) {
                // leave out unused data
                unset(
                    $item->created_at, $item->updated_at, $item->capacity, $item->address, $item->place, $item->postalCode
                );
                return $item;
            });

        $result = compact('performance', 'plays', 'halls');
        Json::dump($result);
        return view('admin.performances.create', $result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'hall_id' => 'required',
            'play_id' => 'required',
            'date' => 'required|date_format:d/m/Y',
            'time' => 'required|date_format:H:i',
            'price' => 'required|numeric|min:0'
        ], [
            'date.date_format' => 'Gebruik AUB dit formaat: DD/MM/YYYY vb. 02/12/2020',
            'time.date_format' => 'Gebruik AUB dit formaat: HH:MM vb. 20:30',
            'price.min' => 'De prijs mag niet negatief zijn.'
        ]);

        $performance = new Performance();

        $performance->hall_id = $request->hall_id;
        $performance->play_id = $request->play_id;
        $performance->dateTime = Carbon::createFromFormat("d/m/Y H:i", $request->date . " " . $request->time);
        $performance->price = $request->price;

        $isChecked = $request->has('active');
        $performance->active = $isChecked;

        $performance->save();

        // Create (unreserved) tickets for new performance
        $hall = Hall::findOrFail($performance->hall_id);

        // Create (unreserved) tickets for new performance
        for ($i = 1; $i <= $hall->capacity; $i++) {
            $ticket = new Ticket();

            $ticket->performance_id = $performance->id;
            $ticket->reservation_id = null;
            $ticket->chair_id = $i;
            $ticket->wheelchairAccessible = false;
            $ticket->active = ($i == 180 || $i == 193) ? 0 : 1;

            $ticket->save();
        }

        // Show alert
        $play = Play::findOrFail($performance->play_id);
        $date = Carbon::parse($performance->dateTime)->format("d/m/Y");
        $time = Carbon::parse($performance->dateTime)->format("H:i");
        session()->flash('success', "De nieuwe voorstelling van <b>$play->name</b> op <b>$date</b> om <b>$time</b> werd succesvol aangemaakt");

        return redirect('admin/performances');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Performance  $performance
     * @return \Illuminate\Http\Response
     */
    public function show(Performance $performance)
    {
        $tickets = Ticket::where('performance_id', 'like', $performance->id)
            ->get()
            ->transform(function ($item, $key){
                $item->icon = 'fas fa-chair';
                if ($item->reservation_id){
                    $item->status = "booked";
                    $item->checked = "checked disabled";
                    $item->stack = 'far fa-circle';
                    $item->stackColor = 'style=color:Lightgrey';
                    $item->title = 'Ticket bezet';
                }
                else{
                    $item->status = "unbooked";
                    $item->stack = 'far fa-circle';
                    $item->stackColor = 'style=color:Lightgrey';
                    $item->title = 'Ticket vrij';
                }
                if ($item->active == false){
                    $item->stack = 'fas fa-ban';
                    $item->stackColor = 'style=color:Tomato';
                    $item->title = 'Ticket inactief';
                }
                if ($item->wheelchairAccessible == true){
                    $item->stackColor = 'style=color:Blue';
                    $item->title = 'Ticket is rolstoeltoegankelijk';
                }
                unset(
                    $item->created_at, $item->updated_at
                );
                return $item;
            });


        $performances = Performance::with('play')
            ->has('tickets')
            ->withCount('tickets')
            ->where('active', true)
            ->get()
            ->transform(function ($item, $key){
                $item->date = Carbon::parse($item->dateTime)->format("d/m/Y");
                $item->time = Carbon::parse($item->dateTime)->format("H:i");
                $item->dateTime = "(" .$item->date . "  " . $item->time . ")";
                unset($item->created_at, $item->updated_at, $item->active,
                    $item->playtime, $item->active, $item->date, $item->time);
                return $item;
            });

        $result = compact('performance', 'tickets', 'performances');

        Json::dump($result);
        return view('admin.tickets.edit', $result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Performance  $performance
     * @return \Illuminate\Http\Response
     */
    public function edit(Performance $performance)
    {
        $performance->date = Carbon::parse($performance->dateTime)->format("d/m/Y");
        $performance->time = Carbon::parse($performance->dateTime)->format("H:i");

        $plays = Play::orderBy('year', 'desc')
            ->get()
            ->transform(function ($item, $key) {
                // leave out unused data
                unset(
                    $item->created_at, $item->updated_at, $item->description, $item->playtime, $item->active, $item->year
                );
                return $item;
            });

        $halls = Hall::orderBy('name')
            ->get()
            ->transform(function ($item, $key) {
                // leave out unused data
                unset(
                    $item->created_at, $item->updated_at, $item->capacity, $item->address, $item->place, $item->postalCode
                );
                return $item;
            });

        /*$result = compact('performance');*/ $result = compact('performance', 'plays', 'halls');
        Json::dump($result);
        return view('admin.performances.edit', $result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Performance  $performance
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Performance $performance)
    {
        $this->validate($request,[
            'hall_id' => 'required',
            'play_id' => 'required',
            'date' => 'required|date_format:d/m/Y',
            'time' => 'required|date_format:H:i',
            'price' => 'required|numeric|min:0'
        ], [
            'date.date_format' => 'Gebruik AUB dit formaat: DD/MM/YYYY vb. 02/12/2020',
            'time.date_format' => 'Gebruik AUB dit formaat: HH:MM vb. 20:30',
            'price.min' => 'De prijs mag niet negatief zijn.'
        ]);

        $performance->play_id = $request->play_id;
        $performance->dateTime = Carbon::createFromFormat("d/m/Y H:i", $request->date . " " . $request->time);
        $performance->price = $request->price;

        $isChecked = $request->has('active');
        $performance->active = $isChecked;

        $performance->save();

        // Show alert
        $play = Play::findOrFail($performance->play_id);
        $date = Carbon::parse($performance->dateTime)->format("d/m/Y");
        $time = Carbon::parse($performance->dateTime)->format("H:i");
        session()->flash('success', "De voorstelling van <b>$play->name</b> op <b>$date</b> om <b>$time</b> werd succesvol bijgewerkt");

        return redirect('admin/performances');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Performance  $performance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Performance $performance)
    {
        $performance->delete();

        // Show alert
        $play = Play::findOrFail($performance->play_id);
        $date = Carbon::parse($performance->dateTime)->format("d/m/Y");
        $time = Carbon::parse($performance->dateTime)->format("H:i");
        session()->flash('success', "De voorstelling van <b>$play->name</b> op <b>$date</b> om <b>$time</b> werd succesvol verwijderd");

        return redirect('admin/performances');
    }
}
