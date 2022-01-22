<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Performance;
use App\Reservation;
use App\Ticket;
use Carbon\Carbon;
use Facades\App\Helpers\Json;
use Illuminate\Http\Request;
use PDF;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Performance $performance
     * @return void
     */
    public function index(Request $request)
    {
        if ($request->selected) {
            if ($request->control == 'actief') {
                foreach ($request->selected as $key => $part) {
                    $ticket = Ticket::where('id', $key)->first();
                    $ticket->active = true;
                    $ticket->save();
                }
            } elseif ($request->control == 'inactief') {
                foreach ($request->selected as $key => $part) {
                    $ticket = Ticket::where('id', $key)->first();
                    $ticket->active = false;
                    $ticket->save();
                }
            } elseif ($request->control == 'rolstoeltoegankelijk') {
                foreach ($request->selected as $key => $part) {
                    $ticket = Ticket::where('id', $key)->first();
                    $ticket->wheelchairAccessible = true;
                    $ticket->save();
                }
            } elseif ($request->control == 'normaal') {
                foreach ($request->selected as $key => $part) {
                    $ticket = Ticket::where('id', $key)->first();
                    $ticket->wheelchairAccessible = false;
                    $ticket->save();
                }
            }
        }
        $performance = Performance::with('play')->findOrFail($request->performance_id);

        $performances = Performance::with('play')
            ->has('tickets')
            ->withCount('tickets')
            ->where('active', true)
            ->get()
            ->transform(function ($item, $key) {
                $item->date = Carbon::parse($item->dateTime)->format("d/m/Y");
                $item->time = Carbon::parse($item->dateTime)->format("H:i");
                $item->dateTime = "(" . $item->date . "  " . $item->time . ")";
                unset($item->created_at, $item->updated_at, $item->playtime, $item->date, $item->time);
                return $item;
            });


        $tickets = Ticket::where('performance_id', 'like', $performance->id)
            ->get()
            ->transform(function ($item, $key) {
                unset(
                    $item->created_at, $item->updated_at
                );
                return $item;
            });

        $result = compact('performance', 'tickets', 'performances');

        Json::dump($result);
        return view('admin.tickets.edit', $result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $resId = $request->reservationId;
        $resetTickets = Ticket::where('reservation_id', $resId)->get();
        foreach ($resetTickets as $ticket) {
            $ticket->reservation_id = null;
            $ticket->save();
        }

        if ($request->selected) {
            foreach ($request->selected as $key => $part) {
                $ticket = Ticket::where('id', $key)->first();
                $ticket->reservation_id = $resId;
                $ticket->save();
            }
        }

        return redirect('/admin/reservations');
    }

    /**
     * Creates PDF
     * @return mixed
     */
    public function createPDF($performanceId)
    {
        $performance = Performance::where('id', $performanceId)->with(['play'])->get()->transform(function ($item, $key) {
            $item->date = Carbon::parse($item->dateTime)->format("d/m/Y");
            $item->time = Carbon::parse($item->dateTime)->format("H:i");
            $item->dateTime = $item->date . " " . $item->time;
            unset($item->created_at, $item->updated_at, $item->active, $item->playtime, $item->active, $item->date, $item->time);
            return $item;
        })->first();

        $reservations = Reservation::where('performance_id', $performanceId)->has('tickets')->with(['tickets' => function ($query) {
            $query->with('chair');
        }])->orderBy('surName')->get();

        $result = compact('performance', 'reservations');

        Json::dump($result);

        view()->share('admin.reservations.pdf', $result);
        $pdf = PDF::loadView('admin.reservations.pdf', $result);

        return $pdf->download("{$performance->play->name}_{$performance->dateTime}.pdf");
    }
}
