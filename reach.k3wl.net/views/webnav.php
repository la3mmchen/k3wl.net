 <div class="header clearfix">
   <nav>
     <ul class="nav nav-pills pull-right">
       <li role="presentation"
       <?php if (isset($site) && preg_match('/home/', $site))
          echo 'class="active"'; ?>
        ><a href="<?=$app->urlFor('home');?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></i></a>
       </li>
       <?php if (isset($_SESSION['isAuthed']) &&$_SESSION['isAuthed']) {?>
         <li role="presentation"
           <?php if (isset($site) && preg_match('/channel/', $site))
              echo 'class="active"'; ?>
           ><a href="<?=$app->urlFor('channel', array('username'=>'alex'));?>"><span class="glyphicon glyphicon-list" aria-hidden="true"></span></a></li>
       <?php } ?>
       <?php if (isset($_SESSION['isAuthed']) &&$_SESSION['isAuthed']) {?>
         <li role="presentation"
         <?php if (isset($site) && preg_match('/profile/', $site))
            echo 'class="active"'; ?>
          ><a href="<?=$app->urlFor('profile');?>"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span></a></li>
      <?php } ?>
      <?php if (isset($_SESSION['isAuthed']) &&$_SESSION['isAuthed']) {?>
         <li role="presentation">
           <a href="<?=$app->urlFor('logout');?>"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span></a>
         </li>
      <?php } ?>
     </ul>
   </nav>
   <h3 class="text-muted"><?=$app->getName();?></h3>
 </div>
