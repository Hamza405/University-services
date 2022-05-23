<?php

namespace App\Exports;
use App\Models\Subject;
use Mpdf\Mpdf;
use PDF;
use Auth;
// use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Maatwebsite\Excel\Concerns\WithMapping;

class OExport implements FromCollection,WithHeadings,WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
   

    public function collection()
    {
        return Subject::select('name','year','semester','section')->get();
    }

    public function headings(): array

    {

        return [

            'أسم المقرر',

            'سنة المقرر',

            'الفصل الدراسي',

            'القسم',
        ];

    }

    public function map($data): array
    {
        $year = 'الأولى';
        if($data->year==1){
            $year='الأولى';
        }else if($data->year==2){
            $year='الثانية';
        }
        else if($data->year==3){
            $year='الثالثة';
        }
        else if($data->year==4){
            $year='الرابعة';
        }
        else if($data->year==5){
            $year='الخامسة';
        }

        $s='الأول';
        if($data->semester==1){
            $users='الأول';
        }else if($data->semester==2){
            $s='الثاني';
        }
        else if($data->semester==3){
            $s='الثالث';
        }
        else if($data->semester==4){
            $s='الرابع';
        }
        else if($data->semester==5){
            $s='الخامس';
        }
        
      
            return [
            $data->name,
            $year,
            $s,
            $data->section,
            
        ];
    }
}
