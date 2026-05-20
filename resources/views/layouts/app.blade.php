<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MultiRental</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body style="background:#f5f7fb; font-family:Figtree,sans-serif;">
    @include('layouts.navigation')

    @if(isset($header))
        <header class="bg-white border-bottom shadow-sm">
            <div class="container py-4">
                {{ $header }}
            </div>
        </header>
    @endif

    <main class="container-fluid py-4">
        {{ $slot }}
    </main>
</body>
</html>