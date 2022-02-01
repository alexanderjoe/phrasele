<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Phrasele - Add Phrase</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>
<body class="antialiased">
<div id="content">
    <div class="flex justify-center items-center bg-gray-700 min-h-screen content-center">
        <div class="block p-6 rounded-lg shadow-lg bg-white max-w-sm">
            <form action="{{ route('create.phrase') }}" method="POST">
                @csrf
                <div class="form-group mb-6">
                    <label for="phrase" class="form-label inline-block mb-2 text-gray-700">New Phrase</label>
                    <input type="text"
                           class="block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                           id="phrase" name="phrase" placeholder="New Phrase">
                </div>
                <div class="form-group mb-6">
                    <label for="password" class="form-label inline-block mb-2 text-gray-700">Password</label>
                    <input type="password"
                           class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                           id="password" name="password" placeholder="Password">
                </div>
                <button type="submit"
                        class="px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                    Submit
                </button>
                <div class="font-medium text-green-600 mt-3">
                    @if(session('message'))
                        {{ session('message') }}
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
<div id="footer">
    <footer class="fixed bottom-0 w-full bg-gray-800 text-center lg:text-left">
        <div class="text-center p-4 text-white">
            <p class="uppercase tracking-wide">PHRASELE - Daily phrase guessing game.</p>
        </div>
    </footer>
</div>
</body>
</html>
