<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="csrf-param" content="_token" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Менеджер задач</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>
    <header>
        <div class="container-fluid">   
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="/">Менеджер задач</a>
                <div class="navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="/tasks">Задачи</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/task_statuses">Статусы</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/labels">Метки</a>
                    </li>
                    </ul>
                </div>
                    @if (Route::has('login'))
                            @auth
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a href="route('logout')"
                                            onclick="event.preventDefault();
                                                        this.closest('form').submit();"
                                            class="btn btn-success">
                                        {{ __('Log Out') }}
                                    </a>
                                </form>
                            @else
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a class="btn btn-success" href="{{ route('login') }}" role="button">Log in</a>
                                    <a class="btn btn-secondary" href="{{ route('register') }}" role="button">Register</a>
                                </div>
                            @endauth
                    @endif
            </nav>
        </div>
     </header>
    <div class="container">
        @yield('content')
    </div>
</body>
</html>