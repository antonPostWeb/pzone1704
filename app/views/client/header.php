<!DOCTYPE HTML>
<html>
<head>
<script src = "/js/jquery-2.1.0.min.js"> </script>


<script type="javascript" src = "/js/jquery-ui-1.10.4.custom.min.js"> </script>
<script src = "/js/jquery.validate.js"> </script>
<script src = "/js/scriptjava.js"> </script>
<link rel="stylesheet" href="/css/chosennew.css" type="text/css" />

<link rel="stylesheet" href="/css/jquery.mCustomScrollbar.css" type="text/css" />


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
               
                    <a  class="menu" href="<?php echo URL::to('client')?>" > Чат </a>
                
                </td>
                
                <td>
                    
                    <a  class="menu" id="head_people" onClick="ShowDatePicker();"    href="javascript:void(0);"> Календарь </a>
                
                </td>
                <td>
                
                        <div id="time" >
                     
                        </div>
                    
                </td>
                <td>
      
                    <a class="menu"   href="<?php echo URL::to('client').'/files' ?>"> Файлы </a>
                  
                </td>
                <td>
      
                    <a class="menu"   href="<?php echo URL::to('client').'/index' ?>"> Help </a>
                  
                </td>
                <td>
      
                    <a class="menu"   href="<?php echo URL::to('client').'/note' ?>"> Заметки </a>
                  
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
            
            $.datepicker.setDefaults($.datepicker.regional['ru']);

            $( "#datepicker" ).datepicker();
        });
        
        
        function ShowDatePicker() {
        
        var display =  $('div#datepicker').css("display");
        if(display == "none"){
            $('div#datepicker').show();  
        } else {
            
            $('div#datepicker').hide();  
            
        }
        
    }    
        
     
    </script>