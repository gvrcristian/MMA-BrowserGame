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
			echo " <a href='{$_SERVER['REQUEST_URI']}&item_type=1'>GLOVES||</a> ";
			echo " <a href='{$_SERVER['REQUEST_URI']}&item_type=2'>SHORTS||</a> ";
			echo " <a href='{$_SERVER['REQUEST_URI']}&item_type=3'>DRINKS</a><br> ";
			echo '<b>Money:'.$user['money'];
			echo '</b>';
			$drink_time=72000;
			
			?>
	<?php  //echipeaza item
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
							if($type==1)
							{	
								if($user['gloves']==0)
								{
									$update_equipment=mysql_query("UPDATE users SET gloves=1 WHERE id='$id_user'");
									$update_equip_table=mysql_query("INSERT items_equiped (id_item,id_user,type) VALUES ($id_item, $id_user,$type)");
									$update_stats=mysql_query("UPDATE users SET power=power+$new_power, fastness=fastness+$new_fastness, agility=agility+$new_agility, energy=energy+$new_energy, endurance=endurance+$new_endurance, money=money-$money WHERE id='$id_user'");
									Header("Location: ./?m=shop&item_type=1");
								}
							}
							else if($type==2)
							{	
								if($user['shorts']==0)
								{
									$update_equipment=mysql_query("UPDATE users SET shorts=1 WHERE id='$id_user'");
									$update_equip_table=mysql_query("INSERT items_equiped (id_item,id_user,type) VALUES ($id_item, $id_user,$type)");
									$update_stats=mysql_query("UPDATE users SET power=power+$new_power, fastness=fastness+$new_fastness, agility=agility+$new_agility, energy=energy+$new_energy, endurance=endurance+$new_endurance, money=money-$money WHERE id='$id_user'");
									Header("Location: ./?m=shopt&item_type=2");
								}
							}
							else if($type==3)
							{	
								if($user['drink_end_time']==0)
								{
									$time=time();
									$update_equipment=mysql_query("UPDATE users SET drink_end_time='$time'+'$drink_time' WHERE id='$id_user'");
									$update_equip_table=mysql_query("INSERT items_equiped (id_item,id_user,type) VALUES ($id_item, $id_user,$type)");
									$update_stats=mysql_query("UPDATE users SET power=power+$new_power, fastness=fastness+$new_fastness, agility=agility+$new_agility, energy=energy+$new_energy, endurance=endurance+$new_endurance, money=money-$money WHERE id='$id_user'");
									Header("Location: ./?m=shop&item_type=3");
								}
							}
						}
						if(isset($_GET['item_type']))
							$item_type=$_GET['item_type'];
						else $item_type=1;
						if($item_type==3) 
							{echo '<b>You need to wait '.expire($user['drink_end_time']).' until you can buy a new drink</b><br>';}			
						// find out how many rows are in the table 
						$sql = "SELECT COUNT(id) FROM items WHERE type=$item_type";
						$result = mysql_query($sql) or trigger_error("SQL", E_USER_ERROR);
						$r = mysql_fetch_row($result);
						$numrows = $r[0];

						// number of rows to show per page
						$rowsperpage = 6;
						// find out total pages
						$totalpages = ceil($numrows / $rowsperpage);

						// get the current page or set a default
						if (isset($_GET['currentpage']) && is_numeric($_GET['currentpage'])) {
   						// cast var as int
   						$currentpage = (int) $_GET['currentpage'];
						} else {
   						// default page num
   						$currentpage = 1;
						} // end if

						// if current page is greater than total pages...
						if ($currentpage > $totalpages) {
   						// set current page to last page
   						$currentpage = $totalpages;
						} // end if
						// if current page is less than first page...
						if ($currentpage < 1) {
   						// set current page to first page
   						$currentpage = 1;
						} // end if

						// the offset of the list, based on current page 
						$offset = ($currentpage - 1) * $rowsperpage;

						// get the info from the db 
						$sql = "SELECT * FROM items WHERE type=$item_type ORDER BY price LIMIT $offset, $rowsperpage";
						$result = mysql_query($sql) or trigger_error("SQL", E_USER_ERROR);
						if($user['drink_end_time']!=0 && $user['drink_end_time']<=time())
						{
							$query = mysql_query("SELECT id_item FROM items_equiped WHERE id_user='$id_user' AND type=3;") ;
							$row = mysql_fetch_array($query);
							$query1=mysql_query("SELECT * FROM items WHERE id=$row[id_item]");
							$row1=mysql_fetch_array($query1);
							$new_power=$row1['power'];
							$new_fastness=$row1['fastness'];
							$new_agility=$row1['agility'];
							$new_energy=$row1['energy'];
							$new_endurance=$row1['endurance'];
							$type=$row1['type'];
							$delete_equip_table=mysql_query("DELETE FROM items_equiped where id_item='$row1[id]'");
							$set_to_0_end_time=mysql_query("UPDATE users SET power=power-'$new_power', fastness=fastness-'$new_fastness', agility=agility-'$new_agility', energy=energy-'$new_energy', endurance=endurance-'$new_endurance', drink_end_time=0 WHERE id='$id_user'");
							Header("Location: ./?m=shop&id_item=3");
						}
						if($item_type==1)
							$user_item=$user['gloves'];
						elseif($item_type==2){
							$user_item=$user['shorts'];}
						else
							$user_item=$user['drink_end_time'];
						// while there are rows to be fetched...
							echo '<table>';
							$j=0;
						while ($list = mysql_fetch_array($result)) {
   						// echo data
						$id_item=$list['id'];
						$img=$list['img'];
						if(!$img)
						{$img = 'assets/imgs/items_default.png';}
						if($j==0){echo '<tr>';}
						$j++;
						echo '<td width="20%" valign="top" class="hll">'
							?>
							<?php  echo '<b>'.$list['name'].'</b>';  ?><br>
							<?php echo '<img src='. $img .'>';?><br>
							<?php echo "Power: +"; echo $list['power']; ?><br>
							<?php echo "Agility: +"; echo $list['agility']; ?><br>
							<?php echo " Endurance: +"; echo $list['endurance']; ?><br>
							<?php echo " Energy: +"; echo $list['energy']; ?><br>
							<?php echo " Fastness: +"; echo $list['fastness']; ?><br>
								<?php
								if($user_item==0)
								{
									if($list['status']==1)
									{
										if($user['money'] >= $list['price']) 
											echo "<a href='{$_SERVER['REQUEST_URI']}&id_item=$id_item'><b>BUY</b></a><br>";
										else 
											echo "<b>You don't have enough money!</b><br>";
									}  else if($user['premium']==1)
										{
											if($user['money'] >= $list['price']) 
												echo " <a href='{$_SERVER['REQUEST_URI']}&id_item=$id_item'><b>BUY</b></a><br>";
											else echo "<b>You don't have enough money!</b><br>";
										}else echo "<b>You need a <i>PREMIUM</i> account to buy this item!</b><br>";
								}else echo "<b>You already have an item from this category!</b><br>";
								echo '</td>';
								if($j==2){$j=0; }
								echo '</br>';
						} // end while
						
					
						echo '<td width="60%" valign="top">';
						echo '</td>';
						echo '</tr>';
						
						echo '</table>';

