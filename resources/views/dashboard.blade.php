@include('layout.header')
<!-- Wrapper Start -->
<div class="wrapper">
    @include('layout.sidebar')
    @include('layout.topnav')

    <div class="content-page">
        <div class="row">
            <div class="col-lg-12 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"> Welcome, {{ Auth::user()->name }}</h4>
                        <p class="card-text">
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Wrapper End-->
@include('layout.footer')

<!-- Backend Bundle JavaScript -->
@include('layout.script')
</body>

</html>
