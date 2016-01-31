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
			$sql = mysql_query("SELECT * FROM requests WHERE user_id='$_SESSION[user_id]'");
			if(mysql_num_rows($sql)>0) {
			?>
			<table border="0" cellspacing="2" cellpadding="2" class="trans" width="90%">
				<tr>
					<td><a href="./?m=fight"><?php $nums = number_format(mysql_num_rows($sql)); echo str_replace("%nums%",$nums,$lang['new_requests']); ?></a></td>
				</tr>
			</table>
			
			<br>
			<?php
			}
			?>
			
			<table border="0" cellspacing="2" cellpadding="2" class="trans" width="90%">
				<tr>
					<td width="10%" valign="top">
					  <table border="0" cellspacing="2" cellpadding="2" width="60%">
						<tr><td><div id="progress_text"><?php echo $lang['force']; ?></div><div id="progress_red" class="force"><div class="progress" title="<?php echo $user['power']; ?>/<?php echo $web['player_max_force']; ?>" style="width:<?php echo percent($user['power'],$web['player_max_force']); ?>%;"></div><button type="button" onclick="add_force()" class="add_btn"></button></div></td></tr>
						<tr><td><div id="progress_text"><?php echo $lang['agility']; ?></div><div id="progress_red" class="agility"><div class="progress" title="<?php echo $user['agility']; ?>/<?php echo $web['player_max_agility']; ?>" style="width:<?php echo percent($user['agility'],$web['player_max_agility']); ?>%;"></div><button type="button" onclick="add_agility()" class="add_btn"></button></div></td></tr>
						<tr><td><div id="progress_text"><?php echo $lang['endurance']; ?></div><div id="progress_red" class="endurance"><div class="progress" title="<?php echo $user['endurance']; ?>/<?php echo $web['player_max_endurance']; ?>" style="width:<?php echo percent($user['endurance'],$web['player_max_endurance']); ?>%;"></div><button type="button" onclick="add_endurance()" class="add_btn"></button></div></td></tr>
						<tr><td><div id="progress_text"><?php echo $lang['fastness']; ?></div><div id="progress_red" class="fastness"><div class="progress" title="<?php echo $user['fastness']; ?>/<?php echo $web['player_max_fastness']; ?>" style="width:<?php echo percent($user['fastness'],$web['player_max_fastness']); ?>%;"></div><button type="button" onclick="add_fastness()" class="add_btn"></button></div></td></tr>
					  </table>
					</td>
					<td width="40%" valign="top">
						<div class="box">
							<table border="0" cellspacing="2" cellpadding="2" width="90%">
								<tr>
									<td><div id="progress_text"><?php echo $lang['energy']; ?></div></td>
								</tr>
								<tr>
									<td><div id="progress_green" class="energy"><div class="progress" title="<?php echo $user['energy']; ?>/100" style="width:<?php echo $user['energy']; ?>%;"></div><button type="button" onclick="add_energy()" class="add_btn"></button></div></div></td>
								</tr>
							</table>
							<table border="0" align="right" style="font-weight:bold;">
								<tr>
									<td>Money:</td><td id="money">$<?php echo number_format($user['money']); ?></td>
								</tr>
								<tr>
									<td><?php echo $lang['points']; ?>:</td><td id="points"><?php echo number_format($user['points']); ?></td>
								</tr>
							</table>
						</div>
					</td>
				</tr>
			</table>
			
			<br>
			
			<table border="0" cellspacing="2" cellpadding="2" class="trans" width="90%">
				<tr>
				  <td width="22%"><span class="counter"><?php echo number_format($user['battles_won']); ?></span><br/><span class="counter_info"><?php echo $lang['player_battles_won']; ?></span></td>
				  <td class="counter_line"></td>
				  <td width="22%"><span class="counter"><?php echo number_format($user['tournaments_won']); ?></span><br/><span class="counter_info"><?php echo $lang['player_won_tournaments']; ?></span></td>
				  <td class="counter_line"></td>
				  <td width="22%"><span class="counter"><?php echo number_format($user['workouts']); ?></span><br/><span class="counter_info"><?php echo $lang['player_workouts']; ?></span></td>
				  <td class="counter_line"></td>
				  <td width="22%"><span class="counter"><?php echo number_format($user['battles_lost']); ?></span><br/><span class="counter_info"><?php echo $lang['player_battles_lost']; ?></span></td>
				 </tr>
			</table>
		</div>

			</div></div>
                     
                  </section>
				  

    </body>
</html>