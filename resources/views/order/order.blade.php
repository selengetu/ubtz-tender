@extends('layouts.app')
@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" />
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
    <div class="col-md-12">
        <div class="card" style="font-size:12px;">
            <div class="card-header">
                <h3 class="card-title">Захиалгын мэдээлэл</h3>
                <div class="card-tools">
                <button class="btn btn-info btn-xs right"  onclick="orderEdit()" data-toggle="modal" data-target="#depModal"><i class="fa fa-plus"></i> </button>
                </div>
            </div>
            <div class="card-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Захиалга</a>
                </li>
                <li class="nav-item menuli1 disabled disabledTab">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Дэлгэрэнгүй</a>
                </li>
              
                </ul>
                <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="myTable">
                        <thead >
                            <th>#</th>
                            <th>Харьяа байгууллага</th>
                            <th>Захиалагч</th>
                            <th>Нэр</th>
                            <th>Хэмжих нэгж</th>
                            <th>Тоо хэмжээ</th>
                            <th>Мөрдөх журам</th>
                            <th>Хөрөнгө оруулалт </th>
                            <th>Төсөвт өртөг</th>
                            <th>Тухайн онд санхүүжих </th>
                            <th>Төлөв </th>
                            <th>Захиалга өгсөн</th>
                            <th>Тайлбар</th>
                         
                        </thead>
                        <tbody id="tbody">
                        <?php $no = 1; ?>
                         @foreach ($order as $item )
                         <tr class="orderinformation" onclick="$('#profile-tab').trigger('click')" data-id="{{$item->order_id}}" tag="{{$item->order_id}}" >
                            <td>{{$no}}</td>
                            <td>{{$item->order_dep}}</td>
                            <td>{{$item->order_employee}}</td>
                            <td>{{$item->order_name}}</td>
                            <td>{{$item->unit_name}}</td>
                            <td>{{$item->order_count}}</td>
                            <td>{{$item->tenderselectionname}}</td>
                            <td>{{$item->order_budget_source_name}}</td>
                            <td>{{$item->order_budget}}</td>
                            <td>{{$item->order_thisyear}}</td>
                            <td>{{$item->order_state_name}}</td>
                            <td>{{$item->order_date}}</td>
                            <td>{{$item->order_comment}}</td>
                           
                         
                        </tr>
                        <?php $no++; ?>
                        @endforeach
                        
                        
                        </tbody>
                    </table>
                </div>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="table-responsive">
                    <br>
                    <table class="table table-bordered table-striped" id="infonews">
                        <thead >
          
                            <th>Харьяа байгууллага</th>
                            <th>Захиалагч</th>
                            <th>Нэр</th>
                            <th>Хэмжих нэгж</th>
                            <th>Тоо хэмжээ</th>
                            <th>Мөрдөх журам</th>
                            <th>Хөрөнгө оруулалт </th>
                            <th>Төсөвт өртөг</th>
                            <th>Тухайн онд санхүүжих </th>
                            <th>Төлөв </th>
                            <th>Захиалга өгсөн</th>
                            <th>Тайлбар</th>
                            <th></th>
                        </thead>
                        <tbody id="tbody">                   
                        </tbody>
                    </table>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="infotender">
                        <thead >
                          
                            <th>Шалгаруулалтын төрөл</th>
                            <th>Тендерийн №</th>
                            <th>Төрөл</th>
                            <th>Зарлагдсан огноо</th>
                            <th>Батлагдсан төсөвт өртөг</th>
                            <th>Урилгын №</th>
                            <th>Урилгын огноо </th>
                            <th>Тендер нээх хугацаа</th>
                            <th>Хүчинтэй хугацаа </th>
                            <th>Багцын тоо </th>
                            <th>Үнэлгээ</th>
                            <th>Тайлбар</th>
                            <th> <button class='btn btn-info btn-xs' data-toggle="modal" data-target="#tenderModal"><i class='fa fa-plus'></i></button></th>
                        </thead>
                        <tbody id="tbody">
                    
                        
                        </tbody>
                    </table>
                </div>
                </div>
            
                </div>
              
            </div>
        </div>
    </div>
</div>
        <!-- Modal -->
   
        @component('order.modal.ordermodal')
        @endcomponent 
        @component('order.modal.tendermodal')
        @endcomponent
@stop
<style type="text/css">
              .disabledTab {
    pointer-events: none;
}
              .table-row{
                  cursor:pointer;
              }
              #nemelt tr:hover {
                  background-color: #ccc;
              }
              #zurch tr:hover {
                  background-color: #ccc;
              }
              @page { size: landscape; }
            </style>
@section('script')
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

