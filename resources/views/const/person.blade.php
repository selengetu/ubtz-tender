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
        <div class="card" style="font-size:14px;">
            <div class="card-header">
                <h3 class="card-title">Хэрэглэгчийн мэдэээлэл</h3>
                <div class="card-tools">
                    <button class="btn btn-primary btn-small" id="btnper" onclick="perEdit()" data-toggle="modal" data-target="#personModal"><i class="fa fa-plus"></i> Хэрэглэгч нэмэх</button>

                </div>
            </div>
            <div class="card-body">
                @if(Session::get('message'))
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-ban"></i> Анхаар!</h5>
                        {{  Session::get('message') }}
                    </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <th>#</th>
                            <th>Албан тушаал</th>
                            <th>Овог</th>
                            <th>Нэр</th>
                            <th>Цахим шуудан</th>
                            <th>Утас</th>
                            <th></th>
                        </thead>
                        <tbody id="tbody">
                        <?php $no = 1; ?>
                        @foreach ($user as $item )
                        <tr>
                        <td>{{$no}}</td>
                        <td>{{$item->jobname}}</td>
                        <td>{{$item->last_name}}</td>
                        <td>{{$item->first_name}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->phone}}</td>
                 
                        <td>  
                        <button class='btn btn-primary btn-xs' onclick="perEdit('{{$item->id}}')" data-toggle='modal' data-target='#personModal' title='Засах'><i class='fa fa-edit'></i></button>
                        <button class='btn btn-primary btn-xs' onclick="perDel('{{$item->id}}','{{$item->first_name}}')" data-toggle='modal' title='Устгах'><i class='fa fa-trash-alt'></i></button>  </td>
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
        <div class="modal fade" id="personModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Хэрэглэгч нэмэх</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" id="formSub" action={{ route('savePerson') }} enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                    @csrf
                    <div class="col-4">
                            <div class="form-group">
                                <label for="fname">Овог</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Овог">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="fname">Нэр</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Нэр">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Албан тушаал</label>
                                <select class="form-control" name="jobid" id="jobid">
                                        @foreach ($jobs as $item)
                                            <option value="{{ $item->jobcode }}">{{ $item->jobname }}</option>
                                        @endforeach
                                </select>
                            @csrf
                            </div>
                            
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="phonenumber">Цахим хаяг</label>
                                <input type="text" class="form-control" name="email" id="email" placeholder="Цахим хаяг">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="phonenumber">Утас</label>
                                <input type="number" class="form-control" name="phone" id="phone" placeholder="Утас">
                            </div>
                        </div>   
                        <div class="col-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">идэвхтэй эсэх</label>
                                <select class="form-control" name="is_active" id="is_active">          
                                            <option value="1">Тийм</option> 
                                            <option value="0">Үгүй</option>
                                </select>
                            @csrf
                            </div>
                            
                        </div>     
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden"  id="hid" name="hid">
       
                    <button type="submit" class="btn btn-primary">Хадгалах</button>
                </div>
                </form>
            </div>
        </div>
        </div>
@stop

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>

<script>
  
    function perEdit(hid){
        if(hid){
            $.get('getPerson/' + hid, function (data) {
                $('#last_name').val(data[0].last_name);
                $('#first_name').val(data[0].first_name);
                $('#phone').val(data[0].phone);
                $('#jobid').val(data[0].jobid).trigger('change');
                $('#email').val(data[0].email);
                $('#hid').val(data[0].id);
            });
        } else {

                $('#lname').val('');
                $('#fname').val('');
                $('#phonenumber').val('');
                $('#workname').val('');
                $('#jobid').val('1');
                $('#mailadd').val('');
                $('#hid').val('');
        }
    }

      function perDel(hid){
        if(confirm('Энэ хэрэглэгчийг устгах уу?'))
        {
           $.get('perDel/'+hid , function (data)
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
