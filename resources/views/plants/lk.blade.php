<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ __('Личный кабинет') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ __('Личный кабинет') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Вход') }}</a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Регистрация') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                                <img class="img-profile rounded-circle " src="{{Auth::user()->avatar}}" height="40px"
                                    width="40px">
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Выход') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4" style="max-width: 1140px; margin: auto; margin-top: 50px;">
            <!-- @yield('content') -->
            <div class="row">
                <div class="col-md-12">
                    <form method="post" action="{{route('account.update')}}">
                        @csrf
                        @method('PUT')
                        <!-- Advanced Tables -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h2>Редактирование пользователя</h2>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>

                                                <th>
                                                    <label for="name">
                                                        Name
                                                    </label>
                                                </th>
                                                <th>
                                                    <label for="email">
                                                        Email
                                                    </label>
                                                </th>
                                                <th>
                                                    <label for="avatar">
                                                        Avatar
                                                    </label>
                                                </th>
                                                <th>
                                                    <label for="time">
                                                        Time
                                                    </label>
                                                </th>
                                                <th>
                                                    <label for="notice">
                                                        Notice
                                                    </label>
                                                </th>
                                                <th>Действие</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr>

                                                <td>
                                                    <input type="text" class="form-control" name="name"
                                                        placeholder="name" id="name" value="{{$user->name}}">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="email"
                                                        placeholder="email" id="email" value="{{$user->email}}">
                                                </td>
                                                <td>
                                                    <img src="{{$user->avatar}}" alt="slide" height="150px"
                                                        width="150px"><br><br>
                                                    <input type="url" class="form-control" name='avatar'
                                                        placeholder="ссылка на аватарку" id="file">
                                                </td>
                                                <td>
                                                    <input type="time" id="time" name="time" />
                                                </td>
                                                <td>
                                                    <div class="notice_edit">
                                                        <input type="checkbox"><label>&nbsp;SMS</label><br>
                                                        <input type="checkbox"><label>&nbsp;Telegram</label><br>
                                                        <input type="checkbox"><label>&nbsp;E-mail</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <input class="btn btn-primary" style="float: right" type="submit"
                                                        value="Сохранить">
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                    </form>
                </div>
                <!--End Advanced Tables -->
            </div>
    </div>
    </main>
    </div>
</body>

</html>