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
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <h6>Шалгаруулалтын төрөл :</h6>
                                    <select class="form-control" name="sselection" id="sselection"  onchange="javascript:location.href = 'filter_selection/'+this.value;">
                                    <option value="0">Бүгд</option>
                                @foreach ($tendertype as $item)
                                        <option value="{{ $item->contracttypecode }}"  @if($item->contracttypecode==$sselection) selected @endif>{{ $item->contracttypename }}</option>
                                    @endforeach
                            </select>
                                </div>
                            </div>
                         
                         
    <div class="col-md-12">
        <div class="card" style="font-size:12px;">
         
                <div class="table-responsive"  id="acontent">
                    <h4><center><strong><br>Явцын судалгаа</strong></center></h4><br>
                    <table class="table table-bordered table-striped" id="myTable" >
                    <thead>
                            <th>№</th>
                            <th>Худалдан авах бараа, ажил, үйлчилгээний санхүүжилтийн эх үүсвэр, нэр, төрөл, тоо хэмжээ, хүчин чадал</th>
                            <th>Төсөвт өртөг (мян.төг)</th>
                            <th>Тухайн онд санхүүжих дүн (мян.төг)</th>
                            <th>Эрх шилжүүлэх эсэх / ТЕЗ-н нэр/</th>
                            <th>Худалдан авах ажиллагаанд мөрдөх журам</th>
                            <th>Үнэлгээний хороо байгуулах огноо</th>
                            <th>Тендер зарлах огноо</th>
                            <th>Гэрээ байгуулах эрх олгох огноо</th>
                            <th>Гэрээ дуусгавар болох, дүгнэх огноо  </th>
                            <th>Тайлбар, тодруулга</th>
                            <th>Төлөвлөгөөнд тусгагдсан төрөл </th>
                            <th>Захиалагч алба</th>
                            <th>Явц</th>
                        </thead>
                        <tbody id="tbody">
                        <?php $no = 1; ?>
                         @foreach ($tenders as $item )
                        <tr>
                            <td>{{$no}}</td>
                            <td>{{$item->order_name}}</td>
                            <td>{{number_format($item->order_budget, 2)}}</td>
                            <td>{{number_format($item->order_thisyear, 2)}}</td>
                            <td></td>
                            <td><b>{{$item->tenderselectionabbr}}</b></td>
                            
                            <td>    @foreach ($item->komiss as $komissinfo)
                            {{$komissinfo->komiss_date}} <br>
                            @endforeach
                            </td>
                            <td>{{$item->assessment_at}}</td>
                            @if($item->contract)
                            @foreach ($item->contract as $contract)
                            <td>{{$contract->contract_date}}</td>
                            <td>{{$contract->contract_end_date}}</td>                      
                            @endforeach
                            @else
                            <td></td>
                            <td></td>   
                            @endif
                            <td></td>   
                            <td>{{$item->order_budget_source_name}}</td>
                            <td>    @foreach ($item->detail as $detailinfo)
                            {{$detailinfo->executor_abbr}} <br>
                            @endforeach
                            </td>
                            <td><b>{{$item->tender_state_name}}</b></td>
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