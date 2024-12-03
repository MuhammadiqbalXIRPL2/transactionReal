@include('template.header')

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper">
            @include('template.navbar')
            <div class="navbar-bg"></div>
            @include('template.sidebar')
            <div class="main-content">
                <main class="container">
                    @include('chart.cardReport')
                    @include('chart.timeChart')
                    @include('chart.responseChart')
                </main>
            </div>
        </div>
    </div>
    @include('template.footer')
</body>
