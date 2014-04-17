<!DOCTYPE HTML>
<html>
  <head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <link href="/css/style.css" rel="stylesheet" type='text/css'> 
  <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900&subset=latin,cyrillic-ext,latin-ext,cyrillic' rel='stylesheet' type='text/css'>
  
  <link href="/css/jquery-ui-1.10.4.custom.css" rel="stylesheet">
	<script src = "/js/jquery-2.1.0.min.js"> </script>
	<script src="/js/jquery-ui-1.10.4.custom.js"></script>
	<script src = "/js/jquery.mCustomScrollbar.js"> </script>
	 <link rel="stylesheet" href="/css/jquery.mCustomScrollbar.css" type="text/css" />
  
  <title>IAmFro Notes</title>
  
 <script type="text/javascript">
  $(document).ready(function () {
 change_1();
 active_1();
  arrow_1();
});
 function arrow_1(){
  $(".big_text").each(function(){
  if($(this).text().length>107){$(this).parent().prev('td').find(".pasiv").addClass("activ_note off").removeClass("pasiv");}
  
 
  })}

function active_1(){
$('.edit').click(function(){   
if ($(this).hasClass("activ"))
  {$(this).removeClass("activ");
  $(this).parent().parent().css("border-bottom","1px solid #ececec");} 
  else  {$(this).addClass("activ");
  $(this).parent().parent().css("border-bottom","0");};
  
 $(this).parent().parent().next('tr').toggle();
 
});}
function change_1(){
  $('.pasiv').click(function(){   
 if ($(this).parent().next('td').find(".big_text").hasClass("wh_sp"))
  {$(this).parent().next('td').find(".big_text").removeClass("wh_sp")} else
       {$(this).parent().next('td').find(".big_text").addClass("wh_sp")}; 
if ($(this).hasClass("off"))
  {$(this).removeClass("off").addClass("on");} 
  else  {$(this).removeClass("on").addClass("off");};
});}
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
				<li class="active"><a onclick="fast_note();">Заметки</a></li>
                                <li><a href="<?php echo URL::to('manager').'/notification' ?>" >Обьявления</a></li>
				<li><a href="<?php echo URL::to('manager/help')?>">Помощь</a></li>
			</ul>
		</div>
	</header>
  	
  <main>
  
  <div class="calendar_wrapper" style="z-index:10;" >
		<div class="calendar_arrow" style="z-index:10;" ></div>
	</div>
  
  <div id="fast_note">
   <p>Быстрая заметка</p>
   <textarea></textarea>
   <a href="<?php echo URL::to('manager').'/note' ?>"  >Посмотреть все заметки</a>
   <input type="submit" value="Сохранить">
   </div> 
     
  
   <div id="list">
  <div class="headline">Все заметки</div>
  
  <table class="note_table">
                  <?php
                    $cur_user = Auth::user()->id;
                    foreach(Note::where('user_id','=',$cur_user)->orderBy('created_at','ASC')->get() as $item){
                        echo ' <tr class="row" id = "'. $item->id .'"> <td class="col_1"> <a class="pasiv"></a></td>';
                        
                        
                        
                            if(isset($item->text)){
                                echo '<td class="col_2"><p class="big_text wh_sp" id = "'. $item->id .'">' . $item->text . '</p>
  </td>';
                            }
                             echo '<td class="col_3"><a class="del" href="'. URL::to('manager/deletenote') . '/' . $item->id . '"></a><a class="edit" note_id = "'. $item->id .'"></a>
  </td>
  </tr>';
  
                        echo ' <tr class="row row_edit" id = "'. $item->id .'"> <td class="col_1"> <a class="pasiv"></a></td>';
                        
                        
                        
                            if(isset($item->text)){
                                echo '<td class="col_2"><textarea rows="1" id = "'. $item->id .'" class="edit_inp">' . $item->text . '</textarea>
  </td>';
                            }
                             echo '  <td class="col_3"><button id = "'. $item->id .'" class="editnote" id="'.$item->id.'" >Сохранить</button></td>
  
  </tr>';
                               
		
		
		
                             
							   
                    }
                ?>
  
  



 
  </table>
  
  <div class="new_note">
  <form id="notes_form" method="POST" action = "<?php echo  URL::to('manager/newnote') ?>" >
  <p>Новая заметка:</p>
  <textarea class="new_note_text" name = "newnote" id="newnote"></textarea>
	
  <button class="new_note_but">Добавить</button>
  </div>
  </div>
   </main>
   
   <footer id="footer">
		<div id="nav_footer_wrapper">
			<ul>
				<li><a href="<?php echo URL::to('manager')?>">Чат</a></li>
				<li id="calendar_footer">Календарь</li>
				<li><a href="<?php echo URL::to('manager').'/allfiles' ?>">Файлы</a></li>
				<li><a href="<?php echo URL::to('manager').'/notification' ?>">Обьявления</a></li>
				<li><a href="<?php echo URL::to('manager').'/note' ?>">Заметки</a></li>
				<li><a href="<?php echo URL::to('manager/help')?>">Помощь</a></li>
			</ul>
			<button class="footer_exit footer_exit_alt">Экстренный выход</button>
   </div>
	</footer>
  
    <div id="openModal" class="modalDialog">
  <div>
    <div class="cls_row">
    <h2>Удаление</h2>
        <a href="#close" title="Закрыть" class="close">X</a>
     </div>   
        <p>Вы действительно хотите удалить заметку?</p>
        <div id="del_but"> <a href="#close">Нет</a> <a href="#close">Да</a></div>
  		</div>
	</div>
  
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

  
  </body>
  <script>

  
  
  $('button[class="confirm"]').click(function(){
  
	alert('Hello World');
  
  })
  
  $('span[id="header_exit_text"]').click(function() {

window.location.href = '<?php echo URL::to('auth/logout')?>'; 

})  

$('button[class="confirm"]').click(function() {

	window.location.href = '<?php echo URL::to('auth/superlogout')?>'; 

})

$('button[class="editnote"]').click(function(){

	var note_id = $(this).attr('id');
	var text_edit_note = $('textarea[id = "'+ note_id +'"]').val();
	
	if(text_edit_note.length != 0){
            $.ajax({
		type: "POST",
		url: "<?php echo Url::to('manager/editnote')?>",
		data:{
		
		"note_id":note_id,
		"text_edit_note":text_edit_note,
		
		
		},
		success:function(data){
		
		$('p[id="'+ note_id +'"]').empty();
		$('p[id="'+ note_id +'"]').append(text_edit_note);
		}
            })
            
            $('a[id=""]').click();
            
            } else {
            
            alert('Нельзя сохранить пустую заметку');
            
            
            }    
})
  </script>
 </html>  































