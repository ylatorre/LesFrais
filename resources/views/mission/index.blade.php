@extends('layouts.main')

@section('title')
Déplacements
@endsection

@section('content')
<div class="container mt-3">
    @if ($message = session('success'))
    <div class="alert alert-success mx-1" role="alert">
        {{ $message }}
    </div>
    @endif



    <table class="table table-hover mt-5">
        <thead>
            <tr>
                <th>Jour</th>
                <th>Mission</th>
                <th>Client</th>
                <th>Ville</th>
                <th>Code Postal</th>
                <th>Peage</th>
                <th>Parking</th>
                <th>Divers</th>
                <th>Repas</th>
                <th>Hotel</th>
                <th>KM</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($missions as $mission)
            <tr>
                <td> {{ $mission->id }}</td>
                <td>{{ $mission->mission }}</td>
                <td>{{ $mission->client }}</td>
                <td>{{ $mission->ville }}</td>
                <td>{{ $mission->code_postal }}</td>
                <td>{{ $mission->peage }}</td>
                <td>{{ $mission->parking }}</td>
                <td>{{ $mission->divers }}</td>
                <td>{{ $mission->repas}}</td>
                <td>{{ $mission->hotel }}</td>
                <td>{{ $mission->km }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-5">
        {{ $missions->links() }}
    </div>
</div>
@endsection
