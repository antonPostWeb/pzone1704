<?php
include 'header.php';
?>

    <style>
    #table {
        border-collapse: collapse;
        !important;
        
        
    }
 #wrap1 #table tr[superattr="chat"] {
margin-left:10%;
border: 1px solid #d0dae1;
margin-top:10%;
!important;

}

 h4 {
 
border-color: white;
!important;
}

div#author{
    
    border-color:white;
    
}    
</style>

<?php
$cur_client_id = Auth::user()->id;
 Foreach(Notificationuser::where('client_id','=',$cur_client_id)->get() as $item){
    
    echo '<div class="forstyle" style="width:50%;margin:0 auto;margin-bottom:10px;height:auto;text-align:center;">';
        if(isset($item->notification_id)){
            $notification_id = $item->notification_id;
            $cur_notification = Notification::find($notification_id);
            if(isset($cur_notification->text)){
                
                echo $cur_notification->text;
                
            }
            
        }    
    echo '</div>';
    
}


?>


<script type="text/javascript" src="http://scriptjava.net/source/scriptjava/scriptjava.js"></script>
<div id="wrap3" style="position:relative;width:50%;margin:0 auto;height:600px;">
    
    
<div id="wrap2">
   <div class="forstyle" style="width:auto;height:47px"></div>
    
    
<div id="wrap1"  class="vkmessage" style="position:relative;height:700px;margin:0 auto;">
     <table id="table" style="width:100%">
        <thead>
            <tr style="width:100%">
                <th>
                    
                </th>
                <th>
                    
                </th>
            </tr>
        </thead>
        <tbody>
    
    
<?php


$client_id = Auth::user()->id;
$client_manager = ClientManager::where('client_id','=',$client_id)->first();
$manager_id = $client_manager->manager_id;
$all_messages = Message::where('manager_id','=',$manager_id)->where('client_id','=',$client_id)->orderBy('created_at','ASC')->get();
                            
                            foreach ($all_messages as $item){
                                
                                
                                if(isset($item->user_id)){
                                    $user_id = $item->user_id;
                                }
                                
                                $cur_user = User::find($user_id);
                                $firstname = '';
                                $lastname = '';
                                
                                if (isset($cur_user->firstname)){
                                    
                                    $firstname = $cur_user->firstname;
                                    
                                }
                                
                                
                                if (isset($cur_user->lastname)){
                                    
                                    $lastname = $cur_user->lastname;
                                    
                                }
                                
                                $fio = $firstname . '  ' . $lastname;
                                
				$background = 'background:#f5fafc;';
                                $background = 'background:white;';
                                
                                
                                $role_id = 4; 
                                if(isset($cur_user->role_id)){
                                 $role_id = $cur_user->role_id;
                                 }
                                 
                                 
                                $online = "Offline"; 
                                $rezult = 100;
                                
                                if(isset($cur_user->last_activity2)){
                                    
                                    $last_activity = $cur_user->last_activity2;
                                    
                                    $now = time();
                                    
                                    $rezult = $now - $last_activity;
                                    
                                            if($rezult < 900){
                                                
                                                $online = "Online";
                                                
                                            }
                                    
                                    
                                    
                                    
                                }
                                
                                 
                                $read = 1;
				if(isset($item->read_manager)){
				$read = $item->read_manager;				
				}
                                
                               
                                        
                                echo '<tr superattr="chat"   id = "'.$item->id.'">';
				 if ($read == 1){
                                    echo '<td class="firstTD" >';
					} else {
					 echo '<td class="firstTD" style="background:#DAE1E8;" >';
					}
                                           
                                            echo '<div id="divforphoto">';
                                                        echo '<div class="photoImage" >';
                                                       if($role_id == 4){
                                                        echo '<img  src="'.URL::to('../images/avatars/client.jpg').'" width=60 height=60 top:0px >';
                                                        } else {
                                                            
                                                            echo '<img  src="'.URL::to('../images/avatars/manager.jpg').'" width=60 height=60 top:0px >';
                                                        }
                                                        echo '</div>';
                                                        echo '</div>';
                                           
                                           
                                            echo '<div id="author_name" style="width:150px;" >';
                                                        echo '<h3 class = "fio">' . $fio . '</h3>';
							 echo '<h3 class = "date" >' . $online . '</h3>';
                                                        echo '<h3 class = "date" >';
                                                            if(isset($item->created_at)){
                                                                  $time = strtotime($item->created_at);
                                                                  $time = $time + (4 * 3600);
                                                                echo date("j M H:i:s ", $time);
                                                                
                                                            }
                                                        
                                                        
                                                        echo '</h3>';
                                                        
                                            echo '</div>';
                                         echo '</div>';
                                    echo '</td>';
                                   if ($read == 1){
                                    echo '<td class="secondTD" >';
					} else {
					 echo '<td class="secondTD" style="background:#DAE1E8;" >';
					 
					}
                                     //echo '<div  id="divfortext">';
                                        if(isset($item->text)){
                                            $text = $item->text;
                                        } 
						            

                                            
                                             
						 echo '<p class="message"  >' . $text . '</p>';
                                                 
                                                 $maybe_we_have_file = Request_attachment::where('message_id','=',$item->id)->get();
                                                            if(isset($maybe_we_have_file)){
                                                                    foreach($maybe_we_have_file as $file){
                                                                    echo '<br><a class="file" href = "'. Url::to('client/show/'.
                                                                    $file->id) .'"><strong>File:</strong>' . 
                                                                    $file->filename . '</a>';	
                                                                    }    
                                                            }
                                                 
                                                 
                                    //echo '</div>';        
                                        
                                    echo '</td>';
                                echo '</tr>';
                                
                            }
                        
      

