<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;
use App\Customer;

class CustomersExport implements FromCollection, WithHeadings
{
	public function headings(): array
    {
        return [
            '#',
            'Name',
            'Phone',
            'Address',
            'Email',
            'Remark',
            'Created At',
            'Updated At',
        ];
    }
    public function collection()
    {
    	return Customer::get();
    }
}