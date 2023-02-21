<div id="kt_app_footer" class="app-footer">
    <!--begin::Footer container-->
    <div class="app-container container-fluid d-flex flex-column flex-md-row flex-center flex-md-stack py-3">
        <!--begin::Copyright-->
        <div class="text-dark order-2 order-md-1">
            <span class="text-muted fw-semibold me-1">
                &copy {{ date('Y') }} {{ __('messages.all_rights_reserved')}}
                <a href="{{ url('/') }}" class="text-gray-800 text-hover-primary fw-bolder">
                    {{ Config::get('settings.site_name') }}
                </a>
                . {{ __('messages.powered_by') }}
            </span>
            <a href="https://dotzonegrp.com" target="_blank" class="text-gray-800 text-hover-primary fw-bolder">
                Dotzone Group
            </a>
        </div>
        <!--end::Copyright-->
    </div>
    <!--end::Footer container-->
</div>
