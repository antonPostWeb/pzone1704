<!DOCTYPE HTML>
<html>
  <head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <link href='/css/style.css' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900&subset=latin,cyrillic-ext,latin-ext,cyrillic' rel='stylesheet' type='text/css'>
  
  
	<script src = "/js/jquery-2.1.0.min.js"> </script>
    <script src = "/js/jquery.mCustomScrollbar.js"> </script>
	<link href="/css/jquery-ui-1.10.4.custom.css" rel="stylesheet">
	<script src="/js/jquery-ui-1.10.4.custom.js"></script>
    <link rel="stylesheet" href="/css/jquery.mCustomScrollbar.css" type="text/css" />
	
  
  <title>Files</title>
  
  <script type="text/javascript">
$(document).ready(function () {
	alert1();
});

function alert1(){  //дикий Fail!!!

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
                    <a href="<?php echo URL::to('auth/logout') ?>" id="exit_link">
		<span id="header_exit_text">Выход</span>
		<div id="header_exit"></div>
		</a>
			<ul>
				<li ><a href="<?php echo URL::to('manager')?>" >Чат</a></li>
				<li id="calendar">Календарь</li>
				<li class="active"><a href="<?php echo URL::to('manager').'/allfiles' ?>" >Файлы</a></li>
				<li><a onclick="fast_note();">Заметки</a></li>
                                <li><a href="<?php echo URL::to('manager').'/notification' ?>" >Обьявления</a></li>
				<li><a href="<?php echo URL::to('manager/help')?>">Помощь</a></li>
			</ul>
		</div>
	</header>
    	
  <main class="content">
  
  <div class="calendar_wrapper" style="z-index:10;" >
		<div class="calendar_arrow" style="z-index:10;" ></div>
		</div>
    
   <div id="fast_note">
   <p>Быстрая заметка</p>
   <textarea name="newnote"></textarea>
   <a href="<?php echo URL::to('manager').'/note' ?>"  >Посмотреть все заметки</a>
   <input type="submit" value="Сохранить">
   </div> 
   
     <script type="text/javascript">
     function fast_note(){$("#fast_note").toggle();}
     </script>

  <div id="search_cont">
  <p>Поиск файлов</p>
  <input type="text" placeholder="Введите ключевые слова" class="inp" id="findtext">
  </div>
  
  <div id="list">
  <div class="headline">Список загруженных файлов</div>
  <p class="head_tbl">Дата</p>
  <p class="head_tbl">Имя файла</p>
  
  <table class="files_table" >
  
  <?php

  
  
  
$cur_client_id = Auth::user()->id;
foreach(Request_attachment::where('client_id','=',$client_id)->orderBy('created_at', 'desc')->get() as $item){
echo '<tr class="row">';
echo '<td class="col_1" >' . date("j M Y", strtotime($item->created_at)) . '
</td>';

echo '<td class="col_2"><a   href = "'. URL::to('manager/show/'.$item->id) .'">' ;
 if(isset($item->filename)) echo  $item->filename ;
echo '</a></td>' ;

echo '<td class="col_3"><a class="downl" href="'. URL::to('manager/show') . '/' . $item->id .'"></a><a class="del" href="' . URL::to('manager/deletefile') . '/' . $item->id . '"></a>
</td></tr>';

}


?>
  
  
  
  </table>
  
  <div class="empty" style="display:none;">
   <p>Нет файлов, соответствующих критериям поиска.</p>
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
        <p>Вы действительно хотите удалить файл?</p>
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







<script type="text/javascript"  >
	$('#findtext').on("keyup",function(){
		
               
                
		var find_text = $(this).val();
			if(find_text.length == 0){
			$('tr').show();
                        $('div[class="empty"]').css("display","none");
                        return true;
			}
		
                        var result = 0;
			$('td[class="col_2"]').each(function(){
				
				var file_name = $(this).text();
				
                                 var lower_find_text = find_text.toLowerCase();
                                
				if(file_name.indexOf(lower_find_text) == -1){
				
                                        $(this).parent().hide();
                                
					
                                } else {
                                    
                                        $(this).parent().show();
                                        result =1 ;
                                
                                    
                                }
				
                                
                        })
                        
                        if(result == 1){
                            
                            $('div[class="empty"]').css("display","none");
                            
                        } else {
                            
                            $('div[class="empty"]').css("display","block");    
                            
                        }
                        
                        
                        
	
	})
        
        $('button[class="decline"]').click(function(){

        $(".alert_wrapper").fadeOut();
})
</script>

</html>




















