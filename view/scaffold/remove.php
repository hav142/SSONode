    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeRemove_<?echo $pageID;?>"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Remove Data</h4>
        </div>
        <form action="<?echo $_SERVER['SCRIPT_NAME'];?>" method="post" role="form" id="validation-form" target="iframer" data-parsley-validate>
        <input type="hidden" name="<?echo $pageID;?>_id" value="" id="remove_<?echo $pageID;?>_id" />
        <div class="modal-body">          
          This data will be removed from the list:<br/>          
          <div class="container-fluid">  
            <div class="caption col-xs-9" style="padding:15px 0">
              <h4 id="remove_item"></h4>
            </div>
          </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary" value="remove" name="cmd">Remove</button>
        </div>
        </form>
      </div>
    </div>