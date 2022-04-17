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
<div id="editor"></div>
<button type='button' class="btn btn-default pull-right" onclick="printDiv('printableArea')"><i class="glyphicon glyphicon-print" ></i> ХЭВЛЭХ</button>
    <div class="col-md-12">
        <div class="card" style="font-size:12px;">
         
            <div class="card-header">
            
            </div>
                <div class="table-responsive"  id="acontent">
                    <h4><center><strong>Давхар хандалт цуцлах</strong></center></h4><br>
                    <table class="table table-bordered table-striped" id="myTable">
                        <thead >
                            <th>Д/д</th>    
                            <th>Email</th>                        
                            <th>Нэр</th>
                            <th></th>
                        </thead>
                        <tbody id="tbody">
                        <?php $no = 1; ?>
                         @foreach ($user as $item )
                        <tr>
                            <td>{{$no}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->name}}</td>
                            <td>  <button class='btn btn-primary'><i class='fa fa-pen'></i></button></td>
                         
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