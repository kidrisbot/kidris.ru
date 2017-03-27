 //удалил пока что
  <div class="modal fade" id="modal_video_{id_post}" tabindex="-1" role="dialog" aria-labelledby="interviewModalLabel" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
                 <h4 class="modal-title" id="memberModalLabel">{lang_attach_poll}{id_post}</h4>

            </div>
            <div class="modal-body">
<div class="form-group">
<label class="col-lg-4 control-label" for="focusedInput">{lang_search_video}
</label>
<div class="col-lg-6">
<input type="text" name="name_film" placeholder="{lang_start_typing}" value="" class="form-control" id="who_film" autocomplete="off">

</div>
<div class="col-lg-2">
<button type="button" class="btn btn-success pull-right  " id="video_{id_post}">
{lang_attach}      </button>
</div>
</div><br>
<div id="search_result_film">
</div>          </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>