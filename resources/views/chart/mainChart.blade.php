@include('template.header')
@include('template.navbar')
@include('template.sidebar')




<main class="container">
    @yield('content')
    @include('chart.timeChart')
    @include('chart.responseChart')
</main>



@include('template.footer')