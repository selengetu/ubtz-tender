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
                        <tfoot>
                            <th>#</th>
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
                        </tfoot>
                    </table>
                </div>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="table-responsive">
                    <br>
                    <table class="table table-bordered table-striped" id="infonews">
                        <thead >                        
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
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="infocontract">
                        <thead >
                          
                            <th>Гэрээний №</th>
                            <th>Гэрээ байгуулсан огноо</th>
                            <th>Хүчинтэй хугацаа</th>
                            <th>Валют</th>
                            <th>Гэрээний дүн</th>
                            <th>Төлбөрийн нөхцөл</th>
                            <th>Төлбөрийн огноо </th>
                            <th>Төлбөр хийх хугацаа</th>
                            <th>Нийлүүлэх нөхцөл </th>
                            <th>Нийлүүлэх хугацаа </th>
                            <th>Нийлүүлэгч</th>
                            <th>Алдангийн нөхцөл</th>
                            <th>Гэрээний хэрэгжилт</th>
                            <th>Тодруулга</th>
                            <th>Дүгнэлт</th>
                            <th>Санамж</th>
                            <th>Гэрээний төлөв</th>
                            <th> <button class='btn btn-info btn-xs' data-toggle="modal" data-target="#contractModal"><i class='fa fa-plus'></i></button></th>
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
<div class="modal fade" id="depModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" id="formSub" action={{ route('saveOrder') }}>
                <div class="modal-body">
               
                    <div class="row">
                       
                        <div class="col-12">
                            <div class="form-group">
                                <label for="jobname">Худалдан авах ажил, үйлчилгээний нэр</label>
                                <input type="text" class="form-control" id="order_name" name="order_name" >
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">Хэмжих нэгж</label>
                                <select class="form-control" name="order_unit" id="order_unit" >
                                @foreach ($unit as $item)
                                        <option value="{{ $item->unit_id }}">{{ $item->unit_name }}</option>
                                    @endforeach
                            </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">Тоо хэмжээ</label>
                                <input type="number" class="form-control" id="order_count" name="order_count">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">Мөрдөх журам</label>
                                <select class="form-control" name="order_selection" id="order_selection" >
                                @foreach ($selection as $item)
                                        <option value="{{ $item->tenderselectioncode }}">{{ $item->tenderselectionabbr }}</option>
                                    @endforeach
                            </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">Эх үүсвэр</label>
                                <input type="text" class="form-control" id="order_budget_source" name="order_budget_source">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Төсөвт өртөг</label>
                                <input type="text" class="form-control" id="order_budget" name="order_budget">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Тухайн онд санхүүжих</label>
                                <input type="text" class="form-control" id="order_thisyear" name="order_thisyear">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Төлөв</label>
                                <select class="form-control" name="order_state" id="order_state" >
                                @foreach ($mstate as $item)
                                        <option value="{{ $item->state_id }}">{{ $item->state_name }}</option>
                                    @endforeach
                            </select>
                            </div>
                        </div> 
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Захиалга өгсөн</label>
                                <input type="date" class="form-control" id="order_date" name="order_date" >
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="form-group">
                                <label for="jobname">Захиалга батлагдсан</label>
                                <input class="form-control" type="file" id="formFile">
                            </div>
                        </div>
                     
                        <div class="col-12">
                            <div class="form-group">
                                <label for="jobname">Тайлбар</label>
                                <input type="text" class="form-control" id="order_comment" name="order_comment" placeholder="Тайлбар">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden"  id="hid" name="hid">
                    <input type="hidden"  id="flg" name="flg">
                    @csrf
                    <button type="submit" class="btn btn-primary">Хадгалах</button>
                </div>
                </form>
            </div>
        </div>
        </div>
        <div class="modal fade" id="tenderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Тендер бүртгэл</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" id="formTender" action={{ route('saveTender') }}>
                <div class="modal-body">
               
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Шалгаруулалтын төрөл</label>
                                <select class="form-control" name="tenderselectioncode" id="tenderselectioncode" >
                                @foreach ($tendertype as $item)
                                        <option value="{{ $item->contracttypecode }}">{{ $item->contracttypename }}</option>
                                    @endforeach
                            </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Тендерийн №</label>
                                <input type="text" class="form-control" id="tenderno" name="tenderno" placeholder="Тендерийн №">
                                <input type="hidden" class="form-control" id="order_id" name="order_id" placeholder="Тендерийн №">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Төрөл</label>
                                <select class="form-control" name="tendertypecode" id="tendertypecode" >
                                @foreach ($type as $item)
                                        <option value="{{ $item->tendertypecode }}">{{ $item->tendertypename }}</option>
                                    @endforeach
                            </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Зарлагдсан огноо</label>
                                <input type="date" class="form-control" id="tender_call_at" name="tender_call_at" >
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Батлагдсан төсөвт өртөг</label>
                                <input type="number" class="form-control" id="tender_budget" name="tender_budget" >
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Урилгын №</label>
                                <input type="text" class="form-control" id="tender_invitationcode" name="tender_invitationcode">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">Урилгын огноо</label>
                                <input type="date" class="form-control" id="tender_invitation_at" name="tender_invitation_at" >
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">Тендер нээх хугацаа</label>
                                <input type="date" class="form-control" id="tender_open_at" name="tender_open_at">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">Хүчинтэй хугацаа</label>
                                <input type="date" class="form-control" id="tender_validdate" name="tender_validdate">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">Багцын тоо</label>
                                <input type="number" class="form-control" id="packcount" name="packcount">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Үнэлгээ</label>
                                <input type="text" class="form-control" id="assessment" name="assessment">
                            </div>
                        </div> 
                        <div class="col-8">
                            <div class="form-group">
                                <label for="jobname">Тендерт оролцогч</label>
                                <input type="text" class="form-control" id="tender_player" name="tender_player" placeholder="Тендерт оролцогч">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Тендерийн явц</label>
                                <select class="form-control" name="tender_state" id="tender_state" >
                                @foreach ($tenderstate as $item)
                                        <option value="{{ $item->state_id }}">{{ $item->state_name }}</option>
                                    @endforeach
                            </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Үнэлгээ хийсэн огноо</label>
                                <input type="date" class="form-control" id="assessment_at" name="assessment_at" >
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Мэдэгдэл тараасан огноо</label>
                                <input type="date" class="form-control" id="statement_at" name="statement_at" >
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Гэрээ байгуулах эрх огноо</label>
                                <input type="date" class="form-control" id="contract_at" name="contract_at" >
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Түдгэлзүүлсэн огноо</label>
                                <input type="date" class="form-control" id="suspended_at" name="suspended_at" >
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Гомдол гаргасан огноо</label>
                                <input type="date" class="form-control" id="complaint_at" name="complaint_at" >
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="jobname">Тайлбар</label>
                                <input type="text" class="form-control" id="tender_comment" name="tender_comment" placeholder="Тайлбар">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden"  id="hid" name="hid">
                    <input type="hidden"  id="flg" name="flg">
                    @csrf
                    <button type="submit" class="btn btn-primary">Хадгалах</button>
                </div>
                </form>
            </div>
        </div>
        </div>
        <div class="modal fade" id="contractModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Гэрээ бүртгэл</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" id="formContract" action={{ route('saveContract') }}>
                <div class="modal-body">
               
                    <div class="row">
                        
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Гэрээний №</label>
                                <input type="text" class="form-control" id="tenderno" name="tenderno" placeholder="Тендерийн №">
                                <input type="hidden" class="form-control" id="order_id" name="order_id" placeholder="Тендерийн №">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Гэрээ байгуулсан огноо</label>
                                <input type="date" class="form-control" id="tender_call_at" name="tender_call_at" >
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Хүчинтэй хугацааг</label>
                                <input type="date" class="form-control" id="tender_budget" name="tender_budget" >
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Валют</label>
                                <input type="text" class="form-control" id="tender_invitationcode" name="tender_invitationcode">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Гэрээний дүн</label>
                                <input type="number" class="form-control" id="tender_invitation_at" name="tender_invitation_at" >
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Төлбөрийн нөхцөл</label>
                                <input type="text" class="form-control" id="tender_open_at" name="tender_open_at">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Төлбөрийн огноо</label>
                                <input type="date" class="form-control" id="tender_validdate" name="tender_validdate">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Төлбөр хийх хугацаа</label>
                                <input type="number" class="form-control" id="packcount" name="packcount">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Нийлүүлэх нөхцөл</label>
                                <input type="text" class="form-control" id="assessment" name="assessment">
                            </div>
                        </div> 
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Нийлүүлэх хугацаа</label>
                                <input type="date" class="form-control" id="tender_player" name="tender_player" placeholder="Тендерт оролцогч">
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="form-group">
                                <label for="jobname">Нийлүүлэгч</label>
                                <input type="text" class="form-control" id="assessment_at" name="assessment_at" >
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Алдангийн нөхцөл</label>
                                <input type="text" class="form-control" id="assessment_at" name="assessment_at" >
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Гэрээний хэрэгжилт</label>
                                <input type="text" class="form-control" id="statement_at" name="statement_at" >
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Тодруулга</label>
                                <input type="text" class="form-control" id="contract_at" name="contract_at" >
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Дүгнэлт</label>
                                <input type="text" class="form-control" id="suspended_at" name="suspended_at" >
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Санамж</label>
                                <input type="text" class="form-control" id="complaint_at" name="complaint_at" >
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="jobname">Гэрээний төлөв</label>
                                <input type="text" class="form-control" id="tender_comment" name="tender_comment" placeholder="Тайлбар">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden"  id="hid1" name="hid">
                    <input type="hidden"  id="flg1" name="flg">
                    @csrf
                    <button type="submit" class="btn btn-primary">Хадгалах</button>
                </div>
                </form>
            </div>
        </div>
        </div>
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
    $('#myTable tfoot th').each(function () {
        var title = $(this).text();
        $(this).html('<input type="text" placeholder="' + title + ' хайх" />');
    });
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
      
         "   <td class='m3'> <button class='btn btn-primary btn-xs' data-toggle='modal' onclick='tenderEdit("+ qwe.tenderid +")' data-target='#tenderModal'><i class='fa fa-pen'></i></button></td>"+
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
               
                $('#order_employee').val('');
                $('#order_job').val('');
                $('#order_name').val('');
                $('#order_unit').val('');
                $('#order_count').val('');
                $('#order_budget').val('');
                $('#order_thisyear').val('');
                $('#order_date').val('');
                $('#order_comment').val('');
                $('#hid').val(0);
                $('#flg').val(0);
                document.getElementById("exampleModalLabel").innerHTML="Шинээр захиалга нэмэх";
        }
    }
    function tenderEdit(hid){
        if(hid){
            $.get('gettender/' + hid, function (data) {
                $('#tenderno').val(data[0].tenderno);
                $('#tendertypecode').val(data[0].tendertypecode).trigger('change');
                $('#tenderselectioncode').val(data[0].tenderselectioncode).trigger('change');
                $('#tender_call_at').val(data[0].order_name);
                $('#tender_open_at').val(data[0].order_unit);
                $('#tender_budget').val(data[0].order_count);
                $('#tender_budget_source').val(data[0].tender_budget_source).trigger('change');
                $('#tendertitle').val(data[0].order_selection);
                $('#tender_invitationcode').val(data[0].tender_invitationcode);
                $('#tender_invitation_at').val(data[0].tender_invitation_at);
                $('#tender_validdate').val(data[0].tender_validdate);
                $('#packcount').val(data[0].packcount);
                $('#assessment').val(data[0].assessment);
                $('#tender_player').val(data[0].tender_player);
                $('#tender_state').val(data[0].tender_state).trigger('change');
                $('#assessment_at').val(data[0].assessment_at);
                $('#statement_at').val(data[0].statement_at);
                $('#contract_at').val(data[0].contract_at);
                $('#suspended_at').val(data[0].suspended_at);
                $('#tender_comment').val(data[0].tender_comment);
                $('#order_id').val(data[0].order_id);
                $('#hid1').val(data[0].tender_id);
                $('#flg1').val(1);
                document.getElementById("exampleModalLabel").innerHTML="Захиалгын мэдээллийг засварлах";
            });
        } else {
                $('#tenderno').val('');
                $('#tender_call_at').val('');
                $('#tender_open_at').val('');
                $('#tender_budget').val('');
                $('#tendertitle').val('');
                $('#tender_invitationcode').val('');
                $('#tender_invitation_at').val('');
                $('#tender_validdate').val('');
                $('#packcount').val('');
                $('#assessment').val('');
                $('#tender_player').val('');
                $('#assessment_at').val('');
                $('#statement_at').val('');
                $('#contract_at').val('');
                $('#suspended_at').val('');
                $('#tender_comment').val('');
                $('#order_id').val('');
                $('#hid1').val(0);
                $('#flg1').val(0);
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
