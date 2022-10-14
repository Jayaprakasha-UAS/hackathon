

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {
  box-sizing: border-box;
}

/* Create two equal columns that floats next to each other */
.column1 {
  float: left;
  width: 30%;
  padding: 10px;
  height: auto; /* Should be removed. Only for demonstration */
}

/* Create two equal columns that floats next to each other */
.column2 {
  float: right;
  width: 70%;
  padding: 10px;
  height: auto; /* Should be removed. Only for demonstration */
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

table, th, td {
  border: 1px solid;
}

table {
  width: 100%;
}

</style>
</head>
<body>

<div class="row">
  <div class="column1" style="background-color:#ccc;">
  	<p><table><tr><td><h2>Release Notes</h2></td></tr></table></p>
  	 <p><table><tr><td><h2>Charts</h2></td></tr></table></p>
    
    <p>Some text..</p>
  </div>
  <div class="column2" style="background-color:#ddd;">
    <p><table><tr><td><h2>FIlters</h2></td></tr></table></p>
    <p><table class="table">
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
</table></p>
  </div>
</div>

</body>
</html>