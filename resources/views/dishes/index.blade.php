@extends('layouts.app')

@section('title', 'Bicolano Dishes')

@section('content')
    <a href="{{ route('dishes.create') }}" class="btn btn-success mb-3">Add Dish</a>

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Dish</th>
                <th>Main Ingredient</th>
                <th>Origin</th>
                <th>Tag</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($dishes as $id => $dish)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><a href="{{ route('dishes.show', $id) }}">{{ $dish['name'] }}</a></td>
                    <td>{{ $dish['main_ingredient'] }}</td>
                    <td>{{ $dish['origin'] }}</td>
                    <td>
                        @if ($dish['origin'] === 'Camarines Sur')
                            <span class="badge bg-success">Camarines Sur</span>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No dishes are available right now. Please check back later.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection