<?php
include 'header.php';
?>

<div id="wrap3" style="width:auto;margin:0% 25% 10% 25%;height:auto;">
    
    
<div id="wrap2">
   <div class="forstyle" style="width:100%;height:47px"></div>
    
    
<div id="wrap1"  class="vkmessage" style="height:auto;padding:15px 5% 15px;" id="fortable">
<a href = "<?php echo Url::to('admin/altermanager'. '/' . $client_id)?>" ><Button class="btn btn-info" >Сменить менеджера</button></a>
<br>
<a href = "<?php echo Url::to('admin/delpassword'. '/' . $client_id)?>" ><Button class="btn btn-info" style="margin-top:1%;width:28%;" >Сбросить   пароль</button></a>

<br>
<h2 style="text-align:center;"><p class="text-info">Профиль</p></h2>
<br>
<table id="filetable">
<thead>
<tr>
<th >ФИО</th>
<th >Email</th>
<th >Менеджер</th>
</tr>
</thead>
<tbody>
<?php 


$cur_client = User::find($client_id);
$fio = $cur_client->firstname  .  $cur_client->lastname;

echo '<tr><td >';
if(isset($fio))  echo $fio; 
echo '</td>';
echo '<td>' ;
if(isset($cur_client->email)) echo $cur_client->email ;
echo '</a></td>';
$manager = ClientManager::where('client_id','=', $client_id)->first();
if (isset($manager)){
$manager_id = $manager->manager_id;
$that_manager = User::find($manager_id);
$fiomanager = $that_manager->firstname . $that_manager->lastname;
} else {
$fiomanager = 'Менеджер ещё не назначен';
}
echo '<td>';
if(isset($fiomanager)) echo $fiomanager;
echo '</td>';




 



?>
</tbody>
</table>
<br>
<br>
</div>
<div class="forstyle" style="width:100%;height:47px"></div>
</div>
</div>


<script >

$(document).ready(function() {
$('#filetable').dataTable();

} );
</script>
</div>

</body>


