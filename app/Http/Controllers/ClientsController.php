<?php

namespace App\Http\Controllers;

use App\DataTables\ClientsDataTable;

class ClientsController extends Controller
{
    public function index(ClientsDataTable $dataTable)
    {
        // dd($dataTable->query(new Client()));
        return $dataTable->render('livewire.admin.clients.clients_list');
    }

}