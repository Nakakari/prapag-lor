<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>{{env('APP_NAME')}} - @yield('title')</title>
    @include('layouts.partials._styles')
</head>

<body class="bg-gradient-primary">

    <div class="container">
        @yield('content')
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center text-white">
                        <strong>{{env('APP_NAME')}} By Black Dev &copy;</strong>
                        <img src="{{asset('icon.png')}}" width="30px">
                    </div>
                </div>
            </div>
        </footer>
    </div>
    @include('layouts.partials._scripts')
</body>
</html>