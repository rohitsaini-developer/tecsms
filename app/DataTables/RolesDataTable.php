<?php

namespace App\DataTables;

use Gate;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Services\DataTable;

class RolesDataTable extends DataTable
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
                if (Gate::check('role-edit')) {
                    $action .= '<a href="'.route('admin.roles.show', $record->id).'" class="text-blue me-2" style="float:left;" title="View"><i class="far fa-eye me-1"></i>
                    </a>';
                }
                if (Gate::check('role-view')) {
                    $action .= '<a href="'.route('admin.roles.edit', $record->id).'" class="text-orange me-2" style="float:left;" title="Edit"><i class="far fa-edit me-1"></i> 
                    </a>';
                }
                if (Gate::check('role-delete')) {
                    $action .= '<form class="deleteRoleForm" action="'.route('admin.roles.destroy', $record->id).'" method="POST">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="'.csrf_token().'">
                        <button class="btn btn-sm p-0 text-danger me-2" type="submit"><i class="far fa-trash-alt me-1"></i></button></form>';
                }
                return $action;
            })            
            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Role $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Role $model)
    {
        return $model->where('id',"!=", 1)->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('roles-table')
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
                  ->addClass('datatable_action'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Roles_' . date('YmdHis');
    }
}
