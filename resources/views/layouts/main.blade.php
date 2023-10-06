<!DOCTYPE html>
<html lang="en">
    <x-head-task-manager/>
    <body>
        <x-nav-task-manager></x-nav-task-manager>
        <div class="container">

            @yield('title')

            @include('flash::message')
            
            @yield('filter')

            @yield('content')
        </div> 
    </body>
</html>