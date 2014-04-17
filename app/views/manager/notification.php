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
		<script src = "/js/chosen.jquery.min.js"> </script>
		<link rel="stylesheet" href="/css/chosen111.css" type="text/css" />
		<script src = "/js/jquery.validate.js"> </script>

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
<style>

</style>
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
				<li ><a href="<?php echo URL::to('manager')?>" >Чат</a></li>
				<li id="calendar">Календарь</li>
				<li><a href="<?php echo URL::to('manager').'/allfiles' ?>" >Файлы</a></li>
				<li><a onclick="fast_note();">Заметки</a></li>
                                <li class="active"><a href="<?php echo URL::to('manager').'/notification' ?>" >Обьявления</a></li>
				<li><a href="<?php echo URL::to('manager/help')?>">Помощь</a></li>
			</ul>
		</div>
	</header>
	<main class="content">
	<div class="calendar_wrapper" style="z-index:10;" >
		<div class="calendar_arrow" style="z-index:10;" ></div>
	</div>
	  <div id="fast_note" style="z-index:10;">
   <p>Быстрая заметка</p>
   
   <textarea name = "newnote"></textarea>
   <input type="hidden" name="fast_note" value="1" />
   <a href="<?php echo URL::to('manager').'/note' ?>"  >Посмотреть все заметки</a>
   <input type="submit" id="send_note" value="Сохранить">
   </div> 
     <script type="text/javascript">
     function fast_note(){$("#fast_note").toggle();}
     </script>
		<div class="notification_wrapper">
			<div class="notification_pic"><img src="img/notif_png.png" alt=""></div>
			<div class="notification_text">Важное оповещение! После 7 секунд это сообщение исчезнет.</div>
		</div>
		<div class="headline">Текущие обьявления</div>
		<div id="chat_wrapper" class="vkmessage" style="height:540px;" >
			<?php
                    $cur_user = Auth::user()->id;
                    foreach(Notification::where('user_id','=',$cur_user)->orderBy('created_at','ASC')->get() as $item){
                      echo  '<div class="message_wrapper" id="'. $item->id .'"   >
					   
                       <div class="avatar"></div>
                                                <div class="user_name" style="margin-left:0px;">';
                                                      if(isset($item->created_at)){
                                                                  $time = strtotime($item->created_at);
                                                                  $time = $time + (4 * 3600);
                                                                echo date("j M H:i:s ", $time);
                                                                
                                                            }
                                                 
                                                echo '</div>
                                        
                                        <div class="text_in_mes" style="word-wrap:break-word;position:relative;height:100%;">
                                            <p class="message_date" style="position:relative;">';  
                        echo 'Для пользователей:';
                        foreach(Notificationuser::where('notification_id','=',$item->id)->get() as $client){
                            
                            
                            
                            $client_id = $client->client_id;
                            
                            $cur_client = User::find($client_id);
                            
                            $firstname = '';
                            $lastname = '';
                            
                            if(isset($cur_client->firstname)){
                                
                                $firstname = $cur_client->firstname;
                                
                            }
                            
                            if(isset($cur_client->lastname)){
                                
                                $lastname = $cur_client->lastname;
                                
                            }
                            
                            $fio = $firstname . '   ' . $lastname;
                            
                            echo $fio . '  ';
                        }
                            if(isset($item->text)){
                                echo '<p class="note" >' . $item->text . '</p>';
                            }
                            echo '</p>';
                             echo '</p>';
                             echo '</br><a href="'. URL::to('manager/delnotification') . '/' . $item->id . '"> Удалить обьявление </a>';
                             
                                   
                                            
                             echo '            </div>
                                        </div>';
                    }
                ?>
		
		
		
                   
			
                        
                        
                        
                        
                        
		</div>
              
 



			  
		 <div class="new_note">
  <form id="notes_form" method="POST" action = "<?php echo  Url::to('manager/notification') ?>" >
  <p>Новое обьявление:</p>
  <div >
            <select data-placeholder="Choose a Country..." class="chosen-select" multiple style="width:84%;" name="tagsSelect[]"  tabindex="4">
            <option value=""></option> 
            <?php
            
            $manager_id = Auth::user()->id;
            foreach(ClientManager::where('manager_id','=',$manager_id)->get() as $item){
                
                if(isset($item->client_id)){
                    
                    $client = User::find($item->client_id);
                    $firstname = '';
                    $lastname = '';
                    if(isset($client->firstname)){
                        
                        $firstname = $client->firstname;
                        
                    }
                    
                    if(isset($item->lastname)){
                        
                        $lastname = $item->lastname;
                        
                    }
                    $fio = $firstname . '   ' . $lastname;
                    
                    
                    echo '<option value="'.$client->id.'" selected><p class="mainlogin">' .$fio . '</p></option>';
                    
                    
                    
                }
                
                
                
            }
            
            
            
            
            ?>
            </select> 
			</div>
  <textarea class="new_note_text" name = "text" id="newnote"></textarea>
	
  <button type="submit" class="new_note_but" style="float:right;">Сохранить обьявление</button>
  </div>
  </div>
	</main><!-- .content -->
	
	<footer id="footer">
		<div id="nav_footer_wrapper">
			<ul>
			<li class="active"><a href="<?php echo URL::to('manager')?>">Чат</a></li>
			<li id="calendar_footer">Календарь</li>
			<li><a href="<?php echo URL::to('manager').'/allfiles' ?>">Файлы</a></li>
                        <li><a href="<?php echo URL::to('manager').'/note' ?>">Заметки</a></li>
			<li><a href="<?php echo URL::to('manager').'/notification' ?>">Обьявления</a></li>
			<li><a href="<?php echo URL::to('manager/help')?>">Помощь</a></li>
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
			url: "<?php echo Url::to('manager/newnote')?>",
			data:{
			
			"newnote":newnote
		
		},
		success: function(data){
			fast_note();
			$('textarea[name="newnote"]').val('');
		}
		})
	}else {
	
	alert('Нельзя сохранить пустую заметку');
	
	}
 
})


 document.onkeyup = function (e) {

                e = e || window.event;

                    if ((e.keyCode === 13) && (event.ctrlKey) ) {
                    
                      
    
                       $('form[id="notes_form"]').submit();
                       
                       

                    }

    

                return false;

    }



        
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
    
    
     $(document).ready(function(){$("#notes_form").validate({
      rules:
                {
                    text:
                        {
                            required: true,
                            
                        }

                },
    messages:
                {
                    text:
                    {
                        required: "<li> Нельзя оставлять пустую заметку </li>",
                        
                    }
                }
    }
    
    );}
    );    
        
    
    $('#notes_form').validate({

rules: {

      text: {

        required: true,



      }
},
      

    messages: {

    text: {

        required: "Нельзя сохранить пустое обьявление",
		}


	}
})

$('button[class="decline"]').click(function(){

        $(".alert_wrapper").fadeOut();
})
</script>



