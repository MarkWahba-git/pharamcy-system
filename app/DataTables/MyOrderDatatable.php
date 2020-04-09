<?php

namespace App\DataTables;
use App\Orders;
//use App\MyOrderDatatable;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class MyOrderDatatable extends DataTable
{
    

    public function ajax()
    {
        return $this->datatables
        ->eloquent($this->query())
        ->make(true);
    }

    public function query(){
        $users = Orders::query()
                ->select([
                    'orders.id as id',
                    'orders.created_at as created_at',
                    'posts.updated_at as updated_at',
                    'users.name as created_by'
                ])
                ->leftJoin('users', 'orders.user_id', '=', 'users.id');
    
        return $users;
    }
}
