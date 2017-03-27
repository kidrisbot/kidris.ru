 <!-- Post -->
 <div class="post" id = "#{id_post}">
  <div class="user-block">
    <img class="img-circle img-bordered-sm" src="{group_photo}" alt="user image">
    <span class='username'>
      <a href="https://vk.com/wall-{idGroup}_{id_post}"  target="_blank" rel="nofollow">{group_name}</a>

    </span>
    <span class='description'> {date}</span>
  </div><!-- /.user-block -->
  <div class="result-{id_post}">{alert_message}
            </div>
  <p>
   {text}
 </p>
 <div class='row'>
   {attachments}

 </div><!-- /.row -->
 <ul class="list-inline">
  <li class="text-sm"><i class="fa fa-heart margin-r-5"></i> {lang_likes} ({likes})</li>
  <li class="text-sm"><i class="fa fa-comments-o margin-r-5"></i> {lang_comments} ({comments})</li>
</ul>

<form class="form-horizontal" id="anon{id_post}"  enctype="multipart/form-data">
  <div class="form-group margin-bottom-none">
    <div class="col-md-5">
      <textarea class="form-control input-sm" id="ololo{id_post}"  placeholder="{lang_enter_comment}"></textarea>
      <input type="hidden" name="id" id="{id_post}" value="{cnt}">
    </div>
    <div class="col-md-4"> 
    <!--
      <div class="fileinput fileinput-new input-group "  data-provides="fileinput" >
        <div class="form-control" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
        <span class="input-group-addon btn btn-success btn-file"><span class="fileinput-new"><i class="fa fa-camera"></i></span><span class="fileinput-exists">{lang_change}</span><input type="file" id="{id}" class="photofile" name="image" accept="image/jpeg, image/png, image/gif"></span>
        <a href="#" class="input-group-addon btn btn-success fileinput-exists" data-dismiss="fileinput">X</a>
      </div>
  -->

    </div>  

    <div class="col-md-3">
    <!--
      <div class="btn-group">
        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">{lang_attach} <span class="caret"></span></button>
        <ul class="dropdown-menu" role="menu">
        
          <li><a href="#"><i class="glyphicon glyphicon-music"></i>{lang_audio}</a></li>
          <li><a href="#modal_video_{id_post}"  data-toggle="modal"> <i class="glyphicon glyphicon-film"></i>{lang_video}</a></li> 
          <li><a href="#{id_post}" id="addlist" onclick="openbox('interview-{id_post}', 'addlist')"> <i class="glyphicon glyphicon-list"></i>{lang_poll}</a></li>
        </ul>
       
      </div> -->
      <button type="button" class="btn btn-warning pull-right btn-lrg ajax" id="{id_post}">
        <i class="fa fa-paper-plane"></i>&nbsp; {lang_send}
      </button>
    </div>

 <div class="col-xs-12">
  <div id="interview-{id_post}" style="display: none;">
  <a id="delinterview_{id_post}_{id}" class="btn btn-danger pull-right delinterview">{lang_remove}</a>
    <table class="table table-bordered table-hover" id="tab_logic_{id}">
      <tbody>
        <tr id="ques">
          <td>{lang_question}</td>
          <td>
            <input type="text" name="ques" id="ques" placeholder="{lang_enter_question}" class="form-control">
          </td>
        </tr>
        <tr id="addr_{id_post}_0">
          <td>1 </td>
          <td>
            <input type="text" name="name[]" id="name[]" class="form-control">
          </td>
        </tr>
        <tr id="addr_{id_post}_1">
        </tr>
      </tbody>
    </table>
    <a id="add_{id_post}_{id}" class="btn btn-info pull-left add_row">{lang_add_row}</a><a id="del_{id_post}_{id}" class="pull-right btn btn-danger delete_row">{lang_delete_row}</a>
  </div>      
 </div>                      
</div>                        
</form>


                    </div><!-- /.post -->
                  