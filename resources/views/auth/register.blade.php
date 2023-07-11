@extends('layouts.app', [
'class' => 'register-page',
'backgroundImagePath' => 'img/bg/jan-sendereks.jpg'
])

@section('content')
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-5 ml-auto">
                <div class="info-area info-horizontal mt-5">
                    <div class="icon icon-primary">
                        <i class="nc-icon nc-tv-2"></i>
                    </div>
                    <div class="description">
                        <h5 class="info-title">{{ __('Product Catalog') }}</h5>
                        <p class="description">
                            {{ __('Browse and explore a diverse range of products with brief descriptions, images, pricing, and customer reviews.') }}
                        </p>
                    </div>
                </div>
                <div class="info-area info-horizontal">
                    <div class="icon icon-primary">
                        <i class="nc-icon nc-html5"></i>
                    </div>
                    <div class="description">
                        <h5 class="info-title">{{ __('Shopping Cart and Checkout') }}</h5>
                        <p class="description">
                            {{ __('Easily add items to your cart, review your selection, and proceed to secure checkout for a seamless buying experience.') }}
                        </p>
                    </div>
                </div>
                <div class="info-area info-horizontal">
                    <div class="icon icon-info">
                        <i class="nc-icon nc-atom"></i>
                    </div>
                    <div class="description">
                        <h5 class="info-title">{{ __('User Account Management') }}</h5>
                        <p class="description">
                            {{ __('Create and manage your personal profile, including login, registration, and the ability to update your information.') }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mr-auto">
                <div class="card card-signup text-center">
                    <div class="card-header ">
                        <h4 class="card-title">{{ __('Register') }}</h4>
                        <div class="social">
                            <button class="btn btn-icon btn-round btn-twitter">
                                <i class="fa fa-twitter"></i>
                            </button>
                            <button class="btn btn-icon btn-round btn-dribbble">
                                <i class="fa fa-dribbble"></i>
                            </button>
                            <button class="btn btn-icon btn-round btn-facebook">
                                <i class="fa fa-facebook-f"></i>
                            </button>
                            <p class="card-description">{{ __('or be classical') }}</p>
                        </div>
                    </div>
                    <div class="card-body ">
                        <form class="form" method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="input-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="nc-icon nc-single-02"></i>
                                    </span>
                                </div>
                                <input name="name" type="text" class="form-control" placeholder="Name" value="{{ old('name') }}" required autofocus>
                                @if ($errors->has('name'))
                                <span class="invalid-feedback" style="display: block;" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="input-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="nc-icon nc-email-85"></i>
                                    </span>
                                </div>
                                <input name="email" type="email" class="form-control" placeholder="Email" required value="{{ old('email') }}">
                                @if ($errors->has('email'))
                                <span class="invalid-feedback" style="display: block;" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="input-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="nc-icon nc-key-25"></i>
                                    </span>
                                </div>
                                <input name="password" type="password" class="form-control" placeholder="Password" required>
                                @if ($errors->has('password'))
                                <span class="invalid-feedback" style="display: block;" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="nc-icon nc-key-25"></i>
                                    </span>
                                </div>
                                <input name="password_confirmation" type="password" class="form-control" placeholder="Password confirmation" required>
                                @if ($errors->has('password_confirmation'))
                                <span class="invalid-feedback" style="display: block;" role="alert">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-check text-left">
                                <label class="form-check-label">
                                    <input class="form-check-input" name="agree_terms_and_conditions" type="checkbox">
                                    <span class="form-check-sign"></span>
                                    {{ __('I agree to the') }}
                                    <a href="#something">{{ __('terms and conditions') }}</a>.
                                </label>
                                @if ($errors->has('agree_terms_and_conditions'))
                                <span class="invalid-feedback" style="display: block;" role="alert">
                                    <strong>{{ $errors->first('agree_terms_and_conditions') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="card-footer ">
                                <button type="submit" class="btn btn-info btn-round">{{ __('Get Started') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        demo.checkFullPageBackgroundImage();
    });
</script>
@endpush