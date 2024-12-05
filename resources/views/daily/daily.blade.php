@include('template.header')
@include('template.sidebar')
@include('template.navbar')

<div class="main-content">
    <div class="text-md pt-2 pb-1 px-2">
        <h1 class="font-bold p-4">Transaction Issue</h1>
    </div>
    <div class="d-flex">

        <section class="container">
            @include('daily.realTimeTable')
        </section>
        <section class="container">
            @include('daily.realTimeChart')
        </section>
    </div>
    {{-- @include('test.autoInsert') --}}
</div>
@include('template.footer')
