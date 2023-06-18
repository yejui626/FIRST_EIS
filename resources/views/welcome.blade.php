@extends('layouts.app', [
'class' => 'login-page',
'elementActive' => ''
])

@section('content')
<div class="content col-md-12 ml-auto mr-auto">
    <div class="header py-5 pb-7 pt-lg-9">
        <div class="container col-md-10">
            <div class="header-body text-center mb-7">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-md-12 pt-5">
                        <h1 class="@if(Auth::guest()) text-white @endif">{{ __('Welcome to Ecommerce Name') }}</h1>

                        <p class="@if(Auth::guest()) text-white @endif text-lead mt-3 mb-0">
                            {{__("Discover the latest gadgets at Ecommerce Website Name! From cutting-edge tech to must-have accessories, we've got you covered. Shop now for the coolest gadgets, seamless browsing, secure payments, and reliable delivery. Elevate your tech game today!")}}
                        </p>
                        <a href="{{ route('cust') }}" class="btn btn-primary">
                            <i class="nc-icon nc-tap-01"></i>{{ __('Customer Page') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<!-- @push('scripts')
<script>
    $(document).ready(function() {
        demo.checkFullPageBackgroundImage();
    });
</script>
@endpush -->