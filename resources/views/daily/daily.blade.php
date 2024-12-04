@include('template.header')
@include('template.sidebar')
@include('template.navbar')

<div class="main-content d-flex">
    <section class="container">
        
        @include('daily.realTimeTable')
    </section>
    <section class="container">
        @include('daily.realTimeChart')
    </section>
    {{-- @include('test.autoInsert') --}}
</div>
@include('template.footer') 