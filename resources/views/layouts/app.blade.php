<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>{{ env('APP_NAME') }} - @yield('title')</title>
    @include('layouts.partials._styles')
</head>

<body id="page-top">
    <div id="wrapper">
        @include('layouts.partials.sidebar')
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('layouts.partials.topbar')
                <div class="container-fluid">
                    {{-- <div class="d-sm-flex align-items-center justify-content-between mb-3">
                        <h1 class="h4 mb-0 text-gray-800">@yield('title')</h1>
                        @yield('header-button')
                    </div> --}}
                    @include('layouts.partials.alert')
                    @yield('content')


                </div>
            </div>
            @include('layouts.partials.footer')
        </div>
    </div>
    @include('layouts.partials._scripts')
</body>

</html>
