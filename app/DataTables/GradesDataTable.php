<?php

namespace App\DataTables;

use App\Models\Grade;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class GradesDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->editColumn('code', function (Grade $grade) {
                return '<span class="badge badge-light-primary fw-bold">' . $grade->code . '</span>';
            })
            ->editColumn('name', function (Grade $grade) {
                return '<div class="d-flex align-items-center">
                            <div class="symbol symbol-50px me-3">
                                <div class="symbol-label bg-light-info">
                                    <i class="ki-outline ki-book fs-2x text-info"></i>
                                </div>
                            </div>
                            <div class="d-flex flex-column">
                                <span class="text-gray-800 fw-bold fs-6">' . $grade->name . '</span>
                                <span class="text-muted fs-7">Grade Code: ' . $grade->code . '</span>
                            </div>
                        </div>';
            })
            ->editColumn('created_at', function (Grade $grade) {
                return $grade->created_at->format('d M Y, H:i');
            })
            ->addColumn('action', function (Grade $grade) {
                return view('pages/apps.grades.columns._actions', compact('grade'));

            })
            ->rawColumns(['code', 'name', 'action'])
            ->setRowId('id');
    }

    public function query(Grade $model): QueryBuilder
    {
        return $model->newQuery()->orderBy('name', 'asc');
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('grades-table')
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
            ])
            ->drawCallback("function() {" . file_get_contents(resource_path('views/pages/apps/grades/columns/_draw-scripts.js')) . "}");
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
                ->title('Grade Name')
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
        return 'Grades_' . date('YmdHis');
    }
}