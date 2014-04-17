<?php
include 'header.php';
?>
<div id="wrap3" style="width:auto;margin:0% 25% 10% 25%;height:auto;">
    
    
<div id="wrap2">
   <div class="forstyle" style="width:100%;height:47px"></div>
    
    
<div id="wrap1"  class="vkmessage" style="height:auto;padding:15px 5% 15px;" id="fortable">
<table id="table">
<thead>
    <tr>
        <th> ФИО </th>
        <th> Восстановить </th>
    </tr>
<thead>
<tbody>
<?php
foreach(Useremergencyexit::all() as $item){
    echo '<tr>';
    echo '<td>';
    if(isset($item->firstname)){
        echo $item->firstname;
        
    }
     echo '  ';
     if(isset($item->lastname)){
        echo $item->lastname;
        
    }
    echo '</td>';
    echo '<td>';
    echo '<a href = "'. Url::to('admin/yesrecovery') . '/' . $item->id . '">Восстановить</a>';
    echo '</td>';
    echo '</tr>';
    
    
    
    }
?>
<tbody>



</table>
</div>
</div>
</div>
<script>
$('#table').dataTable();
</script>