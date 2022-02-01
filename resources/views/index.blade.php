<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Phrasele</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>

    @livewireStyles
    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body class="antialiased">
<div id="content">
    <livewire:game />
</div>
<div id="footer">
    <footer class="fixed bottom-0 w-full bg-gray-800 text-center lg:text-left">
        <div class="text-center p-4 text-white">
            <p class="uppercase tracking-wide">PHRASELE - Daily phrase guessing game.</p>
        </div>
    </footer>
</div>
@livewireScripts
</body>
</html>
