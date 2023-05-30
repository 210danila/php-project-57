<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Менеджер задач</title>

        <!-- Scripts -->
        <link rel="stylesheet" href="https://php-task-manager-ru.hexlet.app/build/assets/app.8ad19020.css">
        <link rel="stylesheet" href="https://php-task-manager-ru.hexlet.app/build/assets/app.8ad19020.css">
        <!-- <script type="module" src="../../js/app.js"></script> -->
        <script src="{{ asset('js/app.js') }}"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    </head>

    <body>
        <div id="app">

            <header class="fixed w-full">
                @include('layouts.navigation')
            </header>

            <!-- Page Content -->
            <section class="bg-white dark:bg-gray-900">
                <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 lg:pt-28">
                    @yield('content')
                </div>
            </section>

        </div>
    </body>
</html>
