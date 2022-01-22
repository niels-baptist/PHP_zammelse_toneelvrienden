<?php

namespace App\Http\Controllers\Visitor;

use Auth;
use Facades\App\Helpers\Json;
use App\Http\Controllers\Controller;
use App\Performance;
use App\Reservation;
use App\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $reservation = new Reservation();
        $performances = Performance::where('active', 1)->with(['play', 'hall', 'tickets' => function($query) {$query->with('chair')->orderBy('chair_id');}])
            ->withCount(['tickets' => function ($query) {
                $query->where('active', 1);
                $query->where('reservation_id', null);
            }])
            ->get()
            ->transform(function ($item, $key) {
                $item->date = Carbon::parse($item->dateTime)->format("d/m/Y");
                $item->time = Carbon::parse($item->dateTime)->format("H:i");
                $item->available_seats = $item->hall->capacity - $item->ticket_count;
                $item->dateTime = "(" .$item->date . "  " . $item->time . ")";
                return $item;
            });
        $result = compact('performances', 'reservation');
        Json::dump($result);
        return view('visitor.index', $result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'firstName' => 'required|min:2|max:255|regex:/^[A-Za-zÀ-ÖØ-öø-ÿ]+$/',
            'surname' => 'required|min:2|max:255',
            'email' => "required|min:2|max:255|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix",
            'telephone' => 'required|min:8|max:12',
            'address' => 'required|min:2|max:255|regex:/^[A-z]+\s\d+$/',
            'place' => 'required|min:2|max:255|regex:/^[A-Za-zÀ-ÖØ-öø-ÿ]+$/',
            'postalCode' => 'required|digits:4',
            'performance_id' => 'required',
            'selected' => "required|array|min:1"
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
            'performance_id.required' => 'Selecteer een voorstelling',
            'selected.required' => 'Selecteer minstens 1 stoel.'
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
        $reservation->paid = 0;

        $reservation->save();
        $amount = 0;
        foreach ($request->selected as $key => $part) {
            $ticket = Ticket::where('id', $key)->first();
            $ticket->reservation_id = $reservation->id;
            $ticket->save();
            $amount++;
        }

        $performance = $reservation::with('performance');
        $play = $performance==with('play');
        $hall = $performance==with('hall');
        $result = compact('performance', 'reservation', 'play', 'hall');
        json::dump($result);

        $cost = $reservation->performance->price * $amount;
        try {
            $mail = new PHPMailer(true);
            $mail->SMTPDebug = SMTP::DEBUG_OFF;
            $mail->isSMTP();
            $mail->Host = 'smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Username = 'ee7f5745138e67';
            $mail->Password = '559b3cde52596b';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 2525;
            $mail->setFrom('no-reply@zammelsetoneelvrienden.be', 'Zammelse Toneelvrienden');
            $mail->addAddress($reservation->email, $reservation->firstName . ' ' . $reservation->surname);
            $mail->isHTML(true);
            $mail->Subject = 'Bedankt voor uw reservatie';
            $mail->Body = '<style>.h1{padding: 10px;} .body{font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";} </style>' .
                '<h3>Wij hebben uw reservatie goed ontvangen</h3>
                <p>Beste ' . $reservation->firstName . ' ' . $reservation->surname . ' <br> wij verwelkomen u graag op ' . $reservation->performance->dateTime . ' te ' . $reservation->performance->hall->name . '</p>
                <p style="font-style: italic">Graag op voorhand betalen? Schrijf dan  <span style="font-weight: bold">' . ($cost) . '</span> euro over op rekeningnummer  <span style="font-weight: bold">BE001234567</span> met vrije mededeling <span style="font-weight: bold">' . $reservation->firstName . ' ' . $reservation->surname . ' ' . substr($reservation->performance->dateTime, 0, 10) . '</span> </p>
                <p>Met vriendelijke groeten <br> Zammelse Toneelvrienden</p>';
            $mail->send();
        }
        catch (phpmailerException $e) {
            echo $e->errorMessage(); //Pretty error messages from PHPMailer
        }

        if (Auth::check())
        {
            if(auth()->user()->admin)
            {
                $performance_id = $request->input('performance_id') ?? '%';
                $reservationName = '%' . $request->input('reservationName') . '%';
                $sort_by = $request->input('sort_by');
                $column = 'id';
                $direction = 'asc';
                if (strpos($sort_by, 'desc') !== false) {
                    $direction = 'desc';
                }
                if (strpos($sort_by, 'name') !== false) {
                    $column = 'firstName';
                }
                elseif (strpos($sort_by, 'payed') !== false) {
                    $column = 'paid';
                    $direction = 'desc';
                }

                $reservations = Reservation::withCount('tickets')
                    ->with(['performance' => function ($query){$query->with('play');}])
                    ->where(function($query) use($performance_id, $reservationName){
                        $query->where('performance_id', 'like', $performance_id)
                            ->where('firstName', 'like', $reservationName);
                    })
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

                        ;
                        // Remove all fields that you don't use inside the view
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
                        $item->price;
                        unset($item->created_at, $item->updated_at, $item->active, $item->playtime, $item->active, $item->paymentByTransfer);
                        return $item;
                    });

                $result = compact('reservations', 'performances', 'maillist');
                Json::dump($result);
                $reservation->name = $reservation->firstName . ' ' . $reservation->surname;
                session()->flash('success', "De reservatie voor <b>$reservation->name</b> werd succesvol aangemaakt");
                return view('admin.reservations.index', $result);
            }
        }
        else {
            return view('visitor.success', $result);
        }
    }
}
