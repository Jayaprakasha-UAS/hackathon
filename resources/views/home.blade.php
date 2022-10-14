

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


</head>
<body>

	<div class="container " style="margin-top:30px;">

	  <div class="row mb-3">      
      <div class="col-md-4 themed-grid-col">
      	
<!-- Image and text -->
<nav class="navbar navbar-light bg-light">

    <img src="{{url('logo.jpg')}}" width="30" height="30" class="d-inline-block align-top" alt="">
    <h1>Release Notes</h1>
    Current Version: {{$currentversion}}
 
</nav>

<div id="piechart3d" style="width: 400px; height: 400px;"></div>

      </div>
      <div class="col-md-8 themed-grid-col">
      	
<table id="sortTable" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Ticket ID</th>
      <th scope="col">Category</th>
      <th scope="col">Version Number</th>
      <th scope="col">Release Date</th>
      <th scope="col">Release Note</th>
      <th scope="col">Lables/Categories</th>
    </tr>
  </thead>
  <tbody>
  	<?php 
foreach($issues as $item){ ?>
	 <tr>
      <td>{{$item->id}}</td>
      <td>{{$item->key}}</td>
      <td>{{$item->type_name}}</td>
      <td>{{$item->fix_versions}}</td>
      <td>{{$item->release_date}}</td>
      <td>{{$item->release_notes}}</td>
      <td></td>
    </tr>

   
<?php } ?>
</tbody>
</table>

      </div>
    </div>

</div>



</body>
<script>
$('#sortTable').DataTable();


$(document).ready(function(){

google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {

var data = google.visualization.arrayToDataTable([
['Task', 'Release Notes'],
['New Feature', 10],
['Defect', 50],
['Improvement', 40],


]);

var options = {
title: 'Release Notes',
pieSliceText: 'value',
is3D:true
};
var chart = new google.visualization.PieChart(document.getElementById('piechart3d'));

chart.draw(data, options);
}


});
</script>

</html>

