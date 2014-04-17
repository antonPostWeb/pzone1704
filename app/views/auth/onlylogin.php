<!DOCTYPE HTML>
<html>
<head>

<link rel="stylesheet" href="/css/chosennew.css" type="text/css" />
<link rel="stylesheet" href="/css/flick/jquery-ui-1.10.4.custom.min.css" type="text/css" />
<script src = "/js/jquery-2.1.0.min.js"> </script>
<script src = "/js/jquery.validate.js"> </script>
<script src = "/js/jquery-ui-1.10.4.custom.min.js"> </script>
<style>

  li {
    list-style-type: none; /* Убираем маркеры */
   }

</style>
</head>
<body>
    
	
   
	<div id = "auth">
             <form id="authform" name = "auth" method = "POST" action = "<?php echo URL::to('auth').'/onlylogin' ?>">
	  <p class="mainlogin">Input login</strong></p>
  	<input type="text" class="form-control" id="inputSuccess" placeholder = "Login" id= "username" name = "username">
	</div>


	
    </form>
</body>    
<script>
$( document ).ready(function() {
    $('#auth').dialog();
    $('#auth').dialog("option", "draggable", false );
	$('#auth').dialog("option", "modal", true );
	$('#auth').dialog("option", "closeOnEscape", false );
	$('div[class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix"]').hide();

});


 $(document).ready(function(){$("#authform").validate({
      rules:
                {
                    username:
                        {
                            required: true,
                            
                        }

                },
    messages:
                {
                    username:
                    {
                        required: "<li> Please input login </li>",
                        
                    }
                }
    }
    
    );}
    );
    
    

</script>
    
