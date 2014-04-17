<?php
include 'header.php';
?>
<style>

li {
  list-style: none;
}
</style>
<div id="wrap3" style="width:auto;margin:0% 25% 10% 25%;height:auto;">
    
    
<div id="wrap2">
   <div class="forstyle" style="width:100%;height:47px"></div>
    
    
<div id="wrap1"  class="vkmessage" style="height:auto;padding:15px 5% 15px;" id="fortable">
<a style="margin-left:38%;" href = "<?php echo URL::to('admin/newmanager')?>"><button class="btn btn-info"> Новый менеджер </button></a>
<h2 style="text-align:center;">Менеджеры</h2>
<br>

<?php

$cur_manager = User::find(3);
$firstname = '';
$lastname = '';
if(isset($cur_manager->firstname)){
    
    $firstname = $cur_manager->firstname;
    }
if(isset($cur_manager->lastname)){
    
    $lastname = $cur_manager->lastname;
    }
    
    $fio = $firstname . '   ' . $lastname ;
    echo '<ul style="float:left;">' . $fio . '<br><br>';


    
    
    foreach(ClientManager::where('manager_id','=',3)->get() as $item){
        
        if(isset($item->client_id)){
            
            $cur_user = User::find($item->client_id);
            
            $firstname = '';
            $lastname = '';
            if(isset($cur_user->firstname)){
    
                $firstname = $cur_user->firstname;
            }
            if(isset($cur_user->lastname)){
    
                $lastname = $cur_user->lastname;
            }
    
            $fio = $firstname . '   ' . $lastname ;
            echo '<li>' . $fio . '</li>';
            
        }
        
        
    }
    
    echo '</ul>';
    
    
    $cur_manager = User::find(13);
$firstname = '';
$lastname = '';
if(isset($cur_manager->firstname)){
    
    $firstname = $cur_manager->firstname;
    }
if(isset($cur_manager->lastname)){
    
    $lastname = $cur_manager->lastname;
    }
    
    $fio = $firstname . '   ' . $lastname ;
    echo '<ul style="margin-left:100px;">'. $fio  . '<br><br>';
    
    foreach(ClientManager::where('manager_id','=',13)->get() as $item){
        
        if(isset($item->client_id)){
            
            $cur_user = User::find($item->client_id);
            
            $firstname = '';
            $lastname = '';
            if(isset($cur_user->firstname)){
    
                $firstname = $cur_user->firstname;
            }
            if(isset($cur_user->lastname)){
    
                $lastname = $cur_user->lastname;
            }
    
            $fio = $firstname . '   ' . $lastname ;
            echo '<li>' . $fio . '</li>';
            
        }
        
        
    }
    
echo '</ul>';
?>
</tbody>
</table>
</div>
   <div class="forstyle" style="width:100%;height:47px"></div>

</div>
</div>

</body>
<script >

$(document).ready(function() {
$('#filetable').dataTable();
} );
</script>
</div>
</body>


