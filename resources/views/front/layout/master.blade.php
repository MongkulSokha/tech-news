<!DOCTYPE html>
<html>

<head>
    @include('front.layout.top')
</head>

<body id="page-top" data-spy="scroll" data-target=".navbar">
    <div id="main-wrapper">
        <!-- Page Preloader -->
        <div id="preloader">
            <div id="status">
                <div class="status-mes"></div>
            </div>
        </div>
        <!-- preloader -->

        <div class="uc-mobile-menu-pusher">
            <div class="content-wrapper">
                @include('front.layout.header')

                @yield('content')


                @include('front.layout.footer')
            </div>
        </div>
    </div>
    <!-- #main-wrapper -->

    @include('front.layout.bottom')
</body>

</html>
