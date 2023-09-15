<header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid ">
                <div class="container">
                    <div class="navbar-collapse d-flex justify-content-between" id="navbarNav">
                        <a class="navbar-brand" href="/">Менеджер задач</a>
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="/tasks">Задачи</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/task_statuses">Статусы</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/labels">Метки</a>
                            </li>
                        </ul>
                        @if (Route::has('login'))
                                @auth
                                    <form method="POST" class="flex items-center lg:order-2" action="{{ route('logout') }}">
                                        <p style="margin-bottom: -; margin-bottom: 0px; margin-right: 6px;">
                                            {{ Auth::user()->name }}
                                        </p> 
                                        @csrf
                                        <a href="route('logout')"
                                                onclick="event.preventDefault();
                                                            this.closest('form').submit();"
                                                class="btn btn-primary">
                                            {{ __('Log Out') }}
                                        </a>
                                    </form>
                                @else
                                    <div>
                                        <a class="btn btn-primary" href="{{ route('login') }}" role="button">Log in</a>
                                        <a class="btn btn-primary" href="{{ route('register') }}" role="button">Register</a>
                                    </div>
                                @endauth
                        @endif
                    </div>
                </div>
            </div>
        </nav>

 </header>