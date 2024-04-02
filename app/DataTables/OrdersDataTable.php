<?php

namespace App\DataTables;

use App\Models\StoreOrder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class OrdersDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    // protected $actions = ['print', 'excel', 'csv', 'pdf', 'reset', 'reload'];

    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        // ->addColumn('action', 'orders.action')
            ->addColumn('cleint', function ($query) {
                return ($query->client->firstname . ' ' . $query->client->lastname) ?? 'Unknow';
            })
            ->addColumn('date', function ($query) {
                return $query->created_at->format('d-m-Y H:i');
            })
            ->addColumn('total', function ($query) {
                return ($query->total . ' ' . $query->currency);
            })
            ->addColumn('type', function ($query) {
                if ($query->order_type == 'shipping') {
                    return ('<span class="badge badge-primary badge-pill">' . $query->order_type . '</span>');

                } else {
                    return ('<span class="badge badge-info badge-pill">' . $query->order_type . '</span>');
                }
            })
            ->addColumn('status', function ($query) {
                if ($query->status == 'pending') {
                    return ('<span class="badge badge-warning badge-pill">' . $query->status . '</span>');

                } elseif ($query->status == 'verified') {
                    return ('<span class="badge badge-success badge-pill">' . $query->status . '</span>');
                } elseif ($query->status == 'confirmed') {
                    return ('<span class="badge badge-success badge-pill">' . $query->status . '</span>');
                } elseif ($query->status == 'shipped') {
                    return ('<span class="badge badge-primary badge-pill">' . $query->status . '</span>');
                } elseif ($query->status == 'delivered') {
                    return ('<span class="badge badge-primary badge-pill">' . $query->status . '</span>');
                } elseif ($query->status == 'canceled') {
                    return ('<span class="badge badge-secondary badge-pill">' . $query->status . '</span>');
                } else {
                    return ('<span class="badge badge-danger badge-pill">' . $query->status . '</span>');
                }

            })
            ->addColumn('actions', function ($query) {
                return '<a href="/admin/orders/details/' . $query->id . '" class="badge badge-info">View</a>';
            })
            ->orderColumn('date', 'store_orders.created_at $1')
            ->filterColumn('date', function ($query, $keyword) {
                $query->whereRaw('DATE_FORMAT(store_orders.created_at, "%d-%m-%Y %H:%i") like ?', ["%{$keyword}%"]);
            })
            ->orderColumn('total', 'store_orders.total $1')
            ->filterColumn('total', function ($query, $keyword) {
                $query->whereRaw('store_orders.total like ?', ["%{$keyword}%"]);
            })
            ->orderColumn('type', 'store_orders.order_type $1')
            ->filterColumn('type', function ($query, $keyword) {
                $query->where('store_orders.order_type', 'like', "%{$keyword}%");
            })

            ->rawColumns(['client', 'date', 'total', 'type', 'status', 'actions'])
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Order $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(StoreOrder $model): QueryBuilder
    {
        $query = $model->where('store_id', Auth::user()->store->id)
        // ->leftJoin('clients', 'clients.id', 'store_orders.client_id')
            ->with(['client' => function ($q) {
                $q->select('id', 'firstname', 'lastname');
            }])
            ->select('store_orders.id', 'store_orders.store_id', 'store_orders.client_id', 'store_orders.currency', 'store_orders.total', 'store_orders.status', 'store_orders.order_type', 'store_orders.created_at')
            ->orderBy('store_orders.created_at', 'DESC')
            ->newQuery();

        return $query;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {

        return $this->builder()
            ->setTableId('orders-table')

            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
        // ->orderBy(1)
            ->selectStyleSingle();
        // ->parameters([
        //     'dom' => 'Bfrtip',
        //     'buttons' => ['csv', 'print', 'reset', 'reload'],
        // ]);
        // ->buttons([
        //     Button::make('excel'),
        //     Button::make('csv'),
        //     Button::make('pdf'),
        //     Button::make('print'),
        //     // Button::make('reset'),
        //     // Button::make('reload'),
        // ]);

    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
            // Column::computed('action')
            //     ->exportable(false)
            //     ->printable(false)
            //     ->width(60)
            //     ->addClass('text-center'),
            Column::make('id'),
            Column::make('cleint')->orderable(false),
            Column::make('type'),
            Column::make('status'),
            Column::make('total'),
            Column::make('date')->orderable(false),
            Column::make('actions')->orderable(false),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Orders_' . date('YmdHis');
    }
}
