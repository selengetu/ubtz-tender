@extends('layouts.app')
@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
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
<div class="card">
            <div class="card-header">
            <h5 class="card-title"><b> Мэдээ мэдээлэл</b></h5>
                <div class="card-tools">
                    <button type="button" class="btn btn-primary btn-sm"
                        title="Collapse" data-toggle="modal" data-target="#infoModal">
                        <i class="fas fa-plus"></i></button>
                  
                </div>
            </div>
          
        </div>
        </div>
    @foreach ($info as $item )

       <div class="col-md-3">
       <div class="card" style="height: 250px;">
  <div class="card-header">
    <b>{{$item->infotitle}}</b>
    <div class="card-tools">
                    <button class="btn btn-primary btn-xs right"  onclick=infoEdit('{{$item->infoid}}') data-toggle="modal" data-target="#infoModal"><i class="fa fa-pen"></i></button>
                </div>
  </div>
  <div class="card-body">
  @if (mb_strlen($item->infonews) > 250)
                                                                {{ mb_substr($item->infonews, 0, 250) }}...<a href=""
                                                                data-toggle="modal" data-target="#detailModal"  onclick=detail('{{$item->infoid}}')
                                                                    class="btn-sm-link">Цааш
                                                                    унших</a>
                                                            @else
                                                            {{$item->infonews}}
                                                            @endif
    
  </div>
  <div class="card-footer text-muted">
  {{ $item->department_abbr}} -{{ $item->name}} {{ $item->createdate}}
  </div>
</div>
       </div>
       @endforeach
  
</div>
        <!-- Modal -->
        <div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Мэдээ мэдээлэл нэмэх</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" id="formSub" action={{ route('addInfo') }}>
                <div class="modal-body">
                    <div class="row">
                    <div class="col-12">
                            <div class="form-group">
                                <label for="jobname">Мэдээний төрөл</label>
                                <select class="form-control" name="infotype" id="infotype">                                 
                                        <option value="1">Шинэ мэдээ</option>
                                        <option value="2">Албан хэрэгцээнд</option>
                            </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="jobname">Мэдээний гарчиг</label>
                                <input type="text" class="form-control" id="infotitle" name="infotitle" maxlength="100">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="jobname">Мэдээний агуулга</label>
                                <textarea class="form-control" id="infonews" name="infonews" rows="10" maxlength="1000"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden"  id="hid" name="hid">
                    <input type="hidden"  id="flg" name="flg">
                    @csrf
                    <button type="button" class="btn btn-danger" onclick="removeInfo('{{$item->infoid}}')">Устгах</button>
                    <button type="submit" class="btn btn-primary">Хадгалах</button>
                </div>
                </form>
            </div>
        </div>
        </div>
        <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Мэдээ мэдээлэл</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
              
                <div class="modal-body">
                    <div class="row">
                
                        <div class="col-12">
                            <div class="form-group">
                               <span id="detailnews"></span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                              
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" onclick="removeInfo('{{$item->infoid}}')">Устгах</button>
                    <button type="submit" class="btn btn-primary">Хадгалах</button>
                </div>
               
            </div>
        </div>
        </div>
@stop

@section('script')

<script>

    function infoEdit(hid){
        if(hid){
            $.get('getInfo/' + hid, function (data) {
                $('#infotitle').val(data[0].infotitle);
                $('#infonews').val(data[0].infonews);
                $('#infotype').val(data[0].infotype);
                $('#hid').val(data[0].hid);
                $('#id').val(data[0].infoid);
                $('#flg').val(1);
            });
        } else {
                $('#infotitle').val('');
                $('#infonews').val('');
                $('#infotype').val(1);
                $('#hid').val(0);
                $('#flg').val(0);
        }
    }
    function detail(hid){
        if(hid){
            $.get('getInfo/' + hid, function (data) {
                $('#detailnews').text(data[0].infonews);
            });
        } else {
                $('#detailnews').text('');
        }
    }
    function removeInfo(hid){
        if(confirm('Энэ мэдээллийг устгах уу?'))
        {
           $.get('{{ route("removeInfo") }}/'+hid , function (data) 
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
