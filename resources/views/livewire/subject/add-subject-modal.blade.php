<div class="modal fade" id="kt_modal_add_subject" tabindex="-1" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header" id="kt_modal_add_subject_header">
                <h2 class="fw-bold">{{ $edit_mode ? 'Edit Subject' : 'Add Subject' }}</h2>
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal" aria-label="Close">
                    {!! getIcon('cross','fs-1') !!}
                </div>
            </div>
            <div class="modal-body px-5 my-7">
                <form id="kt_modal_add_subject_form" class="form" action="#" wire:submit="submit">
                    <input type="hidden" wire:model.live="subject_id" name="subject_id" wire:model.live="subject_id"/>
                    <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_subject_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_subject_header" data-kt-scroll-wrappers="#kt_modal_add_subject_scroll" data-kt-scroll-offset="300px">
                        <div class="fv-row mb-7">
                            <label class="required fw-semibold fs-6 mb-2">Subject Code</label>
                            <input type="text" wire:model.live="code" name="code" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="e.g., MAT-001"/>
                            @error('code')
                            <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="fv-row mb-7">
                            <label class="required fw-semibold fs-6 mb-2">Subject Name</label>
                            <input type="text" wire:model.live="name" name="name" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="e.g., Mathematics"/>
                            @error('name')
                            <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
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
                </form>
            </div>
        </div>
    </div>
</div>