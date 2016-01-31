		<h2>Users manager</h2>
		
		<form action="" method="POST"> 
			<div class="input-group">
			  <input type="text" class="form-control" name="q" placeholder="Search by username...">
			  <span class="input-group-btn">
				<button class="btn btn-default" name="do_search" type="submit">Search</button>
			  </span>
			</div><!-- /input-group -->
		</form>
		
		<?php if(isset($_POST['do_search'])) { ?>
		<br>
		<table class="table table-striped">
		  <thead>
			<tr>
				<td width="30%">Username</td>
				<td width="20%">Total stats</td>
				<td width="20%">Battles won</td>
				<td width="20%">Won tournaments</td>
				<td width="10%">Actions</td>
			</tr>
		  </thead>
		  <tbody>
			<?php
			$q = protect($_POST['q']);
			if(empty($q)) { echo '<tr><td colspan="5">No found results.</td></tr>'; }
			else {
			$sql = mysql_query("SELECT * FROM users WHERE usern LIKE '%$q%' ORDER BY id");
			if(mysql_num_rows($sql)>0) {
				while($row = mysql_fetch_array($sql)) {
					$nums = mysql_num_rows(mysql_query("SELECT * FROM tournaments_players WHERE tour_id='$row[id]'"));
					echo '<tr>
							<td>'.$row[usern].'</td>
							<td>'.number_format($row[total_stats]).'</td>
							<td>'.number_format($row[battles_won]).'</td>
							<td>'.number_format($row[battles_lost]).'</td>
							<td><a href="./admin.php?m=edit&t=user&id='.$row[id].'"><i class="fa fa-pencil"></i></a> <a href="./admin.php?m=delete&t=user&id='.$row[id].'"><i class="fa fa-times"></i></a></td>
						</tr>';
					$nums = '';
				}
			} else {
				echo '<tr><td colspan="5">No found results.</td></tr>';
			}
			}
			?>
		  </tbody>
		</table>
		<?php } ?>