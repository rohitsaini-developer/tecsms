<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Gate;

class UsersDataTable extends DataTable
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
            // ->eloquent($query)
            ->eloquent($query->with(['roles'])->select('users.*'))
            ->addIndexColumn()
            ->editColumn('name', function($record) {
                return $record->name ?? "";
            })    
            ->editColumn('email', function($record) {
                return $record->email ?? "";
            })             
            ->editColumn('roles.name', function($record){
                $roleName = $record->getRoleNames();
                $ucName = array_map('ucfirst', $roleName->toArray());
                return  implode(', ', $ucName);
            })
            ->addColumn('action', function($record) {
                $action  = '';
                if (Gate::check('user-edit')) {
                    $action .= '<a href="'.route('admin.users.show', $record->id).'" class="text-blue me-2" style="float:left;" title="View"><i class="far fa-eye me-1"></i>
                    </a>';
                }
                if (Gate::check('user-view')) {
                    $action .= '<a href="'.route('admin.users.edit', $record->id).'" class="text-orange me-2" style="float:left;" title="Edit"><i class="far fa-edit me-1"></i> 
                    </a>';
                }
                if (Gate::check('user-delete')) {
                    $action .= '<form class="deleteUserForm" action="'.route('admin.users.destroy', $record->id).'" method="POST" style="float:left">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="'.csrf_token().'">
                        <button class="btn btn-sm p-0 text-danger me-2" type="submit"><i class="far fa-trash-alt me-1"></i></button></form>';
                }
                if(Gate::check('user-change-password-admin')){
                    $action .= '<a href="'.route('admin.users.changePasswordByAdmin', $record->id).'" class="text-gray me-2"><i class="fas fa-lock me-1" title="Change Password"></i></a>';
                }
                return $action;
            })            
            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->whereHas('roles', function($q){
            $q->where('name', '!=', 'admin');
        })->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('users-table')
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
            Column::make('email')->title('Email'),
            Column::make('roles.name')->title('Role'),
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
        return 'Users_' . date('YmdHis');
    }
}
