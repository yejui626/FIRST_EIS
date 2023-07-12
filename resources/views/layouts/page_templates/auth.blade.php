<div class="wrapper">

    @include('layouts.navbars.auth')

    <div class="main-panel">
        @include('layouts.navbars.navs.auth')
        @yield('content')
    </div>
</div>