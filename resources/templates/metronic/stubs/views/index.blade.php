@extends('manage.layouts.app')

@section('title' , __('messages.{{name}}.{{names}}'))

@section('content')
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content ">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container ">
            <!--begin::Row-->
            <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                <!-- begin::Card -->
                <div class="card">
                    <div class="card-header border-0 pt-6">
                        @include('manage.includes.search-component')
                        <div class="card-toolbar">
                            <div class="d-flex align-items-center py-1">
                                @permission('{{names}}-create')
                                <a href="#" class="btn btn-primary fw-bolder" data-bs-target="#{{name}}_modal" data-bs-toggle="modal" onclick="initResetAdd{{Name}}Form()">
                                    <i class="fas fa-plus"></i>
                                    {{__('messages.{{names}}.new_{{name}}')}}</a>
                                @endpermission
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0 fs-6 py-8 px-8  px-lg-10 text-gray-700">
                        @include('manage.pages.{{names}}.table')
                    </div>

                </div>
                <!-- end::Card -->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
    @include('manage.pages.{{names}}.modal')
@endsection
@section('scripts')
    <script src="{{ asset('manage/js/custom/{{name}}/index.js') }}"></script>
@endsection
