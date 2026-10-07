<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>
<body>
    @include('partials._nav')

    <div class="container mt-4">
        <h1>Bicolano Dishes</h1>
        <p class="text-muted">Prepared by: LAGMAY JR. MANUEL T.</p>

        {{-- Part E: success message, read once from the session --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @yield('content')
    </div>
</body>
</html>