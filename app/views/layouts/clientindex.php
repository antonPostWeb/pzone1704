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
<a class="navbar-brand" href="<?php echo URL::to('client')?>">Главная</a>

<ul class="nav navbar-nav">
<li ><a href="<?php echo URL::to('client').'/messages' ?>">Обратная связь</a></li>
<li><a href="<?php echo URL::to('client').'/newrequire' ?>">Новая заявка</a></li>
<li><a href="<?php echo URL::to('client').'/forum' ?>">Форум</a></li>
<li><a href="<?php echo URL::to('auth').'/logout' ?>">Выход</a></li>


</ul>
</li>
</ul>

</div> 
</div>
</div>
</div>


<div style="margin-left:15%;margin-top:10%;height:20%;width:70%;" id = 'requires'>
<h2 style="text-align:center;">Заявки</h2>
<br>
<table id="table">
<thead>
<tr><th >Дата</th><th >Название</th><th > Статус</th><th >Готовность</th></tr>
</thead>
<tbody>
<?php 
$client_id = Auth::user()->id;
foreach (Req::where('client_id','=', $client_id)->get() as $item){

echo '<tr><td >'.date("j M ", strtotime($item->created_at)).'</td><td ><a href = "'.  URL::to('client').'/req/'. $item->id   .'">'.$item->name.'</a></td><td  >'.$item->status .'</td><td  >' .$item->percents .'</td>';

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
