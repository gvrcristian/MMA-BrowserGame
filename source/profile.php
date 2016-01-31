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
			
<table border="0" width="90%" cellspacing="2" cellpadding="2">
				<tr>
					<td class="trans" valign="top" width="50%">
					<span style="font-size:15px;font-weight:bold;color:#1E7BBB ;"><?php echo $lang['avatar']; ?></span><br/>
					<br>
					<?php
					if(isset($_POST['do_upload'])) {
						$ext = array('jpg','png','jpeg','JPEG','PNG','JPG'); 
						$extnafaila = end(explode('.',$_FILES['uploadfile']['name'])); 
						$extnafaila = strtolower($extnafaila); 
						if(in_array($extnafaila,$ext)){ 
							$sizes = getimagesize($_FILES['uploadfile']['tmp_name']);
							$filesize = floor($_FILES['uploadfile']['size'] / 1024);
							$max_filesize = '41943040';
							if($sizes[0] !== 200 and $sizes[1] !== 200) {
								echo error($lang['avatar_error_1']);
							} elseif($filesize > $max_filesize) {
								echo error($lang['avatar_error_2']);
							} else {
								$putq = 'uploads/'.$_SESSION[user_id].'_'.basename($_FILES['uploadfile']['name']); 
								if (@move_uploaded_file($_FILES['uploadfile']['tmp_name'], $putq)) { 
									echo success($lang['avatar_success']);
									$update = mysql_query("UPDATE users SET avatar='$putq' WHERE id='$user[id]'");
									$user = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE id='$user[id]'"));
								} else { 
									echo error($lang['avatar_error_3']);
								} 
							}
						} 
						else { 
							echo error($lang['avatar_error_4']);
						} 
					}
					?>
					<table border="0" cellspacing="2" cellpadding="2">
						<tr>
							<td width="100px" valign="top">
							<?php
							if($user['avatar']) {
								echo '<img src="'.$user[avatar].'" width="200px">'; 
							} else {
								echo '<img src="assets/imgs/avatar.jpg" width="200px">';
							}
							?>
							</td>
							<td valign="top"><b><?php echo $lang['max_file_size']; ?>: 500KB</b><br/><b><?php echo $lang['max_size']; ?>: 200x200</b><br/><b><?php echo $lang['allowed']; ?>: JPEG, PNG</b></td>
						</tr>
						<tr>
							<td colspan="2">
							<form action="" method="POST" enctype="multipart/form-data">
								<input type="file"  name="uploadfile"> <input type="submit" class="btn_small"name="do_upload" value="<?php echo $lang['upload']; ?>" style="padding:2px;">
							</form>
							</td>
						</tr>
					</table>
					</td>
					
					<td class="trans" valign="top" width="50%">
				<span style="font-size:15px;font-weight:bold;color:#1E7BBB ;"><?php echo $lang['password']; ?></span><br/>
					<br>
					<?php
					if(isset($_POST['do_update'])) {
						$cpasswd = protect($_POST['cpasswd']);
						$cpasswd = md5($cpasswd);
						$npasswd = protect($_POST['npasswd']);
						$cnpasswd = protect($_POST['cnpasswd']);
						
						if(empty($cpasswd) or empty($npasswd) or empty($cnpasswd)) { echo error($lang['pass_error_1']); }
						elseif($user['passwd'] !== $cpasswd) { echo error($lang['pass_error_2']); }
						elseif($npasswd !== $cnpasswd) { echo error($lang['pass_error_3']); }
						else {
							$passwd = md5($npasswd);
							$update = mysql_query("UPDATE users SET passwd='$passwd' WHERE id='$user[id]'");
							echo success($lang['pass_success']);
						}
					}
					?>
					<form action="" method="POST">
					<table border="0" cellspacing="4" cellpadding="4" width="100%">
						<tr>
							<td><b><?php echo $lang['current_password']; ?></b></td>
							<td><input type="password" class="input" name="cpasswd"></td>
						</tr>
						<tr>
							<td><b><?php echo $lang['new_password']; ?></b></td>
							<td><input type="password" class="input" name="npasswd"></td>
						</tr>
						<tr>
							<td><b><?php echo $lang['confirm_password']; ?></b></td>
							<td><input type="password" class="input" name="cnpasswd"></td>
						</tr>
						<tr>
							<td colspan="2" style="padding-top:20px;" align="center">
								<input type="submit" name="do_update" class="btn_small" value="<?php echo $lang['update']; ?>">
							</td>
						</table>
					</table>
					</form>
					</td>
				</tr>
			</table>
                     
                  </section>
				  

    </body>
</html>