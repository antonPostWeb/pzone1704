<?php
include 'header.php';
?>

<style>
    p.note{
        
        color:#51749c;
        font-size:13px;
        margin-bottom:10px;
        
    }
    
</style>
<div id="wrap3" style="width:50%;margin:0 auto;height:600px;">
    <div id="wrap2">
        
            <div id="wrap1"  class="vkmessage"  style="height:600px;">
		<h3>Help</h3>        
    <div class="forstyle" style="width:100%;height:94px;">
        <div  class="form-group" style = "margin-left:15%;" name = "newmessage">
            <form id="notes_form" method="POST" action = "<?php echo  Url::to('manager/newnote') ?>" >
                <textarea name = "newnote" placeholder = "Insert note" style="width:83.5%;" rows="3" > </textarea>
                <br>
                <div class="button_blue button_wide button_big" id="quick_auth_button" style="width:150px;top:0px;float:left;">
                    <button class="btn btn-primary btn-xs" type="submit" >  Сохранить заметку </button>
                </div>    
            </form>
        </div>
    </div>
   </div>
</div>
<script>

</script>


