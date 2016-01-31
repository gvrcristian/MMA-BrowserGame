				<h2>Ads manager</h2>
		
		<?php
		/**
* @author FightMMA
* @copyright 2015 FightMMA All rights reserved.
*/
		if(isset($_POST['do_save'])) {
			$ad_place = $_POST['ad_place'];
			$update = mysql_query("UPDATE settings SET ad_place='$ad_place'");
			echo success("Your changes was saved successfully.");
			$web = mysql_fetch_array(mysql_query("SELECT * FROM settings ORDER BY id DESC LIMIT 1"));
		}
		?>
		
		<form role="form" action="" method="POST">
		  <div class="form-group">
			<label>Ad place 468x60</label>
			<textarea rows="5" class="form-control" name="ad_place"><?php echo $web['ad_place']; ?></textarea>
		  </div>
		  <button type="submit" name="do_save" class="btn btn-default">Save changes</button>
		</form>