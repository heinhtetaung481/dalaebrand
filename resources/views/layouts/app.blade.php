<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'DalaeBrand') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script src="https://code.jquery.com/jquery.js"></script>
    <script src="https://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">



</head>
<body>
    <div id="app">
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container-fluid">
              <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="./">Dalae Brand</a>
              </div>
              <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav show-on-mobile">
                  <li><a href="#"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a></li>
                  <li><a href="{{ url('/stock') }}"><span class="glyphicon glyphicon-briefcase"></span> Product</a></li>
                  <li>
                  <li><a href="/itemtype"><span class="glyphicon glyphicon-tasks"></span> Product Type</a></li>
                  <li>
                    <a href="#order-detail" class="dropdown-toggle" data-toggle="collapse"><span class="glyphicon glyphicon-shopping-cart"></span> Order &nbsp; &nbsp; &nbsp;  	&nbsp;<span class="caret"></span></a>
                    <ul class="nav collapse" id="order-detail">
                      <li><a href="{{ url('/order')}}">View Orders</a></li>
                      <li><a href="{{ url('/order/create')}}">Make New Order</a></li>
                    </ul>
                  </li>
                  <li><a href="/customer"><span class="glyphicon glyphicon-user">Customer</span></a></li>
                  <li><a href="{{ url('/design')}}"><span class="glyphicon glyphicon-scissors"></span> Design</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @guest
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu">
                                <li>
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
              </div>
            </div>
      </nav>
<!-- Sidebar Start -->
      <div class="container-fluid">
            <div class="row row-offcanvas row-offcanvas-left hide-on-mobile">
              <!-- sidebar start -->
              @auth
               <div class="col-sm-3 col-md-2 col-xs-12 sidebar-offcanvas" id="sidebar" role="navigation">

                  <ul class="nav nav-sidebar" role="navigation">
                    <li><a href="/dashboard"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a></li>
                    <li><a href="{{ url('/stock') }}"><span class="glyphicon glyphicon-briefcase"></span> Product</a></li>
                    <li>
                    <li><a href="/itemtype"><span class="glyphicon glyphicon-tasks"></span> Product Type</a></li>
                    <li>
                      <a href="#order-detail" class="dropdown-toggle" data-toggle="collapse" data-target="#order-detail2"><span class="glyphicon glyphicon-shopping-cart"></span> Order &nbsp; &nbsp; &nbsp;  	&nbsp;<span class="caret"></span></a>
                      <ul class="nav collapse" id="order-detail2">
                        <li><a href="{{ url('/order')}}">View Orders</a></li>
                        <li><a href="{{ url('/order/create')}}">Make New Order</a></li>
                      </ul>
                    </li>
                    <li><a href="/customer"><span class="glyphicon glyphicon-user"></span> Customer</a></li>
                    <li><a href="{{ url('/design')}}"><span class="glyphicon glyphicon-scissors"></span> Design</a></li>
                  </ul>

              </div><!--/span-->
              @endauth
              <!-- sidebar end -->
              <div class="col-sm-9 col-md-10 main">

                <!--toggle sidebar button-->
                <!-- <p class="visible-xs">
                  <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas"><i class="glyphicon glyphicon-chevron-left"></i></button>
                </p> -->

                @yield('content')
            </div><!--/row-->
        </div>
      </div>
    </div>

    <!-- Scripts -->

    <script src="{{ asset('js/app.js') }}"></script>

</body>
</html>
