<?php

namespace App\Exports;
use App\Models\Subject;
use App\Models\User;
use App\Models\Complaint;
use Mpdf\Mpdf;
use PDF;
use Auth;
// use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Maatwebsite\Excel\Concerns\WithMapping;

class CExport implements FromCollection,WithHeadings,WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
   

    public function collection()
    {
        return Complaint::select('id','student_id','content','isShown','section')->get();
    }

    public function headings(): array

    {

        return [

            'رقم الشكوى',

            'صاحب الشكوى',

            'محتوى الشكوى',

            'القسم',
        ];

    }

    public function map($data): array
    {
        $user = 'محجوب';
        if($data->isShown){
            $name = User::where('id',$data->student_id)->first();
            if($name!=null) $user=$name->name;
        }
            return [
            $data->id,
            $user,
            $data->content,
            $data->section,
            
        ];
    }
}
