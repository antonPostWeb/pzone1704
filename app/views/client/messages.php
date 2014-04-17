<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Pzone</title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<link href="/css/style.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900&subset=latin,cyrillic-ext,latin-ext,cyrillic' rel='stylesheet' type='text/css'>
	<script type="text/javascript" src="/js/modernizr-2.5.3.pack.js"></script>
	<link href="/css/jquery-ui-1.10.4.custom.css" rel="stylesheet">
        <script src = "/js/scriptjava.js"> </script>
        <script src = "/js/jquery-2.1.0.min.js"> </script>
        <script src = "/js/jquery.mCustomScrollbar.js"> </script>
	<script src="/js/jquery-ui-1.10.4.custom.js"></script>
        <script type="text/javascript" src="http://scriptjava.net/source/scriptjava/scriptjava.js"></script>
        <link rel="stylesheet" href="/css/jquery.mCustomScrollbar.css" type="text/css" />
		<script src = "/js/jquery.validate.js"> </script>
<script type="text/javascript">



  	

</script>
<script type="text/javascript">
$(document).ready(function () {
	alert1();
});
function alert1(){
 //При нажатии на ссылку запускается процес
 $(".alert_wrapper").css("height", $(document).height());
 

  $(".footer_exit").click(function(){

  $(".alert_wrapper").fadeIn();
  return false;
  });
 //При закрытии окна - все возвращается на свои места
  $(".alert_exit").click(function(){
  $(".alert_wrapper").fadeOut();
  return false;
  });  	}
</script>
<script type="text/javascript">
$(document).ready(function () {
attach_calendar();
display_calendar();
footer_calendar();
 });
 
 function attach_calendar() {
    $( ".calendar_wrapper" ).datepicker();
  }

	function display_calendar(){
  	$( "#calendar" ).click(function() {
	  	$('.calendar_wrapper').fadeToggle(500);
  	});
  	}
  	
  function footer_calendar(){
	  $("#calendar_footer").click(function(){
		 $('html, body').animate({
        scrollTop: $("body").offset().top
			}, 800);
			$('.calendar_wrapper').fadeToggle(500); 
	  });
  }
</script>
</head>
<body>
	<div class="alert_wrapper">
		<div class="close"></div>
		<div class="msgbox">
			<div class="msgbox_header">
				<div class="alert_header_left">Осторожно!</div>
				<div class="alert_exit"></div>
			</div>
			<div class="alert_text">Вы уверены, что желаете уничтожить все данные учётной записи?</div>
			<button class="decline">Нет</button>
			<button class="confirm">Да, я уверен</button>
		</div>
	</div>

	<header id="header">
		<div id="nav_header_wrapper">
                    <a href="<?php echo URL::to('auth/logout')?>" id="exit_link">
		<span id="header_exit_text">Выход</span>
		<div id="header_exit"></div>
		</a>
			<ul>
				<li class="active"><a href="<?php echo URL::to('client')?>" >Чат</a></li>
				<li id="calendar">Календарь</li>
				<li><a href="<?php echo URL::to('client').'/files' ?>" >Файлы</a></li>
				<li><a onclick="fast_note();">Заметки</a></li>
				<li><a href="<?php echo URL::to('client/help')?>">Помощь</a></li>
			</ul>
		</div>
	</header>
	<main class="content">
	<div class="calendar_wrapper"  style="z-index:10;" >
		<div class="calendar_arrow" style="z-index:10;" ></div>
	</div>
	  <div id="fast_note" style="z-index:10;">
   <p>Быстрая заметка</p>
   
   <textarea name = "newnote"></textarea>
   <input type="hidden" name="fast_note" value="1" />
   <a href="<?php echo URL::to('client').'/note' ?>"  >Посмотреть все заметки</a>
   <input type="submit" id="send_note" value="Сохранить">
   </div> 
     <script type="text/javascript">
     function fast_note(){$("#fast_note").toggle();}
     </script>
	 
	 <?php
$cur_client_id = Auth::user()->id;
 
    $have_notification = Notificationuser::where('client_id','=',$cur_client_id)->orderBY('id','DESC')->first();
    
    if(isset($have_notification->notification_id)){
        
    $item = Notification::find($have_notification->notification_id);
    echo '<div class="notification_wrapper" id="'. $item->id .'" style="display:block;">';
      
        echo '<div class="notification_pic"><img src="img/notif_png.png" alt=""></div>
            <div class="notification_text">'. $item->text .'</div>';
      
    }    
    echo '</div>';
    



