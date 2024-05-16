<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Management Tasks</title>

    @include('components.style')
</head>

<body class="bg-soft-blue">

    @include('components.navbar')

    <section class="py-5">
        <div class="container-fluid px-2 px-lg-5">
            @yield('content')
        </div>
    </section>

   @include('components.script')
</body>

</html>
