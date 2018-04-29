<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Order;

class OrdersExport implements FromQuery, WithHeadings
{

	public function headings(): array
    {
        return [

            '#',
            'Order Date',
            'Customer',
            'Discount',
            'Remarks',
            'Status',
            'Created At',
            'Updated At',
        ];
    }
    public function query()
    {
         return Order::query()->join('customers', 'customers.id', '=', 'orders.customer_id')
         	->select('orders.id', 'orders.orderdate', 'customers.name', 'orders.discount', 'orders.remarks', 'orders.status', 'orders.created_at', 'orders.updated_at');
    }
}	