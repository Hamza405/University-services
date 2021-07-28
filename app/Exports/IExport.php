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

class IExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
   

    public function collection()
    {
        return User::select('name','email','num','section','year','gender')->get();
    }
}
