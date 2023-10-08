<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid ">
            <div class="container">
                <div class="navbar-collapse d-flex justify-content-between" id="navbarNav">
                    <a class="navbar-brand" href="{{ route('main') }}">{{ __('messages.Task Manager') }}</a>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('task.index') }}">{{ __('messages.Task') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('task_statuses.index') }}">{{ __('messages.Statuses') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('label.index') }}">{{ __('messages.Label') }}</a>
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
                                            {{ __('messages.Log Out') }}
                                    </a>
                                </form>
                            @else
                            <div>
                                <a class="btn btn-primary" href="{{ route('login') }}" role="button">{{ __('messages.Login') }}</a>
                                <a class="btn btn-primary" href="{{ route('register') }}" role="button">{{ __('messages.Registration') }}</a>
                            </div>
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>
</header>