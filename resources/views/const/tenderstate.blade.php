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
        <div class="card" style="font-size:12px;">
            <div class="card-header">
                <h3 class="card-title">Тендерийн явц</h3>
                <div class="card-tools">
 
                    <button class="btn btn-primary btn-small right" onclick="jobEdit()" data-toggle="modal" data-target="#jobModal"><i class="fa fa-plus"></i> Мэдээлэл нэмэх</button>
  
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <th>#</th>
                            <th>Явцын нэр</th>
                            <th></th>
                        </thead>
                        <tbody id="tbody">
                        <?php $no = 1; ?>
                        @foreach ($state as $item )
                        <tr>
                            <td>{{$no}}</td>
                            <td>{{$item->state_name}}</td>
                            <td></td>

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
        <div class="modal fade" id="jobModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Тендерийн явц нэмэх</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" id="formSub" action={{ route('saveTenderState') }}>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                 <label>Тендерийн явц</label>
                                <input type="text" class="form-control" id="state_name" name="state_name" placeholder="Тендерийн явц">
                            </div>
                        </div>
                      
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden"  id="state_id" name="state_id">
                    @csrf
                    <button type="submit" class="btn btn-primary">Хадгалах</button>
                </div>
                </form>
            </div>
        </div>
        </div>
@stop

@section('script')

<script>
  
    function jobEdit(hid){
        if(hid){
            $.get('getTenderstates/' + hid, function (data) {
                $('#state_name').val(data[0].state_name);
                $('#state_id').val(data[0].state_id);
            });
        } else {
            $('#state_name').val('');
            $('#state_id').val('');
        }
    }

</script>
@stop
