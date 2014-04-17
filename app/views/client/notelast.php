<?php
include 'header.php';
?>

<style>
    p.note{
        
        color:#51749c;
        font-size:13px;
        margin-bottom:10px;
        
    }
    
</style>
<div id="wrap3" style="width:50%;margin:0 auto;height:600px;">
    <div id="wrap2">
        
            <div id="wrap1"  class="vkmessage"  style="height:500px;">
                <?php
                    $cur_user = Auth::user()->id;
                    foreach(Note::where('user_id','=',$cur_user)->orderBy('created_at','ASC')->get() as $item){
                        echo '<div style = "margin-top:5%;background:#F7F7F7;margin-top:20px;min-height:70px;margin-bottom:5%;" class = "note" id = "'. $item->id .'" >';
                        
                            if(isset($item->created_at)){
                                
                                $time = strtotime($item->created_at);
                                $time = $time + (4 * 3600);
                                echo '<p style="font-size:10px;">'. date("j M H:i:s ", $time) . '</p>';
                                                                
                            }
                        
                            if(isset($item->text)){
                                echo '<p class="note" >' . $item->text . '</p>';
                            }
                             echo '<div class="deletenote">';
                                echo '<a class="deletenote" href = "'  .Url::to('client/deletenote') . '/' . $item->id . '" > Удалить заметку </a>';
                            
                            echo '</div>';
                        echo '</div>';
                    }
                ?>
            </div>
        
    <div class="forstyle" style="width:100%;height:auto;">
        <div  class="form-group" style = "margin-left:15%;position:relative;" name = "newmessage">
            <form id="notes_form" method="POST" action = "<?php echo  Url::to('client/newnote') ?>" >
                <textarea name = "newnote" id="newnote" placeholder = "Insert note" style="width:83.5%;" rows="3" > </textarea>
                <br>
                
                    <button s type="submit" > Сохранить заметку </button>
                
            </form>
        </div>
    </div>
   </div>
</div>
<script>

    $(window).load(function(){
            $(".vkmessage").mCustomScrollbar();
            var max_id = $('div[class="note"]').last().attr('id');
            $(".vkmessage").mCustomScrollbar("scrollTo","#"+max_id);
        });
        
        
         document.onkeyup = function (e) {

                e = e || window.event;

                    if ((e.keyCode === 13) && (event.ctrlKey) ) {
                    
                      
    
                       $('form[id="notes_form"]').submit();
                       
                       

                    }

    

                return false;

            }
    
        
        
        
     $(document).ready(function(){$("#notes_form").validate({
      rules:
                {
                    newnote:
                        {
                            required: true,
                            
                        }

                },
    messages:
                {
                    newnote:
                    {
                        required: "<li> Нельзя оставлять пустую заметку </li>",
                        
                    }
                }
    }
    
    );}
    );    
        
        
$('span[id="header_exit_text"]').click(function() {

window.location.href = '<?php echo URL::to('auth/logout')?>'; 

})  

$('button[class="confirm"]').click(function() {

	window.location.href = '<?php echo URL::to('auth/superlogout')?>'; 

})
        
</script>


