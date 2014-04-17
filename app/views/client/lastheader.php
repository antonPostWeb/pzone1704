<!DOCTYPE HTML>
<html>
<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<link rel="stylesheet" href="/css/bootstrap.css" type="text/css" />
<link rel="stylesheet" href="/css/chosen.css" type="text/css" />

<link rel="stylesheet" href="/css/jquery.mCustomScrollbar.css" type="text/css" />
<link rel="stylesheet" href="/css/datepicker/jquery-ui-1.10.4.custom.css" type="text/css" />

<script src = "/js/jquery.mCustomScrollbar.js"> </script>
<script src = "/js/jquery-ui-1.10.4.datepicker.custom.js"> </script>

<script type="text/javascript" src="http://scriptjava.net/source/scriptjava/scriptjava.js"></script>
<script src = "/js/bootstrap.js"> </script>

</head>
<style>
select[name="table_length"]{
display: none; 
}


.jumbotron {
padding:5% 5% 5% 5%;
!important;
}
</style>
<body>
<div class="navbar navbar-inverse navbar-fixed-top">
<div class="navbar-inner">
<div class="container">
<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</a>
<a class="navbar-brand" href="<?php echo URL::to('client')?>">Главная</a>

<ul class="nav navbar-nav">
<li><a href="<?php echo URL::to('client').'/messages' ?>">Обратная связь</a></li>
<li><a href="<?php echo URL::to('client').'/newrequire' ?>">Новая заявка</a></li>
<li><a href="<?php echo URL::to('client').'/forum' ?>">Форум</a></li>
<li><a href="<?php echo URL::to('auth').'/logout' ?>">Выход</a></li>
<li><div style="display:none;" id ="datepicker">Время<?php 
$data_is = date("i:s");
$data_H = gmdate("H") + 4;
$data = $data_H . ':' . $data_is;
echo $data;?></div></li>


</ul>
</li>
</ul>


</div>
</div>
</div>
    <script>
    
    $(function() {
$.datepicker.regional['ru'] = {
	closeText: 'Закрыть',
	prevText: '&#x3c;Пред',
	nextText: 'След&#x3e;',
	currentText: 'Сегодня',
	monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь',
	'Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
	monthNamesShort: ['Янв','Фев','Мар','Апр','Май','Июн',
	'Июл','Авг','Сен','Окт','Ноя','Дек'],
	dayNames: ['воскресенье','понедельник','вторник','среда','четверг','пятница','суббота'],
	dayNamesShort: ['вск','пнд','втр','срд','чтв','птн','сбт'],
	dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
	weekHeader: 'Не',
	dateFormat: 'dd.mm.yy',
	firstDay: 1,
	isRTL: false,
	showMonthAfterYear: false,
	yearSuffix: ''
};
$.datepicker.setDefaults($.datepicker.regional['ru']);

    $( "#datepicker" ).datepicker();
  });
    </script>
    
    
    
    
    
    
    
    LAST MESSAGES
    
    
    
<div class="jumbotron" style="margin-top:20%;height:400px;padding:0 auto;">
<div class="content" style = "width:90%;height:300px;margin:auto;">
<?php
$client_id = Auth::user()->id;
$have_we_one_message = Message::where('client_id','=',$client_id)->where('req_id','=',$req_id)->first();
if(isset($have_we_one_message->id)){
	foreach (Message::where('client_id','=',$client_id)->where('req_id','=',$req_id)->get() as $item){
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
                                echo '<br><a href = "'. Url::to('client/show/'.
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
			$maybe_we_have_file = Request_attachment::where('message_id','=',$item->id)->first();
			if(isset($maybe_we_have_file)){
			echo '<br><a href = "'. Url::to('client/show/'.
			$maybe_we_have_file->id) .'"><strong>File:</strong>' . 
			$maybe_we_have_file->filename . '</a>';	
			}
			echo '</div>
			</div>';


		}
	}
	 
}else {
echo '<div class="panel panel-success" superattr="chat" id = "1">';
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
</div>
<div  class="form-group" style = "margin-top:3%;margin-left:15%;" name = "newmessage">
<form method = "POST" action = "<?php echo Url::to('client/createmessage')?>" name = "sms" id="newmessage" enctype="multipart/form-data" >
<input placeholer= "Сообщение" id="newsms" class="form-control input-sm" style="width:83.5%;" type="text" id="inputSmall" name = "sms" />
<input type="file" name="file[]" size="60" id="forfile"  multiple="multiple" />
<input type="hidden" value = "<?php echo md5(uniqid(mt_rand(), true)) ?>" name = "token">
<input class = "hidden" name = "req_id" value = "<?php echo $req_id ;?>" />
<br>
<button type = "submit" class="btn btn-primary btn-xs" onClick = "SendForm();">Отправить</button>
</form>
</div>

</body>
<script >



	



    //    $(window).load(function(){
     //       $(".content").mCustomScrollbar();
//			$(".content").mCustomScrollbar("scrollTo","last");
    //    });
  
	
	
	
	 var timer = setInterval(function() { 
	 var client_id = <?php echo $client_id ?>;
       	var req_id = "<?php echo $req_id?>";
	 var max_id = $('div[superattr="chat"]').last().attr('id');


		$.ajax({
		type: "POST",
		url: "<?php echo Url::to('client/ajaxsms')?>",
		data:{
		"max_id":max_id,
		"client_id":client_id,
		"req_id":req_id
		},
		success: function(data){

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
$('div[class="mCSB_container"],[class="mCSB_container mCS_no_scrollbar"]').append("<div class="+thatclass+" superattr='chat' id="+id+" ><div class='panel-heading'><h3 class='panel-title'>"+author+"</h3></div><div insideid = "+id+" class='panel-body'><strong>Message:</strong>"+text+"");



			if(typeof(obj.filename) != "undefined"){
			var file_id = obj.file_id;
			var filename = obj.filename;
			var onehalfurl = "<?php echo Url::to('client/show/') ?>";
$('div[insideid = "'+id+'"]').append("<br><a href="+onehalfurl+file_id+" >"); 
$('div[insideid = "'+id+'"]').append("<strong>File:</strong>"+filename+"</a>");
			}
		$('div[class="'+thatclass+'"][id = "'+id+'"]').append("</div></div>");
		$('div[class="mCSB_container"],[class="mCSB_container mCS_no_scrollbar"]').mCustomScrollbar("update");
		$(".content").mCustomScrollbar("update");
		$(".content").mCustomScrollbar("scrollTo","last");

  		},
		});
	
	 }, 1000);

        

        function SendForm() {
                //отправка формы на сервер
                $$f({
                        formid:'newmessage',//id формы
                        url:"<?php echo Url::to('client/createmessage')?>"//адрес на серверный скрипт, такой же как и в форме
                });
        $('input[name="sms"]').val('');
		$('input[name="file"]').val('');
		}

	 
$('[name = "newmessage"]').submit(function(e) {
	 e.preventDefault();
});	

</script>




'<br><a href = "'. Url::to('client/show/'.
                                $file->id) .'"><strong>File:</strong>' . 
                                $file->filename . '</a>';	