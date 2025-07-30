<div class="modal fade" id="kt_modal_add_grade" tabindex="-1" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header" id="kt_modal_add_grade_header">
                <h2 class="fw-bold">{{ $edit_mode ? 'Edit Grade' : 'Add Grade' }}</h2>
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal" aria-label="Close">
                    {!! getIcon('cross','fs-1') !!}
                </div>
            </div>
            <div class="modal-body px-5 my-7">
                <form id="kt_modal_add_grade_form" class="form" action="#" wire:submit="submit">
                    <input type="hidden" wire:model.live="grade_id" name="grade_id" wire:model.live="grade_id"/>
                    <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_grade_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_grade_header" data-kt-scroll-wrappers="#kt_modal_add_grade_scroll" data-kt-scroll-offset="300px">
                        <div class="fv-row mb-7">
                            <label class="required fw-semibold fs-6 mb-2">Grade Code</label>
                            <input type="text" wire:model.live="code" name="code" class="form-control form-control-solid @error('code') is-invalid @enderror mb-3 mb-lg-0" placeholder="e.g., MAT-001"/>
                            @error('code')
                            <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="fv-row mb-7">
                            <label class="required fw-semibold fs-6 mb-2">Grade Name</label>
                            <input type="text" wire:model.live="name" name="name" class="form-control form-control-solid @error('name') is-invalid @enderror mb-3 mb-lg-0" placeholder="e.g., Mathematics"/>
                            @error('name')
                            <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="fv-row mb-7">
                            <label class="required fw-semibold fs-6 mb-2">Homeroom Teacher</label>
                            <select wire:model.live="teacher_id" class="form-select form-select-solid @error('teacher_id') is-invalid @enderror" data-placeholder="Select homeroom teacher">
                                <option value="">-- Select Homeroom Teacher --</option>
                                @foreach($teachers as $teacher)
                                    <option value="{{ $teacher['id'] }}">{{ $teacher['display_name'] }}</option>
                                @endforeach
                            </select>
                            @error('teacher_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        @if($teacher_id)
                            @php
                                $selectedTeacher = collect($teachers)->firstWhere('id', $teacher_id);
                            @endphp
                            
                            @if($selectedTeacher)
                                <div class="card border border-dashed border-primary mb-7">
                                    <div class="card-body p-6">
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-60px me-4">
                                                <div class="symbol-label bg-light-primary">
                                                    <i class="ki-outline ki-teacher fs-2x text-primary"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div>
                                                        <h5 class="fw-bold text-gray-900 mb-1">
                                                            {{ $selectedTeacher['name'] ?? 'Unknown Teacher' }}
                                                        </h5>
                                                        <div class="text-muted fw-semibold fs-7 mb-1">
                                                            <i class="ki-outline ki-sms fs-6 me-2 text-primary"></i>
                                                            {{ $selectedTeacher['email'] ?? 'No Email Available' }}
                                                        </div>
                                                        @if(isset($selectedTeacher['teacher_id']) && $selectedTeacher['teacher_id'])
                                                            <div class="text-muted fw-semibold fs-7">
                                                                <i class="ki-outline ki-badge fs-6 me-2 text-success"></i>
                                                                Teacher ID: {{ $selectedTeacher['teacher_id'] }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="text-end">
                                                        <span class="badge badge-light-primary fs-7 fw-bold px-3 py-2">
                                                            <i class="ki-outline ki-check-circle fs-6 me-1"></i>
                                                            Assigned
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endif
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