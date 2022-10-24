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
   
    .icondetail{
    width:25px;
}
    </style>

@stop

@section('content')
<div class="row">
<div id="editor"></div>
<button type='button' class="btn btn-default pull-right" onclick="printDiv('printableArea')"><i class="glyphicon glyphicon-print" ></i> ХЭВЛЭХ</button>
<div class="row">
                    <div class="col-md-3">
                    <div class="card card-primary" >
                    <div class="card-header">
                        <h3 class="card-title">Тендерийн мэдээлэл</h3>
                        <div class="card-tools">
                       
                        </div>
                    </div>
                    <div class="card-body" style="font-size:14px">
                    <div class="table-responsive">
                    <br>
                    <table class="table table-bordered table-striped">
                       
                     
                        <tbody id="tbody">   
                            <tr><td>Шалгаруулалтын төрөл:</td><td id="t_tender_selection"></td></tr>    
                            <tr><td>Тендерийн №:</td><td><b id="t_tender_no"></b></td></tr>    
                            <tr><td>Төрөл:</td><td id="t_tender_type"></td></tr> 
                            <tr><td>Зарлагдсан огноо:</td><td id="t_tender_called_at"></td></tr> 
                            <tr><td>Батлагдсан төсөвт өртөг:</td><td  id="t_tender_budget"></td></tr> 
                            <tr><td>Урилгын №:</td><td id="t_tender_invitation"></td></tr> 
                            <tr><td>Урилгын огноо:</td><td id="t_tender_invitation_at"></td></tr> 
                            <tr><td>Тендер нээх хугацаа:</td><td id="t_tender_open_at"></td></tr> 
                            <tr><td>Хүчинтэй хугацаа:</td><td id="t_tender_validdate"></td></tr> 
                            <tr><td>Багцын тоо:</td><td id="t_tender_packcount"></td></tr> 
                            <tr><td>Үнэлгээ:</td><td id="t_tender_assessment"></td></tr> 
                        </tbody>
                    </table>
                </div>
              
                    </div>
                </div>
                <div class="card card-primary card-outline"  style="font-size:12px">
                       
                        <div class="card-body">
                        <table class="table table-bordered" >
                            <tbody >
                           
                            <tr>
                            <td style="padding:0rem;"><button type="button" style="font-size:0.8rem;text-align:left" class="btn btn-block ButtonClicked" style="text-align:left" id="btn_1">  <img src="{{ asset('img/tender.png') }}" class="icondetail">  Тендер</button></td>
                            </tr>
                            <tr><td style="padding:0rem"><button type="button" style="font-size:0.8rem;text-align:left" class="btn btn-block" style="text-align:left" id="btn_2"><img src="{{ asset('img/package.png') }}" class="icondetail"> Багц</button></td>
                            </tr>
                            <tr>
                            <td style="padding:0rem">
                            <button type="button" class="btn btn-block" style="font-size:0.8rem;text-align:left" id="btn_3"><img src="{{ asset('img/ywts.png') }}" id="btn_3" class="icondetail">  Явцын мэдээлэл</button>
                            </td>
                            </tr>
                            <tr>
                            <td style="padding:0rem">
                            <button type="button" class="btn btn-block"style="font-size:0.8rem;text-align:left" id="btn_4"><img src="{{ asset('img/warning.png') }}" id="btn_4" class="icondetail"> Үнэлгээ/мэдэгдэл</button>
                            </td>
                            </tr>
                            <tr>
                            <td style="padding:0rem;"><button type="button" style="font-size:0.8rem;text-align:left" class="btn btn-block" style="text-align:left" id="btn_detail">  <img src="{{ asset('img/order.png') }}" class="icondetail">Захиалгын дэлгэрэнгүй</button></td>
                            </tr>
                            </tbody></table>
                      
                        </div>
                        </div>
                        </div>
                        <div class="col-md-9">
                        <div class="card card-primary card-list" style="font-size:12px;" id="card_1">
                    <div class="card-header">
                        <h3 class="card-title">Тендерийн мэдээлэл</h3>
                        <div class="card-tools">
                        <button class='btn btn-primary btn-xs' data-toggle="modal" data-target="#tenderModal"><i class='fa fa-plus'></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                    <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="infotender">
                        <thead >
                        <th></th>
                            <th>Шалгаруулалтын төрөл</th>
                            <th>Тендерийн №</th>
                            <th>Төрөл</th>
                            <th>Зарлагдсан огноо</th>
                            <th>Батлагдсан төсөвт өртөг</th>
                            <th>Урилгын №</th>
                            <th>Тендер нээх хугацаа</th>
                            <th>Хүчинтэй хугацаа </th>
                            <th>Багцын тоо </th>
                            <th>Үнэлгээ</th>
                            <th>Тайлбар</th>
                            
                        </thead>
                        <tbody id="tbody">
                    
                        
                        </tbody>
                    </table>

                </div>
                   
                    </div>
                </div>
                <div class="card card-primary card-list" style="font-size:12px; display:none" id="card_main">
                    <div class="card-header">
                        <h3 class="card-title">Захиалгын мэдээлэл</h3>
                        <div class="card-tools">
                        <button class='btn btn-primary btn-xs' data-toggle="modal" onclick='orderdetailEdit()' data-target="#detailModal" ><i class='fa fa-plus'></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        
                       
                        <div class="table-responsive">
                    <br>
                    <table class="table table-bordered table-striped">
                    <thead >                        
                            <th>Захиалгын нэр</th>
                            <th>Хэмжих нэгж</th>
                            <th>Тоо хэмжээ</th>
                            <th>Мөрдөх журам</th>
                            <th>Хөрөнгө оруулалт:</th>
                            <th>Төсөвт өртөг:</th>
                            <th>Тухайн онд санхүүжих:</th>
                            <th>Захиалга өгсөн:</th>
                        
                        </thead>
                        <tbody id="tbody">   
                            <tr><td id="t_order_name"></td>
                            <td id="t_order_unit"></td>
                            <td id="t_order_count"></td>  
                            <td id="t_order_selection"></td>
                            <td id="t_order_budget_source"></td>
                            <td id="t_order_budget"></td>
                            <td id="t_order_thisyear"></td>
                            <td id="t_order_date"></td></tr> 
                         
                        </tbody>
                    </table>
                </div>
                             </div>
                      
               
                   
                
                </div>
                        <div class="card card-primary card-list" style="font-size:12px; display:none" id="card_detail">
                    <div class="card-header">
                        <h3 class="card-title">Захиалгын дэлгэрэнгүй</h3>
                        <div class="card-tools">
                        <button class='btn btn-primary btn-xs' data-toggle="modal" onclick='orderdetailEdit()' data-target="#detailModal" ><i class='fa fa-plus'></i></button>
                        </div>
                    </div>
                    <div class="card-body">           
                        <div class="table-responsive">
                    <br>
                    <table class="table table-bordered table-hover table-striped" id="infodetails">
                        <thead >                        
                            <th>Алба</th>
                            <th>Тоо хэмжээ</th>
                            <th>Төсөвт өртөг</th>
                            <th>Гүйцэтгэл</th>
                            <th></th>
                        </thead>
                        <tbody id="tbody">                   
                        </tbody>
                    </table>
                </div>

                    </div>
                </div>
                <div class="card card-primary card-list" style="font-size:12px; display:none"  id="card_2">
                    <div class="card-header">
                        <h3 class="card-title">Багцын мэдээлэл</h3>
                        <div class="card-tools">
                        <button class='btn btn-primary btn-xs' data-toggle="modal" data-target="#packModal"  onclick='packEdit()'><i class='fa fa-plus'></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                    <div class="table-responsive">
                    <br>
                    <table class="table table-bordered table-hover table-striped" id="infopack">
                        <thead >                        
                            <th>Багцын нэр</th>
                            <th>Огноо</th>
                            <th>Төсөвт өртөг</th>
                            <th>Гэрээ байгуулах эрх огноо</th>
                            <th>Түдгэлзүүлсэн огноо</th>
                            <th>Гомдол гаргасан огноо</th>
                            <th></th>
                        </thead>
                        <tbody id="tbody2">                   
                        </tbody>
                    </table>
                </div>
                    </div>
                </div>  <div class="card card-primary card-list" style="font-size:12px; display:none"  id="card_3">
                    <div class="card-header">
                        <h3 class="card-title">Явцын мэдээлэл</h3>
                        <div class="card-tools">
                        <button class='btn btn-primary btn-xs' data-toggle="modal" data-target="#progressModal" onclick='progressEdit()'><i class='fa fa-plus'></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                    <div class="table-responsive">
                    <br>
                    <table class="table table-bordered table-hover table-striped">
                        <thead >                        
                            <th>Огноо</th>
                            <th>Явцын төлөв</th>
                            <th>Тайлбар</th>
                            <th>Ажилтан</th>
                            <th></th>
                        </thead>
                        <tbody id="tbody3">                   
                        </tbody>
                    </table>
                </div>
                    </div>
                </div>
                <div class="card card-primary card-list" style="font-size:12px; display:none"  id="card_4">
                    <div class="card-header">
                        <h3 class="card-title">Үнэлгээ/мэдэгдэл</h3>
                        <div class="card-tools">
                        <button class='btn btn-primary btn-xs' data-toggle="modal" data-target="#complaintModal" onclick='complaintEdit()'><i class='fa fa-plus'></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                    <div class="table-responsive">
                    <br>
                    <table class="table table-bordered table-hover table-striped">
                        <thead >                        
                            <th>Огноо</th>
                            <th>Тайлбар</th>
                            <th></th>
                        </thead>
                        <tbody id="tbody4">                   
                        </tbody>
                    </table>
                </div>
                    </div>
                </div>
                        </div>
                    </div>
    </div>
</div>
@stop

@section('script')
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
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