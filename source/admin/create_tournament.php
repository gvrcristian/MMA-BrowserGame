	<h2>Create tournament</h2>
	
	<script type="text/javascript">
	  $(document).ready(function() {
		$("#start_time").datepicker();
		$("#end_time").datepicker();
	  });
	</script>
	<h2>Edit tournament</h2>
	
	<?php
	/**
* @author FightMMA
* @copyright 2015 FightMMA All rights reserved.
*/
	if(isset($_POST['do_save'])) {
		$name = protect($_POST['name']);
		$start_time = protect($_POST['start_time']);
		$end_time = protect($_POST['end_time']);
		$max_players = protect($_POST['max_players']);
		$rewards = protect($_POST['rewards']);
		$date = new DateTime($start_time);
		$start_time = $date->getTimestamp();
		$date = new DateTime($end_time);
		$end_time = $date->getTimestamp();
		
		if(empty($name) or empty($start_time) or empty($end_time) or empty($max_players)) { echo error("All fields are required."); }
		else {
			$ext = array('jpg','png','jpeg','JPEG','PNG','JPG'); 
						$extnafaila = end(explode('.',$_FILES['uploadfile']['name'])); 
						$extnafaila = strtolower($extnafaila); 
						if(in_array($extnafaila,$ext)){ 
							$sizes = getimagesize($_FILES['uploadfile']['tmp_name']);
							$filesize = floor($_FILES['uploadfile']['size'] / 1024);
							$max_filesize = '41943040';
							if($sizes[0] !== 335 and $sizes[1] !== 120) {
								echo error("Poster sizes must be 335x120.");
							} elseif($filesize > $max_filesize) {
								echo error("Poster max file size must be 500KB.");
							} else {
								$putq = 'uploads/tournament_'.rand(1,100).'_'.basename($_FILES['uploadfile']['name']); 
								if (@move_uploaded_file($_FILES['uploadfile']['tmp_name'], $putq)) { 
									echo success("Tournament was created successfully.");
									$insert = mysql_query("INSERT tournaments (name,poster,start_time,end_time,max_players,rewards) VALUES ('$name','$putq','$start_time','$end_time','$max_players','$rewards')");
								} else { 
									echo error("Error uploading! Please try again.");
								} 
							}
						} 
						else { 
							echo error("This file type is not supported.");
						} 
		}
	}
	?>
	
	<form role="form" action="" method="POST" enctype="multipart/form-data">
		  <div class="form-group">
			<label>Name</label>
			<input type="text" class="form-control" name="name">
		  </div>
		  <div class="form-group">
			<label>Poster (Size: 335x120)</label>
			<input type="file" class="form-control" name="uploadfile">
		  </div>
		  <div class="form-group">
			<label>Start date</label>
			<input type="text" class="form-control" name="start_time" id="start_time">
		  </div>
		  <div class="form-group">
			<label>End date</label>
			<input type="text" class="form-control" name="end_time" id="end_time">
		  </div>
		  <div class="form-group">
			<label>Max players</label>
			<input type="text" class="form-control" name="max_players">
		  </div>
		  <div class="form-group">
			<label>Rewards</label>
			<textarea class="form-control" name="rewards"></textarea>
		  </div>
		  <button type="submit" name="do_save" class="btn btn-default">Create</button>
	</form>