<div class="modal fade" id="kt_modal_add_user" tabindex="-1" aria-hidden="true" wire:ignore.self>
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="kt_modal_add_user_header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">{{ $edit_mode ? 'Edit User' : 'Add User' }}</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal" aria-label="Close">
                    {!! getIcon('cross','fs-1') !!}
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body px-5 my-7">
                <!--begin::Form-->
                <form id="kt_modal_add_user_form" class="form" action="#" wire:submit="submit" enctype="multipart/form-data">
                    <input type="hidden" wire:model.live="user_id" name="user_id" value="{{ $user_id }}"/>
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="d-block fw-semibold fs-6 mb-5">Avatar</label>
                            <!--end::Label-->
                            <!--begin::Image placeholder-->
                            <style>
                                .image-input-placeholder {
                                    background-image: url('{{ image('svg/files/blank-image.svg') }}');
                                }

                                [data-bs-theme="dark"] .image-input-placeholder {
                                    background-image: url('{{ image('svg/files/blank-image-dark.svg') }}');
                                }
                            </style>
                            <!--end::Image placeholder-->
                            <!--begin::Image input-->
                            <div class="image-input image-input-outline image-input-placeholder {{ $avatar || $saved_avatar ? '' : 'image-input-empty' }}" data-kt-image-input="true">
                                <!--begin::Preview existing avatar-->
                                @if($avatar)
                                    <div class="image-input-wrapper w-125px h-125px" style="background-image: url({{ $avatar ? $avatar->temporaryUrl() : '' }});"></div>
                                @else
                                    <div class="image-input-wrapper w-125px h-125px" style="background-image: url({{ $saved_avatar }});"></div>
                                @endif
                                <!--end::Preview existing avatar-->
                                <!--begin::Label-->
                                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                    {!! getIcon('pencil','fs-7') !!}
                                    <!--begin::Inputs-->
                                    <input type="file" wire:model.live="avatar" name="avatar" accept=".png, .jpg, .jpeg"/>
                                    <input type="hidden" name="avatar_remove"/>
                                    <!--end::Inputs-->
                                </label>
                                <!--end::Label-->
                                <!--begin::Cancel-->
                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                    {!! getIcon('cross','fs-2') !!}
                                </span>
                                <!--end::Cancel-->
                                <!--begin::Remove-->
                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                                    {!! getIcon('cross','fs-2') !!}
                                </span>
                                <!--end::Remove-->
                            </div>
                            <!--end::Image input-->
                            <!--begin::Hint-->
                            <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                            <!--end::Hint-->
                            @error('avatar')
                            <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">Full Name</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" wire:model.live="name" name="name" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Full name"/>
                            <!--end::Input-->
                            @error('name')
                            <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">Email</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="email" wire:model.live="email" name="email" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="example@domain.com"/>
                            <!--end::Input-->
                            @error('email')
                            <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="mb-7">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-5">Role</label>
                            <!--end::Label-->
                            @error('role')
                            <span class="text-danger">{{ $message }}</span> @enderror
                            <!--begin::Roles-->
                            @foreach($roles as $role)
                                <!--begin::Input row-->
                                <div class="d-flex fv-row">
                                    <!--begin::Radio-->
                                    <div class="form-check form-check-custom form-check-solid">
                                        <!--begin::Input-->
                                        <input class="form-check-input me-3" id="kt_modal_update_role_option_{{ $role->id }}" wire:model.live="role" name="role" type="radio" value="{{ $role->name }}" checked="checked"/>
                                        <!--end::Input-->
                                        <!--begin::Label-->
                                        <label class="form-check-label" for="kt_modal_update_role_option_{{ $role->id }}">
                                            <div class="fw-bold text-gray-800">
                                                {{ ucwords($role->name) }}
                                            </div>
                                            <div class="text-gray-600">
                                                {{ $role->description }}
                                            </div>
                                        </label>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Radio-->
                                </div>
                                <!--end::Input row-->
                                @if(!$loop->last)
                                    <div class='separator separator-dashed my-5'></div>
                                @endif
                            @endforeach
                            <!--end::Roles-->
                        </div>
                        <!--end::Input group-->
                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal" aria-label="Close" wire:loading.attr="disabled">
                            {{ $edit_mode ? 'Cancel' : 'Discard' }}
                        </button>
                        <button type="submit" class="btn btn-{{ $edit_mode ? 'warning' : 'primary' }}" data-kt-grades-modal-action="submit" wire:loading.attr="disabled" wire:target="submit">
                            <span class="indicator-label" wire:loading.remove wire:target="submit">{{ $edit_mode ? 'Update' : 'Submit' }}</span>
                            <span class="indicator-progress" wire:loading wire:target="submit">
                                Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>