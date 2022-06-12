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
        body{ background: #fff }
        table{ width: 70%;margin: auto;text-align: center }
        table tr,table th,table td{ border: 1px solid #000; }
        table th{ background: rgb(207, 154, 6);color: #fff }
        .headerSection{
            display:inline-flex;
        }
        img{
            width:20%;
        }
        .content{
            width:95%;
        }
        .styled-table{
            width:90%;
        }
        .styled-table th{
            background: #ccc;
            font-size:.9rem;
        }
        .styled-table th,.styled-table td{    
            color: #000;
            border-radius:10px;
            border:1px solid #ddd;
            padding:1rem;
        }
    </style>
  </head>
  <body>
      <div class="headerSection">
          <table style="border:none;width:95%">
              <tr>
                  <td style="border:none;text-align:start"><img src="assets/images/icon/logo.jpeg" alt=""></td>
                  
                  <td dir="rtl" style="border:none;text-align:end;font-weight:bold">
                  <p>
                         وزارة التعليم العالي
                  </p>
                  <br>
                  <p>
                        جامعة تشرين
                  </p>
                  <br>
                    <p>
                        كلية الهندسة الميكانيكية و الكهربائية
                    </p>
                </td>
              </tr>
          </table>
      </div>
      
      <div class="content">
      <p dir="rtl">الطالب {{$user->name}}</p>
      <p dir="rtl">قسم {{$user->section}}</p>
      <p dir="rtl">الرقم الجامعي {{$user->num}}</p>
      </div>
   
      <div class="table">
        <table style="margin-top:3rem" class="styled-table">
            <thead>
                <tr >
                
                    <th >علامة المقرر النظري</th>
                    <th >علامة المقرر العملي</th>
                    <th >سنة  النجاح  بالمادة</th>
                    <th >دورة  النجاح  بالمادة</th>
                    <th  >المادة</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($marks as $s)
                <tr>
                    
                    <td >
                        {{$s->th}}
                    </td>	
                
                    <td >
                        {{$s->pr==null?'لايوجد':$s->pr}}
                    </td>		
                
                    <td >
                        {{$s->year}}
                    </td>	
                
                    
                    <td >
                            {{$s->semester}}
                    </td>	
                    <td>
                        {{ $us->getSubjecteName($s->subjectId)->name}}
                    </td>
                    </tr>	
                @endforeach
            </tbody>
        </table>
    </div>
  </body>
</html>