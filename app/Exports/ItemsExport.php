<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Item;

class ItemsExport implements FromCollection
{
    public function collection()
    {
        return Item::all();
    }
}