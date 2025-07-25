<?php

namespace App\DataTables;

use App\Models\Subject;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class SubjectsDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->editColumn('code', function (Subject $subject) {
                return '<span class="badge badge-light-primary fw-bold">' . $subject->code . '</span>';
            })
            ->editColumn('name', function (Subject $subject) {
                return '<div class="d-flex align-items-center">
                            <div class="symbol symbol-50px me-3">
                                <div class="symbol-label bg-light-info">
                                    <i class="ki-outline ki-book fs-2x text-info"></i>
                                </div>
                            </div>
                            <div class="d-flex flex-column">
                                <span class="text-gray-800 fw-bold fs-6">' . $subject->name . '</span>
                                <span class="text-muted fs-7">Subject Code: ' . $subject->code . '</span>
                            </div>
                        </div>';
            })
            ->editColumn('created_at', function (Subject $subject) {
                return $subject->created_at->format('d M Y, H:i');
            })
            ->addColumn('action', function (Subject $subject) {
                return '<div class="d-flex justify-content-end">
                            <a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                Actions
                                <i class="ki-outline ki-down fs-5 ms-1"></i>
                            </a>
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                <div class="menu-item px-3">
                                    <a href="' . route('subjects.show', $subject->id) . '" class="menu-link px-3">View</a>
                                </div>
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3 edit-btn" data-bs-toggle="tooltip" title="Edit"
                                    data-id="' . $subject->id . '"
                                    data-code="' . $subject->code . '"
                                    data-name="' . $subject->name . '">
                                        Edit
                                    </a>
                                </div>
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3 text-danger" data-bs-toggle="modal" data-bs-target="#delete_modal" data-id="' . $subject->id . '">Delete</a>
                                </div>
                            </div>
                        </div>';
            })
            ->rawColumns(['code', 'name', 'action'])
            ->setRowId('id');
    }

    public function query(Subject $model): QueryBuilder
    {
        return $model->newQuery()->orderBy('name', 'asc');
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('subjects-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('rt<"d-flex justify-content-between"<"col-sm-12 col-md-5"i><"d-flex justify-content-between"p>>')
            ->addTableClass('table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer text-gray-600 fw-semibold')
            ->setTableHeadClass('text-start text-muted fw-bold fs-7 text-uppercase gs-0')
            ->orderBy(1, 'asc')
            ->responsive(true)
            ->autoWidth(false)
            ->parameters([
                'scrollX' => true,
                'drawCallback' => 'function() { KTMenu.createInstances(); }'
            ]);
    }

    public function getColumns(): array
    {
        return [
            Column::computed('DT_RowIndex')
                ->title('#')
                ->addClass('text-center')
                ->width(50)
                ->orderable(false)
                ->searchable(false),
            Column::make('code')
                ->title('Code')
                ->addClass('text-center')
                ->width(100),
            Column::make('name')
                ->title('Subject Name')
                ->addClass('min-w-250px'),
            Column::make('created_at')
                ->title('Created')
                ->addClass('text-nowrap text-center')
                ->width(150),
            Column::computed('action')
                ->title('Actions')
                ->addClass('text-end text-nowrap')
                ->width(100)
                ->exportable(false)
                ->printable(false)
                ->orderable(false)
                ->searchable(false)
        ];
    }

    protected function filename(): string
    {
        return 'Subjects_' . date('YmdHis');
    }
}