<?php
include 'header.php';
?>

<div id="wrap3" style="width:auto;margin:0% 25% 10% 25%;height:auto;">
    
    
<div id="wrap2">
   <div class="forstyle" style="width:100%;height:47px"></div>
    
    
<div id="wrap1"  class="vkmessage" style="height:auto;padding:15px 5% 15px;" id="fortable">
    
  <form name = "auth" method = "POST" id = "form" action = "<?php echo URL::to('admin').'/newmanager' ?>">
	<p class="mainlogin">Создание нового менеджера</p>
	<br>
	<div class="form-group has-success">
	  <p class="mainlogin">Логин</p>
	  <input type="text" class="form-control" id="inputSuccess" name = "login" placeholder = "login">
	</div>
	<div class="form-group has-success">
	  <p class="mainlogin">Email</p>
	  <input type="text" class="form-control" id="inputSuccess" name = "email" placeholder = "email">
	</div>
	
	<p class="mainlogin">Тип аккаунта</p>
<div class="checkbox">
          <label>
            <input type="checkbox" name = "projectmanager"> Project Manager
          </label>
</div>
<div class="checkbox">
          <label>
            <input type="checkbox" name = "clientmanager"> Client Manager
          </label>
</div>
	<div class="form-group has-success">
	  <p class="mainlogin">Имя</p>
	  <input type="text" class="form-control" id="inputSuccess" name = "firstname" placeholder = "Имя">
	</div>
	<div class="form-group has-success">
            <p class="mainlogin">Фамилия</p>
	  <input type="text" class="form-control" id="inputSuccess" name = "lastname" placeholder = "Фамилия">
	</div>
	<div class="form-group has-success">
	  <p class="mainlogin">Пароль</p>
	  <input type="password" class="form-control" id="inputSuccess" name = "password" placeholder = "password">
	</div>
		<div class="form-group has-success">
	  <p class="mainlogin">Пароль</p>
	  <input type="password" class="form-control" id="inputSuccess"  name = "repassword" placeholder = "password">
	</div>

	<br>
	<input type="submit" class="btn btn-success btn-sm"> </input>
    </form>

</div>
<div class="forstyle" style="width:100%;height:47px"></div>
</div>
</div>

</body>
<script>
$('input[type="checkbox"]').bind('click', function() {
	if ($(this).attr("name") == "projectmanager"){
	$('input[type="checkbox"][name="clientmanager"]').prop('checked',false);
	} else {
	$('input[type="checkbox"][name="projectmanager"]').prop('checked',false);
	
	}
	
	
});

</script>
