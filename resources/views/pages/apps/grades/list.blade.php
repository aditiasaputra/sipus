<x-default-layout>
    
    @section('title')
        Grades
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('grades.index') }}
    @endsection

    <div class="card">
        <div class="card-header border-0 pt-6">
            <div class="card-title">
                <div class="d-flex align-items-center position-relative my-1">
                    {!! getIcon('magnifier', 'fs-3 position-absolute ms-5') !!}
                    <input type="text" data-kt-grades-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Search grades" id="gradesSearchInput"/>
                </div>
            </div>

            <div class="card-toolbar">
                <div class="d-flex justify-content-end" data-kt-grades-table-toolbar="base">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_grade" id="addGradeButton">
                        {!! getIcon('plus', 'fs-2', '', 'i') !!}
                        Add Grade
                    </button>
                </div>

                <livewire:grade.add-grade-modal></livewire:grade.add-grade-modal>
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
            document.getElementById('gradesSearchInput').addEventListener('keyup', function () {
                window.LaravelDataTables['grades-table'].search(this.value).draw();
            });
            document.addEventListener('livewire:init', function () {
                Livewire.on('success', function () {
                    $('#kt_modal_add_grade').modal('hide');
                    window.LaravelDataTables['grades-table'].ajax.reload();
                });
            });
            $('#kt_modal_add_grade').on('hidden.bs.modal', function () {
                Livewire.dispatch('new_grade');
            });
        </script>
    @endpush

</x-default-layout>