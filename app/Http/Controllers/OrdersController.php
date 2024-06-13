<?php

namespace App\Http\Controllers;

use App\DataTables\OrdersDataTable;

class OrdersController extends Controller
{
    public function index(OrdersDataTable $dataTable)
    {
        // dd($dataTable->query(new StoreOrder()));

        return $dataTable->render('livewire.admin.orders.orders_list');
    }

}
