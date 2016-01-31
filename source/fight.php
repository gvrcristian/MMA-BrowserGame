<?php
/**
* @author FightMMA
* @copyright 2015 FightMMA All rights reserved.
*/
if(!$_SESSION['usern']) { header("Location: ./"); }
?>
<html dir="ltr" lang="en-US" xmlns="http://www.w3.org/1999/xhtml">


    <body>
	<a href="./"><div class="logo"></div></a>
        <!-- Container -->
        <section id="container">

            <!-- Content -->
            <section id="content" >

  <div id="play"> 
  <div id='cssmenu'>
<ul>
   <li class='active1'><a href="./?m=city" ><?php echo $lang['menu_city']; ?></a> </li>
   <li><a href="./?m=statistics" ><?php echo $lang['menu_statistics']; ?></a> </li>
   <li> <a href="./?m=hall" ><?php echo $lang['menu_hall']; ?></a> </li>
   <li> <a href="./?m=fight" ><?php echo $lang['menu_fight']; ?></a> </li>
   <li>	 <a href="./?m=tournaments" ><?php echo $lang['menu_tournaments']; ?></a> </li>
   <li><a href="./?m=rankings" ><?php echo $lang['menu_rankings']; ?></a> </li>
<li class='last'> <a href="./?m=listmes" ><?php echo $lang['menu_msg']; ?></a></td></li>
   
</ul>
</div>

			<br>

			<?php
			$check_requests = mysql_query("SELECT * FROM requests WHERE user_id='$user[id]'");
			if(mysql_num_rows($check_requests)>0) {
			?>
			<table border="0" class="trans" width="100%" cellspacing="2" cellpadding="2">
				<tr>
					<td valign="top">
					<span style="font-size:15px;font-weight:bold;"><?php echo $lang['requests_for_fight']; ?></span><br/>
					<br>
					<?php
					while($r = mysql_fetch_array($check_requests)) {
						$u = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE id='$r[request_id]'"));
						if($u['avatar']) { $avatar = $u['avatar']; } else { $avatar = 'assets/imgs/avatar.jpg'; }
						$act = "'$r[id]'";
						echo '<div id="player" class="request_'.$r[id].'"><img src="'.$avatar.'" width="20px"> '.$u[usern].'<br/><span style="font-size:10px;margin-left:23px;"><a href="./?m=f&u='.$u[id].'">'.$lang[accept].'</a> / <a href="javascript:void(0);" onclick="reject_request('.$act.')">'.$lang[reject].'</a></span></div>';
					}
					?>
					</td>
				</tr>
			</table>
			
			<br>
			<?php
			}
			?>
			
			<table border="0" class="trans" width="100%" cellspacing="2" cellpadding="2">
				<tr>
					<td valign="top">
					<span style="font-size:15px;font-weight:bold;color:#1E7BBB ;"><?php echo $lang['players_for_fight']; ?></span><br/>
					<br>
					<?php
					$req = get_requests($user['id']);
					$query = mysql_query("SELECT * FROM users WHERE id NOT IN ($req) ORDER BY RAND() LIMIT 24");
					if(mysql_num_rows($query)>0) {
						while($row = mysql_fetch_array($query)) {
							if($row['avatar']) { $avatar = $row['avatar']; } else { $avatar = 'assets/imgs/avatar.jpg'; }
							$act = "'$row[id]'";
							echo '<div id="player" class="player_'.$row[id].'"><a href="javascript:void(0);" onclick="send_request('.$act.')"><img src="'.$avatar.'" width="20px"> '.$row[usern].'</a></div>';
						}	
					} else {
						echo error($lang['no_players_for_fight']);
					}
					?>
					</td>
				</tr>
			</table>
                     
                  </section>
				  

    </body>
</html>