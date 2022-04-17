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
    }/
   
   
    </style>

@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card" style="font-size:12px;">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-3"> 
                        <h4>Сэдвийн талаарх мэдээлэл   </h4>
                    </div>
                  
              
                <div class="offset-md-5 col-md-2" >
                @if(Auth::user()->userlevel==2 ) 
                    <select class="form-control mb-3" id="type" name="type"  onchange="javascript:location.href = 'filter_type/'+this.value;">
                      <option value="0" @if($type == 0) selected @endif>Нийтийн</option>
                      <option value="1" @if($type == 1) selected @endif>Албаны</option>
                    </select>
                    @endif
                </div>
                
                 
                <div class="col-md-2">
                 
                        @if((Auth::user()->userlevel<>4)&&(Auth::user()->userlevel<>4) ) 
                    <button class="btn btn-primary btn-small right"  onclick="topicEdit()" data-toggle="modal" data-target="#topicModal"><i class="fa fa-plus"></i> Сэдэв нэмэх</button>
                    @endif
                </div>
            </div>
            </div>
            
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="myTable">
                        <thead >
                            <th>#</th>
                            <th>Сэдвийн нэр</th>
                            <th>Ангилал</th>
                            <th>Алба, ААН-ийн нэр</th>
                            <th>Асуултын тоо</th>
                            <th>Нэмэлт тэмдэглэл</th>
                            <th>Бүртгэсэн</th>
                            @if((Auth::user()->userlevel<>4) )  <th>Үйлдэл</th>  @endif  
                        </thead>
                        <tbody id="tbody">
                        <?php $no = 1; ?>
                        @foreach ($topic as $item )
                        <tr>
                        <td>{{$no}}</td>
                        <td>{{$item->topictitle}}</td>
                        <td>{{$item->groupname}}</td>
                        <td>{{$item->depname}}</td>
                        <td>{{$item->totalquestion}}</td>
                        <td>{{$item->notes}}</td>
                        <td>{{$item->usrname}}</td>
                      @if((Auth::user()->userlevel<>4) )
                        <td>  
                        @if($item->depid == 0 )
                        <button class='btn btn-primary btn-xs' onclick=confirmFunction(); data-toggle='modal' data-target='#transferModal' title='Өөрийн болгон хуулах'><i class='fa fa-clone'></i></button>
                     @else

                        <button class='btn btn-primary btn-xs' onclick=topicEdit('{{$item->hid}}') data-toggle='modal' data-target='#topicModal' title='Засах'><i class='fa fa-edit'></i></button>
                        <button class='btn btn-primary btn-xs' onclick="tpcDel('{{$item->hid}}','{{$item->topictitle}}','{{$item->depname}}')" data-toggle='modal' title='Устгах'><i class='fa fa-trash-alt'></i></button>
                        @endif
                        </td>
                         @endif
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
        <!-- Modal -->
        <div class="modal fade" id="topicModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" id="formSub" action={{ route('saveTopic') }}>
                <div class="modal-body">
                    <div class="row">
                    <div class="col-12">
                            <div class="form-group">
                                <label for="jobname">Сэдвийн нэр</label>
                                <input type="text" class="form-control" id="topic_title" name="topic_title" placeholder="Сэдвийн нэр">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="jobname">Алба, ААН-ийн нэр</label>
                                <select class="form-control" name="dep_id" id="dep_id" >
                                @foreach ($dep as $item)
                                        <option value="{{ $item->hid }}">{{ $item->department_name }}  ( {{ $item->department_abbr }}) </option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="jobname">Сэдвийн ангилал</label>
                                <select class="form-control" name="top_grp_id" id="top_grp_id" >
                                @foreach ($t_grp as $item)
                                        <option value="{{ $item->hid }}">{{ $item->topicgroupname }}  </option>
                                @endforeach
                            </select>
                            </div>
                        </div>                        
                        <div class="col-12">
                            <div class="form-group">
                                <label for="lbl_ttl_qstn">Нийт асуултын тоо</label>
                                <input type="text" class="form-control" id="q_count" name="q_count" placeholder="Асуултын тоо">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="lbl_add_nts">Нэмэлт тэмдэглэл</label>
                                <input type="text" class="form-control" id="notes" name="notes" placeholder="Нэмэлт тэмдэглэл">
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
         <div class="modal fade" id="topicModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" id="formSub" action={{ route('saveTopic') }}>
                <div class="modal-body">
                    <div class="row">
                    <div class="col-12">
                            <div class="form-group">
                                <label for="jobname">Сэдвийн нэр</label>
                                <input type="text" class="form-control" id="topic_title" name="topic_title" placeholder="Сэдвийн нэр">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="jobname">Алба, ААН-ийн нэр</label>
                                <select class="form-control" name="dep_id" id="dep_id" >
                                @foreach ($dep as $item)
                                        <option value="{{ $item->hid }}">{{ $item->department_name }}  ( {{ $item->department_abbr }}) </option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="jobname">Сэдвийн ангилал</label>
                                <select class="form-control" name="top_grp_id" id="top_grp_id" >
                                @foreach ($t_grp as $item)
                                        <option value="{{ $item->hid }}">{{ $item->topicgroupname }}  </option>
                                @endforeach
                            </select>
                            </div>
                        </div>                        
                        <div class="col-12">
                            <div class="form-group">
                                <label for="lbl_ttl_qstn">Нийт асуултын тоо</label>
                                <input type="text" class="form-control" id="q_count" name="q_count" placeholder="Асуултын тоо">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="lbl_add_nts">Нэмэлт тэмдэглэл</label>
                                <input type="text" class="form-control" id="notes" name="notes" placeholder="Нэмэлт тэмдэглэл">
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
@stop

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
    function topicEdit(hid){
        
        if(hid){
            $.get('getTopic/' + hid, function (data) {
                $('#topic_title').val(data[0].topictitle);
                $('#dep_id').val(data[0].depid);
                $('#top_grp_id').val(data[0].topicgroupid);
                $('#q_count').val(data[0].totalquestion);
                $('#notes').val(data[0].notes);   //
                $('#hid').val(data[0].hid);
                $('#flg').val(1);
                document.getElementById("exampleModalLabel").innerHTML="Сэдэв засварлах";
            });
        } else {
             $('#topic_title').val('');
                $('#dep_id').val('');
                $('#top_grp_id').val('');
                $('#notes').val('');
                $('#q_count').val(0);
                $('#hid').val(0);
                $('#flg').val(0);
                document.getElementById("exampleModalLabel").innerHTML="Сэдэв нэмэх";
        }
    }

    function tpcDel(hid,ttl,dpn){
        if(confirm(dpn+'-ийн '+ttl+' сэдвийг устгах уу?'))
        {
           $.get('{{ route("delTopic") }}/'+hid , function (data) 
            {
                if(data==1)
                {
                    location.reload();
                }
            }); 
        }

    }
function confirmFunction() {
    if (confirm("Та энэ сэдвийг хуулах уу") == true) {
    
    } else {
     
    }
}

</script>
@stop
