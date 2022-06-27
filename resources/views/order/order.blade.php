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

.ps-container {
    position: relative;
}
.icondetail{
    width:25px;
}
.ButtonClicked {
    background-color:#4da3ff;
}
.btn-list {
    background-color:#4da3ff;
}
.orderinformation {cursor: context-menu;}
.ps-container {
    -ms-touch-action: auto;
    touch-action: auto;
    overflow: hidden!important;
    -ms-overflow-style: none;
}

.media-chat {
    padding-right: 64px;
    margin-bottom: 0;
}

.media {
    padding: 16px 12px;
    -webkit-transition: background-color .2s linear;
    transition: background-color .2s linear;
}

.media .avatar {
    flex-shrink: 0;
}

.avatar {
    position: relative;
    display: inline-block;
    width: 36px;
    height: 36px;
    line-height: 36px;
    text-align: center;
    border-radius: 100%;
    background-color: #f5f6f7;
    color: #8b95a5;
    text-transform: uppercase;
}

.media-chat .media-body {
    -webkit-box-flex: initial;
    flex: initial;
    display: table;
}

.media-body {
    min-width: 0;
}

.media-chat .media-body p {
    position: relative;
    padding: 6px 8px;
    margin: 4px 0;
    background-color: #f5f6f7;
    border-radius: 3px;
    font-weight: 100;
    color:#9b9b9b;
}

.media>* {
    margin: 0 8px;
}

.media-chat .media-body p.meta {
    background-color: transparent !important;
    padding: 0;
    opacity: .8;
}

.media-meta-day {
    -webkit-box-pack: justify;
    justify-content: space-between;
    -webkit-box-align: center;
    align-items: center;
    margin-bottom: 0;
    color: #8b95a5;
    opacity: .8;
    font-weight: 400;
}

.media {
    padding: 16px 12px;
    -webkit-transition: background-color .2s linear;
    transition: background-color .2s linear;
}

.media-meta-day::before {
    margin-right: 16px;
}

.media-meta-day::before, .media-meta-day::after {
    content: '';
    -webkit-box-flex: 1;
    flex: 1 1;
    border-top: 1px solid #ebebeb;
}

.media-meta-day::after {
    content: '';
    -webkit-box-flex: 1;
    flex: 1 1;
    border-top: 1px solid #ebebeb;
}

.media-meta-day::after {
    margin-left: 16px;
}

.media-chat.media-chat-reverse {
    padding-right: 12px;
    padding-left: 64px;
    -webkit-box-orient: horizontal;
    -webkit-box-direction: reverse;
    flex-direction: row-reverse;
}

.media-chat {
    padding-right: 64px;
    margin-bottom: 0;
}

.media {
    padding: 16px 12px;
    -webkit-transition: background-color .2s linear;
    transition: background-color .2s linear;
}

.media-chat.media-chat-reverse .media-body p {
    float: right;
    clear: right;
    background-color: #48b0f7;
    color: #fff;
}

.media-chat .media-body p {
    position: relative;
    padding: 6px 8px;
    margin: 4px 0;
    background-color: #f5f6f7;
    border-radius: 3px;
}


.border-light {
    border-color: #f1f2f3 !important;
}

.bt-1 {
    border-top: 1px solid #ebebeb !important;
}

.publisher {
    position: relative;
    display: -webkit-box;
    display: flex;
    -webkit-box-align: center;
    align-items: center;
    padding: 12px 20px;
    background-color: #f9fafb;
}

.publisher>*:first-child {
    margin-left: 0;
}

.publisher>* {
    margin: 0 8px;
}

.publisher-input {
    -webkit-box-flex: 1;
    flex-grow: 1;
    border: none;
    outline: none !important;
    background-color: transparent;
}

button, input, optgroup, select, textarea {
    font-family: Roboto,sans-serif;
    font-weight: 300;
}

.publisher-btn {
    background-color: transparent;
    border: none;
    color: #8b95a5;
    font-size: 16px;
    cursor: pointer;
    overflow: -moz-hidden-unscrollable;
    -webkit-transition: .2s linear;
    transition: .2s linear;
}

.file-group {
    position: relative;
    overflow: hidden;
} 

