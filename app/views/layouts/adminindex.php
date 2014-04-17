<!-- 
Пока используем только admin/allclients and admin/allmanagers 


<!DOCTYPE HTML>
<html>
<head>
<link rel="stylesheet" href="/css/bootstrap.css" type="text/css" />
<link rel="stylesheet" href="/css/jquery.dataTables.css" type="text/css" />
<script src = "/js/jquery-2.1.0.min.js"> </script>
<script src = "/js/jquery.dataTables.min.js"> </script>
<script src = "/js/bootstrap.min.js"> </script>

<style>
td,th {
width:25%;
text-align:left;
!important
}
.dataTables_filter {
display: none; 
}
select[name="table_length"]{
display: none; 
}
</style>

</head>
<body>
<div class="navbar navbar-inverse navbar-fixed-top">
<div class="navbar-inner">
<div class="container">
<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</a>
<a class="brand" href="<?php echo URL::to('admin')?>">Главная</a>
<a class="brand" href="<?php echo URL::to('admin')?>">Главная</a>
<div class="nav-collapse collapse">
<ul class="nav">
<li ><a href="<?php echo URL::to('admin').'/allclients' ?>">Клиенты</a></li>
<li><a href="<?php echo URL::to('admin').'/allmanagers' ?>">Менеджеры</a></li>

</ul>
</li>
</ul>

</div> 
</div>
</div>
</div>


<div style="margin-left:15%;margin-top:10%;height:20%;width:70%;" id = 'requires'>
<h2 style="text-align:center;">Клиенты</h2>
<br>
<table id="table">
<thead>
<tr>
<th >Дата</th>
<th >Название</th>
<th >Автор(id)</th>
<th > Статус</th>
<th >Готовность</th></tr>
</thead>
<tbody>
<?php 
$manager_id = Auth::user()->id;
foreach (Req::where('manager_id','=',$manager_id)->get() as $item){

echo '<tr><td >'.date("j M ", strtotime($item->created_at)).'</td>';
echo '<td><a href = "'.  URL::to('manager').'/req/'. $item->id   .'">'.$item->name.'</a></td>';
echo '<td>'.$item->client_id .'</td>';
echo '<td>'.$item->status .'</td>';
echo '<td>' .$item->percents .'</td>';

}
?>
</tbody>
</table>

<script >

$(document).ready(function() {
$('#table').dataTable();
} );
</script>
</div>
</body>


