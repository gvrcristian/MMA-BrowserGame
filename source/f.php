<?php
/**
* @author FightMMA
* @copyright 2015 FightMMA All rights reserved.
*/
if(!$_SESSION['usern']) { header("Location: ./"); }
$uid = protect($_GET['u']);
$sql = mysql_query("SELECT * FROM requests WHERE user_id='$user[id]' and request_id='$uid'");
if(mysql_num_rows($sql)==0) { header("Location: ./?m=fight"); }
$u = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE id='$uid'"));
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
<table border="0" cellspacing="2" cellpadding="2" width="100%" style="margin-left:15px;">
			<tr>
				<td width="33%" valign="top">
					<table border="0" cellspacing="2" cellpadding="2" width="200px" align="center">
						<tr>
							<td class="trans"><div class="profile_red" style="font-size:17px;"><?php echo $user['usern']; ?></div></td>
						</tr>
						<tr>
							<td class="trans"><img src="<?php if($user['avatar']) { echo $user['avatar']; } else { echo 'assets/imgs/avatar.jpg'; } ?>" width="200px" height="200px"></td>
						</tr>
						<tr>
							<td class="box">
								<table border="0" cellspacing="2" cellpadding="2" width="100%" style="font-weight:bold;">
									<tr>
										<td><?php echo $lang['force']; ?></td>
										<td align="right"><?php echo number_format($user['power']); ?></td>
									</tr>
									<tr>
										<td><?php echo $lang['agility']; ?></td>
										<td align="right"><?php echo number_format($user['agility']); ?></td>
									</tr>
									<tr>
										<td><?php echo $lang['endurance']; ?></td>
										<td align="right"><?php echo number_format($user['endurance']); ?></td>
									</tr>
									<tr>
										<td><?php echo $lang['force']; ?></td>
										<td align="right"><?php echo number_format($user['fastness']); ?></td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</td>
				<td width="33%" valign="top">
					<div class="vs"></div>
					<?php
					if($rand_points > $user['energy']) {
						?>
						<table border="0" width="150px" cellspacing="2" cellpadding="2" class="box" style="margin-top:20px;margin-right:9px;">
							<tr>
								<td valign="top" style="font-size:15px;font-weight:bold;"><?php echo $lang['sorry']; ?></td>
							</tr>
							<tr>
								<td valign="top">
									<?php echo $lang['no_energy']; ?>
								</td>
							</tr>
						</table>
						<?php
					} else {
					if($user['total_stats'] > $u['total_stats']) {
						if($user['premium'] == 1) {
							$rand_points = rand(5,30)+$web['premium_bonus_points'];
						} else {
							$rand_points = rand(5,30);
						}
						$update = mysql_query("UPDATE users SET money=money+400,points=points+$rand_points,battles_won=battles_won+1,energy=energy-$rand_points WHERE id='$user[id]'");
						$update = mysql_query("UPDATE users SET battles_lost=battles_lost+1,energy=energy-$rand_points WHERE id='$u[id]'");
						$time = time();
						$insert = mysql_query("INSERT meetings (user_win,user_lost,fight_time) VALUES ('$user[id]','$u[id]','$time')");
						?>
						<table border="0" width="150px" cellspacing="2" cellpadding="2" class="box" style="margin-top:20px;margin-right:9px;">
						<tr>
							<td valign="top" style="font-size:15px;font-weight:bold;"><?php echo $lang['CONGRATULATIONS']; ?></td>
						</tr>
						<tr>
							<td valign="top">
								<?php
								$replace = str_replace("%user%",$u['usern'],$lang['you_win']);
								$replace = str_replace("%points%",$rand_points,$replace);
								echo $replace;
								?>
							</td>
						</tr>
						</table>
						<?php
					} else {
						if($u['premium'] == 1) {
							$rand_points = rand(5,30)+$web['premium_bonus_points'];
						} else {
							$rand_points = rand(5,30);
						}
						$update = mysql_query("UPDATE users SET money=money+400,points=points+$rand_points,battles_won=battles_won+1,energy=energy-$rand_points WHERE id='$u[id]'");
						$update = mysql_query("UPDATE users SET battles_lost=battles_lost+1,energy=energy-$rand_points WHERE id='$user[id]'");
						$time = time();
						$insert = mysql_query("INSERT meetings (user_win,user_lost,fight_time) VALUES ('$u[id]','$user[id]','$time')");
						?>
						<table border="0" width="150px" cellspacing="2" cellpadding="2" class="box" style="margin-top:20px;margin-right:9px;">
							<tr>
								<td valign="top" style="font-size:15px;font-weight:bold;"><?php echo $lang['sorry']; ?></td>
							</tr>
							<tr>
								<td valign="top">
									<?php
									$replace = str_replace("%user%",$u['usern'],$lang['you_lost']);
									echo $replace;
									?>
								</td>
							</tr>
						</table>
						<?php
					}
					$delete = mysql_query("DELETE FROM requests WHERE user_id='$user[id]' and request_id='$u[id]'");
					}
					?>
				</td>
				<td width="33%" valign="top">
					<table border="0" cellspacing="2" cellpadding="2" width="200px" align="center">
						<tr>
							<td class="trans"><div class="profile_red" style="font-size:17px;"><?php echo $u['usern']; ?></div></td>
						</tr>
						<tr>
							<td class="trans"><img src="<?php if($u['avatar']) { echo $u['avatar']; } else { echo 'assets/imgs/avatar.jpg'; } ?>" width="200px" height="200px"></td>
						</tr>
						<tr>
							<td class="box">
								<table border="0" cellspacing="2" cellpadding="2" width="100%" style="font-weight:bold;">
									<tr>
										<td><?php echo $lang['force']; ?></td>
										<td align="right"><?php echo number_format($u['power']); ?></td>
									</tr>
									<tr>
										<td><?php echo $lang['agility']; ?></td>
										<td align="right"><?php echo number_format($u['agility']); ?></td>
									</tr>
									<tr>
										<td><?php echo $lang['endurance']; ?></td>
										<td align="right"><?php echo number_format($u['endurance']); ?></td>
									</tr>
									<tr>
										<td><?php echo $lang['fastness']; ?></td>
										<td align="right"><?php echo number_format($u['fastness']); ?></td>
									</tr>
								</table>
							</td>
						</tr>
					</table> 
				</td>
			</tr>
		</table>
                     
                  </section>
				  

    </body>
</html>