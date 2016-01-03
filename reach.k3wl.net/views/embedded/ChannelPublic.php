  <div class="col-xs-4">
    <h4><?=$Channel->getIcon();?> <?=$Channel->ChannelName;?></h4>
    <p>Last updated: <em><?=$Channel->updatedAgo();?></em>.</p>
      <button type="button" class="list-group-item btn btn-default" data-toggle="tooltip" data-placement="top" title="Turn on/off"><span class="badge"><?=$Channel->ChannelDetails;?></span><?=$Channel->ChannelName;?>
      </button>
  </div>