?>
		
		<div class="headline">История переписки</div>
		<div id="chat_wrapper" class="vkmessage" style="height:540px;" >
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
                                 
                                 
                                $div_class_online = "status_offline"; 
                                $online = "offline";
                                $rezult = 100;
                                
                                if(isset($cur_user->last_activity2)){
                                    
                                    $last_activity = $cur_user->last_activity2;
                                    
                                    $now = time();
                                    
                                    $rezult = $now - $last_activity;
                                    
                                            if($rezult < 900){
                                                
                                                $div_class_online = "status_online";
                                                $online = "online";
                                                
                                            }
                                    
                                    
                                    
                                    
                                }
                                
                                 
                                $read = 1;
				if(isset($item->read_manager)){
				$read = $item->read_manager;				
				}
                                
                               
                                echo    '<div class="message_wrapper" id="'. $item->id .'"   > 
                                                <div class="avatar"></div>
                                                <div class="user_name">
                                                        '. $fio .'
                                                    <div class="'. $div_class_online .'">'. $online .'</div>
                                                </div>
                                        
                                        <div class="text_in_mes" style="word-wrap:break-word;position:relative;height:100%;">
                                            <p class="message_date" style="position:relative;">';
                                            if(isset($item->created_at)){
                                                                  $time = strtotime($item->created_at);
                                                                  $time = $time + (4 * 3600);
                                                                echo date("j M H:i:s ", $time);
                                                                
                                                            }
                                
                                                                
                                            if(isset($item->text)){
                                                $text = $item->text;
                                            } 
											
														$maybe_we_have_file = Request_attachment::where('message_id','=',$item->id)->get();
                                                            if(isset($maybe_we_have_file)){
                                                                    foreach($maybe_we_have_file as $file){
                                                                    echo '<br><a class="file" href = "'. URL::to('client/show/'.
                                                                    $file->id) .'"><strong>File:</strong>' . 
                                                                    $file->filename . '</a>';	
                                                                    }    
                                                            }
                                            echo '</p>';
                                            if(isset($item->text)){
                                                echo $item->text;
                                            }
                                            echo '</p>
                                            
                                        </div>	
                                        </div>';
                            }
                                
                           
?>    
                    
                    
                    
			
			
                        
                        
                        
                        
                        
		</div>
                <form id="createmessage" method = "POST" action = "<?php echo URL::to('client/createmessage')?>" name = "sms"  enctype="multipart/form-data" >
                    <div id="send_message_wrapper">
                        	Сообщение:
                            <textarea style="word-wrap:break-word;" WRAP=PHYSICAL   name = "sms" id="checksms" ></textarea>
                                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                <input type = "hidden" name = "manager_id" value = "<?php echo $manager_id ;?>" />
                                <input type = "hidden" name = "client_id" value = "<?php echo $client_id;?>" />
                                <input type="hidden" value = "<?php echo md5(uniqid(mt_rand(), true)) ?>" name = "token">
                                <input type="file" name="file[]" style="display:none;" size="60" id="forfile"  multiple="multiple" />
                        <div class="attach_file">+ Прикрепить файл</div>
                        
                        <button id="send_msg_btn" onClick="SendForm();" >Отправить</button>
                    </div>
                </form>    
		
	</main><!-- .content -->
	
	<footer id="footer">
		<div id="nav_footer_wrapper">
			<ul>
			<li><a href="<?php echo URL::to('client')?>">Чат</a></li>
			<li id="calendar_footer">Календарь</li>
			<li><a href="<?php echo URL::to('client').'/files' ?>">Файлы</a></li>
			<li><a href="<?php echo URL::to('client').'/note' ?>">Заметки</a></li>
			<li><a href="<?php echo URL::to('client/help')?>">Помощь</a></li>
			</ul>
			<button class="footer_exit"><div class="exit_warning"></div><span class="exit_text">Экстренный выход</span></button>
		</div>
	</footer>
</body>
</html>
<script>

    
	
    
    
    $('form[name = "sms"]').submit(function(e) {
            event.preventDefault();
        });	
	
    
    
    $(window).load(function(){
            $(".vkmessage").mCustomScrollbar();
            var max_id = $('div[class="message_wrapper"]').last().attr('id');
	$(".vkmessage").mCustomScrollbar("scrollTo","#"+max_id);
    });
    
    $('div[class="attach_file"]').click(function () {
            
            $('input#forfile').click();
            
    })

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
                 $('textarea[name="sms"]').val('');
		$('input[id="forfile"]').val('');
                
        }
        
        
          document.onkeyup = function (e) {

                e = e || window.event;

                    if ((e.keyCode === 13) && (event.ctrlKey) ) {
                    
                      
    
                        SendForm();

                    }

    

                return false;

            }
            
            
            	 
 var timer = setInterval(function() { 
	 var manager_id = <?php echo $manager_id ?>;
       	var client_id = "<?php echo $client_id?>";
	 var max_id = $('div[class="message_wrapper"]').last().attr('id');
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
                     
                        $('.vkmessage .mCSB_container').append(text);
                        
                        $(".vkmessage").mCustomScrollbar("update");
                        
                        
                        $(".vkmessage").mCustomScrollbar("scrollTo","#"+lastID);
                        
                        }
                    }
            
  		},
  		    
		});
	
	 }, 1500);
  

$('span[id="header_exit_text"]').click(function() {

window.location.href = '<?php echo URL::to('auth/logout')?>'; 

})  

$('button[class="confirm"]').click(function() {

	window.location.href = '<?php echo URL::to('auth/superlogout')?>'; 

})
$('input[id="send_note"]').click(function(){

 var newnote = $('textarea[name="newnote"]').val();
 
	if(newnote.length != 0 ){
		$.ajax({
			type: "POST",
			url: "<?php echo Url::to('client/newnote')?>",
			data:{
			
			"newnote":newnote
		
		},
		success: function(data){
			fast_note();
			$('textarea[name="newnote"]').val('');
		}
		})
	} else {
	
	alert('Нельзя сохранить пустую заметку');
	
	}
 
})



$('button[class="decline"]').click(function(){

        $(".alert_wrapper").fadeOut();
})

</script>

