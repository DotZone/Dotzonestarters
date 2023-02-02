<!-- Modal -->
<div id="{{name}}_modal" class="modal fade" role="dialog" tabindex="-1" aria-modal="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h2>{{ __('messages.{{names}}.new_{{name}}') }}</h2>
                <button type="button" aria-label="Close" class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
						<svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
							<g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000, 4.000000)" fill="#000000">
								<rect fill="#000000" x="0" y="7" width="16" height="2" rx="1"></rect>
								<rect fill="#000000" opacity="0.5" transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000)" x="0" y="7" width="16" height="2" rx="1"></rect>
							</g>
						</svg>
					</span>
                </button>
            </div>
            <form method="POST" action="">
                <div class="modal-body scroll-y">
                    <div class="row">

                        

                    </div>
                    <div class="text-center pt-7">
                        <button type="submit" class="btn btn-primary me-2" id="btn-submit">
                            <span class="indicator-label">{{ __('messages.common.save') }}</span>
                            <span class="indicator-progress">{{ __('messages.common.please_wait') }}...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                        <button type="button" class="btn btn-light btn-active-light-primary me-2" data-bs-dismiss="modal">
                            {{ __('messages.common.cancel') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal -->
