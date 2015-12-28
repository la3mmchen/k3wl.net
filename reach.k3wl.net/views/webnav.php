 <div class="header clearfix">
   <nav>
     <ul class="nav nav-pills pull-right">
       <li role="presentation" class="active">
         <a href="<?=$app->urlFor('home');?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></i></a>
       </li>
       <li role="presentation"><a href="<?=$app->urlFor('channel', array('username'=>'alex'));?>"><span class="glyphicon glyphicon-list" aria-hidden="true"></span></a></li>
       <li role="presentation"><a href="<?=$app->urlFor('profile');?>"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></a></li>
       <li role="presentation">
         <a href="<?=$app->urlFor('logout');?>"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span></a>
       </li>
     </ul>
   </nav>
   <h3 class="text-muted"><?=$app->getName();?></h3>
 </div>
