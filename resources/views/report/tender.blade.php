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
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <h6>Төрөл :</h6>
                                    <select class="form-control" name="stendertype" id="stendertype"   onchange="javascript:location.href = 'filter_tendertype/'+this.value;">
                                    <option value="0">Бүгд</option>
                                @foreach ($type as $item)
                                        <option value="{{ $item->tendertypecode }}" @if($item->tendertypecode==$stendertype) selected @endif>{{ $item->tendertypename }}</option>
                                    @endforeach
                            </select>
                                </div>
                            </div>
                         
    <div class="col-md-12">
        <div class="card" style="font-size:12px;">
         
                <div class="table-responsive"  id="acontent">
                    <h4><center><strong><br>Тендерийн явцын мэдээ</strong></center></h4><br>
                    <table class="table table-bordered table-striped" id="myTable" >
                    <thead>
                            <th></th>
                            <th>Сангийн яам баталсан огноо</th>
                            <th>Захиалга</th>
                            <th>Захиалагч</th>
                            <th>Тендерийн №</th>
                            <th>Төлөв</th>
                            <th>Шалгаруулалтын төрөл</th>
                            <th>Төсөвт өртөг</th>
                            <th>Төрөл</th>
                            <th>Зарлагдсан огноо</th>
                            <th>Урилгын дугаар</th>
                            <th>Урилгын огноо</th>
                            <th>Хүчинтэй хугацаа </th>
                            <th>Багцын мэдээлэл</th>
                            <th>Гэрээний дугаар</th>
                            <th>гэрээний хугацаа</th>
                            <th>Гэрээний дүн</th>
                            <th>Нийлүүлэгч</th>
                            <th>СЯ уруу төлөвлөгөө явуулсан огноо</th>
                        </thead>
                        <tbody id="tbody">
                        <?php $no = 1; ?>
                         @foreach ($tenders as $item )
                        <tr>
                            <td>{{$no}}</td>
                            <td>{{$item->order_date}}</td>
                            <td>{{$item->order_name}}</td>
                            <td>    @foreach ($item->detail as $detailinfo)
                            {{$detailinfo->executor_abbr}} <br>
                            @endforeach
                            </td>
                            <td><b>{{$item->tenderno}}</b></td>
                            <td><b>{{$item->tender_state_name}}</b></td>
                            <td>{{$item->contracttypename}}</td>
                            <td>{{number_format($item->tender_budget, 2)}}</td>
                            <td>{{$item->tendertypename}}</td>
                            <td>{{$item->tender_call_at}}</td>
                            <td>{{$item->tender_invitationcode}}</td>
                            <td>{{$item->tender_invitation_at}}</td>
                            <td>{{$item->tender_validdate}}</td>
                            <td>    @foreach ($item->pack as $packinfo)
                            {{$packinfo->pack_name}} <br>
                            @endforeach
                            </td>
                            @if($item->contract)
                            @foreach ($item->contract as $contract)
                            <td>{{$contract->contractno}}</td>
                            <td>{{$contract->contract_date}}</td>
                            <td>{{number_format($contract->contract_amount, 2)}}</td>
                            <td>{{$contract->supplier_name}}</td>
                          
                            @endforeach
                            @else
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            @endif
                            <td>{{$item->tender_open_at}}</td>
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