<div class="col-lg-8">

<div class="row">
<div class="col-lg-12">

<div class="box box-primary">
<div class="box-header">
<h3 class="box-title">{groupOfName}</h3>
</div>
<div class="box-body">
{message}

<form class="form-horizontal"  method="post" enctype="multipart/form-data" >
<fieldset>
<div class="form-group"><center>
  <div class="col-lg-6"><img src="{groupOfPhoto}" class="img-circle">   <h4>Рейтинг: {totalMsg}</h4> <h4><a href="/{screenName}" target="_blank">Перейти на страницу</a></h4> </div>

  <div class="col-lg-6"><img src="{groupFon}" width="150" height="150">   <h4>Текущий фон</h4></div></center>
 </div>

<div class="callout callout-info">
<p>Далее, Вы можете изменить  <b>настройки</b> страницы</p>
              </div>



<div class="form-group">
<label class="col-lg-4 control-label" for="focusedInput">Изменить описание:
</label>

 <div class="col-lg-6">
			
            <textarea class="form-control" rows="3" name="desc" >{groupText}</textarea>
</div>
</div>



<div class="form-group">
<label class="col-lg-4 control-label" for="focusedInput">Описание:
</label>

 <div class="col-lg-6">
			           
         <input id="TheCheckBox" type="checkbox" name="desc_off" data-on-text="Вкл" data-off-text="Выкл" checked="false" class="BSswitch">

</div>
</div>




<div class="form-group">
<label class="col-lg-4 control-label" for="focusedInput">Поменять фон: 
</label>
 <div class="col-lg-6">
			<input type="file" name="file" accept="image/*">
<br>
          
</div>


</div>


<div class="form-group">
<label class="col-lg-4 control-label" for="focusedInput">Прикрепление фото и опросов:
</label>

 <div class="col-lg-6">
			
           
          <input id="TheCheckBox" type="checkbox" name="CheckBoxValue1" data-on-text="Вкл" data-off-text="Выкл" checked="false" class="BSswitch">
</div>
</div>







 <div class="form-group">
<label class="col-lg-4 control-label" for="focusedInput">Добавить хэштеги:
</label>

 <div class="col-lg-6">
  <textarea class="form-control" rows="1" name="hashtag" >{hashtag}</textarea>
			
</div>
</div>







 
<div class="form-group">
<label class="col-lg-4 control-label" for="focusedInput">Подпись к записям:<p></p>
</label>
 <div class="col-lg-6">
			<div class="radio">
    <label><input name="hashtagis" type="radio" value="1" checked="">Фото</label>
  <label><input type="radio" name="hashtagis" value="2">Хэштег #kidris</label>
   </div>
 
 </div>
   </div>


 
 
<div class="form-group">
<label class="col-lg-4 control-label" for="focusedInput"></label>
 <div class="col-lg-6">
 
 <input type="submit" class="btn btn-block btn-success btn-lg"" value="Обновить настройки" name="reload">
   </div>
   
 </div>
 <br>
<div class="form-group">
<label class="col-lg-4 control-label" for="focusedInput"></label>
 <div class="col-lg-6">
 
 <input type="submit" class="btn btn-block btn-danger"" value="Отключить группу" name="disconnect">
   </div>
   
 </div>

</fieldset></form></div></div></div></div>

	</div>