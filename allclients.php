<?php
include 'header.php';
?>

<div id="wrap3" style="width:auto;margin:0% 25% 10% 25%;height:auto;">
    
    
<div id="wrap2">
   <div class="forstyle" style="width:100%;height:47px"></div>
    
    
<div id="wrap1"  class="vkmessage" style="height:auto;padding:15px 5% 15px;" id="fortable">
<a style="margin-left:39%;" href = "<?php echo URL::to('admin/newclient')?>"><button class="btn btn-info"> Новый клиент </button></a>
<h2 style="text-align:center;">Клиенты</h2>
<br>
<table id="filetable">
<thead>
<tr>
<th >Дата</th>
<th >Логин</th>
<th >Менеджер</th>
</thead>
<tbody>
<?php 
//$manager_id = Auth::user()->id;
foreach (User::where('role_id','=',4)->get() as $item){

echo '<tr><td >'.date("j M ", strtotime($item->created_at)).'</td>';
echo '<td><a href = "'.  URL::to('admin').'/profile/'. $item->id   .'">'.$item->username.'</a></td>';
$manager = ClientManager::where('client_id','=', $item->id)->first();
if(isset($manager->manager_id)){
$manager_id = $manager->manager_id;
$that_manager = User::find($manager_id);
$fiomanager = $that_manager->firstname . $that_manager->lastname;
} else {
$fiomanager = 'Менеджер ещё не назначен';
}
echo '<td>';
if(isset($fiomanager)) echo $fiomanager;
echo '</td>';


//$manager_id=$item->manager_id;

 


}
?>
</tbody>
</table>
</div>
   <div class="forstyle" style="width:100%;height:47px"></div>

</div>
</div>

</body>
<script >

$(document).ready(function() {
$('#filetable').dataTable({
     "iDisplayLength": 50;
    
});
} );
</script>
</div>
</body>


