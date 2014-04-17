<?php
include 'header.php';
?>


<div id="wrap3" style="width:auto;margin:0% 25% 10% 25%;height:auto;">
    
    
<div id="wrap2">
   <div class="forstyle" style="width:100%;height:47px"></div>
    
    
<div id="wrap1"  class="vkmessage" style="height:auto;padding:15px 5% 15px;" id="fortable">
<form method = "POST" action = "<?php echo Url::to('admin/tempuser')?>" >

 <p class="mainlogin">Введите логин</p>
 
  <input type="text" name = "login" placeholder = "Логин" class="form-control" id="inputSuccess">

<br>
<br>
<br>

<p class="mainlogin">Введите email</p>
 
  <input type="text" class="form-control" id="inputSuccess" name = "email" placeholder = "Email">
<br>
    <p>Выберите менеджера</p>
    <select name="manager"> 
   <?php
   foreach(User::where('role_id','=',2)->get() as $item){
       echo '<option value = "'. $item->id .'">';
       if(isset($item->firstname)){
           echo $item->firstname;
           
       }
       if(isset($item->lastname)){
           echo $item->lastname;
           
       }
       echo '</option>';
       
       }
   
   
   ?>
    
    </select>
<br>
<button class="btn btn-success btn-sm" type = "submit"> Отправить </button>


</div>
<div class="forstyle" style="width:100%;height:47px"></div>
</div>
</div>
