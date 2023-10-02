<!DOCTYPE html>
<html lang="en">
    <x-head-task-manager></x-nav-task-manager>
<body>
    <x-nav-task-manager></x-nav-task-manager>
    <div class="container">

        @include('flash::message')

        @yield('title')

        @yield('filter')

        @yield('content')
    </div> 
</body>
</html>