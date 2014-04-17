<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>I Am Fro - Chat</title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<link href="/css/style.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900&subset=latin,cyrillic-ext,latin-ext,cyrillic' rel='stylesheet' type='text/css'>
	<script type="text/javascript" src="/js/modernizr-2.5.3.pack.js"></script>
	<link href="/css/jquery-ui-1.10.4.custom.css" rel="stylesheet">
	<script src="/js/jquery-2.1.0.min.js"></script>
        <script src="/js/jquery-ui-1.10.4.custom.js"></script>
<script>
$(document).ready(function () {
attach_calendar();
display_calendar();
display_text();
footer_calendar();
fixed_footer();
alert();
 });
 
 function attach_calendar() {
    $( ".calendar_wrapper" ).datepicker();
  }

	function display_calendar(){
  	$( "#calendar" ).click(function() {
	  	$('.calendar_wrapper').fadeToggle(500);
  	});
  	}
  	
  function display_text() {
	$( ".help_wrapper" ).click(function() {
	  	
	  	if ($(this).find(".line_text").is(":hidden")){
	  	$(this).find('.line_text').slideDown(500);
	  	$(this).find('.line_wrapper').css("background-position","0 0px");
	  	$(this).find('.line_wrapper').css("height","21px");
	  	} else {
	  	$(this).find('.line_text').slideUp(500);
		$(this).find('.line_wrapper').css("background-position","0 -26px");  	
	  	}
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
  
  function fixed_footer(){
	  var vusota_okna = Math.abs($(document).height());
var fixed_footer_vusota = Math.round((vusota_okna/3));
if (fixed_footer <= 270){
	$("#footer").css("margin-top","50px");
} else {
$("#footer").css("margin-top",fixed_footer_vusota+'px');
} }
function alert(){
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
				<li ><a href="<?php echo URL::to('manager')?>">Чат</a></li>
				<li id="calendar_footer">Календарь</li>
				<li><a href="<?php echo URL::to('manager').'/allfiles' ?>">Файлы</a></li>
                                <li><a onclick="fast_note();">Заметки</a></li>
				<li><a href="<?php echo URL::to('manager').'/notification' ?>">Обьявления</a></li>
				<li class="active"><a href="<?php echo URL::to('manager/help')?>">Помощь</a></li>
			</ul>
		</div>
	</header>
	<main class="content">
  <div id="fast_note">
   <p>Быстрая заметка</p>
   <textarea name="newnote"></textarea>
   
   <a href="<?php echo URL::to('manager').'/note' ?>"  >Посмотреть все заметки</a>
   <input id="send_note" type="submit" value="Сохранить">
   </div> 
     <script type="text/javascript">
     function fast_note(){$("#fast_note").toggle();}
     </script>
	<div class="calendar_wrapper" style="z-index:10;" >
		<div class="calendar_arrow" style="z-index:10;" ></div>
	</div>
		<div class="headline">Помощь в работе с сервисом</div>
			<div class="help_wrapper">
				<div class="line_wrapper">Шаг 1. Регистрация</div>
				<div class="line_text">Она встала, подсела к нам, оживилась... и мы только в два часа ночи вспомнили, что доктора велят ложиться спать в одиннадцать. В одном из домов слободки, построенном на краю обрыва, заметил я чрезвычайное освещение; по временам раздавался нестройный говор и крики, изобличавшие военную пирушку. Я слез и подкрался к окну; неплотно притворенный ставень позволил мне видеть пирующих и расслышать их слова. Говорили обо мне. Расставшись с Максимом Максимычем, я живо проскакал Терекское и Дарьяльское ущелья, завтракал в Казбеке, чай пил в Ларсе, а к ужину поспел в Владыкавказ. Избавлю вас от описания гор, от возгласов, которые ничего не выражают, от картин, которые ничего не изображают, особенно для тех, которые там не были, и от статистических замечаний, которые решительно никто читать не станет.</div>
			</div>
			<div class="help_wrapper">
				<div class="line_wrapper">Шаг 2. Чат и история сообщений</div>
				<div class="line_text">Она встала, подсела к нам, оживилась... и мы только в два часа ночи вспомнили, что доктора велят ложиться спать в одиннадцать. В одном из домов слободки, построенном на краю обрыва, заметил я чрезвычайное освещение; по временам раздавался нестройный говор и крики, изобличавшие военную пирушку. Я слез и подкрался к окну; неплотно притворенный ставень позволил мне видеть пирующих и расслышать их слова. Говорили обо мне. Расставшись с Максимом Максимычем, я живо проскакал Терекское и Дарьяльское ущелья, завтракал в Казбеке, чай пил в Ларсе, а к ужину поспел в Владыкавказ. Избавлю вас от описания гор, от возгласов, которые ничего не выражают, от картин, которые ничего не изображают, особенно для тех, которые там не были, и от статистических замечаний, которые решительно никто читать не станет.</div>
			</div>
			<div class="help_wrapper">
				<div class="line_wrapper">Шаг 3. Календарь и заметки</div>
				<div class="line_text">Она встала, подсела к нам, оживилась... и мы только в два часа ночи вспомнили, что доктора велят ложиться спать в одиннадцать. В одном из домов слободки, построенном на краю обрыва, заметил я чрезвычайное освещение; по временам раздавался нестройный говор и крики, изобличавшие военную пирушку. Я слез и подкрался к окну; неплотно притворенный ставень позволил мне видеть пирующих и расслышать их слова. Говорили обо мне. Расставшись с Максимом Максимычем, я живо проскакал Терекское и Дарьяльское ущелья, завтракал в Казбеке, чай пил в Ларсе, а к ужину поспел в Владыкавказ. Избавлю вас от описания гор, от возгласов, которые ничего не выражают, от картин, которые ничего не изображают, особенно для тех, которые там не были, и от статистических замечаний, которые решительно никто читать не станет.</div>
			</div>
			<div class="help_wrapper">
				<div class="line_wrapper">Шаг 4. Работа с файлами</div>
				<div class="line_text">Она встала, подсела к нам, оживилась... и мы только в два часа ночи вспомнили, что доктора велят ложиться спать в одиннадцать. В одном из домов слободки, построенном на краю обрыва, заметил я чрезвычайное освещение; по временам раздавался нестройный говор и крики, изобличавшие военную пирушку. Я слез и подкрался к окну; неплотно притворенный ставень позволил мне видеть пирующих и расслышать их слова. Говорили обо мне. Расставшись с Максимом Максимычем, я живо проскакал Терекское и Дарьяльское ущелья, завтракал в Казбеке, чай пил в Ларсе, а к ужину поспел в Владыкавказ. Избавлю вас от описания гор, от возгласов, которые ничего не выражают, от картин, которые ничего не изображают, особенно для тех, которые там не были, и от статистических замечаний, которые решительно никто читать не станет.</div>
			</div>
			<div class="help_wrapper">
				<div class="line_wrapper">Шаг 5. Выход и удаление профиля</div>
				<div class="line_text">Она встала, подсела к нам, оживилась... и мы только в два часа ночи вспомнили, что доктора велят ложиться спать в одиннадцать. В одном из домов слободки, построенном на краю обрыва, заметил я чрезвычайное освещение; по временам раздавался нестройный говор и крики, изобличавшие военную пирушку. Я слез и подкрался к окну; неплотно притворенный ставень позволил мне видеть пирующих и расслышать их слова. Говорили обо мне. Расставшись с Максимом Максимычем, я живо проскакал Терекское и Дарьяльское ущелья, завтракал в Казбеке, чай пил в Ларсе, а к ужину поспел в Владыкавказ. Избавлю вас от описания гор, от возгласов, которые ничего не выражают, от картин, которые ничего не изображают, особенно для тех, которые там не были, и от статистических замечаний, которые решительно никто читать не станет.</div>
			</div>
		</div>
		
	</main><!-- .content -->
	
	<footer id="footer">
		<div id="nav_footer_wrapper">
			<ul>
			<li ><a href="<?php echo URL::to('manager')?>">Чат</a></li>
			<li id="calendar_footer">Календарь</li>
			<li><a href="<?php echo URL::to('manager').'/allfiles' ?>">Файлы</a></li>
			<li><a href="<?php echo URL::to('manager').'/notification' ?>">Обьявления</a></li>
			<li><a href="<?php echo URL::to('manager').'/note' ?>">Заметки</a></li>
			<li><a href="<?php echo URL::to('manager/help')?>">Помощь</a></li>
			</ul>
			<button class="footer_exit"><div class="exit_warning"></div><span class="exit_text">Экстренный выход</div></button>
		</div>
	</footer>
</body>
</html>
<script>
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


$('button[class="decline"]').click(function(){

        $(".alert_wrapper").fadeOut();
})
</script>