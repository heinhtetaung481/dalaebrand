<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Orderitem;

class OrderItemsExport implements FromQuery, WithHeadings
{
	public function headings(): array
    {
        return [
            '#',
            'Order ID',
            'Type',
            'Gender',
            'Size',
            'Color',
            'Price',
            'Quantity',
            'Design',
            'Remarks',
            'Created At',
            'Updated At',
        ];
    }
    public function query()
    {
        return Orderitem::query()
        			->join('items', 'items.id', '=', 'orderitems.item_id')
                    ->join('itemtypes', 'itemtypes.id','=','items.itemtype_id')
                    ->join('designs', 'orderitems.design_id', '=', 'designs.id')
                    ->select('orderitems.id', 'orderitems.order_id', 'itemtypes.type','itemtypes.gender', 'items.size','items.color','orderitems.price','orderitems.quantity','designs.name','orderitems.remarks', 'orderitems.created_at', 'orderitems.updated_at');
    }
}	