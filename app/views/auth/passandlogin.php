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
   }

</style>

</head>
<body>
    <div  id = "auth">
    <form name = "auth" id = "authform" method = "POST" action = "<?php echo URL::to('auth').'/passandlogin' ?>">

     <p class = "mainlogin">Input password</strong></p>
    <input class="form-control" id="inputSuccess" type="password" id="password" name = "password" placeholder = "password" />
    <?php
	if (isset($username))
	{
		echo '<input type="hidden" name = "username" value = '. $username .' />';
		
		
		
	} else {
	echo 'Hello World'; // Ошибку 404 пропишем
	
	}
    ?>
	</div>
    </form>
</body>
<script>
$( document ).ready(function() {
    $('#auth').dialog();
    $('#auth').dialog("option", "draggable", false );
	$('div[class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix"]').hide();
});

 $(document).ready(function(){$("#authform").validate({
      rules:
                {
                    password:
                        {
                            required: true,
                            
                        }

                },
    messages:
                {
                    password:
                    {
                        required: "<li> Please input password </li>",
                        
                    }
                }
    }
    
    );}
    );

</script>



