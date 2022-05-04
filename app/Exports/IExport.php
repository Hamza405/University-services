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

use Maatwebsite\Excel\Concerns\WithMapping;

class IExport implements FromCollection,WithHeadings,WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
   

    public function collection()
    {
        $users = User::select('name','email','num','section','year','gender')
        ->where('role','طالب')
        ->get();
        return $users;
    }

    public function headings(): array

    {

        return [

            'الاسم',

            'الإيميل',

            'الرقم الجامعي',

            'القسم',

            'السنة',

            'الجنس',

        ];

    }

    public function map($users): array
    {
        $ff = null;
        if($users->year==1){
            $ff='الأولى';
        }else if($users->year==2){
            $ff='الثانية';
        }
        else if($users->year==3){
            $ff='الثالثة';
        }
        else if($users->year==4){
            $ff='الرابعة';
        }
        else if($users->year==5){
            $ff='الخامسة';
        }
            return [
            $users->name,
            $users->email,
            $users->num,
            $users->section,
            $ff,
            $users->gender,
            
        ];
    }
}
