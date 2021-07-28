@inject('us','App\Models\User')
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="http://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet">
<link href="http://fonts.googleapis.com/css2?family=Amiri&display=swap" rel="stylesheet">
    
    
    <meta charset="utf-8">
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Marks PDF</title>
    <style>
        body{ background: #ccc }
        table{ width: 70%;margin: auto;text-align: center }
        table tr,table th,table td{ border: 1px solid #000; }
        table th{ background: rgb(207, 154, 6);color: #fff }
    </style>
  </head>
  <body>
    <table class="styled-table">
        <thead>
            <tr >
                <th  >المادة</th>
                <th >علامة المقرر النظري</th>
                <th >علامة المقرر العملي</th>
                <th >سنة  النجاح  بالمادة</th>
                <th >دورة  النجاح  بالمادة</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($marks as $s)
            <tr>
                <td>
                    {{ $us->getSubjecteName($s->subjectId)->name}}
                </td>
                <td >
                    {{$s->th}}
                </td>	
            
                <td >
                    {{$s->pr}}
                </td>	
        
               <td >
                    {{$s->year}}
                </td>	
            
                
                <td >
                        {{$s->semester}}
                    </td>	
                </tr>	
            @endforeach
        </tbody>
    </table>
  </body>
</html>