<!DOCTYPE html>
    <html lang="en">
    <head>
       @include('layouts.partials.head')
    </head>
    <body>
    @include('layouts.partials.nav')
    @include('layouts.partials.header')
    <div class="container">
        <div class="row">
            <div class="col-sm">
            </div>
        </div>
    </div>
    @yield('content')

    @include('layouts.partials.footer')
    @include('layouts.partials.footer-scripts')  
</body>
</html>