<script>
   $(document).ready( function () {
    $('#myTable').DataTable(
        {
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
} );
$('.orderinformation').on('click',function(){
    var itag=$(this).attr('tag');
    $('#order_id').val(itag);
    $("#infonews tbody").empty();    
    $("#infotender tbody").empty();    
    $( ".menuli1" ).removeClass("disabled disabledTab");
    $.get('getorder/'+itag,function(data){
        $.each(data,function(i,qwe){
            var sHtml = "<tr>" +
            "   <td class='m1'>" + qwe.order_dep + "</td>" +
        "   <td class='m2'>" + qwe.order_employee + "</td>" +
        "   <td class='m3'>" + qwe.order_name + "</td>" +
         "   <td class='m3'>" + qwe.unit_name + "</td>"+
         "   <td class='m1'>" + qwe.order_count + "</td>" +
        "   <td class='m2'>" + qwe.tenderselectionname + "</td>" +
        "   <td class='m2'>" + qwe.order_budget_source_name + "</td>" +
        "   <td class='m3'>" + qwe.order_budget + "</td>" +
         "   <td class='m3'>" + qwe.order_thisyear + "</td>"+
         "   <td class='m2'>" + qwe.order_state_name + "</td>" +
        "   <td class='m3'>" + qwe.order_date + "</td>" +
         "   <td class='m3'>" + qwe.order_comment + "</td>"+
         "   <td class='m3'> <button class='btn btn-primary btn-xs' data-toggle='modal' onclick='orderEdit("+ qwe.order_id +")' data-target='#depModal'><i class='fa fa-pen'></i></button></td>"+
        "</tr>";

        $("#infonews tbody").append(sHtml);
               
               
         });
        });
        $.get('getTenders/'+itag,function(data){
        $.each(data,function(i,qwe){
            var sHtml = "<tr>" +
            "   <td class='m1'>" + qwe.tenderselectioncode + "</td>" +
        "   <td class='m2'>" + qwe.tenderno + "</td>" +
        "   <td class='m3'>" + qwe.tendertypecode + "</td>" +
         "   <td class='m3'>" + qwe.tender_call_at + "</td>"+
         "   <td class='m1'>" + qwe.tender_budget + "</td>" +
        "   <td class='m2'>" + qwe.tender_invitationcode + "</td>" +
        "   <td class='m2'>" + qwe.tender_invitation_at + "</td>" +
        "   <td class='m3'>" + qwe.tender_validdate + "</td>" +
        "   <td class='m3'>" + qwe.tender_open_at + "</td>" +
         "   <td class='m3'>" + qwe.packcount + "</td>"+
         "   <td class='m2'>" + qwe.assessment + "</td>" +
        "   <td class='m3'>" + qwe.tender_comment + "</td>" +
      
         "   <td class='m3'> <button class='btn btn-primary btn-xs' data-toggle='modal' onclick='tenderEdit("+ qwe.tenderid +")' data-target='#depModal'><i class='fa fa-pen'></i></button></td>"+
        "</tr>";

        $("#infotender tbody").append(sHtml);
               
               
         });
        });
    });
    function orderEdit(hid){
        if(hid){
            $.get('getorder/' + hid, function (data) {
                $('#order_dep').val(data[0].order_dep).trigger('change');
                $('#order_employee').val(data[0].order_employee);
                $('#order_job').val(data[0].order_job);
                $('#order_name').val(data[0].order_name);
                $('#order_unit').val(data[0].order_unit);
                $('#order_count').val(data[0].order_count);
                $('#order_budget_source').val(data[0].order_budget_source).trigger('change');
                $('#order_selection').val(data[0].order_selection).trigger('change');
                $('#order_budget').val(data[0].order_budget);
                $('#order_thisyear').val(data[0].order_thisyear);
                $('#order_state').val(data[0].order_state).trigger('change');
                $('#order_date').val(data[0].order_date);
                $('#order_comment').val(data[0].order_comment);
                $('#hid').val(data[0].order_id);
                $('#flg').val(1);
                document.getElementById("exampleModalLabel").innerHTML="Захиалгын мэдээллийг засварлах";
            });
        } else {
                $('#order_dep').val('');
                $('#order_employee').val('');
                $('#order_job').val('');
                $('#order_name').val('');
                $('#order_unit').val('');
                $('#order_count').val('');
                $('#order_budget_source').val('');
                $('#order_selection').val('');
                $('#order_budget').val('');
                $('#order_thisyear').val('');
                $('#order_state').val('');
                $('#order_date').val('');
                $('#order_comment').val('');
                $('#hid').val(0);
                $('#flg').val(0);
                document.getElementById("exampleModalLabel").innerHTML="Шинээр захиалга нэмэх";
        }
    }


    function depDel(hid,dname){
        if(confirm(dname+' нэртэй захиалгыг устгах уу?'))
        {
           $.get('{{ route("delDep") }}/'+hid , function (data) 
            {
                if(data==1)
                {
                    location.reload();
                }
            }); 
        }

    }

</script>
@stop
