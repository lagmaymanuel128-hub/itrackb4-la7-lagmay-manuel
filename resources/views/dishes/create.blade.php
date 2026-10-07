@extends('layouts.app')

@section('title', 'Add a Dish')

@section('content')
    <h2>Add a Dish</h2>

    <form method="POST" action="{{ route('dishes.store') }}">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Dish Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="main_ingredient" class="form-label">Main Ingredient</label>
            <input type="text" class="form-control" id="main_ingredient" name="main_ingredient" value="{{ old('main_ingredient') }}">
            @error('main_ingredient')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="origin" class="form-label">Origin</label>
            <select class="form-select" id="origin" name="origin">
                <option value="">-- Choose an origin --</option>
                <option value="Naga City" @selected(old('origin') === 'Naga City')>Naga City</option>
                <option value="Camarines Sur" @selected(old('origin') === 'Camarines Sur')>Camarines Sur</option>
                <option value="Albay" @selected(old('origin') === 'Albay')>Albay</option>
                <option value="Camarines Norte" @selected(old('origin') === 'Camarines Norte')>Camarines Norte</option>
            </select>
            @error('origin')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Save Dish</button>
        <a href="{{ route('dishes.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection