@include('layout.header')

@yield('nav_mobile')
<!-- PAGE CONTENT-->
        <div class="page-content--bgf7 m-h-600">
            @yield('nav_desktop')
            @yield('content')
        </div>

@include('layout.footer')

