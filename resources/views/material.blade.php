@extends('layouts.app')
@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
    <style>
        .btn-circle {
            width: 30px;
            height: 30px;
            padding: 6px 0px;
            border-radius: 15px;
            text-align: center;
            font-size: 12px;
            line-height: 1.42857;
        }

        .card {
            height: 100%;
        }

    </style>
@stop

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div id="jstree" style="font-size:12px;">
                        <ul>
                            <?php $firstHID=''; ?>
                            @foreach ($datas as $parent)
                                <li><span>{{ $parent->typename }}</span>
                                    @if (count($parent->childs) > 0)
                                        <ul>
                                            @foreach ($parent->childs as $child)
                                                <li id="child_node_{{ $child->typeid }}">
                                                    <span>{{ $child->typename }}</span>
                                                    @if (count($child->files) > 0)
                                                        <ul>
                                                            @foreach ($child->files as $file)
                                                                <?php if($firstHID=='') $firstHID=$file->trid; ?>
                                                                @if ($file->traininggroup == 1)
                                                                    <li
                                                                        data-jstree='{"icon":"{{ asset('/img/pdf.png') }}"}'>
                                                                    @else
                                                                    <li
                                                                        data-jstree='{"icon":"{{ asset('/img/video.png') }}"}'>
                                                                @endif
                                                                <span onclick="getfile('{{ $file->trid }}')">
                                                                    {{ $file->trainingname }} </span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                        @endif
                        </li>
                        @endforeach
                        </ul>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="card-tools">
                   
                        <button type="button" class="btn btn-primary btn-circle" data-toggle="modal"
                            data-target="#materialModal" style="float: right; margin-left:15px"><i class="fa fa-plus"></i></button>
                            <button type="button" class="btn btn-warning btn-circle" data-toggle="modal"
                            data-target="#materialModal" style="float: right;"><i class="fa fa-pen"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    {{-- <a id="myLink" href="{{ asset('info/tzt.pdf') }}" target="_blank">Файл татах</a><br> --}}
                  
                    <iframe   @if($firstHID) src="{{ route('show-training-file', [$firstHID]) }}"   @endif id="fileviewer" height="600px" width="100%"></iframe>
             
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="materialModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Сургалтын материал нэмэх</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="POST" action={{ route('addTrainingFile') }} enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="row">
                                    @csrf
                                    <div class="col-12">
                            <div class="form-group">
                                 <label>Байгууллага</label>
                                <select class="form-control" name="depid" id="depid" >                            
                                @foreach ($dep as $item)
                                                    <option value= "{{$item->depid}}" > @if($item->department_par > 0){{$item->p_abbr}} - {{$item->department_abbr}}
                                                        @else {{$item->department_abbr}}@endif</option>
                                             
                                    @endforeach
                            </select>
                            </div>
                        </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                             <label>Төрөл</label>
                                            <select class="form-control" name="group" id="group">
                                                @foreach ($datas as $parent)
                                                    <option value="{{ $parent->typeid }}">{{ $parent->typename }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="lname">Сэдэв</label>
                                            <select class="form-control" name="sgroup" id="sgroup">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="fname">Нэр</label>
                                            <input type="text" class="form-control" id="title" name="title"
                                                placeholder="Нэр">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="exampleInputFile">Файл</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="file" name="file">
                                                    <label class="custom-file-label" for="exampleInputFile">Choose
                                                        file</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1">Тэмдэглэл</label>
                                            <textarea class="form-control" id="note" name="note" rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                            <input type="hidden"  id="hid" name="hid">
                            <input type="hidden"  id="flg" name="flg">
                            @csrf
                                <button type="button" class="btn btn-danger" onclick="delmat('')">Устгах</button>
                                <button type="submit" class="btn btn-primary">Хадгалах</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>
    <script>
        $(function() {
            $('[data-widget="treeview"]').Treeview('init');
            $('ul').Treeview();
            $("#group").trigger('change');
            // 6 create an instance when the DOM is ready
            $('#jstree').jstree({
                "core": {
                    "themes": {
                        "variant": "middle"
                    }
                },
                "plugins": ["wholerow"]
            });
            // 7 bind to events triggered on the tree
            $('#jstree').on("changed.jstree", function(e, data) {});
        });

        $("#group").on('change', function() {
            var itag = $(this).val();
            $('#sgroup').empty();
            $.get('getsgroup/' + itag, function(data) {
                $.each(data, function(i, qwe) {
                    $('#sgroup').append($('<option>', {
                        value: qwe.typeid,
                        text: qwe.typename
                    }));
                });
            });

        });

        function getfile(hid) {
            console.log(hid);
            $('#fileviewer').attr('src','{{ route("show-training-file") }}/'+hid);
            editfile(hid);
        }
        function editfile(hid){
        if(hid){
            $.get('getmaterial/' + hid, function (data) {
                $('#depid').val(data[0].depid);
                $('#group').val(data[0].traininggroup);
                $('#sgroup').val(data[0].trainingsgroup);
                $('#title').val(data[0].trainingname);
                $('#note').val(data[0].note);
                $('#hid').val(data[0].trid);
                $('#flg').val(1);
                document.getElementById("exampleModalLabel").innerHTML="Сургалтын материал засварлах";
            });
        } else {
            $('#title').val('');
                $('#note').val('');
                $('#hid').val(0);
                $('#flg').val(0);
                document.getElementById("exampleModalLabel").innerHTML="Сургалтын материал нэмэх";
        }
    }
    function delmat(hid){
        if(confirm('Энэ файлыг устгах уу?'))
        {
           $.get('{{ route("delmat") }}/'+hid , function (data) 
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
