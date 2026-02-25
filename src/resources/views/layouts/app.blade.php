<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EasyColoc</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">
    @include('partials.header')

    <main
        class="flex-col items-center justify-center min-h-screen bg-cover bg-center bg-no-repeat"
        style="background-image: url('{{ asset('images/pexels-felix-mittermeier-957085.jpg') }}');">
        >
        @yield('content')
    </main>

    @include('partials.footer')
</body>

</html>