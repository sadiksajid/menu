<?php

namespace App\DataTables;

use App\Models\Client;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ClientsDataTable extends DataTable
{

    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        // ->addColumn('action', 'orders.action')
            ->addColumn('client', function ($query) {
                return ($query->firstname . ' ' . $query->lastname) ?? 'Unknow';
            })
            ->addColumn('date', function ($query) {
                return $query->join_date;
            })
            // ->addColumn('total', function ($query) {
            //     return ($query->total . ' ' . $query->currency);
            // })
            ->addColumn('status', function ($query) {
                if ($query->status == 'active') {
                    return ('<span class="badge badge-success badge-pill"> Active </span>');
                } else if ($query->status == 'warning') {
                    return ('<span class="badge badge-warning badge-pill"> Warning </span>');

                } else {
                    return ('<span class="badge badge-danger badge-pill"> Blocked </span>');
                }
            })
            ->addColumn('trusted', function ($query) {
                if ($query->trusted == 1) {
                    return ('<span class="badge badge-success badge-pill"> Trusted </span>');

                } else if ($query->trusted == -1) {
                    return ('<span class="badge badge-danger badge-pill">  Not Trusted </span>');
                } else {
                    return ('<span class="badge badge-primary badge-pill">  Not Yet </span>');

                }
            })
            ->addColumn('phone', function ($query) {
                return $query->phone;
            })
            ->addColumn('actions', function ($query) {
                return '<a href="/admin/clients/details/' . $query->id . '" class="badge badge-info">View</a>';
            })
            ->orderColumn('date', 'client_stores.created_at $1')
            ->filterColumn('date', function ($query, $keyword) {
                $query->whereRaw('DATE_FORMAT(client_stores.created_at, "%d-%m-%Y %H:%i") like ?', ["%{$keyword}%"]);
            })
            ->filterColumn('phone', function ($query, $keyword) {
                $query->whereRaw('clients.phone like ?', ["%{$keyword}%"]);
            })

            ->filterColumn('client', function ($query, $keyword) {
                $query->whereRaw('clients.firstname like ?', ["%{$keyword}%"]);
                $query->orWhereRaw('clients.lastname like ?', ["%{$keyword}%"]);
            })

            ->orderColumn('status', 'clients.status $1')

            ->rawColumns(['client', 'date', 'phone', 'trusted', 'status', 'actions'])
            ->setRowId('id');
    }

    public function query(Client $model): QueryBuilder
    {
        $query = $model->leftjoin('client_stores', 'client_stores.client_id', 'clients.id')
            ->select('clients.id', 'clients.firstname', 'clients.lastname', 'clients.phone', 'client_stores.status', 'client_stores.trusted'
                , \DB::raw("DATE_FORMAT(client_stores.created_at, '%Y-%m-%d') as join_date"))
            ->where('client_stores.store_id', Auth::user()->store->id)

            ->orderBy('join_date', 'DESC')
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
            ->setTableId('clients-table')

            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->selectStyleSingle();

    }

    public function getColumns(): array
    {
        $translations = app('translations_admin');

        return [
            Column::make('id')->title($translations['id']),
            Column::make('client')->title($translations['client'])->orderable(false),
            Column::make('phone')->title($translations['phone']),
            Column::make('status')->title($translations['status']),
            Column::make('trusted')->title($translations['trusted']),
            Column::make('date')->title($translations['date'])->orderable(false),
            Column::make('actions')->title($translations['actions'])->orderable(false),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Clients_' . date('YmdHis');
    }
}
