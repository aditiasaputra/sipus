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
            });
        </script>
    @endpush

</x-default-layout>