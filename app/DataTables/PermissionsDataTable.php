<?php

namespace App\DataTables;

use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Gate;

class PermissionsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->editColumn('name', function($record) {
                return $record->name ?? "";
            })                
            ->addColumn('action', function($record) {
                $action  = '';
                if (Gate::check('permission_edit')) {
                    $action .= '<a href="'.route('admin.permissions.edit', $record->id).'" class="text-orange me-2" style="float:left;" title="Edit"><i class="far fa-edit me-1"></i> 
                    </a>';
                }
                if (Gate::check('permission_delete')) {
                    $action .= '<button class="btn btn-sm p-0 text-danger me-2" data-id="'.$record->id.'" data-action="'.route('admin.permissions.destroy', $record->id).'" onclick="deleteConfirmation('.$record->id.')"> <i class="far fa-trash-alt me-1"></i></button>';
                }
                return $action;
            })            
            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Permission $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Permission $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('permissions-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('lfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('export'),
                        Button::make('reset'),
                        Button::make('reload')
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('DT_RowIndex')->title('#')->orderable(false)->searchable(false),
            Column::make('name')->title('Name'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->addClass('datatable_action no-gutters row'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Permissions_' . date('YmdHis');
    }
}
