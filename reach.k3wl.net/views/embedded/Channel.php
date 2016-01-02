<a href="<?=$app->urlFor('activateChannel', array('username'=>$User->UserName, 'channel'=>$key));?>">
<button type="button" class="list-group-item btn btn-default
  <?php if ($value->active) echo "active"; ?>
" data-toggle="tooltip" data-placement="top" title="Turn on/off"><span class="badge"><?=$value->details;?></span><?=$value->name;?>
</button></a>
<hr/>
