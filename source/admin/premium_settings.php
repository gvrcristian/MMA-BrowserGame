				<h2>Premium settings</h2>
		
		<?php
		/**
* @author FightMMA
* @copyright 2015 FightMMA All rights reserved.
*/
		if(isset($_POST['do_save'])) {
			$premium_bonus_time = protect($_POST['premium_bonus_time']);
			$premium_bonus_price = protect($_POST['premium_bonus_price']);
			$paypal_email = protect($_POST['paypal_email']);
			$update = mysql_query("UPDATE settings SET premium_bonus_time='$premium_bonus_time',premium_bonus_price='$premium_bonus_price',paypal_email='$paypal_email'");
			echo success("Your changes was saved successfully.");
			$web = mysql_fetch_array(mysql_query("SELECT * FROM settings ORDER BY id DESC LIMIT 1"));
		}
		?>
		
		<form role="form" action="" method="POST">
		  <div class="form-group">
			<label>Premium account time</label>
			<select name="premium_bonus_time" class="form-control">
				<option value="86400" <?php if($web['premium_bonus_time'] == "86400") { echo 'selected'; } ?>>daily</option>
				<option value="604800" <?php if($web['premium_bonus_time'] == "604800") { echo 'selected'; } ?>>weekly</option>
				<option value="2419200" <?php if($web['premium_bonus_time'] == "2419200") { echo 'selected'; } ?>>monthly</option>
			</select>
		  </div>
		  <div class="form-group">
			<label>Premium account price (Currency is USD) Eg: 20</label>
			<input type="text" class="form-control" name="premium_bonus_price" value="<?php echo $web['premium_bonus_price']; ?>">
		  </div>
		  <div class="form-group">
			<label>Paypal email address</label>
			<input type="text" class="form-control" name="paypal_email" value="<?php echo $web['paypal_email']; ?>">
		  </div>
		  <button type="submit" name="do_save" class="btn btn-default">Save changes</button>
		</form>