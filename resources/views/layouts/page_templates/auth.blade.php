<div class="wrapper">

        @if(session('role') == '5')
        @include ('home.headerafter')
        @else
        @include ('home.header')
        @endif

    <div class="main-panel">
        @yield('content')
    </div>
    <br>
    <br>

</div>