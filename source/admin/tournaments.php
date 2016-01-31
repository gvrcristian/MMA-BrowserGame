		<h2>Tournaments manager</h2>
		
		<a href="./admin.php?m=create_tournament" class="btn btn-default"><i class="fa fa-plus"></i> Create tournament</a>
		<br><br>
		<?php
		/**
	* @author FightMMA
	* @copyright 2015 FightMMA All rights reserved.
	*/
		$sql = mysql_query("SELECT * FROM tournaments WHERE winner > 0 and winner_rewarded='0' ORDER BY id");
		if(mysql_num_rows($sql)>0) {
		 echo '<table class="table table-striped">
		  <thead>
			<tr>
				<td colspan="3"><b>New winners</b></td>
			</tr>
			<tr>
				<td width="40%">Tournament</td>
				<td width="35%">Winner</td>
				<td width="25%">Rewards</td>
			</tr>
		  </thead>
		  <tbody>';
		  while($row = mysql_fetch_array($sql)) {
			$u = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE id='$row[winner]'"));
			echo '<tr>
					<td>'.$row[name].'</td>
					<td>'.$u[usern].' (<a href="./admin.php?m=edit&t=give_reward&id='.$u[id].'">Give reward</a>)</td>
					<td>'.$row[rewards].'</td>
				</tr>';
		  }
		  echo '</tbody>
			</table><br><br>';
		}
		?>
		
		<table class="table table-striped">
		  <thead>
			<tr>
				<td width="30%">Name</td>
				<td width="20%">Start</td>
				<td width="20%">End</td>
				<td width="20%">Players</td>
				<td width="10%">Actions</td>
			</tr>
		  </thead>
		  <tbody>
			<?php
			$sql = mysql_query("SELECT * FROM tournaments ORDER BY id");
			if(mysql_num_rows($sql)>0) {
				while($row = mysql_fetch_array($sql)) {
					$nums = mysql_num_rows(mysql_query("SELECT * FROM tournaments_players WHERE tour_id='$row[id]'"));
					echo '<tr>
							<td>'.$row[name].'</td>
							<td>'.date("d/m/Y",$row[start_time]).'</td>
							<td>'.date("d/m/Y",$row[end_time]).'</td>
							<td>'.$nums.'/'.$row[max_players].'</td>
							<td><a href="./admin.php?m=edit&t=tournament&id='.$row[id].'"><i class="fa fa-pencil"></i></a> <a href="./admin.php?m=delete&t=tournament&id='.$row[id].'"><i class="fa fa-times"></i></a></td>
						</tr>';
					$nums = '';
				}
			} else {
				echo '<tr><td colspan="5">No have created tournaments.</td></tr>';
			}
			?>
		  </tbody>
		</table>