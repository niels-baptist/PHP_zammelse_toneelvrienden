<?php

namespace App\Http\Controllers\Admin;
use Facades\App\Helpers\Json;
use App\Http\Controllers\Controller;
use App\Performance;
use App\Reservation;
use App\Ticket;
use App\Play;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Foreach_;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $performance_id = $request->input('performance_id') ?? '%';
        $reservationName = '%' . $request->input('reservationName') . '%';

        $sort_by = $request->input('sort_by');
        $column = 'id';
        $direction = 'asc';
        if (is_int(strpos($sort_by, 'desc'))) {
            $direction = 'desc';
        }

        if (is_int(strpos($sort_by, 'name'))) {
            $column = 'firstName';
        }

        elseif (is_int(strpos($sort_by, 'paid'))) {
            $column = 'paid';
            $direction = 'desc';
        }

        $reservations = Reservation::withCount('tickets')
            ->with(['performance' => function ($query){$query->with('play');}])
            //controleren of de ingegeven string in de voornaam zit
            ->where(function($query) use($performance_id, $reservationName){
                $query->where('performance_id', 'like', $performance_id)
                    ->where('firstName', 'like', $reservationName);
            })
            //controleren of de ingegeven string in de achternaam zit
            ->orWhere(function($query) use($performance_id, $reservationName){
                $query->where('performance_id', 'like', $performance_id)
                    ->where('surname', 'like', $reservationName);
            })
            ->orderBy($column, $direction)
            ->get()
            ->transform(function ($item, $key) {
                // Set first letter of name to uppercase and add the counter
                $item->name = ucfirst($item->firstName) . ' ' . $item->surname;
                $item->date = Carbon::parse($item->performance->dateTime)->format("d/m/Y");
                $item->time = Carbon::parse($item->performance->dateTime)->format("H:i");
                $item->record = ucfirst($item->firstName) . ' ' . $item->surname . ' <' . $item->email . '>; ';
                if ($item->paid){
                    $item->message = "Betaald";
                } else{
                    $item->message = "Niet betaald";
                }
                unset($item->created_at, $item->updated_at);
                return $item;
            });

        $maillist = "";
        foreach($reservations as $reservation) {
            if (!str_contains($maillist, $reservation->record)) {
                if (substr($reservation->performance->dateTime, 0, 4) >= date("Y") - 3) {
                    $maillist .= $reservation->record;
                }
            }
        }
        $performances = Performance::with('play')
            ->has('tickets')
            ->withCount('tickets')
            ->get()
            ->transform(function ($item, $key){
                $item->date = Carbon::parse($item->dateTime)->format("d/m/Y");
                $item->time = Carbon::parse($item->dateTime)->format("H:i");
                $item->dateTime = "(" .$item->date . "  " . $item->time . ")";
                unset($item->created_at, $item->updated_at, $item->active, $item->playtime, $item->active, $item->paymentByTransfer);
                return $item;
            });

        $result = compact('reservations', 'performances', 'maillist');
        Json::dump($result);
        /*return redirect('admin/reservations/');*/
        return view('admin.reservations.index', $result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $reservation = new Reservation();

        $performances = Performance::with('play')
            ->get()
            ->transform(function ($item, $key){
                $item->date = Carbon::parse($item->dateTime)->format("d/m/Y");
                $item->time = Carbon::parse($item->dateTime)->format("H:i");
                $item->dateTime = "(" .$item->date . "  " . $item->time . ")";
                $item->performanceText = "(" .$item->date . "  " . $item->time . ")";
                unset($item->created_at, $item->updated_at, $item->active, $item->playtime, $item->active);
                return $item;
            });

        $result = compact('reservation', 'performances');
        Json::dump($result);
        return view('admin.reservations.create', $result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'surname' => 'required|min:2|max:255',
            'firstName' => 'required|min:2|max:255|regex:/^[A-Za-zÀ-ÖØ-öø-ÿ]+$/',
            'email' => 'required|min:5|max:255|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'telephone' => 'required|min:8|max:12',
            'address' => 'required|min:5|max:255|regex:/^[A-z]+\s\d+$/',
            'place' => 'required|min:2|max:255|regex:/^[A-Za-zÀ-ÖØ-öø-ÿ\-]+$/',
            'postalCode' => 'required|digits:4',
            'performance_id' => 'required'

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
        $reservation = new Reservation();
        $reservation->surname = $request->surname;
        $reservation->firstName = $request->firstName;
        $reservation->email = $request->email;
        $reservation->telephone = $request->telephone;
        $reservation->address = $request->address;
        $reservation->place = $request->place;
        $reservation->postalCode = $request->postalCode;
        $reservation->performance_id = $request->performance_id;
        $reservation->reservationDate = now();
        $reservation->paymentByTransfer = false;
        if ($request->paid == null) {
            $reservation->paid = 0;
        }
        else {
            $reservation->paid = 1;
        }

        $reservation->save();
        $performance = Performance::findOrFail($reservation->performance_id);
        $play = Play::findOrFail($performance->play_id);
        session()->flash('success', "De reservatie van <b>$reservation->firstName</b> <b>$reservation->surname</b> voor het toneelstuk <b>$play->name</b> werd succesvol aangemaakt");

        $redirect = '/admin/reservations/' . (string)$reservation->id ;

        return redirect($redirect);
//
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function show(Reservation $reservation)
    {
        $reservation1 = Reservation::where('id', 'like', $reservation->id)
            ->withCount('tickets')->get();
        $reservation = $reservation1->first();

        $tickets = Ticket::where('performance_id', 'like', $reservation->performance_id)->get()
            ->transform(function ($item, $key) {
                $item->icon = 'fas fa-chair';
                $item->stackColor = 'style=color:Lightgrey';
                $item->stack = 'far fa-circle';
                $item->status = "unbooked";
                $item->title = "Ticket vrij";
                unset($item->created_at, $item->updated_at);
                return $item;
            });

        $result = compact('reservation', 'tickets');
        Json::dump($result);
        return view('admin.tickets.show', $result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservation $reservation)
    {
        $reservation = Reservation::with('performance')
            ->withCount('tickets')
            ->findOrFail($reservation->id);
        $reservation->first();

        $performances = Performance::get()
            ->transform(function ($item, $key){
                $item->date = Carbon::parse($item->dateTime)->format("d/m");
                $item->time = Carbon::parse($item->dateTime)->format("H:i");
                $item->performanceText = "(" .$item->date . "  " . $item->time . ")";
                unset($item->created_at, $item->updated_at, $item->active, $item->playtime, $item->active);
                return $item;
            });
        $result = compact('reservation', 'performances');
        Json::dump($result);
        return view('admin.reservations.edit', $result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reservation $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reservation  $reservation)
    {
        $this->validate($request, [
            'surname' => 'required|min:2|max:255',
            'firstName' => 'required|min:2|max:255|regex:/^[A-Za-zÀ-ÖØ-öø-ÿ]+$/',
            'email' => 'required|min:5|max:255|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'telephone' => 'required|min:8|max:12',
            'address' => 'required|min:5|max:255|regex:/^[A-z]+\s\d+$/',
            'place' => 'required|min:2|max:255|regex:/^[A-Za-zÀ-ÖØ-öø-ÿ\-]+$/',
            'postalCode' => 'required|digits:4',
            'performance_id' => 'required'

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
        $reservation->surname = $request->surname;
        $reservation->firstName = $request->firstName;
        $reservation->email = $request->email;
        $reservation->telephone = $request->telephone;
        $reservation->address = $request->address;
        $reservation->place = $request->place;
        $reservation->postalCode = $request->postalCode;
        $reservation->performance_id = $request->performance_id;
        if ($request->paid == null) {
            $reservation->paid = 0;
        }
        else {
            $reservation->paid = 1;
        }
        $reservation->save();

        $performance = Performance::findOrFail($reservation->performance_id);
        $play = Play::findOrFail($performance->play_id);
        session()->flash('success', "De reservatie van <b>$reservation->firstName</b> <b>$reservation->surname</b> voor het toneelstuk <b>$play->name</b> werd succesvol bijgewerkt");

        // Go to the public detail page for the newly created record
        return redirect("admin/reservations");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reservation $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();

        $performance = Performance::findOrFail($reservation->performance_id);
        $play = Play::findOrFail($performance->play_id);
        session()->flash('success', "De reservatie van <b>$reservation->firstName</b> <b>$reservation->surname</b> voor het toneelstuk <b>$play->name</b> werd succesvol verwijderd");

        return redirect('admin/reservations');
    }
}
