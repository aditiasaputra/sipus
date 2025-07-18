<!--begin::Footer-->
<div class="app-sidebar-footer flex-column-auto pt-2 pb-6 px-6" id="kt_app_sidebar_footer">
	<a href="#" data-action="{{ route('logout') }}" data-method="post" data-csrf="{{ csrf_token() }}" data-reload="true" class="btn btn-flex flex-center btn-custom btn-primary overflow-hidden text-nowrap px-0 h-40px w-100 button-ajax menu-link" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss-="click" title="Sign Out Application">
	<span class="btn-label">Sign Out</span>{!! getIcon('document', 'btn-icon fs-2 m-0') !!}</a>
</div>
<!--end::Footer-->
