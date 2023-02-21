@extends('manage.layouts.auth')

@section('title', __('register'))

@section('content')

    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <!--begin::Authentication - Sign-in -->
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <!--begin::Body-->
            <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
                <!--begin::Form-->
                <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                    <!--begin::Wrapper-->
                    <div class="w-lg-500px p-10">
                        <!--begin::Sign in Form-->
                        <form class="form w-100 fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate"
                              id="kt_sign_in_form" method="POST" action="{{ route('register') }}">
                            @csrf
                            <!--begin::Heading-->
                            <div class="text-center mb-11">
                                <img alt="Logo" src="{{ asset('manage/images/logo-dark.png') }}"
                                     class="h-250px">
                                <!--begin::Title-->
                                <h4 class="text-dark fw-bolder mb-3">Welcome to Dotzone</h4>
                                <!--end::Title-->
                                <!--begin::Title-->
                                <h1 class="text-dark fw-bolder mb-3">
                                    {{ __('auth.register') }}
                                </h1>
                                <!--end::Title-->
                            </div>
                            <!--begin::Heading-->
                            <!--begin::Input group=-->
                            <div class="fv-row mb-3 fv-plugins-icon-container fv-plugins-bootstrap5-row-valid">
                                <!--begin::Name-->
                                <input type="text" placeholder="Name" name="name"
                                       class="form-control bg-transparent @error('name') is-invalid @enderror"
                                       required="">
                                <!--end::Name-->
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <!--end::Input group=-->
                            <!--begin::Input group=-->
                            <div class="fv-row mb-3 fv-plugins-icon-container fv-plugins-bootstrap5-row-valid">
                                <!--begin::Email-->
                                <input type="email" placeholder="Email" name="email" autocomplete="off"
                                       class="form-control bg-transparent @error('email') is-invalid @enderror"
                                       required="">
                                <!--end::Email-->
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <!--end::Input group=-->
                            <div class="fv-row mb-3 fv-plugins-icon-container fv-plugins-bootstrap5-row-valid">
                                <!--begin::Input-->
                                <input
                                    class="form-control form-control-lg bg-transparent @error('password') is-invalid @enderror"
                                    id="password" placeholder="Password" type="password" name="password"
                                    autocomplete="off"/>
                                <!--end::Input-->
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <!--end::Input group=-->
                            <!--end::Input group=-->
                            <div class="fv-row mb-3 fv-plugins-icon-container fv-plugins-bootstrap5-row-valid">
                                <!--begin::Input-->
                                <input
                                    class="form-control form-control-lg bg-transparent @error('confirm_password') is-invalid @enderror"
                                    id="confirm_password" placeholder="Confirm Password" type="password" name="confirm_password"
                                    autocomplete="off"/>
                                <!--end::Input-->
                                @error('confirm_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <!--end::Input group=-->
                            <!--begin::Submit button-->
                            <div class="d-grid mb-10">
                                <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                                    <!--begin::Indicator-->
                                    <span class="indicator-label">
                                        {{ __('messages.common.continue')}}
                                    </span>
                                    <span class="indicator-progress">
                                        {{ __('messages.common.please_wait')}}
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                    </span>
                                    <!--end::Indicator-->
                                </button>
                            </div>
                            <!--end::Submit button-->
                        </form>
                        <!--end::Sign in Form-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Form-->
                <!--begin::Footer-->
                <div class="d-flex flex-center flex-column-auto p-10">
                    <!--begin::Links-->
                    <div class="d-flex align-items-center fw-bold fs-6">
                        <div class="text-dark order-2 order-md-1">
                            <span class="text-muted fw-bold me-1">&copy 2022 - {{ date('Y') }}</span>

                            <span class="text-muted fw-bold me-1">{{ __('messages.all_rights_reserved') }}. {{ __('messages.powered_by' )}} </span>
                            <a href="https://dotzonegrp.com" target="_blank"
                               class="text-gray-800 fw-bolder text-hover-primary">Dotzone Group</a>
                        </div>
                    </div>
                    <!--end::Links-->
                </div>
                <!--end::Footer-->
            </div>
            <!--end::Body-->
            <!--begin::Aside-->
            <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2"
                 style="background-image: url({{ asset('manage/images/cover.jpeg') }})">
                <!--begin::Content-->
                <div class="d-flex flex-column flex-center py-15 px-5 px-md-15 w-100">
                    <!--begin::Logo-->
                    <a href="/" class="mb-12">
                        <img alt="Logo" src="{{ asset('manage/images/logo-dark.png') }}" class="h-250px">
                    </a>
                    <!--end::Logo-->
                    <!--begin::Title-->
                    <h1 class="text-white fs-2qx fw-bolder text-center mb-7">Fast, Efficient and Productive</h1>
                    <!--end::Title-->
                    <!--begin::Text-->
                    <div class="text-white fs-base text-center">
                        Dotzone is a powerful and flexible content management system that allows you to manage your
                        Website Content
                    </div>
                    <!--end::Text-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Aside-->
        </div>
        <!--end::Authentication - Sign-in-->
    </div>
@endsection
