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
    <div class="jumbotron" id = "auth">
	
    <form name = "auth" id = "authonlylogin" method = "POST" action = "<?php echo URL::to('tempuser').'/checklogin' ?>">
	<div class="form-group has-success">
	  <label class="control-label" for="inputSuccess"><strong>Input login</strong></label>
  	<input type="text" class="form-control" id="inputSuccess" placeholder = "Login" id="login" name = "login">
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

$(document).ready(function(){$("#authonlylogin").validate({
      rules:
                {
                    login:
                        {
                            required: true,
                            
                        }

                },
    messages:
                {
                    login:
                    {
                        required: "<li> Please input login </li>",
                        
                    }
                }
    }
    
    );}
    );


</script>
    
