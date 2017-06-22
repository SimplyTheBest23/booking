<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Портал сдачи жилья</title>

    <!-- Styles -->
    <link href="{{ asset('/css/app.css')}}" rel="stylesheet">
    <link href="{{ asset('/css/style.css')}}" rel="stylesheet">
    <!-- Scripts -->
    <script src="{{asset('js/app.js')}}"></script>
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    <script src="https://use.fontawesome.com/5ec193cf54.js"></script>
    <script src="{{ url('/js/verify2.js')}}"></script>

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        Главная
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                                @if (url()->current()==url('/admin/statistic'))
                                    <li class="active">
                                @else
                                    <li>
                                @endif
                                    <a href="{{ url('/admin/statistic')}}">Статистика</a></li>

                                @if (url()->current()==url('/admin/hotels'))
                                    <li class="active"><a href="{{ url('/admin/hotels')}}">Объявления</a></li>
                                @else
                                    <li><a href="{{ url('/admin/hotels')}}">Объявления</a></li>
                                @endif

                                @if (url()->current()==url('/admin/pays'))
                                    <li class="active">
                                @else
                                    <li>
                                @endif
                                    <a href="{{url('/admin/pays')}}">Платежи</a></li>


                                <li>
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Настройки
                                    <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                      <li><a href="{{url('/admin/paidservices')}}">Настройки стоимости</a></li>
                                      <li><a href="{{url('/admin/features')}}">Редактирование категорий</a></li>
                                      <li><a href="{{url('/admin/sms')}}">Настройки СМС</a></li>
                                      <li><a href="{{url('/admin/cities')}}">Список городов</a></li>
                                      <li><a href="{{url('/admin/other')}}">Другие настройки</a></li>

                                    </ul>
                                </li>
                    </ul>

                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->

</body>
</html>
