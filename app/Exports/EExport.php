<?php

namespace App\Exports;
use App\Models\Mark;
use App\Models\User;
use Mpdf\Mpdf;
use PDF;
use Auth;
// use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Concerns\WithHeadings;


class EExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
   

    public function collection()
    {
        $users = User::select('name','email','section','gender')
        ->where('role','موظف')
        ->get();
        return $users;
    }

    public function headings(): array

    {

        return [

            'أسم الموظف',

            'البريد الإلكتروني',

            'الجنس',

            'القسم',

        ];

    }

}
