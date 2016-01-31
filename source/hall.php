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
			
<table cellspacing="10">
				<tr>
					<td class="hll" height="100%" >
						<img src="assets/imgs/hall_1.png"><br>
						+<?php if($user['premium'] == 1) { echo '18'; } else { echo '10'; } ?> <?php echo $lang['force']; ?><br>
						+<?php if($user['premium'] == 1) { echo '16'; } else { echo '10'; } ?> <?php echo $lang['agility']; ?><br>
						+<?php if($user['premium'] == 1) { echo '15'; } else { echo '10'; } ?> <?php echo $lang['endurance']; ?><br>
						+100% <?php echo $lang['energy']; ?><br><br>
					
						<?php
						if($user['workout_type'] == 1) {
							$time = time();
							if($time < $user['workout_end_time']) {
								echo $lang[workout_end_after].' '.timeago($user[workout_end_time]).'.';
							} else {
								if($user['premium'] == 1) {
									$new_force = $web['premium_bonus_force'];
									$new_agility = $web['premium_bonus_agility'];
									$new_endurance = $web['premium_bonus_endurance'];;
								} else {
									$new_force = '10';
									$new_agility = '10';
									$new_endurance = '10';
								}
								if(($user['power']+$new_force) > $web['player_max_force']) {
									$new_force = $web['player_max_force']-$user['power'];
								}
								if(($user['agility']+$new_agility) > $web['player_max_agility']) {
									$new_agility = $web['player_max_agility']-$user['agility'];
								}
								if(($user['endurance']+$new_endurance) > $web['player_max_endurance']) {
									$new_endurance = $web['player_max_endurance']-$user['endurance'];
								}
								$update = mysql_query("UPDATE users SET power=power+$new_force,agility=agility+$new_agility,endurance=endurance+$new_endurance,workout_end_time='0',workout_type='0',workouts=workouts+1,energy='100' WHERE id='$user[id]'");
								echo $lang['workout_is_over'];
							}
						} else {
							if($user['workout_type'] == 0) {
							?>
							<a href="javascript:void(0);" id="workout_1" onclick="start_workout('1')" class="button transition"><?php echo $lang['start_workout']; ?></a>
							<?php
							}
						}
						?>
					</td>
			
					<td class="hll" >
						<img src="assets/imgs/hall_2.png"><br>
						+<?php if($user['premium'] == 1) { echo '19'; } else { echo '10'; } ?> <?php echo $lang['fastness']; ?><br>
						+100% <?php echo $lang['energy']; ?><br><br>
						
						<?php
						if($user['workout_type'] == 2) {
							$time = time();
							if($time < $user['workout_end_time']) {
								echo $lang[workout_end_after].' '.timeago($user[workout_end_time]).'.';
							} else {
								if($user['premium'] == 1) {
									$new_fastness = $web['premium_bonus_fastness'];
								} else {
									$new_fastness = '10';
								}
								if(($user['fastness']+$new_fastness) > $web['player_max_fastness']) {
									$new_fastness = $web['player_max_fastness']-$user['fastness'];
								}
								$update = mysql_query("UPDATE users SET fastness=fastness+$new_fastness,workout_end_time='0',workout_type='0',workouts=workouts+1,energy='100' WHERE id='$user[id]'");
								echo $lang['workout_is_over'];
							}
						} else {
							if($user['workout_type'] == 0) {
							?>
							<a href="javascript:void(0);" id="workout_2" onclick="start_workout('2')" class="button transition"><?php echo $lang['start_workout']; ?></a>
							<?php
							}
						}
						?>
					</td>
					<td>
						<div class="box">
							<div class="hall_3"></div>
							<div class="hall_info">
								<span class="hall_title"><?php echo $lang['premium_workout']; ?></span>
								<p><?php echo $lang['premium_bonus']; ?></p>
								+<?php echo $web['premium_bonus_force']; ?> <?php echo $lang['force']; ?><br>
								+<?php echo $web['premium_bonus_agility']; ?> <?php echo $lang['agility']; ?><br>
								+<?php echo $web['premium_bonus_endurance']; ?> <?php echo $lang['endurance']; ?><br>
								+<?php echo $web['premium_bonus_fastness']; ?> <?php echo $lang['fastness']; ?><br>
								<br>
								<?php if($user['premium'] == 1) { ?>
								<?php echo $lang['already_premium']; ?>
								<?php } else { ?>
								<a href="./?m=premium" class="button transition"><?php echo $lang['get_premium']; ?></a>
								<?php } ?>
								<br><br>
							</div>
						</div>
					</td>
				</tr>
			</table>
                     
                  </section>
				  

    </body>
</html>