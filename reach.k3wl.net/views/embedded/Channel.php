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

  <a href="<?=$app->urlFor('activateChannel', array('username'=>$User->UserName, 'channel'=>$Channel->ChannelId));?>">
  <button type="button" class="list-group-item btn btn-default
    <?php if ($Channel->ChannelActive) echo "active"; ?>
  " data-toggle="tooltip" data-placement="top" title="Turn on/off"><span class="badge"><?=$Channel->ChannelDetails;?></span><?=$Channel->ChannelName;?>
  </button></a>
  <p class="text-right">
  <button class="btn btn-info btn-xs" type="button"><span aria-hidden="true" class="glyphicon glyphicon-wrench"></span> </button>
  <button class="btn btn-warning btn-xs" type="button"><span aria-hidden="true" class="glyphicon glyphicon-remove"></span></button>
</p>
</div>
