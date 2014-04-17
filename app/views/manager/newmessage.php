<!DOCTYPE HTML>
<html>
<head>
<link rel="stylesheet" href="/css/bootstrap.css" type="text/css" />
<link rel="stylesheet" href="/css/chosen.css" type="text/css" />
<link rel="stylesheet" href="/css/jquery.dataTables.css" type="text/css" />
<script src = "/js/jquery-2.1.0.min.js"> </script>
<script src = "/js/jquery.dataTables.min.js"> </script>
</head>
<style>
select[name="table_length"]{
display: none; 
}
</style>
<body>
<div class="navbar navbar-inverse navbar-fixed-top">
<div class="navbar-inner">
<div class="container">
<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</a>
<a class="brand" href="<?php echo URL::to('manager')?>">Главная</a>
<div class="nav-collapse collapse">
<ul class="nav">
<li ><a href="<?php echo URL::to('manager').'/messages' ?>">Обратная связь</a></li>
<li><a href="<?php echo URL::to('auth').'/logout' ?>">Выход</a></li>

</ul>
</li>
</ul>

</div> 
</div>
</div>
</div>
<table id="table">
<thead>
<tr>
<th>Дата</th>
<th>Заявка</th>
<th>Текст</th>
<th>Автор</th>
</tr>
</thead>
<tbody>

<?php
$manager_id = Auth::user()->id;
foreach(Message::orderBy('created_at', 'desc')->where('req_id','=', $req_id)->where('manager_id','=', $manager_id)->get() as $item){
echo '<tr><td>' . date("d F Y H:i", strtotime($item->created_at)) . '</td>';
$req_name =  Req::find($item->req_id);

echo '<td>' . $req_name->name . '</td>';
echo '<td>' . $item->text . '</td>';
echo '<td>';
$role = $item->role_id;
	if ($role == 1){
	echo "Клиент";
	} elseif ($role ==2 or $role ==3){
	echo "Менеджер";
	} elseif ($role ==4) {
	echo 'Администратор';
	}
echo '</td>';
}




?>
</table>
<div id="formnewmessage">
<form method = "POST" action = "<?php echo URL::to('manager').'/createmessage' ?>" enctype="multipart/form-data">
<input type="hidden" name="requests" value="<?php echo $req_id; ?>" >
<input type="hidden" name="token" value="<?php echo md5(uniqid(rand(), true)) ?>" />

<textarea rows = 3 name="textnewmessage" >
</textarea>
<br>
<input type="file" name="file">
<br>
<button type="submit">Отправить</button>

</form>
</div>
<?php

?>
</body>
<script >

$(document).ready(function() {
$('#table').dataTable();
} );
</script>