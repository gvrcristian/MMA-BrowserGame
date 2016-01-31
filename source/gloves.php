<?php
/**
* @author FightMMA
* @copyright 2015 FightMMA All rights reserved.
*/
if(!$_SESSION['usern']) { header("Location: ./"); }
$j=1;
?>
<html dir="ltr" lang="en-US" xmlns="http://www.w3.org/1999/xhtml">


    <body>

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
	

						<?php
						//stiu ca aici fac niste teste care teoretic sunt in plus, dar nu stiu de ce m-am gandit ca totusi ar fi bine sa 
						//sa le fac. Daca crezi ca incetinesc prea mult rularea, poti sa le scoti. sau imi zici si le scot eu
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
								}
							}
						}
						
// find out how many rows are in the table 
$sql = "SELECT COUNT(id) FROM items";
$result = mysql_query($sql) or trigger_error("SQL", E_USER_ERROR);
$r = mysql_fetch_row($result);
$numrows = $r[0];

// number of rows to show per page
$rowsperpage = 5;
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
$sql = "SELECT id,name, img, price FROM items ORDER BY min_level LIMIT $offset, $rowsperpage";
$result = mysql_query($sql) or trigger_error("SQL", E_USER_ERROR);

// while there are rows to be fetched...
while ($list = mysql_fetch_assoc($result)) {
   // echo data
		$id_item=$list['id'];
		$img = $list['img'];
		echo '<img src='. $img .'>';
   		echo '<div class="player_list"><span style="font-size:18px"><b>'.$list['name'].'</div><br><br> ';
		if($user['gloves']==0)
		{
			if($user['money'] >= $list['price']) 
				echo " <a href='{$_SERVER['REQUEST_URI']}&id_item=$id_item'>BUY";
			else 
				echo "You don't have enough money!";
		}
		else{ echo "You already have an item from this category!";}
		echo "<br>";
} // end while

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