?>    
    </tbody>
    </table>
</div>
   <div class="forstyle" style="width:auto;height:115px;">
       <div  class="form-group" style = "margin-left:15%;" name = "newmessage">
           
<form id="createmessage" method = "POST" action = "<?php echo Url::to('client/createmessage')?>" name = "sms" id="newmessage" enctype="multipart/form-data" >
<textarea rows="3" placeholer= "Сообщение" id="sms" class="form-control input-sm" style="width:83.5%;word-wrap:break-word;" WRAP=PHYSICAL  id="inputSmall" name = "sms" ></textarea>
<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
<input type = "hidden" name = "manager_id" value = "<?php echo $manager_id ;?>" />
<input type = "hidden" name = "client_id" value = "<?php echo $client_id;?>" />
 <div class="button_blue button_wide button_big" id="quick_auth_button" style="width:150px;top:0px;float:left;">
<button type = "submit" class="btn btn-primary btn-xs" onClick="SendForm();"> Отправить </button>
<input type="hidden" value = "<?php echo md5(uniqid(mt_rand(), true)) ?>" name = "token">
</div>

<div class="label" style="position:relative;margin-top:0px;right:0px;margin-left:100px;">
    <a  href="javascript:void(0);" id="foruploadfiles" > Прикрепить </a>
    <input type="file" name="file[]" style="display:none;" size="60" id="forfile"  multiple="multiple" />
    
</div>

</form>
</div>
       </div>
</div>
</div>
    


</body>
<script >
    
    $(window).load(function(){
            $(".vkmessage").mCustomScrollbar();
            var max_id = $('tr[superattr="chat"]').last().attr('id');
	$(".vkmessage").mCustomScrollbar("scrollTo","#"+max_id);
        });
    
    
        function SendForm() {
        
        
            $('div[id = "validate"]').remove();
            var have_file = $('input[id="forfile"]').val();
            var length_have_file = have_file.length;
            var cur_sms = $('textarea[name="sms"]').val();
          
            if ( (  /\S/.test(cur_sms) ) || ( length_have_file != 0 ) )  {
            
                
            
            
            } else  {
            
            
            $('textarea[name="sms"]').after('<div id ="validate" ><li> Нельзя отправить пустое сообщение </li></div>');
            return false;
            
            
            
            }
            
            
                //отправка формы на сервер
                $$f({
                        formid:'createmessage',//id формы
                        url:"<?php echo Url::to('client/createmessage')?>"//адрес на серверный скрипт, такой же как и в форме
                });
                 $('#sms').val('');
		$('input[id="forfile"]').val('');
                
        }
        
        
        
            document.onkeyup = function (e) {

                e = e || window.event;

                    if ((e.keyCode === 13) && (event.ctrlKey) ) {
                    
                      
    
                        SendForm();

                    }

    

                return false;

            }
    




	$('a#foruploadfiles').click(function () {
            
            $('input#forfile').click();
            
        })



	 
 var timer = setInterval(function() { 
	 var manager_id = <?php echo $manager_id ?>;
       	var client_id = "<?php echo $client_id?>";
	 var max_id = $('tr[superattr="chat"]').last().attr('id');
	 if (typeof(max_id) == undefined){
	 
	 max_id = 0;
	 }
       
   // alert($('input[name=_token]').val());
    
		$.ajax({
		type: "POST",
		url: "<?php echo Url::to('client/ajaxsms')?>",
		data:{
		"_token": $('input[name=_token]').val(),
		"max_id":max_id,
		"manager_id":manager_id,
		"client_id":client_id
		
		},
		success: function(data){
             if(data.length != 0){
                
            	        var obj = JSON.parse(data);
                	    var text = obj.text;
                        var lastID = obj.lastID;
                     
                        if(lastID == max_id){
                        
                            return false;
                         
                        }  else                   {
                     
                        $('table#table').append(text);
                        
                        $(".vkmessage").mCustomScrollbar("update");
                        
                        
                        $(".vkmessage").mCustomScrollbar("scrollTo","#"+lastID);
                        
                        }
                    }
            
  		},
  		    
		});
	
	 }, 1000);
 
$('[name = "newmessage"]').submit(function(e) {
	 e.preventDefault();
});	
	


 
        
    
    







</script>
