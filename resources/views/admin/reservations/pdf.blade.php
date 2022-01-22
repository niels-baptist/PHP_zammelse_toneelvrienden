<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>{{ $performance->play->name }} - {{ $performance->dateTime }}</title>
</head>
<body>
    <h1 class="font-weight-bold">{{ $performance->play->name }}</h1>
    <h2 class="font-weight-bold">{{ $performance->dateTime }}</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Naam</th>
                <th>Telefoon</th>
                <th>Betaald</th>
                <th>Stoelen</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reservations as $reservation)
                <tr>
                    <td>{{ $reservation->surname }} {{ $reservation->firstName }}</td>
                    <td>{{ $reservation->telephone }}</td>
                    <td>{{ $reservation->paid == 0 ? 'Nee' : 'Ja' }}</td>
                    <td>
                        @foreach ($reservation->tickets as $ticket)
                            <span>{{ $ticket->chair->chairNumber }}, </span>
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
