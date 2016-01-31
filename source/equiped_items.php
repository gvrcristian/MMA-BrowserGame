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
						$id_user=$user['id'];
						if(isset($_GET['id_item']))
						{
							$id_item=(int)$_GET['id_item'];
							$query = mysql_query("SELECT * FROM items WHERE id='$id_item'");
							$row = mysql_fetch_array($query);
							$new_power=$row['power'];
							$new_fastness=$row['fastness'];
							$new_agility=$row['agility'];
							$new_energy=$row['energy'];
							$new_endurance=$row['endurance'];
							$money=$row['price'];
							$type=$row['type'];
							if($type=1)
							{
								$update_equipment=mysql_query("UPDATE users SET gloves=0 WHERE id='$id_user'");
								$update_equip_table=mysql_query("DELETE FROM items_equiped WHERE id_item=$id_item AND id_user='$id_user';");
								$update_stats=mysql_query("UPDATE users SET power=power-$new_power, fastness=fastness-$new_fastness, agility=agility-$new_agility, energy=energy-$new_energy, endurance=endurance-$new_endurance WHERE id='$id_user'");
							}else if($type=2)
							{
								$update_equipment=mysql_query("UPDATE users SET shorts=0 WHERE id='$id_user'");
								$update_equip_table=mysql_query("DELETE FROM items_equiped WHERE id_item=$id_item AND id_user='$id_user';");
								$update_stats=mysql_query("UPDATE users SET power=power-$new_power, fastness=fastness-$new_fastness, agility=agility-$new_agility, energy=energy-$new_energy, endurance=endurance-$new_endurance WHERE id='$id_user'");
							}
						}
			?>
		<table border="0" cellspacing="2" cellpadding="2" class="trans" width="100%">
				<tr>
			
						<?php
						$sql1 = mysql_query("SELECT gloves, shorts FROM users WHERE id='$_SESSION[user_id]'");
						$row = mysql_fetch_array($sql1);
						if($row['gloves']==0)
							echo '<b>You have no gloves equiped!</b><br>';
							else
						{
							 echo '	<td width="20%" class="hll" valign="top">';
							$gloves_id = mysql_query("select id_item from items_equiped where id_user='$_SESSION[user_id]' and type='1'");
							$row_gloves_id = mysql_fetch_array($gloves_id);
							$id_gloves=$row_gloves_id['id_item'];
							$gloves_info=mysql_query("select * from items where id=$id_gloves");
							$row_gloves_info=mysql_fetch_array($gloves_info);
							if (isset($row_gloves_info['img']))
								{$img = $row_gloves_info['img'];}
							else{ $img = 'assets/imgs/items_default.png';}
							echo '<img src='. $img .'>';
						?>	
							
							<?php echo "Power: +"; echo $row_gloves_info['power']; ?><br>
							<?php echo "Agility: +"; echo $row_gloves_info['agility']; ?><br>
							<?php echo " Endurance: +"; echo $row_gloves_info['endurance']; ?><br>
							<?php echo " Energy: +"; echo $row_gloves_info['energy']; ?><br>
							<?php echo " Fastness: +"; echo $row_gloves_info['fastness']; ?><br>
							<?php echo " <a href='{$_SERVER['REQUEST_URI']}&id_item=$id_gloves'>UNEQUIP</a>";
							
						}
						?>
						</td>
						
					
						<?php
						if($row['shorts']==0)
						 echo '<b>You have no shorts equiped!</b><br><br>';
						else
						{ 		 echo '	<td width="20%" class="hll" valign="top">';
							$shorts_id = mysql_query("select id_item from items_equiped where id_user='$_SESSION[user_id]' and type='2'");
							$row_shorts_id = mysql_fetch_array($shorts_id);
							$id_shorts=$row_shorts_id['id_item'];
							$shorts_info=mysql_query("select * from items where id=$id_shorts");
							$row_shorts_info=mysql_fetch_array($shorts_info);
							if (isset($row_shorts_info['img']))
								{$img = $row_shorts_info['img'];}
							else{ $img = 'assets/imgs/items_default.png';}
							echo '<img src='. $img .'><br>';
						?>
						
							<?php echo "Power: +"; echo $row_shorts_info['power']; ?><br>
							<?php echo "Agility: +"; echo $row_shorts_info['agility']; ?><br>
							<?php echo " Endurance: +"; echo $row_shorts_info['endurance']; ?><br>
							<?php echo " Energy: +"; echo $row_shorts_info['energy']; ?><br>
							<?php echo " Fastness: +"; echo $row_shorts_info['fastness']; ?><br>
							<?php echo " <a href='{$_SERVER['REQUEST_URI']}&id_item=$id_shorts'>UNEQUIP</a>";
					
						}?>
					
						
						</td>
						<td width="60%" valign="top">
						</td>
						</tr>
						</table>
											
							
                     
                  </section>
				  

    </body>
</html>