.publisher-btn {
    background-color: transparent;
    border: none;
    color: #cac7c7;
    font-size: 16px;
    cursor: pointer;
    overflow: -moz-hidden-unscrollable;
    -webkit-transition: .2s linear;
    transition: .2s linear;
} 

.file-group input[type="file"] {
    position: absolute;
    opacity: 0;
    z-index: -1; 
    width: 20px;
}

.text-info {
    color: #48b0f7 !important;
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
                <button id="addorderbutton" class="btn btn-primary btn-xs right"  onclick="orderEdit()" data-toggle="modal" data-target="#depModal"><i class="fa fa-plus"></i> </button>
                </div>
            </div>
            <div class="card-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist" style="font-size:14px">
            
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Захиалга</a>
                </li>
                <li class="nav-item menuli1 disabled disabledTab">
                    <a class="nav-link" id="tender-tab" data-toggle="tab" href="#tender" role="tab" aria-controls="tender" aria-selected="false">Тендер</a>
                </li>
                <li class="nav-item menuli1 disabled disabledTab">
                    <a class="nav-link" id="contract-tab" data-toggle="tab" href="#contract" role="contract" aria-controls="contract" aria-selected="false">Гэрээ</a>
                </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <br>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="myTable">
                        <thead style="background-color:#007bff; color:white;">
                            <th>#</th>
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
                            <th>Ажилтан</th>
                            <th>Тайлбар</th>
                        </thead>
                        <tbody id="tbody">
                        <?php $no = 1; ?>
                         @foreach ($order as $item )
                         <tr>
                            <td>{{$no}}</td>
                            <td class='m3'><button class='btn btn-primary btn-xs' data-toggle='modal' onclick='orderEdit({{$item->order_id}})' data-target='#depModal'><i class='fa fa-pen'></i></button></td>    
                            <td class="orderinformation" onclick="$('#tender-tab').trigger('click')" data-id="{{$item->order_id}}" tag="{{$item->order_id}}" ><b style="color:#007bff"><u>{{$item->order_name}}</u></b></td>
                            <td>{{$item->unit_name}}</td>
                            <td>{{$item->order_count}}</td>
                            <td>{{$item->tenderselectionname}}</td>
                            <td>{{$item->order_budget_source_name}}</td>
                            <td>{{$item->order_budget}}</td>
                            <td>{{$item->order_thisyear}}</td>
                            <td>{{$item->order_state_name}}</td>
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
                <div class="tab-pane fade" id="tender" role="tabpanel" aria-labelledby="tender-tab">
                    <br>
                    <div class="row">
                    <div class="col-md-3">
                    <div class="card card-primary" >
                    <div class="card-header">
                        <h3 class="card-title">Захиалгын мэдээлэл</h3>
                        <div class="card-tools">
                       
                        </div>
                    </div>
                    <div class="card-body" style="font-size:14px">
                    <div class="table-responsive">
                    <br>
                    <table class="table table-bordered table-striped">
                       
                        <tbody id="tbody">   
                            <tr><td>Захиалгын нэр:</td><td id="t_order_name"></td></tr>  
                            <tr><td>Хэмжих нэгж:</td><td id="t_order_unit"></td></tr>    
                            <tr><td>Тоо хэмжээ:</td><td id="t_order_count"></td></tr>    
                            <tr><td>Мөрдөх журам:</td><td id="t_order_selection"></td></tr> 
                            <tr><td>Хөрөнгө оруулалт:</td><td id="t_order_budget_source"></td></tr> 
                            <tr><td>Төсөвт өртөг:</td><td  id="t_order_budget"></td></tr> 
                            <tr><td>Тухайн онд санхүүжих:</td><td id="t_order_thisyear"></td></tr> 
                            <tr><td>Төлөв:</td><td id="t_order_state"></td></tr> 
                            <tr><td>Захиалга өгсөн:</td><td id="t_order_date"></td></tr> 
                         
                        </tbody>
                    </table>
                </div>
                <a href="#" style="text-align:right" id="btn_detail" class="btn-block">Дэлгэрэнгүй</a>
                    </div>
                </div>
                <div class="card card-primary card-outline"  style="font-size:12px">
                       
                        <div class="card-body">
                        <table class="table table-bordered" >
                            <tbody >
                            <tr>
                            <td style="padding:0rem;"><button type="button" style="font-size:0.8rem;text-align:left" class="btn btn-block" style="text-align:left" id="btn_1">  <img src="{{ asset('img/tender.png') }}" class="icondetail">  Тендер</button></td>
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
                            </tbody></table>
                      
                        </div>
                        </div>
                        </div>
                        <div class="col-md-9">
                        <div class="card card-primary card-list" style="font-size:12px; display:none" id="card_1">
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
                            <th></th>
                        </thead>
                        <tbody id="tbody">
                    
                        
                        </tbody>
                    </table>

                </div>
                   
                    </div>
                </div>
                        <div class="card card-primary card-list" style="font-size:12px;" id="card_detail">
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
                        <button class='btn btn-primary btn-xs' data-toggle="modal" data-target="#packModal"><i class='fa fa-plus'></i></button>
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
                        <button class='btn btn-primary btn-xs' data-toggle="modal" data-target="#progressModal"><i class='fa fa-plus'></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                    <div class="table-responsive">
                    <br>
                    <table class="table table-bordered table-hover table-striped" id="infoprogress">
                        <thead >                        
                            <th>Огноо</th>
                            <th>Явцын төлөв</th>
                            <th>Тайлбар</th>
                            <th>Ажилтан</th>
                            <th></th>
                        </thead>
                        <tbody id="tbody1">                   
                        </tbody>
                    </table>
                </div>
                    </div>
                </div>
                <div class="card card-primary card-list" style="font-size:12px; display:none"  id="card_4">
                    <div class="card-header">
                        <h3 class="card-title">Үнэлгээ/мэдэгдэл</h3>
                        <div class="card-tools">
                        <button class='btn btn-primary btn-xs' data-toggle="modal" data-target="#complaintModal"><i class='fa fa-plus'></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                    <div class="table-responsive">
                    <br>
                    <table class="table table-bordered table-hover table-striped" id="infocomplaint">
                        <thead >                        
                            <th>Огноо</th>
                            <th>Төлөв</th>
                            <th>Тайлбар</th>
                            <th></th>
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
                <div class="tab-pane fade" id="contract" role="tabpanel" aria-labelledby="contract-tab">
                <br>
                <div class="row">
                <div class="col-md-3">
                    <div class="card card-primary" >
                    <div class="card-header">
                        <h3 class="card-title" id="t_order_name">Тендерийн мэдээлэл</h3>
                        <div class="card-tools">
                       
                        </div>
                    </div>
                    <div class="card-body" style="font-size:14px">
                    <div class="table-responsive">
                    <br>
                    <table class="table table-bordered table-striped">
                       
                        <tbody id="tbody">   
                            <tr><td>Шалгаруулалтын төрөл:</td><td id="t_order_unit"></td></tr>    
                            <tr><td>Тендерийн №:</td><td id="t_order_count"></td></tr>    
                            <tr><td>Төрөл:</td><td id="t_order_selection"></td></tr> 
                            <tr><td>Зарлагдсан огноо:</td><td id="t_order_budget_source"></td></tr> 
                            <tr><td>Батлагдсан төсөвт өртөг:</td><td  id="t_order_budget"></td></tr> 
                            <tr><td>Урилгын №:</td><td id="t_order_thisyear"></td></tr> 
                            <tr><td>Урилгын огноо:</td><td id="t_order_state"></td></tr> 
                            <tr><td>Тендер нээх хугацаа:</td><td id="t_order_date"></td></tr> 
                            <tr><td>Хүчинтэй хугацаа:</td><td id="t_order_date"></td></tr> 
                            <tr><td>Багцын тоо:</td><td id="t_order_date"></td></tr> 
                            <tr><td>Үнэлгээ:</td><td id="t_order_date"></td></tr> 
                        </tbody>
                    </table>
                </div>
                       
                    </div>
                    </div>
                </div>
                <div class="col-md-9">
                <div class="card card-primary" style="font-size:12px;" id="cardcontract">
            <div class="card-header">
                <h3 class="card-title">Гэрээний мэдээлэл</h3>
                <div class="card-tools">
                <button class="btn btn-primary btn-xs right"  onclick="orderEdit()" data-toggle="modal" data-target="#depModal"><i class="fa fa-plus"></i> </button>
                </div>
            </div>
            <div class="card-body">
             
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
                            <th> <button class='btn btn-primary btn-xs' data-toggle="modal" data-target="#contractModal"><i class='fa fa-plus'></i></button></th>
                        </thead>
                        <tbody id="tbody">
                    
                        
                        </tbody>
                    </table>
                </div>
              
            </div>
        </div>
                </div>
                </div>
  
       
        <div class="card card-bordered">
              <div class="card-header">
                <h4 class="card-title"><strong>Сэтгэгдэл</strong></h4>
              </div>
              <div class="ps-container ps-theme-default ps-active-y" id="chat-content" style="overflow-y: scroll !important; height:300px !important;">
                <div class="media media-chat">
                  <img class="avatar" src="https://img.icons8.com/color/36/000000/administrator-male.png" alt="...">
                  <div class="media-body">
                    <p>Hi</p>
                    <p>Гэрээний явц ...???</p>
                    <p class="meta"><time datetime="2018">09:58</time></p>
                  </div>
                </div>

                <div class="media media-meta-day">Today</div>

                <div class="media media-chat media-chat-reverse">
                  <div class="media-body">
                    <p>Hiii, Явц 70%</p>
                    <p>Маргааш үлдсэн гарын үсгээ зуруулна</p>

                    <p class="meta"><time datetime="2018">11:06</time></p>
                  </div>
                </div>

                <div class="media media-chat">
                  <img class="avatar" src="https://img.icons8.com/color/36/000000/administrator-male.png" alt="...">
                  <div class="media-body">
                    <p>Okay</p>
                   
                    <p class="meta"><time datetime="2018">11:07</time></p>
                  </div>
                </div>
              <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; height: 0px; right: 2px;"><div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 2px;"></div></div></div>

              <div class="publisher bt-1 border-light">
                <img class="avatar avatar-xs" src="https://img.icons8.com/color/36/000000/administrator-male.png" alt="...">
                <input class="publisher-input" type="text" placeholder="Сэтгэгдэл бичих">
              
                <a class="publisher-btn text-info" href="#" data-abc="true"><i class="fa fa-paper-plane"></i></a>
              </div>

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
                                <select class="form-control" name="order_budget_source" id="order_budget_source" >
                                @foreach ($source as $item)
                                        <option value="{{ $item->source_id }}">{{ $item->source_name }}</option>
                                    @endforeach
                            </select>
                             
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
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Ажилтан</label>
                                <select class="form-control" name="order_employee" id="order_employee" >
                                @foreach ($employee as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                            </select>
                             
                            </div>
                        </div>
                        <div class="col-4">
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
                    <input type="hidden"  id="order_id" name="order_id" class="order_id">
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
                                <input type="hidden" class="form-control" id="torder_id" name="torder_id" class="order_id" placeholder="Тендерийн №">
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
                       
                        <div class="col-8">
                            <div class="form-group">
                                <label for="jobname">Тайлбар</label>
                                <input type="text" class="form-control" id="tender_title" name="tender_title" placeholder="Тайлбар">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden"  id="tender_id" name="tender_id">
                    @csrf
                    <button type="submit" class="btn btn-primary">Хадгалах</button>
                </div>
                </form>
            </div>
        </div>
        </div>
        <div class="modal fade" id="packModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Багц бүртгэл</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" id="formTender" action={{ route('savePack') }}>
                <div class="modal-body">
               
                    <div class="row">
                    <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Тендер</label>
                                <select class="form-control" name="tender_list_id" id="tender_list_id" >
                            </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Багцын нэр</label>
                                <input type="text" class="form-control" id="pack_name" name="pack_name" placeholder="Багцын нэр">
                                <input type="hidden" class="form-control" id="pack_order_id" name="pack_order_id" placeholder="Багцын нэр">
                            </div>
                        </div>
                    
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Огноо</label>
                                <input type="date" class="form-control" id="pack_date" name="pack_date" >
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Төсөвт өртөг</label>
                                <input type="number" class="form-control" id="pack_budget" name="pack_budget" >
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">Гэрээ байгуулах эрх огноо</label>
                                <input type="date" class="form-control" id="pack_contract_at" name="pack_contract_at">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">Түдгэлзүүлсэн огноо</label>
                                <input type="date" class="form-control" id="pack_suspended_at" name="pack_suspended_at" >
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">Гомдол гаргасан огноо</label>
                                <input type="date" class="form-control" id="pack_complaint_at" name="pack_complaint_at">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden"  id="pack_id" name="pack_id">
                    @csrf
                    <button type="submit" class="btn btn-primary">Хадгалах</button>
                </div>
                </form>
            </div>
        </div>
        </div>
        <div class="modal fade" id="progressModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Явцын мэдээлэл</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" id="formProgress" action={{ route('saveProgress') }}>
                <div class="modal-body">
               
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Огноо</label>
                                <input type="date" class="form-control" id="progress_date" name="progress_date" >
                            </div>
                        </div>
                       
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Төлөв</label>
                                <select class="form-control" name="progress_state" id="progress_state" >
                               
                            </select>
                            </div>
                        </div>
                      
                        <div class="col-12">
                            <div class="form-group">
                                <label for="jobname">Тайлбар</label>
                                <input type="text" class="form-control" id="progress_comment" name="progress_comment">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden"  id="progress_id" name="progress_id">
                    @csrf
                    <button type="submit" class="btn btn-primary">Хадгалах</button>
                </div>
                </form>
            </div>
        </div>
        </div>
        <div class="modal fade" id="complaintModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Мэдэгдэл/Үнэлгээ бүртгэл</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" id="formComplaint" action={{ route('saveComplaint') }}>
                <div class="modal-body">
               
                    <div class="row">
                        
                    <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Огноо</label>
                                <input type="date" class="form-control" id="complaint_date" name="complaint_date" >
                            </div>
                        </div>
                      
                        <div class="col-8">
                            <div class="form-group">
                                <label for="jobname">Тайлбар</label>
                                <input type="text" class="form-control" id="complaint_comment" name="complaint_comment">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden"  id="complaint_id" name="complaint_id">
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
                    <input type="hidden"  id="contract_id" name="contract_id">
                    @csrf
                    <button type="submit" class="btn btn-primary">Хадгалах</button>
                </div>
                </form>
            </div>
        </div>
        </div>
        <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="detail-title" id="exampleModalLabel">Захиалгын дэлгэрэнгүй мэдээллийн бүртгэл</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" id="formDetail" action={{ route('saveOrderDetail') }}>
                <div class="modal-body">
               
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Алба хэлтэс</label>
                                <select class="form-control" name="dep_id" id="dep_id" >
                                @foreach ($dep as $item)
                                        <option value="{{ $item->dep_id }}">{{ $item->executor_name }}</option>
                                    @endforeach
                            </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Тоо хэмжээ</label>
                                <input type="text" class="form-control" id="dorder_count_detail" name="dorder_count_detail" >
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Төсөвт өртөг</label>
                                <input type="hidden" class="form-control" id="dorder_id" name="dorder_id" class="order_id">
                                <input type="text" class="form-control" id="dorder_budget" name="dorder_budget">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Гүйцэтгэл</label>
                                <input type="text" class="form-control" id="dorder_performance" name="dorder_performance">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden"  id="detail_id" name="detail_id">
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
    $('.btn-block').on('click',function(){
    $('.btn-block').removeClass('ButtonClicked');
    $('.card-list').hide();
    switch ($(this).attr('id')) {
        case 'btn_detail':
            $('#card_detail').show();
            break;
        case 'btn_1':
            $('#card_1').show();
            $(this).toggleClass('ButtonClicked');
            break;
        case 'btn_2':
            $('#card_2').show();
            $(this).toggleClass('ButtonClicked');
            break;
        case 'btn_3':
            $('#card_3').show();
            $(this).toggleClass('ButtonClicked');
            break;
        case 'btn_4':
            $('#card_4').show();
            $(this).toggleClass('ButtonClicked');
            break;
        }

  
});

} );
$('#home-tab').on('click',function(){
    $('#addorderbutton').show();
});
$('.orderinformation').on('click',function(){
    var itag=$(this).attr('tag');
    $('#torder_id').val(itag);
    $('#addorderbutton').hide();
    $('#order_id').val(itag);
    $('#pack_order_id').val(itag);
    $("#infonews tbody").empty();    
    $("#infotender tbody").empty();   
    $("#infodetails tbody").empty();  
    $( ".menuli1" ).removeClass("disabled disabledTab");
    $.get('getorder/' + itag, function (data) {
                $('#t_order_name').text(data[0].order_name);
                $('#t_order_unit').text(data[0].unit_name);
                $('#t_order_count').text(data[0].order_count);
                $('#t_order_budget_source').text(data[0].order_budget_source_name);
                $('#t_order_selection').text(data[0].tenderselectionabbr);
                $('#t_order_budget').text(data[0].order_budget);
                $('#t_order_thisyear').text(data[0].order_thisyear);
                $('#t_order_state').text(data[0].order_state_name);
                $('#t_order_date').text(data[0].order_date);
                $('#t_order_comment').text(data[0].order_comment);
                $('#dorder_id').val(data[0].order_id);
                $('#hid').val(data[0].order_id);
                $('#flg').val(1);
                document.getElementById("exampleModalLabel").innerHTML="Захиалгын мэдээллийг засварлах";
            });

        $.get('getorderdetails/'+itag,function(data){
        $.each(data,function(i,qwe){
            var sHtml = "<tr>" +
        "   <td class='m3'>" + qwe.executor_abbr + "</td>" +
         "   <td class='m3'>" + qwe.order_count + "</td>" +
        "   <td class='m3'>" + qwe.order_budget + "</td>" +
        "   <td class='m3'>" + qwe.order_performance + "</td>" +
         "   <td class='m3'> <button class='btn btn-primary btn-xs' data-toggle='modal' onclick='orderdetailEdit("+ qwe.order_detail_id +")' data-target='#detailModal'><i class='fa fa-pen'></i></button></td>"+
        "</tr>";

        $("#infodetails tbody").append(sHtml);
               
               
         });
        });
        $.get('getpacks/'+itag,function(data){
        $.each(data,function(i,qwe){
            var sHtml = "<tr>" +
        "   <td class='m3'>" + qwe.pack_name + "</td>" +
         "   <td class='m3'>" + qwe.pack_date + "</td>" +
        "   <td class='m3'>" + qwe.pack_budget + "</td>" +
        "   <td class='m3'>" + qwe.pack_contract_at + "</td>" +
        "   <td class='m3'>" + qwe.pack_suspended_at + "</td>" +
        "   <td class='m3'>" + qwe.pack_complaint_at + "</td>" +
         "   <td class='m3'> <button class='btn btn-primary btn-xs' data-toggle='modal' onclick='packEdit("+ qwe.pack_id +")' data-target='#packModal'><i class='fa fa-pen'></i></button></td>"+
        "</tr>";
            
        $("#tbody2").append(sHtml);
               
               
         });
        });
        $.get('getTenders/'+itag,function(data){
        $.each(data,function(i,qwe){
            var sHtml = "<tr>" +
            "   <td class='m1'>" + qwe.contracttypename + "</td>" +
        "   <td class='m2'>" + qwe.tenderno + "</td>" +
        "   <td class='m3'>" + qwe.tendertypename + "</td>" +
         "   <td class='m3'>" + qwe.tender_call_at + "</td>"+
         "   <td class='m1'>" + qwe.tender_budget + "</td>" +
        "   <td class='m2'>" + qwe.tender_invitationcode + "</td>" +
        "   <td class='m2'>" + qwe.tender_invitation_at + "</td>" +
        "   <td class='m3'>" + qwe.tender_open_at + "</td>" +
        "   <td class='m3'>" + qwe.tender_validdate + "</td>" +
         "   <td class='m3'>" + qwe.packcount + "</td>"+
         "   <td class='m2'>" + qwe.assessment + "</td>" +
        "   <td class='m3'>" + qwe.tendertitle + "</td>" +
      
         "   <td class='m3'> <button class='btn btn-primary btn-xs' data-toggle='modal' onclick='tenderEdit("+ qwe.tenderid +")' data-target='#tenderModal'><i class='fa fa-pen'></i></button></td>"+
        "</tr>";

        $("#infotender tbody").append(sHtml);    
         });
         $('#tender_list_id').empty();

            $.each(data,function(i,qwe){
                $('#tender_list_id').append($('<option>', {
                    value: qwe.tenderid,
                    text: qwe.tenderno
                }));
            });
        });
    
    });
    function orderEdit(hid){
        if(hid){
            $.get('getorder/' + hid, function (data) {
                $('#order_employee').val(data[0].order_employee).trigger('change');
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
                $('.order_id').val(data[0].order_id);
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
                $('#order_id').val(0);
                document.getElementById("exampleModalLabel").innerHTML="Шинээр захиалга нэмэх";
        }
    }
    function orderdetailEdit(hid){
        if(hid){
            $.get('getorderdetail/' + hid, function (data) {
                $('#dep_id').val(data[0].dep_id).trigger('change');
                $('#dorder_id').val(data[0].order_id);
                $('#dorder_count_detail').val(data[0].order_count);
                $('#dorder_budget').val(data[0].order_budget);
                $('#dorder_performance').val(data[0].order_performance);
                $('#detail_id').val(data[0].order_detail_id);
                document.getElementById("exampleModalLabel").innerHTML="Захиалгын мэдээллийг засварлах";
            });
        } else {
               
                $('#dep_id').val('1').trigger('change');
                $('#dorder_count_detail').val('');
                $('#dorder_budget').val('');
                $('#dorder_performance').val('');
                $('#detail_id').val('');
                document.getElementById("exampleModalLabel").innerHTML="Шинээр захиалга нэмэх";
        }
    }
    function packEdit(hid){
        if(hid){
            $.get('getpack/' + hid, function (data) {
                $('#pack_name').val(data[0].pack_name).trigger('change');
                $('#pack_date').val(data[0].pack_date);
                $('#pack_budget').val(data[0].pack_budget);
                $('#pack_contract_at').val(data[0].pack_contract_at);
                $('#pack_suspended_at').val(data[0].pack_suspended_at);
                $('#pack_complaint_at').val(data[0].pack_complaint_at);
                $('#pack_id').val(data[0].pack_id);
                document.getElementById("exampleModalLabel").innerHTML="Захиалгын мэдээллийг засварлах";
            });
        } else {
               
                $('#pack_name').val('');
                $('#pack_date').val('');
                $('#pack_budget').val('');
                $('#pack_contract_at').val('');
                $('#pack_suspended_at').val('');
                $('#pack_complaint_at').val('');
                $('#pack_id').val(0);
                document.getElementById("exampleModalLabel").innerHTML="Шинээр захиалга нэмэх";
        }
    }
    function tenderEdit(hid){
        if(hid){
            $.get('getTender/' + hid, function (data) {
                $('#tenderno').val(data[0].tenderno);
                $('#tendertypecode').val(data[0].tendertypecode).trigger('change');
                $('#tenderselectioncode').val(data[0].tenderselectioncode).trigger('change');
                $('#tender_call_at').val(data[0].tender_call_at);
                $('#tender_open_at').val(data[0].tender_open_at);
                $('#tender_budget').val(data[0].tender_budget);
                $('#tender_budget_source').val(data[0].tender_budget_source).trigger('change');
                $('#tendertitle').val(data[0].tendertitle);
                $('#tender_invitationcode').val(data[0].tender_invitationcode);
                $('#tender_invitation_at').val(data[0].tender_invitation_at);
                $('#tender_validdate').val(data[0].tender_validdate);
                $('#packcount').val(data[0].packcount);
                $('#assessment').val(data[0].assessment);
                $('#tender_state').val(data[0].tender_state).trigger('change');
                $('#assessment_at').val(data[0].assessment_at);
                $('#tender_comment').val(data[0].tender_comment);
                $('#order_id').val(data[0].order_id);
                $('#tender_id').val(data[0].tenderid);
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
                $('#assessment_at').val('');
                $('#tender_comment').val('');
                $('#order_id').val('');
                $('#tender_id').val(0);
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
