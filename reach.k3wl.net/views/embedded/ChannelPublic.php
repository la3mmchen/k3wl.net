  <div class="col-xs-4">
    <h4><?=$Channel->getIcon();?> <?=$Channel->ChannelName;?></h4>
    <p>Last updated:
      <?php if ($Channel->ChannelLastUpdate == 0) { ?>
        <em> never </em>
      <?php }
      else { ?>
        <em><?=$Channel->updatedAgo();?></em>
      <?php }?>
      </p>
      <button type="button" class="list-group-item btn btn-default" data-toggle="tooltip" data-placement="top"><span class="badge"><?=$Channel->ChannelDetails;?></span><?=$Channel->ChannelName;?>
      </button>
  </div>
