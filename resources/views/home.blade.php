@extends('layouts.app')
@section('style')
<style>
</style>
@stop

@section('content')
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Мэдээлэл</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip"
                        title="Remove">
                        <i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
            <div class="row">
                  <div class="col-lg-3 col-6">

                  <div class="small-box bg-info">
                  <div class="inner">
                  @foreach ($count_order as $item )
                  <h3>{{$item->count}}</h3>
                  @endforeach
                  <p>Нийт захиалга</p>
                  </div>
                  <div class="icon">
                  <i class="ion ion-bag"></i>
                  </div>
                
                  </div>
                  </div>

                  <div class="col-lg-3 col-6">

                  <div class="small-box bg-success">
                  <div class="inner">
                  @foreach ($count_tender as $item )
                  <h3>{{$item->count}}</h3>
                  @endforeach
                  <p>Тендер зарласан</p>
                  </div>
                  <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                  </div>
              
                  </div>
                  </div>

                  <div class="col-lg-3 col-6">

                  <div class="small-box bg-warning">
                  <div class="inner">
                  @foreach ($count_contractbegin as $item )
                  <h3>{{$item->count}}</h3>
                  @endforeach
                  <p>Гэрээ байгуулсан </p>
                  </div>
                  <div class="icon">
                  <i class="ion ion-person-add"></i>
                  </div>
                
                  </div>
                  </div>

                  <div class="col-lg-3 col-6">

                  <div class="small-box bg-danger">
                  <div class="inner">
                  @foreach ($count_contract as $item )
                  <h3>{{$item->count}}</h3>
                  @endforeach
                  <p>Дууссан</p>
                  </div>
                  <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                  </div>
     
                  </div>
                  </div>

</div>
       <div class="row">
       <div class="col-md-6">
       <canvas id="myChart" style="width:100%; max-width:800px;"></canvas>
       </div>
       <div class="col-md-6">
       <canvas id="myChart1" style="width:100%;max-width:800px"></canvas>
       </div>
       @if(Auth::user()->jobcode == 1 or Auth::user()->jobcode == 5)
       <div class="col-md-6">
       <canvas id="myChart2" style="width:100%; max-width:800px;"></canvas>
       </div>
       @endif
       </div>
            </div>
        </div>
@stop

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<?php
    $stack = array();
    $stackValue = array();
    $stackValue2 = array();
    $stackname = array();
    $stackValue3 = array();
    $stackValue4 = array();
    foreach($t1 as $item)
    {array_push($stack,$item->executor_abbr); array_push($stackValue,$item->sum_budget);array_push($stackValue2,$item->sum_performance);}
    foreach($t2 as $item)
    {array_push($stackname,$item->name); array_push($stackValue3,$item->countwork);}
?>
<script>
var xValues = ["Italy", "France", "Spain", "USA", "Argentina"];
var yValues = [55, 49, 44, 24, 15];
var barColors = ["#63b598", "#ce7d78", "#ea9e70", "#a48a9e", "#c6e1e8", "#648177" ,"#0d5ac1" ,
                                "#f205e6" ,"#1c0365" ,"#14a9ad" ,"#4ca2f9" ,"#a4e43f" ,"#d298e2" ,"#6119d0",
                                "#d2737d" ,"#c0a43c" ,"#f2510e" ,"#651be6" ,"#79806e" ,"#61da5e" ,"#cd2f00" ,
                                "#9348af" ,"#01ac53" ,"#c5a4fb" ,"#996635","#b11573" ,"#4bb473" ,"#75d89e" ,
                                "#2f3f94" ,"#2f7b99" ,"#da967d" ,"#34891f" ,"#b0d87b" ,"#ca4751" ,"#7e50a8" ,
                                "#c4d647" ,"#e0eeb8" ,"#11dec1" ,"#289812" ,"#566ca0" ,"#ffdbe1" ,"#2f1179" ,
                                "#935b6d" ,"#916988" ,"#513d98" ,"#aead3a", "#9e6d71", "#4b5bdc", "#0cd36d",
                                "#250662", "#cb5bea", "#228916", "#ac3e1b", "#df514a", "#539397", "#880977",
                                "#f697c1", "#ba96ce", "#679c9d", "#c6c42c", "#5d2c52", "#48b41b", "#e1cf3b",
                                "#5be4f0", "#57c4d8", "#a4d17a", "#225b8", "#be608b", "#96b00c", "#088baf",
                                "#f158bf", "#e145ba", "#ee91e3", "#05d371", "#5426e0", "#4834d0", "#802234",
                                "#6749e8", "#0971f0", "#8fb413", "#b2b4f0", "#c3c89d", "#c9a941", "#41d158",
                                "#fb21a3", "#51aed9", "#5bb32d", "#807fb", "#21538e", "#89d534", "#d36647",
                                "#7fb411", "#0023b8", "#3b8c2a", "#986b53", "#f50422", "#983f7a", "#ea24a3",
                                "#79352c", "#521250", "#c79ed2", "#d6dd92", "#e33e52", "#b2be57", "#fa06ec"];
