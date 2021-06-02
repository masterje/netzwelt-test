<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <style>

        ul{
          margin-left:10px;
        }

        /* Second Level */
        ul ul{
          margin-left:15px;
        }

        /* Third Level */
        ul ul ul{
          margin-left:20px;
        }

ul, #myUL {
list-style-type: none;
}
#myUL {
margin: 0;
padding: 0;
}
.caret {
cursor: pointer;
-webkit-user-select: none; /* Safari 3.1+ */
-moz-user-select: none; /* Firefox 2+ */
-ms-user-select: none; /* IE 10+ */
user-select: none;
}
.caret::before {
content: "\25B6";
color: black;
display: inline-block;
margin-right: 6px;
}
.caret-down::before {
-ms-transform: rotate(90deg); /* IE 9 */
-webkit-transform: rotate(90deg); /* Safari */'
transform: rotate(90deg);
}
.nested {
display: none;
}
.active {
display: block;
}
</style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>

    <script>
var toggler = document.getElementsByClassName("caret");
var i;
for (i = 0; i < toggler.length; i++) {
toggler[i].addEventListener("click", function() {
this.parentElement.querySelector(".nested").classList.toggle("active");
this.classList.toggle("caret-down");
});
}
</script>

</html>
