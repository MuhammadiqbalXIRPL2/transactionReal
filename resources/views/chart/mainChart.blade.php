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
                    <div class="col-md-12">
                        @include('chart.timeChart')
                    </div>
                    <div class="col-md-12 row">
                        <div class="col-md-6">
                            @include('chart.responseChart')
                        </div>
                        <div class="col-md-6">
                            @include('chart.hourChart')
                        </div>
                    </div>
                </main>
            </div>
        </div>
        @include('test.autoInsert')
    </div>
    @include('template.footer')
</body>
