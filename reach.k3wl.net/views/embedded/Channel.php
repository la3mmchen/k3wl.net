<a href="<?=$app->urlFor('activateChannel', array('username'=>$User->UserName, 'channel'=>$Channel->id));?>">
<button type="button" class="list-group-item btn btn-default
  <?php if ($Channel->active) echo "active"; ?>
" data-toggle="tooltip" data-placement="top" title="Turn on/off"><span class="badge"><?=$Channel->details;?></span><?=$Channel->name;?>
</button></a>
