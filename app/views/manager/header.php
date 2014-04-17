<!DOCTYPE HTML>
<html>
<head>


<script src = "/js/jquery-2.1.0.min.js"> </script>
<script type="javascript" src = "/js/jquery-ui-1.10.4.custom.min.js"> </script>

<link rel="stylesheet" href="/css/chosennew.css" type="text/css" />

<link rel="stylesheet" href="/css/jquery.mCustomScrollbar.css" type="text/css" />

<script src = "/js/jquery-1.11.0.min.js"> </script>
<script src = "/js/jquery.mCustomScrollbar.js"> </script>


<script src = "/js/bootstrap.js"> </script>
<script src = "/js/jquery.dataTables.js"> </script>
<script src = "/js/jquery-ui-1.10.4.datepicker.custom.js"> </script>





</head>
<style>
select[name="table_length"]{
display: none; 
}


div#quicklyexit{
    background:red;
    !important;
    
    
    
}
div[class="ui-datepicker-inline ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all"]{
    background:#F7F7F7;
    
    
}
td[class=" ui-datepicker-days-cell-over  ui-datepicker-current-day ui-datepicker-today"]{
    background:red;
    
}

  li {
    list-style-type: none; /* Убираем маркеры */
   }
</style>

<body>
    
<div id="page_header" style="width: 100%;" >

    <table cellspacing="0" cellpadding="0" id="formenu">
        <tbody>
            <tr>
            <td>
            <?php
               
               $cur_manager = Auth::user()->id;
               $count = Message::where('manager_id','=',$cur_manager)->where('manager_read','=',0)->count();
               echo '<p style="color:red;font-size:11px;">'. $count . '</p>';
               
               
               ?>
            </td>
                <td>
               
                    <a  class="menu" href="<?php echo URL::to('manager')?>" > Чат </a>
                
                </td>
                
                <td>
                    
                    <a  class="menu" id="head_people" onClick="ShowDatePicker();"    href="javascript:void(0);"> Календарь </a>
                
                </td>
                <td>
                
                        <div id="time" >
                     
                        </div>
                    
                </td>
                 <td>
      
                    <a class="menu"   href="<?php echo URL::to('manager').'/allfiles' ?>"> Файлы </a>
                  
                </td>
                 <td>
      
                    <a class="menu"   href="<?php echo URL::to('manager').'/notification' ?>"> Обьявления </a>
                  
                </td>
                <td>
      
                    <a class="menu"   href="<?php echo URL::to('manager').'/index' ?>"> Help </a>
                  
                </td>
                <td>
      
                    <a class="menu"   href="<?php echo URL::to('manager').'/note' ?>"> Заметки </a>
                  
                </td>
                <td>
      
                    <a class="menu"   href="<?php echo URL::to('auth').'/logout' ?>"> Выход </a>
                  
                </td>
            </tr>
        </tbody>
    </table>
    <div id="emergencyexit">
                      
        <a  href="<?php echo URL::to('auth').'/superlogout' ?>" > Экстренный выход </a>
                      
    </div>    
    
    
    
    
    
</div>
    
   <div id="datepicker" style="display:none;float:left;">
                    
                        </div>
<script>
        
    function ShowDatePicker() {
        
        var display =  $('div#datepicker').css("display");
        if(display == "none"){
            $('div#datepicker').show();  
        } else {
            
            $('div#datepicker').hide();  
            
        }
        
    }    
        
        
    var timer = setInterval(function() { 
        var now = new Date();
        var hours = now.getUTCHours();
        var minutes = now.getMinutes();
        var seconds = now.getSeconds();
        var moscowhours = hours +4;
        $('div#time').empty();
        $('div#time').append('<a href="javascript:void(0);" >' + moscowhours  + ':' + minutes + ':' + seconds + '   MSK</a>');

     }, 10);
     
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
            
          
            
            
            
            var a = ["2014-12-01","2014-01-02","2014-01-03","2014-01-04","2014-01-05","2014-01-06","2014-01-07","2014-01-08","2014-02-23",
            "2014-03-08","2014-04-01","2014-05-09","2014-06-12","2014-11-04"];
            $( "#datepicker" ).datepicker( "option", "firstDay", 1 );
            $( "#datepicker" ).datepicker({
                
                beforeShowDay: function (date)
					{
						//alert(date);
						var year   = date.getFullYear();
						var mounth  =(1+ date.getUTCMonth());
						var day    = date.getDate();
						
						if (mounth < 10 )
							{
								mounth='0' + mounth;
							}
						if (day < 10 )
							{
								day='0' + day;
							}
						
                                                
        
                                                fulldate=year+'-'+mounth+'-'+day;
                                             
                                                
                                                    
                                                for (var z = 0; z < a.length;z++) 
								{
									if(fulldate === a[z])
									{
                                                                            
									x = 1;
									
									
									return [true,"ui-state-highlight",""];
									} else {
									
									x = 2;
									}
								}
								
								
								
                                                        if (x == 1)
							{
								return [true,"ui-state-highlight",""];
							} 
                                                        
                                                        
                                                   
                                                   
                                                        
                                               
							if (x == 2)
							{
                                                            
                                                            
								return [true,"ui-state-default",""];
							}
						
					
    
    }
    });
 
  

        });
      
</script>