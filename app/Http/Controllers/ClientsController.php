<?php

namespace App\Http\Controllers;

use App\DataTables\ClientsDataTable;

class ClientsController extends Controller
{
    public function index(ClientsDataTable $dataTable)
    {
        return $dataTable->render('livewire.admin.clients.clients_list');
    }

}
