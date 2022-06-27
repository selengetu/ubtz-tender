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
                <h3 class="card-title">Байгуулагын мэдээлэл</h3>
                <div class="card-tools">
                
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="myTable">
                        <thead >
                            <th>#</th>
                            <th>Харьяа байгууллага</th>
                            <th>Байгууллагын нэр</th>
                            <th>Товч нэр</th>
                          
                        </thead>
                        <tbody id="tbody">
                        <?php $no = 1; ?>
                        @foreach ($dep as $item )
                        <tr>
                            <td>{{$no}}</td>
                            <td>{{$item->executor_abbr}}</td>
                            <td>{{$item->executor_name}}</td>
                            <td>{{$item->department_abbr}}</td>
                        
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
    function depEdit(hid){
        if(hid){
            $.get('getDep/' + hid, function (data) {
                $('#p_abbr').val(data[0].department_par).trigger('change');
                $('#department_name').val(data[0].department_name);
                $('#department_abbr').val(data[0].department_abbr);
                $('#balance_code').val(data[0].balance_code);
                $('#hid').val(data[0].depid);
                $('#flg').val(1);
                document.getElementById("exampleModalLabel").innerHTML="Байгуулагын мэдээллийг засварлах";
            });
        } else {
             $('#p_abbr').val(0);
                $('#department_name').val('');
                $('#department_abbr').val('');
                $('#balance_code').val('');
                $('#hid').val(0);
                $('#flg').val(0);
                document.getElementById("exampleModalLabel").innerHTML="Шинээр байгуулга нэмэх";
        }
    }


    function depDel(hid,dname){
        if(confirm(dname+' нэртэй байгуулагыг устгах уу?'))
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
