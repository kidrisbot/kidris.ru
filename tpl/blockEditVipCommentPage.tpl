<div class="box box-primary"	id = "BlockEditComment"  style="{display_block_edit}">
	<div class="box-header with-border">
		<h3 class="box-title">Название группы</h3>
	</div>
	<!-- /.box-header -->
	<!-- form start -->
	<form role="form" id="formEdit">
	<div id="okey">
	</div>
		<div class="box-body">
			<div class="row">
				<div class="col-lg-4 text-center" > <h4>Скопируйте ссылку и вставьте в  группе в раздел ссылок:</h4><input type="text"  class="form-control" value="http://kidris.ru/com/{screen_name}" readonly><br><h4><a href="https://vk.com/{photo_caption}" target="_blank">Открыть фотоподпись</a></h4></div>
				<div class="col-lg-4 text-center" ><img src="{photo_100}" class="img-circle"> <h4>Рейтинг: {total_msg}</h4> <h4><a href="http://kidris.ru/com/{screen_name}" target="_blank">Перейти на страницу</a></h4>  </div>
				<div class="col-lg-4 text-center" > </div>
			</div>
			<br>

			<div class="form-group">
				<label for="desc">Изменить описание:</label>
				<textarea class="form-control" rows="4"  name="description" ></textarea>
			</div>
			<div class="form-group">
				<label for="hashtag">Добавить подпись, хештег и тому подобное:</label>
				<input type="text" maxlength="250" class="form-control"	 name="hashtag" value="{hashtag}" >
			</div>
			<div class="form-group">
			<label for="add_hashtag">Текстовую подпись:</label>
				<select class="form-control" name="add_hashtag">
					<option value="0">Скрывать</option>
					<option value="1" {select_hashtag_end}>В конце комментария</option>
					<option value="2" {select_hashtag_first}>В начале комментария</option>
				</select>
			</div>
			<div class="form-group">
				<label class="">
					<div class="icheckbox_flat-green" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox"  name="hide_desc" {hide_desc} class="flat-red" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div> Скрыть описание
				</label>

			</div>
			<!-- 
			<div class="form-group">
				<label for="photoId">Изменить фотоподпись $</label>
				<input type="file" id="photoId" accept="image/*"  name="photoId" >

			</div>
			-->
			<div class="form-group">
				<label class="">
					<div class="icheckbox_flat-green" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" name="hide_links" {hide_links} class="flat-red" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div> Скрыть ссылки сбоку
				</label>
			</div>
			<!-- /.form-group -->
			<div class="form-group">
				<label class="">
					<div class="icheckbox_flat-green" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" name="hide_photo_caption" {hide_photo_caption} class="flat-red" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div> Убрать фотоподпись 
				</label>

			</div>
			<!-- /.form-group -->
			<div class="form-group">
				<label class="">
					<div class="icheckbox_flat-green" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" name="hide_number_suggested" {hide_number_suggested} class="flat-red" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div>Скрыть количество предложенных новостей 
				</label>

			</div>
			<!-- /.form-group -->
			<div class="form-group">
				<label class="">
					<div class="icheckbox_flat-green" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" name="hide_number_posts" {hide_number_posts} class="flat-red" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div>  Скрыть кол-во записей 
				</label>
			</div>
			<!-- /.form-group -->
			<div class="form-group">
				<label class="">
					<div class="icheckbox_flat-green" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" name="hide_number_followers" class="flat-red" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div> Скрыть кол-во подписчиков 
				</label>
			</div>
			<!-- /.form-group -->
			

		</div>
		<!-- /.box-body -->
		<div class="box-footer">
			<div class="col-lg-4" > <button type="button" id="disconnect" value="{id}" class="btn btn-danger btn-block ajax"><span class="glyphicon glyphicon-off"></span> Отключить</button></div>
			<div class="col-lg-8" ><button type="button" id="edit" value="{id}" class="btn btn-success btn-block ajax"><span class="glyphicon glyphicon-pencil"></span> Изменить</button> </div>


		</div>
	</form>
</div>
          <!-- /.box -->