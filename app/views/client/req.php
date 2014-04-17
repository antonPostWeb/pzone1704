<?
include 'header.php';
?>
<div class = "jumbotron">
<table id = "table">
<thead>
<tr>
<th style="width:20%">Дата</th>
<th>Заявка</th>
<th>Имя файла</th>
</tr>
</thead>
<tbody>
<?php
foreach(Request_attachment::orderBy('created_at', 'desc')->where('req_id','=',$req_id)->get() as $item){
echo '<tr><td>' . date("j M Y", strtotime($item->created_at)) . '</td>';
$name = Req::find($req_id)->name;
echo '<td>' . $name . '</td>';
echo '<td><a href = "'. Url::to('client/show/'.$item->id) .'">' . $item->filename . '</a></td>' ;
}


?>

</tbody>
</table>
</div>
<script >

$(document).ready(function() {
$('#table').dataTable();
} );
</script>