var barColors2 = [ "#935b6d" ,"#916988" ,"#513d98" ,"#aead3a", "#9e6d71", "#4b5bdc", "#0cd36d",
                                "#250662", "#cb5bea", "#228916", "#ac3e1b", "#df514a", "#539397", "#880977",
                                "#f697c1", "#ba96ce", "#679c9d", "#c6c42c", "#5d2c52", "#48b41b", "#e1cf3b",
                                "#5be4f0", "#57c4d8", "#a4d17a", "#225b8", "#be608b", "#96b00c", "#088baf",
                                "#f158bf", "#e145ba", "#ee91e3", "#05d371", "#5426e0", "#4834d0", "#802234",
                                "#6749e8", "#0971f0", "#8fb413", "#b2b4f0", "#c3c89d", "#c9a941", "#41d158",
                                "#fb21a3", "#51aed9", "#5bb32d", "#807fb", "#21538e", "#89d534", "#d36647",
                                "#7fb411", "#0023b8", "#3b8c2a", "#986b53", "#f50422", "#983f7a", "#ea24a3",
                                "#79352c", "#521250", "#c79ed2", "#d6dd92", "#e33e52", "#b2be57", "#fa06ec"];
var sname = <?php echo json_encode($stack); ?>;
var cn1 = <?php echo json_encode($stackValue); ?>;
var cn2 = <?php echo json_encode($stackValue2); ?>;
var cname = <?php echo json_encode($stackname); ?>;
var cn3 = <?php echo json_encode($stackValue3); ?>;
new Chart("myChart", {
  type: "bar",
  data: {
    labels: sname,
    datasets: [{
      backgroundColor: barColors,
      data: cn1
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "Гэрээний гүйцэтгэл"
    }
  }
});
new Chart("myChart2", {
  type: "bar",
  data: {
    labels: cname,
    datasets: [{
      backgroundColor: barColors2,
      data: cn3
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "Ажлын гүйцэтгэл",
      ticks: {
                beginAtZero: true   // minimum value will be 0.
            }
    },
    scales: {
        yAxes: [{
            display: true,
            stacked: true,
            ticks: {
                min: 0, // minimum value
               
            }
        }]
    }
    
  },

});
</script>
<script>
var xValues = [100,200,300,400,500,600,700,800,900,1000];

new Chart("myChart1", {
  type: "line",
  data: {
    labels: sname,
    datasets: [{ 
      data: cn1,
      borderColor: "red",
      fill: false
    }, { 
      data: cn2,
      borderColor: "green",
      fill: false
    }]
  },
  options: {
    legend: {display: false}
  }
});

</script>
<script>
var xyValues = [
  {x:50, y:7},
  {x:60, y:8},
  {x:70, y:8},
  {x:80, y:9},
  {x:90, y:9},
  {x:100, y:9},
  {x:110, y:10},
  {x:120, y:11},
  {x:130, y:14},
  {x:140, y:14},
  {x:150, y:15}
];

</script>
<script>
var xValues = [50,60,70,80,90,100,110,120,130,140,150];
var yValues = [7,8,8,9,9,9,10,11,14,14,15];

new Chart("myChart3", {
  type: "line",
  data: {
    labels: xValues,
    datasets: [{
      fill: false,
      lineTension: 0,
      backgroundColor: "rgba(0,0,255,1.0)",
      borderColor: "rgba(0,0,255,0.1)",
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    scales: {
      yAxes: [{ticks: {min: 6, max:16}}],
    }
  }
});
</script>
</script>
@stop
