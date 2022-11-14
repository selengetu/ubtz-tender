@extends('layouts.app')
@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.16/b-1.5.1/b-html5-1.5.1/datatables.min.css"/>
<style>
    .scroll {
        margin:4px, 4px;
        padding:4px;
        height: 710px;
        overflow-x: hidden;
        overflow-y: auto;
        text-align:justify;
    }
   
   
    </style>

@stop

@section('content')
<div class="row">
       
                        <div class="col-sm-2">
                                <div class="form-group">
                                    <h6>Байгууллага сонгох :</h6>
                                   
                                </div>
                            </div>
                      
                         
                         
    <div class="col-md-12">
        <div class="card" style="font-size:12px;">
         
                <div class="table-responsive"  id="acontent">
                    <h4><center><strong><br>Захиалгын мэдээлэл</strong></center></h4><br>
                    <table class="table table-bordered table-striped" id="myTable">
                        <thead style="background-color:#007bff; color:white;">
                            <th>#</th>
                            <th>Нэр</th>
                            <th>Байгууллага</th>
                            <th>Хэмжих нэгж</th>
                            <th>Тоо хэмжээ</th>
                            <th>Мөрдөх журам</th>
                            <th>Хөрөнгө оруулалт </th>
                            <th>Төсөвт өртөг (мян.төг)</th>
                            <th>Тухайн онд санхүүжих </th>
                            <th>Захиалга өгсөн</th>
                            <th>Ажилтан</th>
                            <th>Тайлбар</th>
                        </thead>
                        <tbody id="tbody">
                        <?php $no = 1; ?>
                         @foreach ($order as $item )
                         <tr data-toggle='modal' data-target='#detModal' >
                            <td>{{$no}}</td>
                            <td><b style="color:#007bff"><u>{{$item->order_name}}</u></b></td>
                            <td>{{$item->dep_name}}</td>
                            <td>{{$item->unit_name}}</td>
                            <td>{{$item->order_count}}</td>
                            <td>{{$item->tenderselectionname}}</td>
                            <td>{{$item->order_budget_source_name}}</td>
                            <td>{{number_format($item->order_budget, 2)}}</td>
                            <td>{{number_format($item->order_thisyear, 2)}}</td>
                            <td>{{$item->order_date}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->order_comment}}</td> 
                           
                        </tr>
                        <?php $no++; ?>
                        @endforeach
                        </tbody>
                       
                    </table>
                </div>
            </div>
    
        </div>
    </div>
</div>

@stop

@section('script')
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.16/b-1.5.1/b-html5-1.5.1/datatables.min.js"></script>
<script type="text/javascript">

 function printDiv(printarea) {
     var printContents = document.getElementById('acontent').innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}

</script>


@stop

<style type="text/css">
@page {
  size: A4;
}
body{
  color: black;
}
.clearfix{
  margin-top: 5px
}
  @media print {
   #btn2, #btn, #navbar, .left_col{
        display: none;
    }

}  


</style>