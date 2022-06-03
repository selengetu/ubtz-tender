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
                            <th>Алба салбар нэгж</th>
                            <th>Цех , тасаг</th>
                            <th>Албан тушаал</th>
                            <th>Овог нэр</th>
                            <th>Хэрэглэгчийн эрх</th>
                            <th>Цахим шуудан</th>
                            <th>Утас</th>
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
        <!-- Modal -->
        <div class="modal fade" id="personModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
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
                     
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Албан тушаал</label>
                                <select class="form-control" name="jobcode" id="jobcode">
                                        @foreach ($jobs as $item)
                                            <option value="{{ $item->jobcode }}">{{ $item->jobname }}</option>
                                        @endforeach
                                </select>
                            @csrf
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="phonenumber">Утас</label>
                                <input type="number" class="form-control" name="phonenumber" id="phonenumber" placeholder="Утас">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="lname">Овог</label>
                                <input type="text" class="form-control" id="lname" name="lname" placeholder="Овог">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="fname">Нэр</label>
                                <input type="text" class="form-control" id="fname" name="fname" placeholder="Нэр">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="phonenumber">Цахим хаяг</label>
                                <input type="text" class="form-control" name="mailadd" id="mailadd" placeholder="Цахим хаяг">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputFile">Хэрэглэгч зураг</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="file" name="file">

                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                      
                    </div>

                </div>
                <div class="modal-footer">
                    <input type="hidden"  id="hid" name="hid">
                    <input type="hidden"  id="flg" name="flg">
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
                $('#lname').val(data[0].lname);
                $('#fname').val(data[0].fname);
                $('#phonenumber').val(data[0].phonenumber);
                $('#workname').val(data[0].workname);
                $('#jobcode').val(data[0].jobcode);
                $('#jobname').val(data[0].jobabbr);
                $('#jobname_abbr').val(data[0].jobabbr_s);
                $('#mailadd').val(data[0].mailadd);
                $('#hid').val(data[0].hid);
                $('#flg').val(1);
            });
        } else {

                $('#lname').val('');
                $('#fname').val('');
                $('#phonenumber').val('');
                $('#workname').val('');
                $('#jobcode').val(228);
                $('#jobname').val('');
                $('#jobname_abbr').val('');
                $('#mailadd').val('');
                $('#hid').val(0);
                $('#flg').val(0);
        }
    }
    $( "#formSub" ).submit(function( event ) {
        event.preventDefault();
        var form = $(this);
        var url = form.attr('action');
        $.ajax({
               type: "POST",
               url: url,
               data: form.serialize(), // serializes the form's elements.
               success: function(data)
               {
                   if(data==1){
                    let depid=localStorage.getItem('perDep')
                    changeDep(depid);
                   } else {
                       alert(data);
                   }
                   $("#personModal").modal("hide");
               }
             });
      });
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
