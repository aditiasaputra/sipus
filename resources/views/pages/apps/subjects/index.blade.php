<x-default-layout>

    @section('title')
        Subjects
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('subjects.index') }}
    @endsection

    <div class="card">
        <div class="card-header border-0 pt-6">
            <div class="card-title">
                <div class="d-flex align-items-center position-relative my-1">
                    {!! getIcon('magnifier', 'fs-3 position-absolute ms-5') !!}
                    <input type="text" data-kt-subjects-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Search subjects" id="subjectsSearchInput"/>
                </div>
            </div>

            <div class="card-toolbar">
                <div class="d-flex justify-content-end" data-kt-subjects-table-toolbar="base">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_subject" id="addSubjectButton">
                        {!! getIcon('plus', 'fs-2', '', 'i') !!}
                        Add Subject
                    </button>
                </div>

                <livewire:subject.add-subject-modal></livewire:subject.add-subject-modal>
            </div>
        </div>

        <div class="card-body py-4">
            <div class="table-responsive">
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>

    {{-- Delete Modal tetap sama --}}
    <div class="modal fade" id="delete_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="fw-bold">Delete Subject</h2>
                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                        {!! getIcon('cross', 'fs-1') !!}
                    </div>
                </div>
                <div class="modal-body px-5">
                    <form id="deleteSubjectForm" class="form" action="" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="fv-row mb-7">
                            <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed p-6">
                                <div class="d-flex flex-stack flex-grow-1">
                                    <div class="fw-semibold">
                                        <h4 class="text-gray-900 fw-bold">Are you sure?</h4>
                                        <div class="fs-6 text-gray-700">This action cannot be undone. The subject will be permanently deleted.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center pt-15">
                            <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">
                                <span class="indicator-label">Delete</span>
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        {{ $dataTable->scripts() }}
        <script>
            document.getElementById('subjectsSearchInput').addEventListener('keyup', function () {
                window.LaravelDataTables['subjects-table'].search(this.value).draw();
            });

            document.addEventListener('livewire:init', function () {
                Livewire.on('success', function () {
                    $('#kt_modal_add_subject').modal('hide');
                    window.LaravelDataTables['subjects-table'].ajax.reload();
                });
            });

            $('#kt_modal_add_subject').on('hidden.bs.modal', function () {
                Livewire.dispatch('new_subject');
                document.getElementById('kt_modal_add_subject_header').querySelector('h2').innerText = 'Add Subject';
            });

            document.getElementById('addSubjectButton').addEventListener('click', function() {
                Livewire.dispatch('new_subject');
                document.getElementById('kt_modal_add_subject_header').querySelector('h2').innerText = 'Add Subject';
            });

            document.addEventListener('click', function(event) {
                const editButton = event.target.closest('.edit-btn');

                if (editButton) {
                    const subjectId = editButton.dataset.id;
                    const subjectCode = editButton.dataset.code;
                    const subjectName = editButton.dataset.name;

                    Livewire.dispatch('edit_subject', { id: subjectId, code: subjectCode, name: subjectName });

                    const modalHeader = document.getElementById('kt_modal_add_subject_header');
                    if (modalHeader) {
                        const modalTitle = modalHeader.querySelector('h2');
                        if (modalTitle) {
                            modalTitle.innerText = 'Edit Subject';
                        }
                    }

                    const addSubjectModal = new bootstrap.Modal(document.getElementById('kt_modal_add_subject'));
                    addSubjectModal.show();
                }
            });


            $('#delete_modal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var subjectId = button.data('id');
                var form = $('#deleteSubjectForm');
                form.attr('action', '/subjects/' + subjectId);
            });

            $('#deleteSubjectForm').on('submit', function(e) {
                e.preventDefault();
                var form = $(this);
                var url = form.attr('action');
                
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: form.serialize(),
                    beforeSend: function() {
                        form.find('button[type="submit"]').attr('disabled', true);
                        form.find('.indicator-label').hide();
                        form.find('.indicator-progress').show();
                    },
                    success: function(response) {
                        $('#delete_modal').modal('hide');
                        window.LaravelDataTables['subjects-table'].ajax.reload();
                        toastr.success('Subject deleted successfully');
                    },
                    error: function(xhr) {
                        toastr.error('Error deleting subject');
                    },
                    complete: function() {
                        form.find('button[type="submit"]').attr('disabled', false);
                        form.find('.indicator-label').show();
                        form.find('.indicator-progress').hide();
                    }
                });
            });
        </script>
    @endpush

</x-default-layout>