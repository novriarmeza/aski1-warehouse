<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/datatables.css') }}" rel="stylesheet">

    <title>@yield('title')</title>
  </head>
  <body>
        <nav class="navbar navbar-expand-md shadow-sm" style="background-color: rgb(255, 255, 255)">
            <div class="container">
                <a class="navbar-brand" style="color: black" href="#">MATKOMP</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <div class="navbar-nav">
                        <a class="nav-link nav-item" style="color: black" href="{{url('/')}}">OS</a>
                        <a class="nav-link nav-item" style="color: black" href="{{url('/gr')}}">GR</a>
                        <a class="nav-link nav-item" style="color: black" href="{{url('/sap')}}">Feedback SAP</a>
                        <a class="nav-link nav-item" style="color: black" href="{{url('/stock')}}">Stock</a>
                    </div>
                </div>
            </div>
        </nav>

        @yield('container')


        <!-- Optional JavaScript -->

        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="{{asset('js/jquery.js')}}"></script>
        <script src="{{asset('js/popper.js')}}"></script>
        <script src="{{asset('js/bootstrap.js')}}"></script>
        <script src="{{asset('js/datatable.fixheader.min.js')}}"></script>
        <script src="{{asset('js/datatable.min.js')}}"></script>
        @yield('js')
        @yield('jspagination')
    </body>
    <script type="text/javascript">
    function autoRefreshPage()
    {
        window.location = window.location.href;
    }
    setInterval('autoRefreshPage()', 60000);
    
</script>
</html>
