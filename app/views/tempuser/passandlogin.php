<!DOCTYPE HTML>
<html>
<head>

<link rel="stylesheet" href="/css/chosennew.css" type="text/css" />
<link rel="stylesheet" href="/css/flick/jquery-ui-1.10.4.custom.min.css" type="text/css" />
<script src = "/js/jquery-2.1.0.min.js"> </script>
<script src = "/js/jquery-ui-1.10.4.custom.min.js"> </script>
<script src = "/js/jquery.validate.js"> </script>
<style>

  li {
    list-style-type: none; /* Убираем маркеры */
    color:red;
   }

</style>

</head>
<style>

input[type="submit"]{
margin-left:185px;
}
h2,h3{
text-align:center;

}
</style>
<body>
    <div class="jumbotron" id = "auth">
    <form name = "auth" method = "POST" id = "form" action = "<?php echo URL::to('tempuser').'/createnewuser' ?>">
	<?php
	if((isset($login)) AND (isset($email))){
	echo '<input type="hidden" value = '. $login .' name = "login">';
	echo '<input type="hidden" value = '. $email .' name = "email">';
	echo '<input type="hidden" value = '. $manager_id .' name = "manager_id">';
	
	} else {
	return Redirect::to('tempuser/onlylogin');
	}
	
	?>
<div class="form-group has-success">
  <label class="control-label" for="inputSuccess">Ваше   имя</label>
  <br>
  <input type="text" class="form-control" id="inputSuccess" name = "firstname" placeholder = "Имя">
</div>
<br>
<br>
<div class="form-group has-success">
  <label class="control-label" for="inputSuccess">Ваша   фамилия</label>
  <br>
  <input type="text" class="form-control" id="inputSuccess1" name = "lastname" placeholder = "Фамилия">
</div>
<br>
<br>
	<div class="form-group has-success">
  <label class="control-label" for="inputSuccess">Введите пароль</label>
  <br>
  <input type="password" class="form-control" id="inputSuccess2" name = "password" placeholder = "password">
</div>
<br>
<br>
<div class="form-group has-success">
  <label class="control-label" for="inputSuccess">Введите пароль</label>
  <br>
  <input type="password" class="form-control" id="inputSuccess3" name = "repassword" placeholder = "password">
</div>
<br>
	<br>
	<button type="submit" class="btn btn-success"> Отправить </button>
    </form>
</body>
<script>
$( document ).ready(function() {
    $('#auth').dialog();
    $('#auth').dialog("option", "draggable", false );
	$('#auth').dialog("option", "width", 500	);

	//validation
	$( "#form" ).submit(function( event ) {
	val1 = $('[name="password"]').val();
	val2 = $('[name="repassword"]').val();
	if (val1 != val2) {
	alert ('Пароли не совпадают');
	event.preventDefault();
	}  else {
	
	}
	
	
});

	
	
	
	});
	
	
	
	$(document).ready(function(){$("#form").validate({
      rules:
                {
                    firstname:
                        {
                            required: true,
                            
                        },
                        
                    lastname:
                        {
                            required: true,
                            
                        },    
                        
                    password:
                        {
                            required: true,
                            
                        },    
                    
                    repassword:
                        {
                            required: true,
                            
                        }       

                },
    messages:
                {
                    firstname:
                    {
                        required: "<li> Введите имя </li>",
                        
                    },
                    
                    lastname:
                    {
                        required: "<li> Введите фамилию </li>",
                        
                    },
                    
                    password:
                        {
                            required: "<li> Введите пароль </li>",
                            
                        },    
                    
                    repassword:
                        {
                            required: "<li> Повторите пароль </li>",
                            
                        }       
                    
                }
    }
    
    );}
    );
	



</script>



