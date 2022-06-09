@extends('layouts.main')

@section('title')
Registration form
@endsection

@section('content')
<div class="container">
    <h2 class="text-center mt-3">Mission Registration Form</h2>
    <form action="{{ route('mission.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="mission" class="form-label">Mission</label>
            <input type="text" class="form-control @error('mission')  is-invalid  @enderror" id="mission" name="mission" value="{{ old('mission') }}">
            @error('mission')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mclient
            <label for=" client" class="form-label">Client</label>
            <input type="text" class="form-control @error('client')  is-invalid  @enderror" id="client" name="client" value="{{ old('client') }}">
            @error('client')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="ville" class="form-label">Ville</label>
            <input type="text" class="form-control @error('ville')  is-invalid  @enderror" id="ville" name="ville" value="{{ old('ville') }}">
            @error('ville')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="peage" class="form-label">Peage</label>
            <input type="text" class="form-control @error('peage')  is-invalid  @enderror" id="peage" name="peage" value="{{ old('peage') }}">
            @error('peage')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="parking" class="form-label">Parking</label>
            <input type="text" class="form-control @error('parking')  is-invalid  @enderror" id="parking" name="parking" value="{{ old('parking') }}">
            @error('parking')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="divers" class="form-label">Divers</label>
            <input type="text" class="form-control @error('divers')  is-invalid  @enderror" id="divers" name="divers" value="{{ old('divers') }}">
            @error('divers')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="repas" class="form-label">Repas</label>
            <input type="text" class="form-control @error('repas')  is-invalid  @enderror" id="repas" name="repas" value="{{ old('repas') }}">
            @error('repas')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="hotel" class="form-label">Hotel</label>
            <input type="text" class="form-control @error('hotel')  is-invalid  @enderror" id="hotel" name="hotel" value="{{ old('hotel') }}">
            @error('hotel')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="km" class="form-label"></label>
            <input type="text" class="form-control @error('km')  is-invalid  @enderror" id="km" name="km" value="{{ old('km') }}">
            @error('km')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
