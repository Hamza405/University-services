<?php

namespace App\Exports;
use App\Models\Subject;
use Mpdf\Mpdf;
use PDF;
use Auth;
// use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Excel;

class OExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
   

    public function collection()
    {
        return Subject::select('name','year','semester')->get();
    }
}
