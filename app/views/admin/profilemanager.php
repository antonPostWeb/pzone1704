<?php
include 'header.php';
?>


<link rel="stylesheet" href="/css/chosen111.css" type="text/css" />
<link rel="stylesheet" href="/css/jquery.dataTables.css" type="text/css" />
<script src = "/js/jquery-2.1.0.min.js"> </script>
<script src = "/js/jquery.dataTables.min.js"> </script>
<script src = "/js/bootstrap.min.js"> </script>
<script src = "/js/chosen.jquery.min.js"> </script>


<div id="wrap3" style="width:auto;margin:0% 25% 10% 25%;height:auto;">
    
    
<div id="wrap2">
   <div class="forstyle" style="width:100%;height:47px"></div>
    
    
<div id="wrap1"  class="vkmessage" style="height:auto;padding:15px 5% 15px;" id="fortable">
<form method = "Post" name = "profilemanager" action = "<?php echo Url::to('admin/profilemanager')?>">
<input type = "hidden" name = "manager_id" value = "<?php echo $manager_id ;?>" />
<h3><p class="text-info">Выберите клиентов для менеджера:<?php $cur_manager = User::find($manager_id);if(isset($cur_manager)) $name = $cur_manager->firstname . $cur_manager->lastname ; echo $name?></p><h3>
        <div>
			<div style="display:block;width: 48%;position: relative;">
            <select data-placeholder="Choose a Country..." class="chosen-select" multiple style="width:100%;" name="tagsSelect[]"  tabindex="4">
            <option value=""></option> 
            <?php
            foreach (User::where('role_id','=',4)->get() as $item) {
              echo '<option value="'.$item->id.'" selected><p class="mainlogin">' . $item->firstname . $item->lastname . '</p></option>';
            }
            ?>
            </select> 
			</div>
		</div>
<br>
<br>
<button type = "submit" class="btn btn-info" > Отправить </button>
</form>
</div>
   <div class="forstyle" style="width:100%;height:47px"></div>
   </div>
    </div>
<script>
  $(function(){ 

    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }});
</script>
