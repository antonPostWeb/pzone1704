<?php
include 'header.php';
?>


<div style="margin-left:15%;margin-top:10%;height:20%;width:70%;" id = 'requires'>
<h3>Выберите менеджера для клиента:<?php $cur_client = User::find($client_id); if(isset($cur_client)) echo $cur_client->firstname . $cur_client->lastname ;?></h3>
<form name = "altermanager" action = "<?php echo Url::to('admin/altermanager')?>" method = "POST">
<input type = "hidden" name = "client_id" value = "<?php echo $client_id?>" />
<select name = "manager_id" >
<?php
foreach (User::where('role_id','=',3)->orwhere('role_id','=',2)->get() as $item){
echo '<option value = "'. $item->id .'">' . $item->firstname . $item->lastname . '</option>';
}
?>
</select>
<br>
<button type = "submit" >Отправить </button>
</div>
