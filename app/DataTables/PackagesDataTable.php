<?php

namespace App\DataTables;

use Gate;
use App\Models\Package;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PackagesDataTable extends DataTable
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
            ->editColumn('price', function($record) {
                return $record->price ?? "";
            })        
            ->editColumn('sale_price', function($record) {
                return $record->sale_price ?? "No sale price";
            })     
            ->editColumn('validity', function($record) {
                return $record->validity ?? "";
            })
            ->addColumn('action', function($record) {
                $action  = '';
                if (Gate::check('package-edit')) {
                    $action .= '<a href="'.route('admin.packages.show', $record->id).'" class="text-blue me-2" style="float:left;" title="View"><i class="far fa-eye me-1"></i>
                    </a>';
                }
                if (Gate::check('package-view')) {
                    $action .= '<a href="'.route('admin.packages.edit', $record->id).'" class="text-orange me-2" style="float:left;" title="Edit"><i class="far fa-edit me-1"></i> 
                    </a>';
                }
                if (Gate::check('package-delete')) {
                    $action .= '<form class="deletePackageForm" action="'.route('admin.packages.destroy', $record->id).'" method="POST">
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
     * @param \App\Models\Package $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Package $model)
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
                    ->setTableId('packages-table')
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
            Column::make('price')->title('Price'),
            Column::make('sale_price')->title('Sale Price'),
            Column::make('validity')->title('Validity ( In Days )'),
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
