<!-- Modal -->
<div class="modal fade" id="addChannel" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Give us some information:</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="post" action="<?=$app->urlFor('addChannel');?>">
          <div class="form-group">
            <label for="ChannelName" class="col-sm-2 control-label">Name</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="ChannelName" name="ChannelName" placeholder="Name">
            </div>
          </div>
          <div class="form-group">
            <label for="ChannelDetails" class="col-sm-2 control-label">Name</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="ChannelDetails" name="ChannelDetails" placeholder="Details e.g. account, number.">
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-default btn-success"><span class="glyphicon glyphicon-save" aria-hidden="true"></span> Create</button>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
