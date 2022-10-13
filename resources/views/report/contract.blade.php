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
                                    <select class="form-control" name="sdep" id="sdep" onchange="javascript:location.href = 'filter_dep/'+this.value;">
                                    <option value="0">Бүгд</option>
                                    @foreach ($dep as $item)
                                        <option value="{{ $item->dep_id }}" @if($item->dep_id==$sdep) selected @endif >{{ $item->executor_name }}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                      
                         
                         
    <div class="col-md-12">
        <div class="card" style="font-size:12px;">
         
                <div class="table-responsive"  id="acontent">
                    <h4><center><strong><br>Гэрээний судалгаа</strong></center></h4><br>
                    <table class="table table-bordered table-striped" id="myTable" >
                    <thead>
                            <th>№</th>
                            <th>Ажлын нэр</th>
                            <th>Гэрээний дугаар</th>
                            <th>Байгуулсан огноо</th>
                            <th>ААН</th>
                            <th>Холбоо барих утас</th>
                            <th>Төсөвт өртөг</th>
                            <th>Хэмнэлт</th>
                            <th>Зураг төсөл, захиалагчийн хяналтын зардал, бусад зардал болон чанарын баталгаа 5% хассан дүн</th>
                            <th>Чанарын баталгааны хугацаа</th>
                            <th>Төлбөрийн нөхцөл</th>
                            <th>Захиалагч</th>
                            <th>Зардлын эх үүсвэр</th>
                            <th>Гэрээний биелэлт</th>
                        </thead>
                        <tbody id="tbody">
                        <?php $no = 1; ?>
                         @foreach ($contracts as $item )
                        <tr>
                            <td>{{$no}}</td>
                            <td>{{$item->order_name}}</td>
                            <td>{{$item->contractno}}</td>
                            <td>{{$item->contract_date}}</td>
                            <td>{{$item->supplier_name}}</td>
                            <td></td>
                            <td>{{number_format($item->order_budget, 2)}}</td>
                            <td></td>
                            <td></td>
                            <td>{{$item->supplier_days}}</td>
                            <td>{{$item->contract_condition}}</td>
                            <td>    @foreach ($item->detail as $detailinfo)
                            {{$detailinfo->executor_abbr}} <br>
                            @endforeach
                            </td>
                            <td>{{$item->tenderselectionabbr}}</td>
                            <td></td>
                           
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
        $('#myTable').DataTable(
        {
            "dom": 'Bflrtip',
            "buttons": [ 'copy', 'excel', 'csv' ],
            stateSave: true,
            "language": {
                "lengthMenu": " _MENU_ бичлэг",
                "zeroRecords": "Бичлэг олдсонгүй",
                "info": "_PAGE_ ээс _PAGES_ хуудас" ,
                "infoEmpty": "Бичлэг олдсонгүй",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "search": "Хайлт:",
                "paginate": {
                    "first":      "Эхнийх",
                    "last":       "Сүүлийнх",
                    "next":       "Дараагийнх",
                    "previous":   "Өмнөх"
                },
            },
            "pageLength": 25
        } 
    );
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