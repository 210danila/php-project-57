<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <style class="darkreader darkreader--fallback" media="screen"></style><style class="darkreader darkreader--text" media="screen"></style><style class="darkreader darkreader--invert" media="screen">.jfk-bubble.gtx-bubble, .captcheck_answer_label > input + img, span#closed_text > img[src^="https://www.gstatic.com/images/branding/googlelogo"], span[data-href^="https://www.hcaptcha.com/"] > #icon, #bit-notification-bar-iframe, ::-webkit-calendar-picker-indicator {
            filter: invert(100%) hue-rotate(180deg) contrast(90%) !important;
        }</style><style class="darkreader darkreader--inline" media="screen">[data-darkreader-inline-bgcolor] {
          background-color: var(--darkreader-inline-bgcolor) !important;
        }
        [data-darkreader-inline-bgimage] {
          background-image: var(--darkreader-inline-bgimage) !important;
        }
        [data-darkreader-inline-border] {
          border-color: var(--darkreader-inline-border) !important;
        }
        [data-darkreader-inline-border-bottom] {
          border-bottom-color: var(--darkreader-inline-border-bottom) !important;
        }
        [data-darkreader-inline-border-left] {
          border-left-color: var(--darkreader-inline-border-left) !important;
        }
        [data-darkreader-inline-border-right] {
          border-right-color: var(--darkreader-inline-border-right) !important;
        }
        [data-darkreader-inline-border-top] {
          border-top-color: var(--darkreader-inline-border-top) !important;
        }
        [data-darkreader-inline-boxshadow] {
          box-shadow: var(--darkreader-inline-boxshadow) !important;
        }
        [data-darkreader-inline-color] {
          color: var(--darkreader-inline-color) !important;
        }
        [data-darkreader-inline-fill] {
          fill: var(--darkreader-inline-fill) !important;
        }
        [data-darkreader-inline-stroke] {
          stroke: var(--darkreader-inline-stroke) !important;
        }
        [data-darkreader-inline-outline] {
          outline-color: var(--darkreader-inline-outline) !important;
        }
        [data-darkreader-inline-stopcolor] {
          stop-color: var(--darkreader-inline-stopcolor) !important;
        }</style><style class="darkreader darkreader--variables" media="screen">:root {
           --darkreader-neutral-background: #131516;
           --darkreader-neutral-text: #d8d4cf;
           --darkreader-selection-background: #004daa;
           --darkreader-selection-text: #e8e6e3;
        }</style><style class="darkreader darkreader--root-vars" media="screen"></style><style class="darkreader darkreader--user-agent" media="screen">html {
            background-color: #181a1b !important;
        }
        html {
            color-scheme: dark !important;
        }
        html, body, input, textarea, select, button, dialog {
            background-color: #181a1b;
        }
        html, body, input, textarea, select, button {
            border-color: #736b5e;
            color: #e8e6e3;
        }
        a {
            color: #3391ff;
        }
        table {
            border-color: #545b5e;
        }
        ::placeholder {
            color: #b2aba1;
        }
        input:-webkit-autofill,
        textarea:-webkit-autofill,
        select:-webkit-autofill {
            background-color: #404400 !important;
            color: #e8e6e3 !important;
        }
        ::-webkit-scrollbar {
            background-color: #202324;
            color: #aba499;
        }
        ::-webkit-scrollbar-thumb {
            background-color: #454a4d;
        }
        ::-webkit-scrollbar-thumb:hover {
            background-color: #575e62;
        }
        ::-webkit-scrollbar-thumb:active {
            background-color: #484e51;
        }
        ::-webkit-scrollbar-corner {
            background-color: #181a1b;
        }
        ::selection {
            background-color: #004daa !important;
            color: #e8e6e3 !important;
        }
        ::-moz-selection {
            background-color: #004daa !important;
            color: #e8e6e3 !important;
        }</style>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'TaskManager') }}</title>
        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        <!-- Scripts -->
        @vite(['resources/js/app.js', 'resources/css/app.css'])
    </head>
    <body>
        <div id="app">
            <header class="fixed w-full">
                @include('layouts.navigation')
            </header>
            <!-- Page Content -->
            <section class="bg-white dark:bg-gray-900">
                <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 lg:pt-28">
                    @include('flash::message')
                    @yield('content')
                </div>
            </section>

        </div>
    </body>
</html>
