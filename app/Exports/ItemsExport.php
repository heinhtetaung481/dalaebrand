<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;
use App\Item;

class ItemsExport implements FromQuery, WithHeadings
{
	public function headings(): array
    {
        return [
            '#',
            'Type',
            'Gender',
            'Size',
            'Color',
            'Quantity',
            'Created At',
            'Updated At',
        ];
    }
    public function query()
    {
    	return Item::query()->join('itemtypes', 'itemtypes.id', '=', 'items.itemtype_id')
    			->select('items.id', 'itemtypes.type', 'itemtypes.gender', 'items.size', 'items.color', 'items.quantity', 'items.created_at', 'items.updated_at');
    }
}