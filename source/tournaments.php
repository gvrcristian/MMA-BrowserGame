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

			<table border="0" width="100%" cellspacing="2" cellpadding="2" class="trans">
				<tr>
					<td width="100%">
					<span style="font-size:15px;font-weight:bold;color:#1E7BBB ;"><?php echo $lang['menu_tournaments']; ?></span><br/>
					<br>
					<?php
					$sql = mysql_query("SELECT * FROM tournaments ORDER BY id DESC");
					if(mysql_num_rows($sql)>0) { 
						while($row = mysql_fetch_array($sql)) {
							$total_players = mysql_num_rows(mysql_query("SELECT * FROM tournaments_players WHERE tour_id='$row[id]'"));
							$act = "'$row[id]'";
							$check = mysql_query("SELECT * FROM tournaments_players WHERE user_id='$user[id]' and tour_id='$row[id]'");
							$time_now = time();
							if($time_now > $row['end_time']) {
								$tour = '';
							} else {
								if(mysql_num_rows($check)>0) {
									$tour = '';
								} else {
									$tour = '<tr>
													<td colspan="2" id="join_'.$row[id].'" align="center">
														<br>
														<a href="javascript:void(0);" class="menu" onclick="join_tournament('.$act.')">'.$lang[join_tournament].'</a>
														<br>
														<br>
													</td>
												</tr>';
								}
							}
							if($row['winner'] == 0) {
								$winner = '';
							} else {
								$u = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE id='$row[winner]'"));
								$winner = '<tr>
											<td>'.$lang[winner].'</td>
											<td align="right">'.$u[usern].'</td>
										</tr>';
							}
							echo '<div class="tournament">
									<div class="box">
										<span style="font-size:15px;font-weight:bold;">'.$row[name].'</span><br>
										<img src="'.$row[poster].'" width="335px" height="120px"><br>
										<table border="0" cellspacing="2" cellpadding="2" width="100%">
											<tr>
												<td colspan="2">
												'.$lang[rewards].': '.$row[rewards].'
												</td>
											</tr>
											<tr>
												<td>'.$lang[start].'</td>
												<td align="right">'.date("d/m/Y",$row[start_time]).'</td>
											</tr>
											<tr>
												<td>'.$lang[end].'</td>
												<td align="right">'.date("d/m/Y",$row[end_time]).'</td>
											</tr>
											<tr>
												<td>'.$lang[max_players].'</td>
												<td align="right" id="reload_'.$row[id].'">'.$total_players.'/'.$row[max_players].'</td>
											</tr>
											'.$winner.'
											'.$tour.'
										</table>
									</div>
								</div>';
						}
					} else {
						echo error($lang['no_tournaments']);
					}
					?>
					</td>
				</tr>
			</table>
                     
                  </section>
				  

    </body>
</html>