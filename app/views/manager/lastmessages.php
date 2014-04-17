<?php
include 'header.php';
?>

<script type="text/javascript" src="http://scriptjava.net/source/scriptjava/scriptjava.js"></script>
<div id="wrap3" style="width:auto;margin:0% 25% 10% 25%;height:500px;">
    
    
<div id="wrap2">
   <div class="forstyle" style="width:auto;height:47px"></div>
    
    
<div id="wrap1"  class="vkmessage" style="height:500px;">
<?php
$manager_id = Auth::user()->id;
$have_we_one_message = Message::where('manager_id','=',$manager_id)->where('client_id','=',$client_id)->first();
if(isset($have_we_one_message->id)){
	foreach (Message::where('manager_id','=',$manager_id)->where('client_id','=',$client_id)->get() as $item){
		$role_id = $item->role_id;
 		if($role_id == 4 ){ 
			$max_id = $item->id;
			echo '<div class="panel panel-info" superattr="chat" id = "'. $item->id .'">';
			echo '<div class="panel-heading">
			<h3 class="panel-title">Клиент</h3>
			</div>
			<div class="panel-body">';
			echo '<strong>Message:</strong>'.$item->text ;
                        $maybe_we_have_file = Request_attachment::where('message_id','=',$item->id)->get();
			if(isset($maybe_we_have_file)){
                            foreach($maybe_we_have_file as $file){
                                echo '<br><a href = "'. Url::to('manager/show/'.
                                $file->id) .'"><strong>File:</strong>' . 
                                $file->filename . '</a>';	
                            }    
			}
			echo '</div>
			</div>';

		} elseif ($role_id == 3 or $role_id == 2){

			$max_id = $item->id;
			echo '<div class="panel panel-success" superattr="chat" id = "'. $item->id .'">';
			echo '<div class="panel-heading">
			<h3 class="panel-title">Менеджер</h3>
			</div>
			<div class="panel-body">';
			echo '<strong>Message:</strong>'.$item->text ;
			$maybe_we_have_file = Request_attachment::where('message_id','=',$item->id)->get();
			if(isset($maybe_we_have_file)){
                            foreach($maybe_we_have_file as $file){
                                echo '<br><a href = "'. Url::to('manager/show/'.
                                $file->id) .'"><strong>File:</strong>' . 
                                $file->filename . '</a>';	
                            }    
			}
			echo '</div>
			</div>';


		}
	}
	 
}else {
echo '<div  class="panel panel-success" superattr="chat" id = "1">';
			echo '<div class="panel-heading">
			<h3 class="panel-title">Менеджер</h3>
			</div>
			<div class="panel-body">';
			echo '<strong>Message:</strong>Вы можете начать чат';
			echo '</div>
			</div>';
}
	
	
	

	





?>    
</div>
   <div class="forstyle" style="width:auto;height:94px;">
       <div  class="form-group" style = "margin-left:15%;" name = "newmessage">
           
<form method = "POST" action = "<?php echo Url::to('manager/createmessage')?>" name = "sms" id="newmessage" enctype="multipart/form-data" >
<textarea rows="3" placeholer= "Сообщение" id="newsms" class="form-control input-sm" style="width:83.5%;"  id="inputSmall" name = "sms" > </textarea>
<input class = "hidden" name = "client_id" value = "<?php echo $client_id ;?>" />
 <div class="button_blue button_wide button_big" id="quick_auth_button" style="width:150px;top:0px;float:left;">
<button type = "submit" class="btn btn-primary btn-xs" onClick="SendForm();" > Отправить </button>
<input type="hidden" value = "<?php echo md5(uniqid(mt_rand(), true)) ?>" name = "token">
</div>
<div class="label" style="position:relative;top:-15px;right:0px;margin-left:100px;">
    <a style="margin-left:217px;margin-top:-25px;" href="javascript:void(0);" id="foruploadfiles" > Прикрепить </a>
    <input type="file" name="file[]" style="display:none;" size="60" id="forfile"  multiple="multiple" />
    
</div>
</form>
</div>
       </div>
</div>
</div>

</body>
<script >
    
        function SendForm() {
                //отправка формы на сервер
                $$f({
                        formid:'newmessage',//id формы
                        url:"<?php echo Url::to('manager/createmessage')?>"//адрес на серверный скрипт, такой же как и в форме
                });
                 $('#newsms').val('');
		$('input[name="file"]').val('');
                
        }
    
      $(window).load(function(){
            $(".vkmessage").mCustomScrollbar();
			$(".vkmessage").mCustomScrollbar("scrollTo","last");
        });



	$('a#foruploadfiles').click(function () {
            
            $('input#forfile').click();
            
        })



	 
 var timer = setInterval(function() { 
	 var manager_id = <?php echo $manager_id ?>;
       	var client_id = "<?php echo $client_id?>";
	 var max_id = $('div[superattr="chat"]').last().attr('id');


		$.ajax({
		type: "POST",
		url: "<?php echo Url::to('manager/ajaxsms')?>",
		data:{
		"max_id":max_id,
		"manager_id":manager_id,
		"client_id":client_id
		},
		success: function(data){
                if(data.length != 0){
		var obj = JSON.parse(data);
		var text = obj.text;
	
		var role_id = obj.role_id;
		var id = obj.id;
		if(role_id == 2 || role_id == 3 ){
		var	author = "Менеджер";
		var thatclass = '"panel panel-success"';

		} else if (role_id == 4){
		var author = "Клиент";
		var thatclass = '"panel panel-info"';
		}
$('div[class="mCSB_container"],[class="mCSB_container mCS_no_scrollbar"]').append("<div style='margin-left:10px;margin-bottom:10px;' class="+thatclass+" superattr='chat' id="+id+" ><div class='panel-heading'><h3 class='panel-title'>"+author+"</h3></div><div insideid = "+id+" class='panel-body'>"+text+"");



			if(typeof(obj.forfiles) != "undefined"){
			var forfiles = obj.forfiles;
			
                        $('div[insideid = "'+id+'"]').append( forfiles );
                        
			}
		$('div[class="'+thatclass+'"][id = "'+id+'"]').append("</div></div>");
		$('div[class="mCSB_container"],[class="mCSB_container mCS_no_scrollbar"]').mCustomScrollbar("update");
		$(".vkmessage").mCustomScrollbar("update");
		
                 $(".vkmessage").mCustomScrollbar("scrollTo","last");
                 
                }
                
  		},
		});
	
	 }, 1000);
 
$('[name = "newmessage"]').submit(function(e) {
	 e.preventDefault();
});	
	






</script>



display: table-row;
vertical-align: inherit;
border-color: inherit;
border-top-color: inherit;
border-right-color: inherit;
border-bottom-color: inherit;
border-left-color: inherit;