/******  build the pagination links ******/
// range of num links to show
$range = 3;

// if not on page 1, don't show back links
if ($currentpage > 1) {
   // show << link to go back to page 1
   echo " <a href='{$_SERVER['REQUEST_URI']}&currentpage=1'><<</a> ";
   // get previous page num
   $prevpage = $currentpage - 1;
   // show < link to go back to 1 page
   echo " <a href='{$_SERVER['REQUEST_URI']}&currentpage=$prevpage'><</a> ";
} // end if 

// loop to show links to range of pages around current page
for ($x = ($currentpage - $range); $x < (($currentpage + $range) + 1); $x++) {
   // if it's a valid page number...
   if (($x > 0) && ($x <= $totalpages)) {
      // if we're on current page...
      if ($x == $currentpage) {
         // 'highlight' it but don't make a link
         echo " [<b>$x</b>] ";
      // if not current page...
      } else {
         // make it a link
         echo " <a href='{$_SERVER['REQUEST_URI']}&currentpage=$x'>$x</a> "; //request_uri->am încercat și cu asta...
      } // end else
   } // end if 
} // end for
                 
// if not on last page, show forward and last page links        
if ($currentpage != $totalpages) {
   // get next page
   $nextpage = $currentpage + 1;
    // echo forward link for next page 
   echo " <a href='{$_SERVER['REQUEST_URI']}&currentpage=$nextpage'>></a> ";
   // echo forward link for lastpage
   echo " <a href='{$_SERVER['REQUEST_URI']}&currentpage=$totalpages'>>></a> ";
} // end if
/****** end build pagination links ******/
			?>
										



                     
                  </section> 
				  

    </body>
</html>