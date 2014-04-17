<?php
include 'header.php';
?>
<div style="margin-top:15%;margin-left:25%;width:50%;height:40%;">
<div class="jumbotron">
<form class="form-horizontal" method = "POST" action = "<?php echo URL::to('client/newrequire')?>">
  <fieldset>
    <legend>Новая заявка</legend>
    <div class="form-group">
      <label for="newrequire" class="col-lg-2 control-label">Название заявки</label>
      <div class="col-lg-10">
        <input type="text" class="form-control" placeholder="Введите название" name = "title">
      </div>
    </div>
	<div class="form-group">
      <label for="newrequire" class="col-lg-2 control-label">Описание заявки</label>
      <div class="col-lg-10">
	<textarea class="form-control" rows="3" id="textArea" placeholder = 'Введите описание' rows="5"  
	name = "body" > </textarea>
      </div>
    </div>
	 <div class="col-lg-10 col-lg-offset-2">
    	<button type="submit" class="btn btn-primary">Отправить</button>
      </div>
    </div>
</div>
</div>

</body>
